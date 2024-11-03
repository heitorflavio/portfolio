<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    protected $fillable = ['translatable_type', 'translatable_id', 'language', 'title', 'description'];

    // Relacionamento inverso, morfável para projects ou skills
    public function translatable()
    {
        return $this->morphTo();
    }
}
