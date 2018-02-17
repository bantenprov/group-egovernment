<?php

use Illuminate\Database\Seeder;

class Bantenprov_GroupEgovernmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(Bantenprov_GroupEgovernmentSeeder_GroupEgovernment::class);
    }
}
