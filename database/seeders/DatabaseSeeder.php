<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Translation;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (env('APP_ENV') === 'production') {
        } else {
            $user = User::factory()->create([
                'name' => 'Test User',
                'email' => 'test@example.com',
            ]);

            // Criar 3 projetos para o usuário
            $projects = Project::factory(6)->create();

            foreach ($projects as $project) {
                // Criar traduções para cada projeto
                Translation::factory()->create([
                    'translatable_id' => $project->id,
                    'translatable_type' => Project::class,
                    'language' => 'en',
                    'title' => 'CRM System',
                    'description' => 'Development of a CRM system.',
                ]);
                Translation::factory()->create([
                    'translatable_id' => $project->id,
                    'translatable_type' => Project::class,
                    'language' => 'pt',
                    'title' => 'Sistema de CRM',
                    'description' => 'Desenvolvimento de um sistema de CRM.',
                ]);
            }

            // Criar 2 habilidades para o usuário
            $skills = Skill::factory(4)->create();

            foreach ($skills as $skill) {
                // Criar traduções para cada habilidade
                Translation::factory()->create([
                    'translatable_id' => $skill->id,
                    'translatable_type' => Skill::class,
                    'language' => 'en',
                    'title' => 'Javascript',
                    'description' => 'Frontend and backend programming logic with JavaScript.',
                ]);
                Translation::factory()->create([
                    'translatable_id' => $skill->id,
                    'translatable_type' => Skill::class,
                    'language' => 'pt',
                    'title' => 'Javascript',
                    'description' => 'Lógica de programação frontend e backend com JavaScript.',
                ]);
            }
        }
    }
}
