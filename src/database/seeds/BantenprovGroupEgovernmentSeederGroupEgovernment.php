<?php

use Bantenprov\GroupEgovernment\Models\Bantenprov\GroupEgovernment\GroupEgovernment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BantenprovGroupEgovernmentSeederGroupEgovernment extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
	public function run()
	{
        Model::unguard();

        $group_egovernments = (object) [
            (object) [
                'label' => 'G2G',
                'description' => 'Goverment to Goverment',
            ],
            (object) [
                'label' => 'G2E',
                'description' => 'Goverment to Employee',
            ],
            (object) [
                'label' => 'G2C',
                'description' => 'Goverment to Citizen',
            ],
            (object) [
                'label' => 'G2B',
                'description' => 'Goverment to Business',
            ],
        ];

        foreach ($group_egovernments as $group_egovernment) {
            $model = GroupEgovernment::updateOrCreate(
                [
                    'label' => $group_egovernment->label,
                ],
                [
                    'description' => $group_egovernment->description,
                ]
            );
            $model->save();
        }
	}
}
