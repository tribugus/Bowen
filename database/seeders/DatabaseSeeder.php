<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RollSeeder::class);
        $this->call(UsuarioSeeder::class);
        $this->call(GeneroUsuarioSeeder::class);
        $this->call(EstadoCivilSeeder::class);
        $this->call(CicloEscolarSeeder::class);
        $this->call(MatriculaSeeder::class);
        $this->call(NivelEducativoSeeder::class);
        $this->call(ProfesorSeeder::class);
        $this->call(NacionalidadSeeder::class);
        $this->call(EstadosSeeder::class);
    }
}
