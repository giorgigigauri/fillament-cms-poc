<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentManager extends Model
{
    use HasFactory;
    protected $fillable = ['page_id', 'content'];
    protected $casts = [
        'content' => 'array'
    ];
    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }

}
