<?php
namespace App\Models\Structure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class AwardType extends Model
{
     use HasFactory;
    protected $table = 'award_types';
    protected $fillable = [
        'name',
    ];
    public function userAwards()
    {
        return $this->hasMany(UserAward::class);
    }
}
