<?php

namespace App\Models\Structure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationDepartment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'organization_type_id',
        'parent_id',
        'is_active',
        'short_name',
        'address',
        'email',
        'fax',
        'phone'
    ];
    public function organizationType()
    {
        return $this->belongsTo(OrganizationType::class, 'organization_type_id');
    }
    public function parent()
    {
        return $this->belongsTo(OrganizationDepartment::class, 'parent_id');
    }
    public function children()
    {
        return $this->hasMany(OrganizationDepartment::class, 'parent_id');
    }
    public function childrenRecursive()
    {
        return $this->children()->with(['childrenRecursive', 'organizationType']);
    }
    public function orgPositions()
    {
        return $this->hasMany(OrgPosition::class, 'org_dep_id');
    }
    public function positions()
    {
        return $this->belongsToMany(
            Position::class,
            'org_positions',
            'org_dep_id',
            'position_id'
        );
    }
    public function userEmployments()
    {
        return $this->hasMany(UserEmployment::class, 'organization_id');
    }
}
