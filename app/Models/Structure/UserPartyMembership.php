<?php
namespace App\Models\Structure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class UserPartyMembership extends Model
{
    use HasFactory;
    protected $table = 'user_party_memberships';
    protected $fillable = [
        'user_id',
        'party_name',
        'party_short_name',
        'is_member',
        'member_since',
        'ended_at',
        'member_no',
        'note',
    ];
    protected $casts = [
        'is_member'    => 'boolean',
        'member_since'=> 'date',
        'ended_at'     => 'date',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Aktiv üzvlük
    public function scopeActive($query)
    {
        return $query->where('is_member', true);
    }
}
