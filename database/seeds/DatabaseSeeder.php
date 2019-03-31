<?php

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
        DB::table('packages')->insert([

                [
                    'name' => 'Basic',
                    'price' => '129',
                    'duration' => '30',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                    'status' => '1',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],             

                [
                    'name' => 'Pro',
                    'price' => '299',
                    'duration' => '45',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                    'status' => '1',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],            

                 [
                    'name' => 'Premium',
                    'price' => '399',
                    'duration' => '60',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
                    'status' => '1',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]);
    }
}
