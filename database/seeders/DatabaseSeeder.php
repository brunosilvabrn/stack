<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $categorys = ["JavaScript", "SQL", "Postgresql", "Mongodb", "Mysql", "Banco de Dados", "CSS", "HTML", "Python", "Java", "PHP", "C#", "C++", "TypeScript", "Ruby", "C", "Swift", "R", "Objective-C", "Scala", "Shell", "Go", "PowerShell", "Kotlin", "Rust", "Dart", "Programação Web", "Django", ".NET"];

        foreach ($categorys as $category) {
            DB::table('category')->insert([
                'name' => $category,
            ]);
        }
    }
}
