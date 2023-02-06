<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call(ParticipantesRolesSeeder::class);
        $this->call(ShieldSeeder::class);
        $this->call(AllowedTypesSeeder::class);
    }
}
