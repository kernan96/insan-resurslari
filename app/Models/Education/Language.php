<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
   protected $fillable = ['name', 'key_words', 'code'];

    public function userLanguages()
    {
        return $this->hasMany(UserLanguage::class);
    }
}
