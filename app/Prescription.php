<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
   	protected $table = 'prescription';
    protected $fillable = array(
		'pid',
		'generic_name',
		'brand_name',
		'dosage_form',
		'dosage_strength',
		'pres_quantity',
		'quantity',
		'signa',
		'allergy',
		'time',
		'per_day',
		'refill_check',
    );
    public $timestamps = true;
}
