<?php

namespace App\Models\Structure;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class CriminalRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'reason',
        'date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }
}
