<?php
namespace App\Models\Structure;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class PhoneType extends Model
{
    use HasFactory;
     protected $fillable = ['name'];

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }
}
