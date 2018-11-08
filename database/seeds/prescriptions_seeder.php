<?php

use Illuminate\Database\Seeder;
use App\Prescription;
class prescriptions_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
    {
        $data = [
            [
           	'pid' => 1,
            'brand_name'=>'Test Brand',
            'dosage_form' => 'Test Form',
            'dosage_strength' => 'Test Strength',
            'pres_quantity' =>30,
            'quantity' =>15,
            'signa' =>'Test Signa',
            ],
            [
           	'pid' => 2,
            'brand_name'=>'Test Brand',
            'dosage_form' => 'Test Form',
            'dosage_strength' => 'Test Strength',
            'pres_quantity' =>30,
            'quantity' =>15,
            'signa' =>'Test Signa',
            ],
             
        ];
            foreach($data as $datum){
            Prescription::create($datum);
        }
    }
}
