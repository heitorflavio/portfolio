<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use App\Models\Translation;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class PortfolioController extends Controller
{
    /**
     * Exibe a página de portfólio.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $language = Session::get('locale') ?? App::getLocale();
        
        // Carregar projetos com suas traduções
        $projects = Project::with(['translations' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->get();

        $projects = $projects->map(function ($project) {
            return [
                'title' => $project->translations->first()->title ?? '',
                'description' => $project->translations->first()->description ?? '',
                'image' => $project->image,
                'link' => $project->link,
            ];
        });

        // Carregar habilidades com suas traduções
        $skills = Skill::with(['translations' => function ($query) use ($language) {
            $query->where('language', $language);
        }])->get();

        $skills = $skills->map(function ($skill) {
            return [
                'title' => $skill->translations->first()->title ?? '',
                'description' => $skill->translations->first()->description ?? '',
            ];
        });
        
        // Definir outras informações do portfólio (ex: descrição, sobre mim, etc.)
        $aboutMe = Translation::where('translatable_type', 'about_me')
            ->where('language', $language)
            ->first();

        // Retornar dados para a view usando Inertia.js
        return Inertia::render('Portfolio', [
            'projects' => $projects,
            'skills' => $skills,
            'aboutMe' => [
                'title' => $aboutMe->title ?? '',
                'description' => $aboutMe->description ?? '',
            ],
            'canLogin' => true,
            'canRegister' => true,
            'laravelVersion' => app()->version(),
            'phpVersion' => phpversion(),
        ]);
    }
}
