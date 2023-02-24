<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\StudentManagement\FeeCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin@123'),
            'userType'=>'Aartdmin',
        ]);
        $data=[[
            'fee_cate_name'=>'Registration Fee',
        ],
        ['fee_cate_name'=>'Montly Fees'],
        ['fee_cate_name'=>'Exam Fees'],
        
    ];
    FeeCategory::insert($data);
        
    }
}
