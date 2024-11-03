<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [];

    /**
     * Relacionamento com a tabela de traduções
     * 
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function translations()
    {
        return $this->morphMany(Translation::class, 'translatable');
    }

    /**
     * Função para obter a tradução no idioma atual
     * 
     * @param string $language
     * @return mixed
     */
    public function getTranslation($language = 'pt')
    {
        return $this->translations()->where('language', $language)->first();
    }
}
