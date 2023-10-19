<?php

namespace Database\Seeders;

use App\Models\Form;
use Illuminate\Database\Seeder;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $forms = ['Ficha Inicial', 'Estudio Socioeconómico'];
        foreach ($forms as $form) {
            Form::create([
                'description' => $form
            ]);
        }
    }
}
