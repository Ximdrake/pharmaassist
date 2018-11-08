@extends('layouts.dashboard')

@section('template_title')
  Add Patient
@endsection

@section('header')
 Add Patient
@endsection

@section('breadcrumbs')
  <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
    <a itemprop="item" href="{{url('/')}}">
      <span itemprop="name">
        {{ trans('titles.app') }}
      </span>
    </a>
    <i class="material-icons">chevron_right</i>
    <meta itemprop="position" content="1" />
  </li>
  <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
    <a itemprop="item" href="/home">
      <span itemprop="name">
        Patient List 
      </span>
    </a>
    <i class="material-icons">chevron_right</i>
    <meta itemprop="position" content="2" />
  </li>
  <li class="active" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
    <a itemprop="item" href="/users/create">
      <span itemprop="name">
        Add Patient
      </span>
    </a>
    <meta itemprop="position" content="3" />
  </li>
@endsection

@section('content')

  <div class="mdl-grid full-grid margin-top-0 padding-0">
    <div class="mdl-cell mdl-cell mdl-cell--12-col mdl-cell--12-col-phone mdl-cell--8-col-tablet mdl-cell--12-col-desktop mdl-card mdl-shadow--3dp margin-top-0 padding-top-0">
        <div class="mdl-card card-new-user" style="width:100%;" itemscope itemtype="http://schema.org/Person">

        <div class="mdl-card__title mdl-card--expand mdl-color--green mdl-color-text--white">
          <h2 class="mdl-card__title-text logo-style">Add Patient</h2>
        </div>

        {!! Form::open(array('action' => 'UsersManagementController@store', 'method' => 'POST', 'role' => 'form')) !!}

          <div class="mdl-card__supporting-text">
            <div class="mdl-grid full-grid padding-0">
              <div class="mdl-cell mdl-cell--12-col-phone mdl-cell--12-col-tablet mdl-cell--12-col-desktop">

                <div class="mdl-grid ">
                  <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('firstname') ? 'is-invalid' :'' }}">
                            {!! Form::text('firstname', NULL, array('id' => 'firstname', 'class' => 'mdl-textfield__input')) !!}
                            {!! Form::label('firstname', 'First Name', array('class' => 'mdl-textfield__label')); !!}
                            <span class="mdl-textfield__error">Letters only</span>
                        </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('lastname') ? 'is-invalid' :'' }}">
                          {!! Form::text('lastname', NULL, array('id' => 'lastname', 'class' => 'mdl-textfield__input'))!!}
                          {!! Form::label('lastname', 'Last Name', array('class' => 'mdl-textfield__label')); !!}
                          <span class="mdl-textfield__error">Letters only</span>
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('middlename') ? 'is-invalid' :'' }}">
                          {!! Form::text('middlename', NULL, array('id' => 'middlename', 'class' => 'mdl-textfield__input')) !!}
                          {!! Form::label('middlename', 'Middle Name', array('class' => 'mdl-textfield__label')); !!}
                      </div>
                    </div>
                     <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('spouse_g') ? 'is-invalid' :'' }}">
                          {!! Form::text('spouse_g', NULL, array('id' => 'spouse_g', 'class' => 'mdl-textfield__input')) !!}
                          {!! Form::label('spouse_g', 'Spouse/Guardian', array('class' => 'mdl-textfield__label')); !!}
                      </div>
                      
                    </div>
                    <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('birthdate') ? 'is-invalid' :'' }}">
                          {!! Form::text('birthdate', NULL, array('id' => 'birthdate', 'class' => 'mdl-textfield__input')) !!}
                          {!! Form::label('birthdate', 'Birth Date: (MM/DD/YYYY)', array('class' => 'mdl-textfield__label')); !!}
                      </div>
                      
                    </div>
                    <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                      <select id="gender" name="gender" class="mdl-selectfield__select">                                
                      <option id="gender" name="gender" value="Male">Male</option>
                      <option id="gender" name="gender" value="Female">Female</option>        
                        </select>
                    </div>
                  </div>
                    <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label getmdl-select">
                        
                        <select id="doc_id" name="doc_id" class="mdl-selectfield__select">
                               @foreach($doctors as $item)
                                <option id="doc_id" name="doc_id" value="{{$item->id}}">Dr. {{$item->firstname}} {{$item->lastname}} </option>
                              @endforeach
                        </select>
                    </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('contact_number') ? 'is-invalid' :'' }}">
                          {!! Form::text('contact_number', NULL, array('id' => 'contact_number', 'class' => 'mdl-textfield__input')) !!}
                          {!! Form::label('contact_number', 'Contact Number', array('class' => 'mdl-textfield__label')); !!}
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('address') ? 'is-invalid' :'' }}">
                          {!! Form::text('address', NULL, array('id' => 'address', 'class' => 'mdl-textfield__input')) !!}
                          {!! Form::label('address', 'Address', array('class' => 'mdl-textfield__label')); !!}
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                       <label id="form-image-container" for="photo" style="cursor:pointer">
                  
                      <i>Add Image: &nbsp &nbsp </i><img src="/images/nobody.jpg" alt="profile Pic" id="upload-image-display" width="100px"/>
                                      
                        </label>
                      <input name="photo" id="photo" type="file" class="mdl-textfield_input" style="display:none"/>
                      <input name="captured_photo" id="captured_photo" type="text" value="" style="display:none"/>
                    </div>

                    <div class="mdl-cell mdl-cell--12-col-tablet mdl-cell--12-col-desktop" >
                        <h5>Prescription</h5>
                    </div>

                     <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('generic_name') ? 'is-invalid' :'' }}">
                          {!! Form::text('generic_name', NULL, array('id' => 'generic_name', 'class' => 'mdl-textfield__input')) !!}
                          {!! Form::label('generic_name', 'Generic Name', array('class' => 'mdl-textfield__label')); !!}
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('brand_name') ? 'is-invalid' :'' }}">
                          {!! Form::text('brand_name', NULL, array('id' => 'brand_name', 'class' => 'mdl-textfield__input')) !!}
                          {!! Form::label('brand_name', 'Brand Name', array('class' => 'mdl-textfield__label')); !!}
                      </div>
                    </div>
                     <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('dosage_form') ? 'is-invalid' :'' }}">
                          {!! Form::text('dosage_form', NULL, array('id' => 'dosage_form', 'class' => 'mdl-textfield__input')) !!}
                          {!! Form::label('dosage_form', 'Dosage Form', array('class' => 'mdl-textfield__label')); !!}
                      </div>
                    </div>
                     <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('dosage_strength') ? 'is-invalid' :'' }}">
                          {!! Form::text('dosage_strength', NULL, array('id' => 'dosage_strength', 'class' => 'mdl-textfield__input')) !!}
                          {!! Form::label('dosage_strength', 'Dosage Strength', array('class' => 'mdl-textfield__label')); !!}
                      </div>
                    </div>
                     <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('pres_quantity') ? 'is-invalid' :'' }}">
                          {!! Form::text('pres_quantity', NULL, array('id' => 'pres_quantity', 'class' => 'mdl-textfield__input')) !!}
                          {!! Form::label('pres_quantity', 'Prescribe Quantity', array('class' => 'mdl-textfield__label')); !!}
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('quantity') ? 'is-invalid' :'' }}">
                          {!! Form::text('quantity', NULL, array('id' => 'quantity', 'class' => 'mdl-textfield__input')) !!}
                          {!! Form::label('quantity', 'Quantity On-Hand', array('class' => 'mdl-textfield__label')); !!}
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('signa') ? 'is-invalid' :'' }}">
                          {!! Form::text('signa', NULL, array('id' => 'signa', 'class' => 'mdl-textfield__input')) !!}
                          {!! Form::label('signa', 'Signa', array('class' => 'mdl-textfield__label')); !!}
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('time') ? 'is-invalid' :'' }}">
                          {!! Form::text('time', NULL, array('id' => 'time', 'class' => 'mdl-textfield__input')) !!}
                          {!! Form::label('time', 'Time ex.(1 am)', array('class' => 'mdl-textfield__label')); !!}
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('per_day') ? 'is-invalid' :'' }}">
                          {!! Form::text('per_day', NULL, array('id' => 'per_day', 'class' => 'mdl-textfield__input')) !!}
                          {!! Form::label('per_day', 'Per Day', array('class' => 'mdl-textfield__label')); !!}
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('allergy') ? 'is-invalid' :'' }}">
                          {!! Form::text('allergy', NULL, array('id' => 'allergy', 'class' => 'mdl-textfield__input')) !!}
                          {!! Form::label('allergy', 'Allergy', array('class' => 'mdl-textfield__label')); !!}
                      </div>
                    </div>
                    <div class="mdl-cell mdl-cell--4-col-tablet mdl-cell--6-col-desktop">
                      <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label {{ $errors->has('signa') ? 'is-invalid' :'' }}">
                        <select id="refill_check" name="refill_check" class="mdl-selectfield__select">
                                <option id="refill_check" name="refill_check" value="Minor">Minor</option>
                                <option id="refill_check" name="refill_check" value="Major">Major</option>
                                <option id="refill_check" name="refill_check" value="Critical">Critical</option>         
                        </select>
                      </div>
                    </div>

                   
                </div>
              </div>

            </div>
          </div>

          <div class="mdl-card__actions padding-top-0">
            <div class="mdl-grid padding-top-0">
              <div class="mdl-cell mdl-cell--12-col padding-top-0 margin-top-0 margin-left-1-1">

                {{-- SAVE BUTTON--}}
                <span class="save-actions">
                  {!! Form::button('<i class="material-icons">save</i> Add Patient', array('class' => 'dialog-button-save mdl-button mdl-js-button mdl-js-ripple-effect mdl-color--green mdl-color-text--white mdl-button--raised margin-bottom-1 margin-top-1 margin-top-0-desktop margin-right-1 padding-left-1 padding-right-1 ')) !!}
                </span>

              </div>
            </div>
          </div>

            <div class="mdl-card__menu mdl-color-text--white">

              <span class="save-actions">
                {!! Form::button('<i class="material-icons">save</i>', array('class' => 'dialog-button-icon-save mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect', 'title' => 'Add Patient')) !!}
              </span>

              <a href="{{ url('/') }}" class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect mdl-color-text--white" title="Back to Patient List">
                  <i class="material-icons">reply</i>
                  <span class="sr-only">Back to Patient List</span>
              </a>

            </div>

            @include('dialogs.dialog-save')

          {!! Form::close() !!}

        </div>
    </div>
  </div>

@endsection

@section('footer_scripts')

  @include('scripts.mdl-required-input-fix')
  @include('scripts.gmaps-address-lookup-api3')

  <script src="{{ asset('css/dist/js/moment.js') }}"></script>
  <script type="text/javascript">

   //  window.addEventListener('DOMContentLoaded', function(){
   // var myDatepicker = document.querySelector('input[name="demo"]'),
   //  $myDatepicker.DatePickerX.init({
      
   //    });
     
   //  });

   moment().format();
   moment().format('MM/DD/YYYY');

   
$("#birthdate").change(function() {
  var dateEntered = $('#birthdate').val();

  console.log(dateEntered);
   if (moment(new Date(dateEntered)).isValid()) {
      console.log('Valid Date');
    } else {
      console.log('Invalid Date');
    }

    });
    
    mdl_dialog('.dialog-button-save');
    mdl_dialog('.dialog-button-icon-save');


    $("#photo").change(function() {
    readURL(this);
    });
    function readURL(input) {
    console.log(input); 
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#upload-image-display').attr('src', e.target.result);
        $('#captured_photo').val(e.target.result);
      }
      reader.readAsDataURL(input.files[0]);

    } 

}

  </script>

@endsection