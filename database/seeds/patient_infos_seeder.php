<?php

use Illuminate\Database\Seeder;
use App\PatientInfo;
class patient_infos_seeder extends Seeder
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
           	'doc_id' => 1,
            'firstname'=>'John',
            'middlename' => 'Mao',
            'lastname' => 'Doe',
            'birthdate' =>'12/08/1996',
            'gender' =>'Male',
            'contact_number' =>'09477599352',
            'address' => 'BO Obrero',
            'status' => 'On Maintenance',
            ],
            [
            'doc_id' => 2,
            'firstname'=>'Marie',
            'middlename' => 'Ni',
            'lastname' => 'Suarez',
            'birthdate' =>'03/06/1896',
            'gender' =>'Female',
            'contact_number' =>'09477599352',
            'address' => 'BO Obrero',
            'status' => 'On Maintenance',
            ],
        ];
            foreach($data as $datum){
            PatientInfo::create($datum);
        }
    }
}
