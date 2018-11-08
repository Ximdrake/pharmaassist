<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Traits\CaptureIpTrait;
use Auth;
use Illuminate\Support\Facades\DB;
use App\DoctorInfo;
use App\PatientInfo;
use App\Prescription;
use Illuminate\Http\Request;
use jeremykenedy\LaravelRoles\Models\Role;
use Validator;
use Mail;
use Nexmo\Laravel\Facade\Nexmo;

class UsersManagementController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();

      

        return View('usersmanagement.show-users', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = DoctorInfo::all();

        
        return view('usersmanagement.create-user', compact('doctors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'middlename'           => 'required',
                'firstname'            => 'required',
                'lastname'             => 'required',
                'contact_number'       => 'required',
                'birthdate'            => 'required',
                'gender' => 'required',
                'doc_id'                  => 'required',
                'address'                  => 'required',
                'photo'=>'image|max:2000',
            ]
        );

        // if ($validator->fails()) {
        //     $this->throwValidationException(
        //         $request, $validator
        //     );
        // } else {
            
            $patient = new PatientInfo();
            
           
                    $patient->middlename = $request->input('middlename');
                    $patient->firstname  = $request->input('firstname');
                    $patient->lastname   = $request->input('lastname');
                    $patient->spouse_g   = $request->input('spouse_g');
                    $patient->contact_number = $request->input('contact_number');
                    $patient->birthdate = $request->input('birthdate');
                    $patient->gender = $request->input('gender');
                    $patient->doc_id    = $request->input('doc_id');
                    $patient->address   = $request->input('address');
                    $patient->status    = "On Maintenance";          
                    $patient->image_ext='jpg';
                    $patient->image = $request->captured_photo;
                    $patient->save();

            $medicine = Prescription::create([
                    'pid'       => $patient->id,
                    'generic_name'       => $request->input('generic_name'),
                    'brand_name'       => $request->input('brand_name'),
                    'dosage_form'        => $request->input('dosage_form'),
                    'dosage_strength'  => $request->input('dosage_strength'),
                    'pres_quantity'        => $request->input('pres_quantity'),
                    'quantity'        => $request->input('quantity'),
                    'signa'        => $request->input('signa'),
                    'allergy'      => $request->input('allergy'),
                    'time'        => $request->input('time'),
                    'per_day'        => $request->input('per_day'),
                    'refill_check'        => $request->input('refill_check')
                ]);
            $medicine->save();
            return redirect('home')->with('success', trans('usersmanagement.createSuccess'));
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $user= DB::table('patient_infos')
            ->join('doctor_infos', 'doctor_infos.id', '=', 'patient_infos.doc_id')
            ->join('prescription', 'prescription.pid', '=', 'patient_infos.id')
            ->select('patient_infos.*','doctor_infos.firstname as docfirstname','doctor_infos.lastname as doclastname','prescription.brand_name as brand_name','prescription.dosage_form as pres_dosage','prescription.pres_quantity as pres_quantity','prescription.quantity as quantity','prescription.signa as signa','prescription.dosage_strength as pres_strength')
            ->where('patient_infos.id','=',$id)
            ->first();
            $medicine= DB::table('prescription')
            ->where('pid','=',$id)
            ->get();

            //echo($user);
           return view('usersmanagement.show-user', compact('user','medicine'));
             


       
    }


    function sendMessage(Request $request){

       $medicine = Prescription::all();

     foreach($medicine as $med){
            if($med->time==strtolower($request->data)){ 
              var_dump($med->pid);

              $prescription =  Prescription::where('id', '=',$med->id)->first(); 
              $prescription->quantity = $prescription->quantity-$med->per_day;
              $prescription->save();  

              $patient= PatientInfo::where('id', '=',$med->pid)->first();
              $contact = $patient->contact_number;
              // try{
              //   Nexmo::message()->send([
              //       'to'   => $contact,
              //       'from' => 'PharmaSys',
              //       'text' => 'Good Day Mr/Mrs. '.$patient->firstname." ".$patient->lastname.", "."This is to remind you that you have to take your maintenance medicine ".$prescription->generic_name."(".$prescription->brand_name.") at exactly ".$med->time." You have ".$prescription->quantity."pcs left in your possession.  - PharmASSIST"
              //   ]);
              // }catch(\Exception $e){
              //      $data = array('name'=>"PharmASSIST",
              //       'email'=>"asidorx@gmail.com");
              //           Mail::send([],[],function($message) use ($data){
              //           $message->to($data['email'],'Hello Mr/Mrs '.$data['name'])->subject('Message Sending Error!'.$data['name'])
              //           ->setBody('The system failed to send the message to the patient due to service providers technical problem, you can remind him/her via personal text. Patient number : 09477599352');
              //           $message->from('pharmassisthesis@gmail.com','PharmASSIST');
              //           });   
              //   }
              
                var_dump($contact);
            }
            }
       return json_encode($request->data);

    }

    function add_prescription(Request $request){
            $prescription = new Prescription;
            $prescription->pid = $request->user_id;
            $prescription->generic_name = $request->generic_name;
            $prescription->brand_name = $request->brand_name;
            $prescription->dosage_form = $request->dosage_form;
            $prescription->dosage_strength = $request->dosage_strength;
            $prescription->pres_quantity = $request->pres_quantity;
            $prescription->quantity = $request->quantity;
            $prescription->signa = $request->signa;
            $prescription->allergy = $request->allergy;
            $prescription->time = $request->time;
            $prescription->per_day = $request->per_day;
            $prescription->refill_check = $request->refill_check;    
            $prescription->save(); 
             
        return json_encode("success");
    }
     function fetch_prescription(Request $request){
           $prescription = Prescription::where('id','=',$request->id)->first();
        return $prescription;
    }
     function delete_prescription(Request $request){
           $prescription = Prescription::where('id','=',$request->id)->first();
           // $prescription->delete();
        return $prescription;
    }
     function edit_prescription(Request $request){

            $prescription =  Prescription::where('id', '=',$request->pres_id_edit)->first();
            $prescription->generic_name = $request->generic_name; 
            $prescription->brand_name = $request->brand_name;
            $prescription->dosage_form = $request->dosage_form;
            $prescription->dosage_strength = $request->dosage_strength;
            $prescription->pres_quantity = $request->pres_quantity;
            $prescription->quantity = $request->quantity;
            $prescription->signa = $request->signa;
            $prescription->allergy = $request->allergy;
            $prescription->time = $request->time;
            $prescription->per_day = $request->per_day;
            $prescription->refill_check = $request->refill_check;    
            $prescription->save(); 

            $medicine= DB::table('prescription')
            ->where('pid','=',$prescription->pid)
            ->get();
       return json_encode($medicine);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        foreach ($user->roles as $user_role) {
            $currentRole = $user_role;
        }

        $data = [
            'user'        => $user,
            'roles'       => $roles,
            'currentRole' => $currentRole,
        ];

        return view('usersmanagement.edit-user')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $currentUser = Auth::user();
        $user = User::find($id);
        $emailCheck = ($request->input('email') != '') && ($request->input('email') != $user->email);
        $ipAddress = new CaptureIpTrait();

        if ($emailCheck) {
            $validator = Validator::make($request->all(), [
                    'name'     => 'required|max:255',
                    'email'    => 'email|max:255|unique:users',
                    'password' => 'present|confirmed|min:6',
                ]);
        } else {
            $validator = Validator::make($request->all(), [
                    'name'     => 'required|max:255',
                    'password' => 'nullable|confirmed|min:6',
                ]);
        }
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        } else {
            $user->name = $request->input('name');

            if ($emailCheck) {
                $user->email = $request->input('email');
            }

            if ($request->input('password') != null) {
                $user->password = bcrypt($request->input('password'));
            }

            $user->detachAllRoles();
            $user->attachRole($request->input('role'));
            //$user->activated = 1;

            $user->updated_ip_address = $ipAddress->getClientIp();

            $user->save();

            return back()->with('success', trans('usersmanagement.updateSuccess'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$currentUser = Auth::user();
        $user = PatientInfo::findOrFail($id);
            $user->delete();
            return redirect('home')->with('success', trans('usersmanagement.deleteSuccess'));
    }
}
