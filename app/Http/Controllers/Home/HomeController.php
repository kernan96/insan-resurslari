<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Structure\OrganizationDepartment;
use App\Models\Structure\User;

class HomeController extends Controller
{
    public function index()
    {
        // Mövcud kod...
        $parentOrgs = OrganizationDepartment::whereIn('organization_type_id', [1, 2])->get();
        $Organizations = [];

        foreach ($parentOrgs as $parentOrg) {
            $childrenToInclude = $this->getChildrenExcludingTypes($parentOrg, [1, 2]);

            $userCount = $this->countActiveUsers($parentOrg);

            foreach ($childrenToInclude as $child) {
                $userCount += $this->countActiveUsers($child);
            }

            $Organizations[] = (object) [
                'name' => $parentOrg->name,
                'user_count' => $userCount,
            ];
        }

        $allUsersCount = User::whereHas('activeEmployment')->count();

        // YENİ: Müddəti bitmək üzrə olan müqavilələr
        $expiringUsers = $this->expiringContracts();

        return view('pages.home.home', compact('Organizations', 'allUsersCount', 'expiringUsers'));
    }

    /**
     * Recursive olaraq organization_type_id qadağan olunanları keçərək alt qurumları yığ
     */
    private function getChildrenExcludingTypes($org, array $excludeTypes, &$result = [])
    {
        foreach ($org->children as $child) {
            if (!in_array($child->organization_type_id, $excludeTypes)) {
                $result[] = $child;
            }
            // Altındakıları da yoxla (iç-içə)
            $this->getChildrenExcludingTypes($child, $excludeTypes, $result);
        }
        return $result;
    }

    /**
     * Verilən qurumun öz orgPositions-larından aktiv işçi sayını hesabla
     */
    private function countActiveUsers($org)
    {
        // Əgər qurum aktiv deyilsə, 0 qaytar
        if (!$org->is_active) {
            return 0;
        }

        $count = 0;
        foreach ($org->orgPositions as $orgPosition) {
            foreach ($orgPosition->users as $user) {
                if ($user->activeEmployment) {
                    $count++;
                }
            }
        }
        return $count;
    }
    /**
     * Müddəti bitmək üzrə olan müqavilələr
     */
    public function expiringContracts()
    {
        $today = now()->startOfDay();
        $thirtyDaysLater = $today->copy()->addDays(30);

        $users = User::whereHas('activeEmployment', function ($query) use ($today, $thirtyDaysLater) {
            $query->where('end_date', '<=', $thirtyDaysLater)
                ->where('end_date', '>=', $today);
        })->whereHas('orgPosition.organizationDepartment', function ($query) {
            $query->where('is_active', true);
        })->with(['activeEmployment', 'orgPosition.organizationDepartment'])->get();

        $users = $users->map(function ($user) use ($today) {
            $endDate = $user->activeEmployment->end_date;
            $remainingDays = $today->diffInDays($endDate, false);

            // Status təyini
            if ($remainingDays < 10) {
                $status = ['text' => 'Təcili', 'class' => 'danger'];
            } elseif ($remainingDays < 20) {
                $status = ['text' => 'Yaxınlaşır', 'class' => 'warning'];
            } else {
                $status = ['text' => 'İzləmədə', 'class' => 'info'];
            }

            return (object) [
                'id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'department_name' => $user->orgPosition->organizationDepartment->name ?? '-',
                'end_date' => $endDate,
                'remaining_days' => $remainingDays,
                'status_text' => $status['text'],
                'status_class' => $status['class'],
            ];
        });

        return $users;
    }
}
