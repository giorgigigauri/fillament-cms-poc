<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentEntry extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $casts = [
        'fields' => 'array'
    ];
    public function type()
    {
        return $this->belongsTo(ContentType::class, 'content_type_id');
    }

}
