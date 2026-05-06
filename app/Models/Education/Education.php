<?php

namespace App\Models\Education;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Structure\User;

class Education extends Model
{
    use HasFactory;
    protected $table = 'education';

    protected $fillable = [
        'org_name',
        'start_date',
        'end_date',
        'major',
        'doc_number',
        'doc_date',
        'doc_path',
        'user_id',
        'education_type_id'
    ];

    // User əlaqəsi
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Education Type əlaqəsi
    public function educationType()
    {
        return $this->belongsTo(EducationType::class);
    }
}
