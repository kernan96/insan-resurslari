<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Structure\User;

class UserLanguage extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'language_id',
        'language_level_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function languageLevel()
    {
        return $this->belongsTo(LanguageLevel::class);
    }
}
