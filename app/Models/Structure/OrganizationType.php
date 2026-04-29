<?php
namespace App\Models\Structure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class OrganizationType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    public function departments()
    {
        return $this->hasMany(OrganizationDepartment::class, 'organization_type_id');
    }
}
