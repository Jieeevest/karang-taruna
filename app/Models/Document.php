<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'file_name',
        'file_path',
        'file_size',
        'file_type',
    ];

    protected $casts = [
        'file_size' => 'integer',
    ];

    /**
     * Get the user who uploaded this document.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get formatted file size (KB, MB, GB).
     */
    public function getFormattedFileSizeAttribute()
    {
        $bytes = $this->file_size;
        
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' B';
        }
    }

    /**
     * Get file extension.
     */
    public function getFileExtensionAttribute()
    {
        return pathinfo($this->file_name, PATHINFO_EXTENSION);
    }

    /**
     * Get icon class based on file type.
     */
    public function getFileIconAttribute()
    {
        $extension = strtolower($this->file_extension);
        
        $iconMap = [
            'pdf' => 'text-red-600',
            'doc' => 'text-blue-600',
            'docx' => 'text-blue-600',
            'xls' => 'text-green-600',
            'xlsx' => 'text-green-600',
            'ppt' => 'text-orange-600',
            'pptx' => 'text-orange-600',
            'zip' => 'text-purple-600',
            'rar' => 'text-purple-600',
            'txt' => 'text-gray-600',
        ];

        return $iconMap[$extension] ?? 'text-gray-500';
    }
}
