<?php

use App\Models\Project;
use App\Models\User;

test('a user can view projects', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->get('/projects');
    $response->assertStatus(200);
});

test('a user can view a project', function () {
    $user = User::factory()->create();
    $project = Project::factory()->create();
    $response = $this->actingAs($user)->get('/projects/' . $project->id);
    $response->assertStatus(200);
});

test('a user can create a project', function () {
    $user = User::factory()->create();
    $response = $this->actingAs($user)->post('/projects', [
        'title' => 'Test Project',
        'description' => 'Test Description',
        'language' => 'en',
        'image' => 'https://test.com',
        'link' => 'https://test.com',
    ]);

    $response->assertStatus(302);
    $this->assertDatabaseHas('projects', [
        'image' => 'https://test.com',
        'link' => 'https://test.com',
    ]);
    $this->assertDatabaseHas('translations', [
        'title' => 'Test Project',
        'description' => 'Test Description',
        'language' => 'en',
    ]);
});

test('a user can update a project', function () {
    $user = User::factory()->create();
    $project = Project::factory()->create();

    $project->translations()->create([
        'title' => 'Test Project',
        'description' => 'Test Description',
        'language' => 'en',
    ]);

    $response = $this->actingAs($user)->put('/projects/' . $project->id, [
        'title' => 'Updated Project',
        'description' => 'Updated Description',
    ]);

    $response->assertStatus(302);
    
    $this->assertDatabaseHas('translations', [
        'title' => 'Updated Project',
        'description' => 'Updated Description',
    ]);
});

test('a user can delete a project', function () {
    $user = User::factory()->create();
    $project = Project::factory()->create();
    $response = $this->actingAs($user)->delete('/projects/' . $project->id);
    $response->assertStatus(302);
    $this->assertDatabaseMissing('projects', [
        'id' => $project->id,
    ]);
});