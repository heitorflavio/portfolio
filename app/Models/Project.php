<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'link'];

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
     */
    public function getTranslation($language = 'pt')
    {
        return $this->translations()->where('language', $language)->first();
    }
}
