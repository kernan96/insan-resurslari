<?php
namespace App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Structure\User;
class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'document_type_id',
        'title',
        'doc_no',
        'issued_at',
        'valid_from',
        'valid_to',
        'file_path',
        'original_name',
        'mime_type',
        'file_size',
        'is_active',
    ];
    protected $casts = [
        'issued_at' => 'date',
        'valid_from' => 'date',
        'valid_to' => 'date',
        'is_active' => 'boolean',
    ];
    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }
}