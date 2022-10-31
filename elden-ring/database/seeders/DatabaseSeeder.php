<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class   DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
           'name' => 'Test User',
           'email' => 'test@example.com',
        ]);

        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => '$2y$10$n/ZgBZ18ro13zIyvWjR3bulHkfL7p5bswhsvWLQ8EiAr7NtI8CaPq',
            'role' => '1'
        ]);

        Category::create([
            'name'=>'Bleed',
        ]);
        Category::create([
            'name'=>'Faith',
        ]);
        Category::create([
            'name'=>'Magic',
        ]);
        Category::create([
            'name'=>'Dragon',
        ]);
        Category::create([
            'name'=>'Frost',
        ]);
        Category::create([
            'name'=>'Holy',
        ]);
    }
}
