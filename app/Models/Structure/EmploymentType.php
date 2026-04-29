<?php
namespace App\Models\Structure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class EmploymentType extends Model
{
    use HasFactory;
    protected $table = 'employment_types';
    protected $fillable = [
        'name',
    ];
    public function userEmployments()
    {
        return $this->hasMany(UserEmployment::class, 'emp_type_id');
    }
}
