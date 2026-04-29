<?php
namespace App\Models\Structure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class UserRelative extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'relationship_type_id',
        'full_name',
        'birth_date',
        'birth_place',
        'workplace',
        'position',
        'registered_address',
    ];
    protected $casts = [
        'birth_date' => 'date',
    ];
    // 🔗 User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // 🔗 Relationship Type
    public function relationshipType()
    {
        return $this->belongsTo(RelationshipType::class);
    }
    

    public function getBirthDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('Y-m-d') : null;
    }
}
