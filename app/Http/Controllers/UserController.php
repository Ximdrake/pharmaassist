<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Profile;
use App\Models\User;
use App\PatientInfo;
use App\DoctorInfo;
use App\Prescription;
use Illuminate\Support\Facades\DB;
use App\Traits\CaptureIpTrait;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        // $users = PatientInfo::all();
        // $doctor = DoctorInfo::all();

        $users= DB::table('patient_infos')
            ->join('doctor_infos', 'doctor_infos.id', '=', 'patient_infos.doc_id')
            ->select('patient_infos.*','doctor_infos.firstname as docfirstname','doctor_infos.lastname as doclastname')->get();

        if ($user->isAdmin()) {
            return View('pages.admin.home', compact('users'));
             
        }
       

       
 
    }
}
