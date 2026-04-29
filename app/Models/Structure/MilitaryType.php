<?php

namespace App\Models\Structure;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilitaryType extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function militaries()
    {
        return $this->hasMany(Military::class);
    }
}
