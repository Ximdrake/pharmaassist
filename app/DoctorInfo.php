<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorInfo extends Model
{
	protected $primaryKey = 'id';
    protected $table = 'doctor_infos';
    protected $fillable = array(
		'firstname',
		'middlename',
		'lastname',
		'clinic_location',
		'license_number',
		'contact_number',
		'specialty',
    );
    public $timestamps = true;
}
