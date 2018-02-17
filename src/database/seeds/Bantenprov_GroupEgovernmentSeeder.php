<?php

use Bantenprov\GroupEgovernment\Models\Bantenprov\GroupEgovernment\GroupEgovernment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class Bantenprov_GroupEgovernmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
		Model::unguard();

        $group_egovernment = GroupEgovernment::updateOrCreate(
            [
                'label' => 'G2G',
            ],
            [
                'description' => 'Goverment to Goverment',
            ]
        );
        $group_egovernment->save();

        $group_egovernment = GroupEgovernment::updateOrCreate(
            [
                'label' => 'G2E',
            ],
            [
                'description' => 'Goverment to Employee',
            ]
        );
        $group_egovernment->save();

        $group_egovernment = GroupEgovernment::updateOrCreate(
            [
                'label' => 'G2C',
            ],
            [
                'description' => 'Goverment to Citizen',
            ]
        );
        $group_egovernment->save();

        $group_egovernment = GroupEgovernment::updateOrCreate(
            [
                'label' => 'G2B',
            ],
            [
                'description' => 'Goverment to Business',
            ]
        );
        $group_egovernment->save();
	}
}