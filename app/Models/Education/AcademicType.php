<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicType extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    // Bir type → çox degree
    public function academicDegrees()
    {
        return $this->hasMany(AcademicDegree::class);
    }
}
