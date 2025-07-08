<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Noms catalans aleatoris
        $noms = [
            'Marc', 'Anna', 'Joan', 'Maria', 'Pau', 'Laura', 'David', 'Sara', 'Jordi', 'Elena',
            'Sergi', 'Marta', 'Albert', 'Núria', 'Roger', 'Clara', 'Miquel', 'Cristina', 'Pere', 'Laia',
            'Oriol', 'Carla', 'Arnau', 'Marina', 'Xavier', 'Irene', 'Adrià', 'Judith', 'Francesc', 'Gemma',
            'Lluís', 'Alba', 'Raul', 'Mireia', 'Àlex', 'Andrea', 'Víctor', 'Silvia', 'Daniel', 'Berta',
            'Gerard', 'Montse', 'Ricard', 'Aina', 'Ivan', 'Natàlia', 'Enric', 'Meritxell', 'Antoni', 'Roser'
        ];
        
        // Cognoms catalans aleatoris
        $cognoms = [
            'Garcia', 'Martínez', 'López', 'Sánchez', 'González', 'Hernández', 'Pérez', 'Rodríguez',
            'Fernández', 'Martín', 'Díaz', 'Moreno', 'Muñoz', 'Álvarez', 'Romero', 'Alonso',
            'Gutiérrez', 'Navarro', 'Torres', 'Domínguez', 'Vázquez', 'Ramos', 'Gil', 'Ramírez',
            'Serrano', 'Blanco', 'Molina', 'Morales', 'Suárez', 'Ortega', 'Delgado', 'Castro',
            'Ortiz', 'Rubio', 'Marín', 'Sanz', 'Iglesias', 'Medina', 'Garrido', 'Cortés'
        ];

        // Generar 50 usuaris aleatoris
        for ($i = 1; $i <= 50; $i++) {
            $nom = $noms[array_rand($noms)];
            $cognom = $cognoms[array_rand($cognoms)];
            $nomComplet = $nom . ' ' . $cognom;
            $email = strtolower($nom . '.' . $cognom . $i . '@pixelbar.cat');
            
            // 10% de probabilitat de ser admin
            $isAdmin = rand(1, 10) === 1;
            
            User::create([
                'name' => $nomComplet,
                'email' => $email,
                'password' => Hash::make('password123'), // Contrasenya per defecte
                'is_admin' => $isAdmin,
                'email_verified_at' => rand(0, 1) ? now() : null, // 50% verificats
                'created_at' => now()->subDays(rand(1, 365)), // Registrats en l'últim any
                'updated_at' => now()->subDays(rand(1, 30)),
            ]);
        }

        $this->command->info('50 usuaris aleatoris creats correctament!');
    }
}
