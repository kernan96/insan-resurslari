<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComputerSkill extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'key_words'
    ];

    public function computerKnowledges()
    {
        return $this->hasMany(ComputerKnowledge::class);
    }
}
