<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationType extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function educations()
    {
        return $this->hasMany(Education::class);
    }
}
