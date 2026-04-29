<?php
namespace App\Models\Structure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class NameChange extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'old_first_name',
        'old_last_name',
        'old_father_name',
        'reason',
        'date',
    ];
    // Bu modelin bir istifadəçi ilə əlaqəsi var
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
