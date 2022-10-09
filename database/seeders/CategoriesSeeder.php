<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            0 => "JavaScript",
            1 => "SQL",
            2 => "Postgresql",
            3 => "Mongodb",
            4 => "Mysql",
            5 => "Banco de Dados",
            6 => "CSS",
            7 => "HTML",
            8 => "Python",
            9 => "Java",
            10 => "PHP",
            11 => "C#",
            12 => "C++",
            13 => "TypeScript",
            14 => "Ruby",
            15 => "C",
            16 => "Swift",
            17 => "R",
            18 => "Objective-C",
            19 => "Scala",
            20 => "Shell",
            21 => "Go",
            22 => "PowerShell",
            23 => "Kotlin",
            24 => "Rust",
            25 => "Dart",
            26 => "Programação Web",
            27 => "Django",
            28 => ".NET",
        ];

        DB::table('categories')->delete();

        foreach ($categories as $kew => $value) {
            DB::table('categories')->insert([
                'name' => $value
            ]);
        }
    }
}
