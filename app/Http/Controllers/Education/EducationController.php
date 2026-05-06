<?php

namespace App\Http\Controllers\Education;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Structure\OrgDepartmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

use App\Models\Education\EducationType;
use App\Models\Structure\OrganizationType;
use App\Models\Structure\OrganizationDepartment;
use App\Models\Structure\OrgPosition;
use App\Models\Structure\EmploymentType;
use App\Models\Structure\UserEmployment;
use App\Models\Structure\OldUserEmployment;
use App\Models\Structure\UserAward;
use App\Models\Structure\AwardType;
use App\Models\Structure\UserPartyMembership;
use App\Models\Structure\Position;
use App\Models\Structure\User;
use App\Models\Structure\Role;
use App\Models\Structure\Military;
use App\Models\Structure\MilitaryType;
use App\Models\Structure\NameChange;
use App\Models\Structure\Phone;
use App\Models\Structure\PhoneType;
use App\Models\Structure\RelationshipType;
use App\Models\Structure\UserRelative;
use App\Models\Structure\CriminalRecord;
use App\Models\Staff\DocumentType;
use App\Models\Staff\Document;
use App\Http\Requests\StoreDocumentRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpWord\TemplateProcessor;


class EducationController extends Controller
{
    public function getEducationTypes()
    {
        $types = EducationType::where('id', '<', 6)
            ->select('id', 'name')
            ->get();

        return response()->json($types);
    }
}
