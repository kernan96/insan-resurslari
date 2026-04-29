<?php
namespace App\Models\Structure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Phone extends Model
{
    use HasFactory;
    
      protected $fillable = [
        'user_id',
        'phone_type_id',
        'number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function phoneType()
    {
        return $this->belongsTo(PhoneType::class);
    }
}
