<?php
namespace App\Models\Structure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Position extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    public function orgPositions()
    {
        return $this->hasMany(OrgPosition::class, 'position_id');
    }
    public function organizationDepartments()
    {
        return $this->belongsToMany(
            OrganizationDepartment::class,
            'org_positions',
            'position_id',
            'org_dep_id'
        );
    }
     public function userEmployments()
    {
        return $this->hasMany(UserEmployment::class);
    }
}
