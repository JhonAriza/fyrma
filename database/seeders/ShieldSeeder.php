<?php

namespace Database\Seeders;

use App\Models\Shields;
use Illuminate\Database\Seeder;

class ShieldSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Shields::create([
            'name' => 'Firma',
            'permissions' => 0
        ]);
        Shields::create([
            'name' => 'Documento',
            'permissions' => 1
        ]);
        Shields::create([
            'name' => 'Video',
            'permissions' => 2
        ]);
    }
}
