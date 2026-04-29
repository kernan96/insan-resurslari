<?php
namespace App\Models\Structure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Military extends Model
{
    use HasFactory;
     protected $fillable = [
        'user_id',
        'military_type_id',
        'rank',
        'position',
        'service_date'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function militaryType()
    {
        return $this->belongsTo(MilitaryType::class);
    }
    public function getServiceDateAttribute($value)
{
    return $value ? Carbon::parse($value)->format('Y-m-d') : null;
}
}
