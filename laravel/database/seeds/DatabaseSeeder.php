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
        //$this->call(CyclingsTableSeeder::class);
        //$this->call(PlamodelTableSeeder::class);
        $this->call(PostsTableSeeder::class);
    }
}
