<?php
namespace App\Models\Structure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class OrgPosition extends Model
{
    protected $fillable = [
        'org_dep_id',
        'position_id',
    ];
    public function organizationDepartment()
    {
        return $this->belongsTo(OrganizationDepartment::class, 'org_dep_id');
    }
    public function position()
    {
        return $this->belongsTo(Position::class, 'position_id');
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
