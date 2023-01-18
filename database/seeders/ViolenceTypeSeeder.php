<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ViolenceType;

class ViolenceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $types = [
            'attempted murder',
            'gun shots',
            'murder',
            'intimidation',
            'physical harm',
            'ballot box snatching',
            'physical threat',
            'group clash',
            'sexual violence',
            'other'
        ];

        foreach($types as $type)
        {
            // 
            ViolenceType::updateOrCreate([
                'name' => $type
            ]);
        }
    }
}
