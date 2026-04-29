<?php
namespace App\Models\Structure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class RelationshipType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    // 🔗 Relatives
    public function userRelatives()
    {
        return $this->hasMany(UserRelative::class);
    }
}
