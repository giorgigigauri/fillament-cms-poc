<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentType extends Model
{
    use HasFactory;
    public function entries()
    {
        return $this->hasMany(ContentEntry::class);
    }

}
