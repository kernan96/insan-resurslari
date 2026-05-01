<?php

namespace App\Http\Controllers\Structure;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Requests\StoreEmploymentRequest;
use App\Models\Structure\OrganizationType;
use App\Models\Structure\OrganizationDepartment;
use App\Models\Structure\OrgPosition;
use App\Models\Structure\EmploymentType;
use App\Models\Structure\UserEmployment;
use App\Models\Structure\UserAward;
use App\Models\Structure\AwardType;
use App\Models\Structure\UserPartyMembership;
use App\Models\Structure\Position;
use App\Models\Structure\User;
use App\Models\Structure\Role;
use App\Models\Structure\NameChange;
use App\Models\Structure\CriminalRecord;
use App\Models\Structure\Military;
use App\Models\Structure\Phone;
use App\Models\Structure\OldUserEmployment;
use App\Models\Structure\UserRelative;
use Illuminate\Support\Facades\Schema;

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\TemplateProcessor;

class OrgDepartmentController extends Controller
{
    public function index(Request $request)
    {
        //Organization types (select üçün)
        $types = OrganizationType::orderBy('id')->get();
        $trees = OrganizationDepartment::with([
            'organizationType',
            'childrenRecursive' => function ($q) {
                $q->with('organizationType')->orderBy('name');
            },
        ])
            ->whereNull('parent_id')
            // ->orderBy('name')
            ->get(['id', 'name', 'organization_type_id', 'parent_id', 'is_active', 'short_name', 'email', 'address', 'fax', 'phone']);
        $parents = OrganizationDepartment::orderBy('organization_type_id')
            ->get(['id', 'name', 'organization_type_id', 'parent_id', 'is_active']);
        $trees = $this->sortTreeByOrgType($trees);
        return view('pages.structure.structure', compact('types', 'trees', 'parents'));
    }
    // Metod
    private function sortTreeByOrgType($nodes)
    {
        // Əvvəlcə cari səviyyəni organization_type_id-ə görə sırala (1,2,3 artan)
        $sorted = $nodes->sortBy(function ($node) {
            return $node->organization_type_id;
        });
        // Hər bir node-un uşaqlarını da sırala
        foreach ($sorted as $node) {
            if ($node->childrenRecursive && $node->childrenRecursive->count()) {
                $node->childrenRecursive = $this->sortTreeByOrgType($node->childrenRecursive);
            }
        }
        return $sorted;
    }
    public function store(Request $request)
    {
        try {
            $department = OrganizationDepartment::create([
                'name' => $request->name,
                'organization_type_id' => $request->organization_type_id,
                'parent_id' => $request->parent_id ?: null,
                'is_active' => true,
                'short_name' => $request->short_name,
                'address' => $request->address,
                'email' => $request->email,
                'fax' => $request->fax,
                'phone' => $request->phone,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Uğurla yadda saxlanıldı',
                'id' => $department->id
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi'
            ]);
        }
    }
    public function update(Request $request)
    {
        try {
            $org = OrganizationDepartment::findOrFail($request->org_id);
            $org->update([
                'name' => $request->name,
                'organization_type_id' => $request->organization_type_id,
                'short_name' => $request->short_name,
                'address' => $request->address,
                'email' => $request->email,
                'fax' => $request->fax,
                'phone' => $request->phone,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Uğurla yeniləndi',
                'node' => [
                    'id' => $org->id,
                    'name' => $org->name,
                    'organization_type_id' => $org->organization_type_id,
                    'type_name' => $org->organizationType->name ?? '-',
                    'short_name' => $org->short_name,
                    'address' => $org->address,
                    'email' => $org->email,
                    'fax' => $org->fax,
                    'phone' => $org->phone
                ]
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi'
            ]);
        }
    }
    public function change(Request $request)
    {
        $node = OrganizationDepartment::findOrFail($request->id);
        // 0 → 1 / 1 → 0 toggle
        $node->is_active = $node->is_active == 1 ? 0 : 1;
        $node->save();
        return response()->json([
            'success' => true,
            'status' => $node->is_active,
            'message' => $node->is_active ? 'Aktiv edildi' : 'Deaktiv edildi'
        ]);
    }
    public function employee(Request $request)
    {
        $id = $request->id; // request('id') də olar
        // OrganizationDepartment tap
        $org_dep = OrganizationDepartment::findOrFail($id);
        // Organization types (select üçün)
        $types = OrganizationType::orderBy('id')->get();
        // OrgPosition-lar (org_dep_id ilə)
        $org_pos = OrgPosition::where('org_dep_id', $org_dep->id)->get();
        $employmentTypes = EmploymentType::select('id', 'name')->get();
        // OrgPosition -> position_id-ləri götür, Position-ları tap
        $positionIds = $org_pos->pluck('position_id')->unique()->values();
        $positions = Position::whereIn('id', $positionIds)
            ->orderBy('name')
            ->get(['id', 'name']); // lazım olan sahələr
        $allPositions = Position::orderBy('name')
            ->get(['id', 'name']);
        // ✅ 1) Bu şöbənin OrgPosition id-ləri
        $orgPosIds = $org_pos->pluck('id')->values();
        // ✅ 2) Orden award_type_id (AwardType.name = 'Orden')
        $ordenTypeId = AwardType::where('name', 'Orden')->value('id'); // yoxdursa null ola bilər
        // ✅ 3) Employees (User-lar) + lazım olan sahələr
        $employees = User::query()
            ->select([
                'id',
                'first_name',
                'last_name',
                'father_name',
                'fin',
                'gender',
                'birth_date',
                'username',
                'name',
                'email',
                'email_verified_at',
                'password',
                'role_id',
                'org_position_id',
                'remember_token',
                'created_at',
                'updated_at',
                'profile_photo_path',
                'registered_address',
                'residential_address',
                'birth_place',
                'citizen',
                'serial_no',
                'sin',
                'note',
                'marital_status',
            ])
            ->whereIn('org_position_id', $orgPosIds)
            ->with([
                // Active employment (status=1)
                'employments' => function ($q) {
                    $q->select(
                        'id',
                        'user_id',
                        'salary',
                        'start_date',
                        'end_date',
                        'status',
                        'emp_type_id',
                        'ended_date',
                        'contract_no',
                        'note',
                    )
                        ->where('status', true)
                        ->latest('start_date');
                },
                // Party membership (active)
                'partyMemberships' => function ($q) {
                    $q->select('id', 'user_id', 'party_short_name', 'is_member', 'member_since')
                        ->where('is_member', true)
                        ->latest('member_since');
                },
            ])
            ->get();
        // ✅ 4) Orden bool və award var/yox hesabla (UserAward üzərindən)
        $userIds = $employees->pluck('id');
        // Ümumi mükafat var?
        $hasAnyAwardUserIds = UserAward::whereIn('user_id', $userIds)
            ->pluck('user_id')
            ->unique()
            ->flip(); // quick lookup
        // Orden var?
        $hasOrdenUserIds = collect();
        if ($ordenTypeId) {
            $hasOrdenUserIds = UserAward::whereIn('user_id', $userIds)
                ->where('award_type_id', $ordenTypeId)
                ->pluck('user_id')
                ->unique()
                ->flip();
        }
        // ✅ 5) İstədiyin əlavə field-ləri employees collection-a yapışdır
        $employees->transform(function ($u) use ($hasAnyAwardUserIds, $hasOrdenUserIds) {
            // Active employment (1-ci record)
            $activeEmp = $u->employments->first();
            $u->salary = $activeEmp?->salary;
            $u->start_date = $activeEmp?->start_date;
            $u->end_date = $activeEmp?->end_date;
            // Party short name (active)
            $party = $u->partyMemberships->first();
            $u->party_short_name = $party?->party_short_name;
            // Orden bool
            $u->ordenbool = isset($hasOrdenUserIds[$u->id]);
            // Ümumi award var?
            $u->has_award = isset($hasAnyAwardUserIds[$u->id]);
            return $u;
        });
        $roles = Role::select('id', 'name')
            ->orderBy('name')
            ->get();
        return view('pages.structure.structure-employee', compact(
            'types',
            'org_dep',
            'org_pos',
            'positions',
            'allPositions',
            'employees',
            'roles',
            'employmentTypes'
        ));
    }
    public function position_store(Request $request)
    {
        try {
            $position = Position::firstOrCreate([
                'name' => trim($request->name)
            ]);
            $exists = OrgPosition::where('org_dep_id', $request->org_dep_id)
                ->where('position_id', $position->id)
                ->exists();
            if ($exists) {
                return response()->json(['success' => false, 'message' => 'Bu vəzifə artıq mövcuddur!']);
            }
            $orgPos = OrgPosition::create([
                'org_dep_id' => $request->org_dep_id,
                'position_id' => $position->id,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Vəzifə uğurla əlavə edildi!',
                'data' => [
                    'id' => $position->id,
                    'name' => $position->name,
                    'org_pos_id' => $orgPos->id
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Xəta baş verdi!']);
        }
    }
    public function position_update(Request $request)
    {
        try {
            $name = trim($request->position_name);
            $position = Position::whereRaw('BINARY name = ?', [$name])->first();
            if (!$position) {
                $position = Position::create([
                    'name' => $name,
                ]);
            }
            $orgPos = OrgPosition::find($request->org_position_id);
            if ($orgPos) {
                $orgPos->position_id = $position->id;
                $orgPos->save();
            }
            return response()->json([
                'status' => 'success',
                'message' => 'Uğurla göndərildi',
                'name' => $position->name,
                'position_id' => $position->id,
                'orgPos_id' => $orgPos?->id
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(), // 🔥 real xətanı göstərir
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ], 500);
        }
    }
    public function position_delete(Request $request)
    {
        try {
            OrgPosition::findOrFail($request->org_pos_id)->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Uğurla silindi'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Silinmə zamanı xəta baş verdi'
            ], 500);
        }
    }
    public function employee_store(StoreEmployeeRequest $request)
    {
        $data = $request->validated(); // ✅ validated() istifadə edin
        // password hash
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        // USER create və ya update (FIN üzrə)
        $user = User::updateOrCreate(
            ['fin' => $data['fin']],
            [
                'first_name' => $data['first_name'] ?? null,
                'last_name' => $data['last_name'] ?? null,
                'father_name' => $data['father_name'] ?? null,
                'gender' => $data['gender'] ?? null,
                'birth_date' => $data['birth_date'] ?? null,
                'birth_place' => $data['birth_place'] ?? null,
                'citizen' => $data['citizen'] ?? null,
                'serial_no' => $data['serial_no'] ?? null,
                'sin' => $data['sin'] ?? null,
                'marital_status' => $data['marital_status'] ?? null,
                'registered_address' => $data['registered_address'] ?? null,
                'residential_address' => $data['residential_address'] ?? null,
                'username' => $data['username'] ?? null,
                'email' => $data['email'] ?? null,
                'password' => $data['password'] ?? null,
                'role_id' => $data['role_id'] ?? null,
                'org_position_id' => $data['org_position_id'] ?? null,
            ]
        );
        // Profile şəkli yükləmə
        if ($request->hasFile('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs("uploads/{$user->id}", $filename, 'public');
            $user->profile_photo_path = $path;
            $user->save();
        }
        // position_id tap
        $positionId = $user->orgPosition?->position?->id;
        $topOrgDep = $this->findTopOrganizationDepartment($data['org_position_id']);
        // Əvvəlki aktiv işləri deaktiv et
        UserEmployment::where('user_id', $user->id)
            ->where('status', true)
            ->update(['status' => false]);
        // Yeni employment yarat
        $userEmployment = UserEmployment::create([
            'user_id' => $user->id,
            'emp_type_id' => $data['emp_type_id'] ?? null,
            'position_id' => $positionId,
            'salary' => $data['salary'] ?? null,
            'start_date' => $data['start_date'] ?? null,
            'end_date' => $data['end_date'] ?? null,
            'contract_no' => $data['contract_no'] ?? null,
            'organization_id' => $topOrgDep?->id ?? null,
            'status' => true,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Əməkdaş uğurla əlavə edildi.',
            'data' => [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'father_name' => $user->father_name,
                'fin' => $user->fin,
                'gender' => $user->gender,
                'birth_date' => $user->birth_date?->format('Y-m-d'),
                'username' => $user->username,
                'email' => $user->email,
                'role_id' => $user->role_id,
                'org_position_id' => $user->org_position_id,
                'org_position_name' => $user->orgPosition?->position?->name ?? '-',
                'salary' => $userEmployment->salary ?? null,
                'start_date' => $userEmployment->start_date?->format('Y-m-d'),
                'end_date' => $userEmployment->end_date?->format('Y-m-d'),
                'emp_type_id' => $userEmployment->emp_type_id ?? null,
                'contract_no' => $userEmployment->contract_no ?? null,
                'organization_id' => $userEmployment->organization_id ?? null,
                'emp_id' => $userEmployment->id,
                'birth_place' => $user->birth_place,
                'citizen' => $user->citizen,
                'serial_no' => $user->serial_no,
                'sin' => $user->sin,
                'marital_status' => $user->marital_status,
                'registered_address' => $user->registered_address,
                'residential_address' => $user->residential_address,
                'profile_photo_path' => $user->profile_photo_path,
                'note' => $user->note,
            ]
        ]);
    }
    public function employee_update(UpdateEmployeeRequest $request)
    {
        try {
            // USER tap
            $user = User::findOrFail($request->user_id);
            // USER data
            $data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'father_name' => $request->father_name,
                'fin' => $request->fin,
                'gender' => $request->gender,
                'birth_date' => $request->birth_date,
                'birth_place' => $request->birth_place,
                'citizen' => $request->citizen,
                'serial_no' => $request->serial_no,
                'sin' => $request->sin,
                'marital_status' => $request->marital_status,
                'registered_address' => $request->registered_address,
                'residential_address' => $request->residential_address,
                'username' => $request->username,
                'email' => $request->email,
                'role_id' => $request->role_id,
                'org_position_id' => $request->org_position_id,
            ];
            // password
            if (!empty($request->password)) {
                $data['password'] = Hash::make($request->password);
            }
            $user->update($data);
            // şəkil upload
            if ($request->hasFile('profile_photo_path')) {
                // 🔥 köhnə şəkli sil
                if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                    Storage::disk('public')->delete($user->profile_photo_path);
                }
                // yeni şəkil upload
                $file = $request->file('profile_photo_path');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs("uploads/{$user->id}", $filename, 'public');
                $user->profile_photo_path = $path;
                $user->save();
            }
            // EMPLOYMENT update
            $employment = UserEmployment::findOrFail($request->employment_id);
            // $topOrgDep = $this->findTopOrganizationDepartment($data['org_position_id']);
            $positionId = $user->orgPosition?->position?->id;
            $employment->update([
                'emp_type_id' => $request->emp_type_id,
                'position_id' => $positionId,
                'salary' => $request->salary,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'contract_no' => $request->contract_no,
                // 'organization_id'=>$topOrgDep?->id,
            ]);
            // relation reload
            $user->load('orgPosition.position');
            return response()->json([
                'success' => true,
                'message' => 'Əməkdaş uğurla yeniləndi.',
                'data' => [
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'father_name' => $user->father_name,
                    'fin' => $user->fin,
                    'gender' => $user->gender,
                    'birth_date' => $user->birth_date?->format('Y-m-d'),
                    'birth_place' => $user->birth_place,
                    'citizen' => $user->citizen,
                    'serial_no' => $user->serial_no,
                    'sin' => $user->sin,
                    'marital_status' => $user->marital_status,
                    'registered_address' => $user->registered_address,
                    'residential_address' => $user->residential_address,
                    'profile_photo_path' => $user->profile_photo_path,
                    'note' => $user->note,
                    'username' => $user->username,
                    'email' => $user->email,
                    'role_id' => $user->role_id,
                    'org_position_id' => $user->org_position_id,
                    'org_position_name' => $user->orgPosition?->position?->name ?? '-',
                    'salary' => $employment->salary,
                    'start_date' => $employment->start_date?->format('Y-m-d'),
                    'end_date' => $employment->end_date?->format('Y-m-d'),
                    'emp_type_id' => $employment->emp_type_id,
                    'contract_no' => $employment->contract_no,
                    'position_id' => $employment->position_id,
                    'organization_id' => $employment->organization_id,
                    'emp_id' => $employment->id,
                    'emp_note' => $employment->note,
                ]
            ]);
        } catch (\Throwable $e) {
            \Log::error($e);
            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi'
            ], 500);
        }
    }
    public function structure_structure_update(Request $request)
    {
        try {
            $org = OrganizationDepartment::findOrFail($request->org_id);
            $org->update([
                'name' => $request->name,
                'organization_type_id' => $request->organization_type_id,
                'short_name' => $request->short_name,
                'address' => $request->address,
                'email' => $request->email,
                'fax' => $request->fax,
                'phone' => $request->phone,
            ]);
            // type text üçün
            $typeName = OrganizationType::find($request->organization_type_id)?->name ?? '-';
            return response()->json([
                'success' => true,
                'message' => 'Uğurla yeniləndi',
                'data' => [
                    'name' => $request->name,
                    'type' => $typeName,
                    'short_name' => $request->short_name,
                    'address' => $request->address,
                    'email' => $request->email,
                    'fax' => $request->fax,
                    'phone' => $request->phone
                ]
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi'
            ]);
        }
    }
    public function role_update(Request $request)
    {
        try {
            // 1) User tap
            $user = User::findOrFail($request->user_id);
            // 2) Data yığ
            $data = [
                // 'first_name' => $request->first_name,
                // 'last_name' => $request->last_name,
                // 'father_name' => $request->father_name,
                // 'fin' => $request->fin,
                // 'username' => $request->username,
                // 'email' => $request->email ?? null,
                // 'phone' => $request->phone ?? null,
                // 'gender' => (int) $request->gender,
                // 'birth_date' => $request->birth_date ?? null,
                'role_id' => $request->role_id ?? null,
                // 'org_position_id' => $request->org_position_id,
            ];
            $user->update($data);
            return response()->json([
                'success' => true,
                'data' => [
                    'user_id' => $user->id,
                    // 'first_name' => $user->first_name,
                    // 'last_name' => $user->last_name,
                    // 'father_name' => $user->father_name,
                    // 'fin' => $user->fin,
                    // 'username' => $user->username,
                    // 'email' => $user->email,
                    // 'phone' => $user->phone,
                    // 'gender' => $user->gender,
                    // 'org_position_id' => $user->org_position_id,
                    // 'org_position_name' => $user->orgPosition?->position?->name ?? '-',
                    // 'birth_date' => $user->birth_date?->format('Y-m-d') ?? '',
                    'role_id' => $user->role_id,
                ]
            ]);
        } catch (\Throwable $e) {
            \Log::error($e); // səhv log-lanır
            return response()->json([
                'success' => false,
                'message' => 'Xəta baş verdi, yenidən cəhd edin.'
            ], 500);
        }
    }
    public function employee_employment_store(StoreEmploymentRequest $request)
    {

        $data = $request->all();


        $userId = $data['user_id'] ?? null;
        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'User seçilməyib.'
            ]);
        }
        try {
            $positionId = OrgPosition::find($data['org_position_id'])
                ?->position?->id;
            $topOrgDep = $this->findTopOrganizationDepartment($data['org_position_id']);
            // 1️⃣ Mövcud employment-ləri status=false et
            UserEmployment::where('user_id', $userId)
                ->update(['status' => false]);
            // 2️⃣ Yeni employment yarat
            $employment = UserEmployment::create([
                'user_id'      => $userId,
                'emp_type_id'  => $data['emp_type_id'] ?? null,
                'position_id'  => $positionId ?? null,
                'organization_id' => $topOrgDep?->id,
                'salary'       => $data['salary'] ?? null,
                'start_date'   => $data['start_date'] ?? null,
                'end_date'     => $data['end_date'] ?? null,
                'contract_no'  => $data['contract_no'] ?? null,
                'note'         => $data['note'] ?? null,
                'status'       => true, // aktiv employment
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Müqavilə uğurla əlavə edildi.',
                'data' => [
                    'id'           => $employment->id,
                    'salary'       => $employment->salary,
                    'start_date'   => $employment->start_date?->format('Y-m-d'),
                    'end_date'     => $employment->end_date?->format('Y-m-d'),
                    'emp_type_id'  => $employment->emp_type_id,
                    'contract_no'  => $employment->contract_no,
                    'note'         => $employment->note,
                    'position_id'  => $employment->position_id,
                    'organization_id' => $employment->organization_id,
                ]
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server xətası baş verdi!'
            ], 500);
        }
    }
    public function archive_employment(Request $request)
    {
        $employmentId = $request->employment_id;
        if (!$employmentId) {
            return response()->json(['success' => false, 'message' => 'Employment seçilməyib']);
        }
        $employment = UserEmployment::find($employmentId);
        if (!$employment) {
            return response()->json(['success' => false, 'message' => 'Employment tapılmadı']);
        }
        // Statusu false et
        $employment->status = false;
        $employment->save();
        return response()->json(['success' => true]);
    }
    // FİN yoxlama
    public function checkFin(Request $request)
    {
        $fin = $request->fin;
        if (!$fin) {
            return response()->json([
                'exists' => false,
                'message' => 'FİN daxil edilməyib.'
            ]);
        }
        $user = User::where('fin', $fin)->first();
        if ($user) {
            // tapıldı → forma məlumat doldur
            return response()->json([
                'exists' => true,
                'data' => [
                    'username' => $user->username,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'father_name' => $user->father_name,
                    'gender' => $user->gender,
                    'birth_date' => $user->birth_date?->format('Y-m-d'),
                    'email' => $user->email,
                    'phone' => $user->phone,
                ]
            ]);
        } else {
            return response()->json([
                'exists' => false
            ]);
        }
    }
    public function hasPermission($permission)
    {
        // direct permission
        if ($this->permissions()->where('slug', $permission)->exists()) {
            return true;
        }
        // role vasitəsilə
        return $this->roles()
            ->whereHas('permissions', function ($q) use ($permission) {
                $q->where('slug', $permission);
            })->exists();
    }
    public function findTopOrganizationDepartment($orgPositionId)
    {
        $orgPosition = OrgPosition::find($orgPositionId);

        if (!$orgPosition) return null;

        $orgDep = $orgPosition->organizationDepartment;

        while ($orgDep) {
            if (in_array($orgDep->organization_type_id, [1, 2])) {
                return $orgDep;
            }
            $orgDep = $orgDep->parent;
        }

        return null;
    }


    public function staffTable($id)
    {
        $org = OrganizationDepartment::findOrFail($id);

        if (!in_array($org->organization_type_id, [1, 2])) {
            return;
        }
        $root = OrganizationDepartment::with([
            'childrenRecursive',
            'orgPositions.users',
            'orgPositions.position'
        ])->findOrFail($id);


        $result = [];


        // 🔹 recursive filter + collect
        function collectTree($node, &$result, $skip = false)
        {
            // root heç vaxt skip olunmur
            if (!$node->is_active) {
                return;
            }
            $result[] = $node;

            if (
                !$node->childrenRecursive ||
                $node->childrenRecursive->isEmpty()
            ) {
                return;
            }

            foreach ($node->childrenRecursive as $child) {

                // 🔴 yalnız child-lar üçün qərar ver
                $childSkip = $skip;

                if (
                    $child->parent_id !== null &&
                    in_array($child->organization_type_id, [1, 2])
                ) {
                    $childSkip = true; // bu node + altı skip
                }

                if ($childSkip || !$child->is_active) {
                    continue;
                }

                collectTree($child, $result, false);
            }
        }

        collectTree($root, $result);



        $templatePath = storage_path('app/templates/staff_table_temp.docx');

        $template = new TemplateProcessor($templatePath);

        $rows = [];
        foreach ($result as $org) {
            foreach ($org->orgPositions as $orgPos) {
                foreach ($orgPos->users as $user) {

                    if (!$user->activeEmployment) {
                        continue;
                    }

                    $rows[] = [
                        'position' => $orgPos->position->name ?? '-',
                        'full_name' =>
                        $user->last_name . ' ' .
                            $user->first_name . ' ' .
                            $user->father_name
                    ];
                }
            }
        }

        $template->cloneRowAndSetValues('position', $rows);

        $id = $id ?? 'unknown';
        $now = now()->format('d-m-Y-H-i');

        $fileName = "staff_table_{$id}_{$now}.docx";
        $path = storage_path("app/{$fileName}");

        $template->saveAs($path);

        return response()->download($path)->deleteFileAfterSend(true);
    }
}
