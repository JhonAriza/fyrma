<?php

namespace Database\Seeders;

use App\Models\Rols;
use Illuminate\Database\Seeder;

class ParticipantesRolesSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Rols::create([
            'name' => 'Firmante'
        ]);
        Rols::create([
            'name' => 'Visto Bueno'
        ]);
    }
}
