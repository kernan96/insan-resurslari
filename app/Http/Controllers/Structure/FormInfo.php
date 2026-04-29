<?php

namespace App\Http\Controllers\Structure;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
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
use App\Models\Structure\PhoneType;
use App\Models\Structure\MilitaryType;
use App\Models\Structure\RelationshipType;
use Carbon\Carbon;





class FormInfo extends Controller
{
    public function handleFormAction(Request $request)
    {
        $action = $request->input('_action'); // 'store', 'update', 'delete'
        $cardType = $request->input('card_type'); // 'relative', 'criminal', 'military', 'phone', 'employment', 'namechange'
        $id = $request->input('id');
        $userId = $request->input('user_id');

        try {
            switch ($action) {
                case 'store':
                    $result = $this->storeItem($cardType, $request, $userId);
                    break;
                case 'update':
                    $result = $this->updateItem($cardType, $request, $id);
                    break;
                case 'delete':
                    $result = $this->deleteItem($cardType, $id);
                    break;
                default:
                    return response()->json(['success' => false, 'message' => 'Yanlış əməliyyat növü'], 400);
            }

            return response()->json(['success' => true, 'data' => $result, 'message' => 'Əməliyyat uğurlu']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    private function storeItem($cardType, $request, $userId)
    {
        switch ($cardType) {
            case 'relative':
                return UserRelative::create([
                    'user_id' => $userId,
                    'relationship_type_id' => $request->relationship_type_id, // DƏYİŞDİ
                    'full_name' => $request->fullname,
                    'birth_date' => $request->birthdate,
                    'workplace' => $request->workplace,
                    'position' => $request->position,
                    'registered_address' => $request->address,
                ]);
            case 'criminal':
                return CriminalRecord::create([
                    'user_id' => $userId,
                    'reason' => $request->reason,
                    'date' => $request->date,
                ]);
            case 'military':
                return Military::create([
                    'user_id' => $userId,
                    'military_type_id' => $request->military_type_id, // DƏYİŞDİ
                    'rank' => $request->rank,
                    'position' => $request->position,
                    'service_date' => $request->serviceDate,
                ]);
            case 'phone':
                return Phone::create([
                    'user_id' => $userId,
                    'phone_type_id' => $request->phone_type_id, // DƏYİŞDİ (əvvəlcə 'type' idi)
                    'number' => $request->number,
                ]);
            case 'employment':
                return OldUserEmployment::create([
                    'user_id' => $userId,
                    'start_date' => $request->start,
                    'end_date' => $request->end,
                    'organization' => $request->org,
                    'position' => $request->position,
                ]);
            case 'namechange':
                return NameChange::create([
                    'user_id' => $userId,
                    'old_first_name' => $request->old_first_name,
                    'old_last_name' => $request->old_last_name,
                    'old_father_name' => $request->old_father_name,
                    'date' => $request->date,
                    'reason' => $request->reason,
                ]);
            default:
                throw new \Exception('Yanlış kart tipi');
        }
    }

    private function updateItem($cardType, $request, $id)
    {
        switch ($cardType) {
            case 'relative':
                $item = UserRelative::findOrFail($id);
                $item->update([
                    'relationship_type_id' => $request->relationship_type_id,
                    'full_name' => $request->fullname,
                    'birth_date' => $request->birthdate,
                    'workplace' => $request->workplace,
                    'position' => $request->position,
                    'registered_address' => $request->address,
                ]);
                return $item;
            case 'criminal':
                $item = CriminalRecord::findOrFail($id);
                $item->update(['reason' => $request->reason, 'date' => $request->date]);
                return $item;
            case 'military':
                $item = Military::findOrFail($id);
                $item->update([
                    'military_type_id' => $request->military_type_id,
                    'rank' => $request->rank,
                    'position' => $request->position,
                    'service_date' => $request->serviceDate,
                ]);
                return $item;
            case 'phone':
                $item = Phone::findOrFail($id);
                $item->update([
                    'phone_type_id' => $request->phone_type_id,
                    'number' => $request->number,
                ]);
                return $item;
            case 'employment':
                $item = OldUserEmployment::findOrFail($id);
                $item->update([
                    'start_date' => $request->start,
                    'end_date' => $request->end,
                    'organization' => $request->org,
                    'position' => $request->position,
                ]);
                return $item;
            case 'namechange':
                $item = NameChange::findOrFail($id);
                $item->update([
                    'old_first_name' => $request->old_first_name,
                    'old_last_name' => $request->old_last_name,
                    'old_father_name' => $request->old_father_name,
                    'date' => $request->date,
                    'reason' => $request->reason,
                ]);
                return $item;
            default:
                throw new \Exception('Yanlış kart tipi');
        }
    }

    private function deleteItem($cardType, $id)
    {
        switch ($cardType) {
            case 'relative':
                $item = UserRelative::findOrFail($id);
                break;
            case 'criminal':
                $item = CriminalRecord::findOrFail($id);
                break;
            case 'military':
                $item = Military::findOrFail($id);
                break;
            case 'phone':
                $item = Phone::findOrFail($id);
                break;
            case 'employment':
                $item = OldUserEmployment::findOrFail($id);
                break;
            case 'namechange':
                $item = NameChange::findOrFail($id);
                break;
            default:
                throw new \Exception('Yanlış kart tipi');
        }
        $item->delete();
        return true;
    }
    public function getAllUserData($userId)
    {
        return response()->json([
            'success' => true,
            'data' => [
                'relative' => UserRelative::where('user_id', $userId)->get(),
                'criminal' => CriminalRecord::where('user_id', $userId)->get(),
                'military' => Military::where('user_id', $userId)->get(),
                'phone' => Phone::where('user_id', $userId)->get(),
                'employment' => OldUserEmployment::where('user_id', $userId)->get(),
                'namechange' => NameChange::where('user_id', $userId)->get(),
            ]
        ]);
    }
    public function getRelationshipTypes()
    {
        try {
            $data = RelationshipType::select('id', 'name')->get();

            return response()->json([
                'success' => true,
                'message' => 'Data successfully fetched',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getMilitaryTypes()
    {
        try {
            $data = MilitaryType::select('id', 'name')->get();

            return response()->json([
                'success' => true,
                'message' => 'Data successfully fetched',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getPhoneTypes()
    {
        try {
            $data = PhoneType::select('id', 'name')->get();

            return response()->json([
                'success' => true,
                'message' => 'Data successfully fetched',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getBirthDateAttribute($value)
    {
        return Carbon::parse($value)->format('Y-m-d');
    }
}
