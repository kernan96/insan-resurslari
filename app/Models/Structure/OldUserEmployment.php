<?php

namespace App\Models\Structure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OldUserEmployment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'start_date',
        'end_date',
        'organization',
        'position',
    ];
    // User əlaqəsi
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getStartDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }

    public function getEndDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }
}
