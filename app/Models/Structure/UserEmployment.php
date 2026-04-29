<?php
namespace App\Models\Structure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class UserEmployment extends Model
{
    use HasFactory;
    protected $fillable = [
        'salary',
        'start_date',
        'end_date',
        'ended_date',
        'status',
        'contract_no',
        'note',
        'user_id',
        'emp_type_id',
        'position_id',
        'organization_id',
    ];
    protected $casts = [
        'salary' => 'decimal:2',
        'start_date' => 'date',
        'end_date' => 'date',
        'ended_date' => 'date',
        'status' => 'boolean',
    ];
    // ================= RELATIONS =================
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function employmentType()
    {
        return $this->belongsTo(EmploymentType::class, 'emp_type_id');
    }
    public function position()
    {
        return $this->belongsTo(Position::class);
    }
     public function organization()
    {
        return $this->belongsTo(OrganizationDepartment::class, 'organization_id');
    }
}
