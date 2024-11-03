<?php

use App\Models\Skill;
use App\Models\User;

it('can view any skill', function () {
    $user = User::factory()->create();
    $this->assertTrue($user->can('viewAny', Skill::class));
});

it('can view a skill', function () {
    $user = User::factory()->create();
    $skill = Skill::factory()->create();
    $this->assertTrue($user->can('view', $skill));
});

it('can create a skill', function () {
    $user = User::factory()->create();
    $this->assertTrue($user->can('create', Skill::class));
});

it('can update a skill', function () {
    $user = User::factory()->create();
    $skill = Skill::factory()->create();
    $this->assertTrue($user->can('update', $skill));
});

it('can delete a skill', function () {
    $user = User::factory()->create();
    $skill = Skill::factory()->create();
    $this->assertTrue($user->can('delete', $skill));
});