<?php
namespace App\Models\Structure;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Staff\Document;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'first_name',
        'father_name',
        'last_name',
        'fin',
        'gender',
        'birth_date',
        'email',
        'phone',
        'password',
        'role_id',
        'org_position_id',
        'profile_photo_path',
        'registered_address',
        'residential_address',
        'birth_place',
        'citizen',
        'serial_no',
        'sin',
        'note',
        'marital_status',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'birth_date'        => 'date',
        'password' => 'hashed',
    ];
    public function orgPosition()
    {
        return $this->belongsTo(OrgPosition::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    // User → Roles
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }
    // User → Permissions (optional)
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_user');
    }
    // --- Helper (istəsən istifadə et) ---
    public function getFullNameAttribute(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }
    public function employments()
    {
        return $this->hasMany(UserEmployment::class);
    }
    public function activeEmployment()
    {
        return $this->hasOne(UserEmployment::class)->where('status', true);
    }
    public function awards()
    {
        return $this->hasMany(UserAward::class);
    }
    public function lastAward()
    {
        return $this->hasOne(UserAward::class)->latest('given_at');
    }
    public function partyMemberships()
    {
        return $this->hasMany(UserPartyMembership::class);
    }
    public function activePartyMembership()
    {
        return $this->hasOne(UserPartyMembership::class)
            ->where('is_member', true);
    }
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
    public function relatedUser()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function relatedBy()
    {
        return $this->hasMany(User::class, 'user_id');
    }
    public function militaries()
    {
        return $this->hasMany(Military::class);
    }
    public function criminalRecords()
    {
        return $this->hasMany(CriminalRecord::class);
    }
    // Bu user-in bir neçə name change-ı ola bilər
    public function nameChanges()
    {
        return $this->hasMany(NameChange::class);
    }
    public function oldEmployments()
    {
        return $this->hasMany(OldUserEmployment::class);
    }
    public function relatives()
{
    return $this->hasMany(UserRelative::class);
}
}
