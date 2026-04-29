<?php
namespace App\Models\Structure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Permission extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'description'];
    // Permission → Roles
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'permission_role');
    }
}
