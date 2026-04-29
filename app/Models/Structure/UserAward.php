<?php
namespace App\Models\Structure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class UserAward extends Model
{
    use HasFactory;
    protected $table = 'user_awards';
    protected $fillable = [
        'user_id',
        'award_name',
        'award_type_id',
        'given_by',
        'given_at',
        'certificate_no',
        'note',
    ];
    protected $casts = [
        'given_at' => 'date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function awardType()
    {
        return $this->belongsTo(AwardType::class);
    }
}
