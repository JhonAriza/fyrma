<?php

namespace Database\Seeders;

use App\Models\AllowedTypes;
use Illuminate\Database\Seeder;

class AllowedTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AllowedTypes::create([
            'value' => 'PDF',
            'accept' => 'application/pdf'
        ]);
        AllowedTypes::create([
            'value' => 'IMG',
            'accept' => 'image/.png,image/jpeg,image/jpg,image/gif,image/webp'
        ]);
    
        AllowedTypes::create([//excel,word,txt,zip /
            'value' => 'archivos',
            'accept' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,
            application/vnd.openxmlformats-officedocument.wordprocessingml.document,
            text/plain,
            application/zip'
        ]); 
      
        AllowedTypes::create([
            'value' => 'MP3,mp4',
            'accept' => 'application/mp3,video/mp4'
        ]);          
    }
}
