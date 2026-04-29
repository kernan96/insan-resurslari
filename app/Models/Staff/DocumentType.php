<?php
namespace App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class DocumentType extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'input_name',
        'icon_class',
        'description',
        'is_multiple',
    ];
    protected $casts = [
        'is_multiple' => 'boolean',
    ];
    // Relation to documents
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
