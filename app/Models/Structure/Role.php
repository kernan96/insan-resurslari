<?php
namespace App\Models\Structure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Role extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'description'];
    // Role → Users
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }
    // Role → Permissions
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }
}
