<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Structure\User;

class AcademicDegree extends Model
{
    use HasFactory;
     protected $fillable = [
        'given_date',
        'given_org',
        'doc_number',
        'doc_date',
        'user_id',
        'academic_type_id'
    ];

    // User əlaqəsi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Academic Type əlaqəsi
    public function academicType()
    {
        return $this->belongsTo(AcademicType::class);
    }
}
