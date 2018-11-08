@extends('layouts.dashboard')

@section('template_title')
  Showing User {{ $user->firstname }}
@endsection

@section('header')
  Showing {{ $user->firstname }}
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
    <a itemprop="item" href="/users/{{ $user->id }}">
      <span itemprop="name">
        {{ $user->firstname }} {{ $user->lastname }}
      </span>
    </a>
    <meta itemprop="position" content="3" />
  </li>
@endsection

@section('content')

        <div class="">
        <div class="content-grid mdl-grid">
          <div class="">
            <h6>Basic Information</h6>
              <ul class="">
                  <li class="mdl-list__item mdl-typography--font-light">
                    <div class="mdl-list__item-primary-content">
                      <i class="">Full Name: &nbsp</i>
                      {{ $user->firstname }} {{ $user->middlename }} {{ $user->lastname }}
                    </div>
                  </li>
                   <li class="mdl-list__item mdl-typography--font-light">
                    <div class="mdl-list__item-primary-content">
                      <i class="">Spouce/Guardian: &nbsp  &nbsp</i>
                       {{ $user->spouse_g }}
                    </div>
                  </li>
                  <li class="mdl-list__item mdl-typography--font-light">
                    <div class="mdl-list__item-primary-content">
                      <i class="">Birthday: &nbsp  &nbsp</i>
                       {{ $user->birthdate }}
                    </div>
                  </li>
                  <li class="mdl-list__item mdl-typography--font-light">
                    <div class="mdl-list__item-primary-content">
                      <i class="">Gender:&nbsp &nbsp &nbsp &nbsp </i>
                        {{ $user->gender }}
                    </div>
                  </li>
                  <li class="mdl-list__item mdl-typography--font-light">
                    <div class="mdl-list__item-primary-content" id="age" >
                      <i class="">Age:  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp </i>
                     <?php  
                        $birthDate = explode("/", $user->birthdate);
                        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                          ? ((date("Y") - $birthDate[2]) - 1)
                          : (date("Y") - $birthDate[2]));
                        echo $age;

                      ?>
                    </div>
                  </li>
                  <li class="mdl-list__item mdl-typography--font-light">
                    <div class="mdl-list__item-primary-content">
                      <i class="">Contact: &nbsp &nbsp&nbsp  </i>
                        {{ $user->contact_number }}
                    </div>
                  </li>
                  <li class="mdl-list__item mdl-typography--font-light">
                    <div class="mdl-list__item-primary-content">
                      <i class="">Address: &nbsp&nbsp &nbsp  </i>
                      {{ $user->address }} 
                    </div>
                  </li>
                 
              </ul>
          </div>
                <div class="mdl-list__item-primary-content">
                   &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp 
                </div>
                      <div id="myDiv">
                        <br>
                        <br>
                        <br>
                        <br>
                        

                        @if($user->image!=null)
                      <img src="{{$user->image}}" alt="profilePic" id="profile-image-display" width="300px"/>
                    @else
                      <img src="/images/nobody.jpg" alt="profilePic" id="profile-image-display" width="300px"/>
                      @endif
                      </div>
                         
          <div class="">
            <h6>Medical Information</h6>
              <ul>
                  <li class="mdl-list__item mdl-typography--font-light">
                    <div class="mdl-list__item-primary-content">
                      <i class="">Status: &nbsp &nbsp &nbsp &nbsp</i>
                      {{ $user->status }}
                    </div>
                  </li>
                  <li class="mdl-list__item mdl-typography--font-light">
                    <div class="mdl-list__item-primary-content">
                      <i class="">Doctor: &nbsp &nbsp &nbsp &nbsp </i>
                      Dr. {{ $user->docfirstname }} {{ $user->doclastname }}
                    </div>

                  </li>
                   

       
    </div>  
    </ul>
      </div>            
      </div>
      </div>

         <div class="mdl-card mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-cell--8-col-tablet mdl-cell--12-col-desktop margin-top-0">
            <div class="mdl-card__title mdl-color--accent mdl-color-text--accent-contrast">
                <h2 class="mdl-card__title-text logo-style">
                    Prescription
                </h2>
                   <div class="mdl-card__menu" style="top: -4px;">

        @include('partials.mdl-highlighter')

        @include('partials.mdl-search')
    </div>
            </div>
          <div class="mdl-card__supporting-text mdl-color-text--grey-600 padding-0 context">    
              <div class="table-responsive material-table">
            <table id="precription_table" class="mdl-data-table mdl-js-data-table data-table"  width="100%">
              <thead>
                <tr>
                    <th class="mdl-data-table__cell--non-numeric">Generic Name</th>
                    <th class="mdl-data-table__cell--non-numeric">Brand Name</th>
                    <th class="mdl-data-table__cell--non-numeric">Dosage Form</th>
                    <th class="mdl-data-table__cell--non-numeric">Dosage Strength</th>
                    <th class="mdl-data-table__cell--non-numeric">Prescription Quantity</th>
                    <th class="mdl-data-table__cell--non-numeric">On-Hand</th>
                    <th class="mdl-data-table__cell--non-numeric">Signa</th>
                    <th class="mdl-data-table__cell--non-numeric">Allergy</th>
                    <th class="mdl-data-table__cell--non-numeric">Refill Check</th>
                    <th class="mdl-data-table__cell--non-numeric">Action</th>
                     
                     
                </tr>
              </thead>
              <tbody>
                  <button class="mdl-button mdl-js-button   mdl-button--colored modal__trigger" data-modal="#modal">
                      <i class="material-icons">add</i>
                    </button>
                    @foreach ($medicine as $med)                   
                        <tr>
                            <td class="mdl-data-table__cell--non-numeric">{{$med->generic_name}}</td>
                            <td class="mdl-data-table__cell--non-numeric">{{$med->brand_name}}</td>
                            <td class="mdl-data-table__cell--non-numeric">{{$med->dosage_form}}</td>
                            <td class="mdl-data-table__cell--non-numeric mdl-layout--large-screen-only">{{$med->dosage_strength}}</td>
                            <td class="mdl-data-table__cell--non-numeric mdl-layout--large-screen-only">{{$med->pres_quantity}}</td>
                            <td class="mdl-data-table__cell--non-numeric mdl-layout--large-screen-only">{{$med->quantity}}</td>
                            <td class="mdl-data-table__cell--non-numeric mdl-layout--large-screen-only">{{$med->signa}}</td>
                            <td class="mdl-data-table__cell--non-numeric mdl-layout--large-screen-only">{{$med->allergy}}</td>
                            <td class="mdl-data-table__cell--non-numeric mdl-layout--large-screen-only">{{$med->refill_check}}</td>
                            <td class="mdl-data-table__cell--non-numeric">
                                <button class="mdl-button mdl-js-button mdl-button--colored modal__trigger edit_prescription" data-modal="#edit_modal" title="Edit Prescription"  value="{{$med->id}}" >
                                    <i class="material-icons mdl-color-text--green">edit</i>
                                </button>
                                  <button class="mdl-button mdl-js-button delete_prescreption" title="Delete Prescription"  value="{{$med->id}}" >
                                    <i class="material-icons mdl-color-text--red">delete</i>
                                </button>
                            </td>
                        </tr>
                     
                   @endforeach
              </tbody>
            </table>
        </div> 
           
          </div>
        </div>
   
          <div class="mdl-card__actions">
          <div class="mdl-grid full-grid">
            <div class="mdl-cell mdl-cell--12-col">
              <a href="/profile/{{ Auth::user()->name }}/edit" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-shadow--3dp mdl-button--raised mdl-button--primary mdl-color-text--white">
                <i class="material-icons padding-right-half-1">edit</i>
                {{ Lang::get('titles.editProfile') }}
              </a>
            </div>
          </div>
          </div>
   
        
    
 
  
 
 
<div class="content">  <!-- For Demo Only -->
      <div id="edit_modal" class="modal modal__bg">
        <div class="modal__dialog">
          <div class="modal__content">
            <div class="modal__header">
              <div class="modal__title">
                <h2 class="modal__title-text">Edit Prescription</h2>
              </div>
 
              <span hidden="" class="mdl-button mdl-button--icon mdl-js-button  material-icons  modal__close"></span>
            </div>
 
 
            <div class="modal__text">
              <div class="mdl-card__supporting-text">
                <form action="POST" name="edit_prescription_form" id="edit_prescription_form">
                  
              <div id="medicine" class = "mdl-grid">
              <div class = "mdl-cell mdl-cell--4-col">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" name="generic_name" id="generic_name_edit">
                <label class="mdl-textfield__label" for="sample3">Generic Name</label>
              </div>
            </div>
              <div class = "mdl-cell mdl-cell--4-col">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" name="brand_name" id="brand_name_edit">
                <label class="mdl-textfield__label" for="sample3">Brand Name</label>
                <input type="" name="user_id_edit" id="user_id_edit" hidden="" value="{{ $user->id }}">
                <input type="" name="pres_id_edit" id="pres_id_edit" hidden="" value="">
              </div>
            </div>
            <div class = "mdl-cell mdl-cell--4-col">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" name="dosage_form" id="dosage_form_edit" >
                <label class="mdl-textfield__label" for="sample3">Dosage Form</label>
              </div>
            </div>
            <div class = "mdl-cell mdl-cell--4-col">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" name="dosage_strength" id="dosage_strength_edit">
                <label class="mdl-textfield__label" for="sample3">Dosage Strength</label>
              </div>
            </div>
            <div class = "mdl-cell mdl-cell--4-col">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="number" name="pres_quantity" id="pres_quantity_edit">
                <label class="mdl-textfield__label" for="sample3">Prescribed Quantity</label>
              </div>
            </div>
            <div class = "mdl-cell mdl-cell--4-col">
               <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="number" name="quantity" id="quantity_edit">
                <label class="mdl-textfield__label" for="sample3">Oh-Hand Quantity</label>
              </div>
            </div>
            <div class = "mdl-cell mdl-cell--4-col">
               <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" name="signa" id="signa_edit">
                <label class="mdl-textfield__label" for="sample3">Signa</label>
              </div>
            </div>
            <div class = "mdl-cell mdl-cell--4-col">
               <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" name="allergy" id="allergy_edit">
                <label class="mdl-textfield__label" for="sample3">Allergy</label>
              </div>
            </div>
            <div class = "mdl-cell mdl-cell--4-col">
               <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" name="time" id="time_edit">
                <label class="mdl-textfield__label" for="sample3">Time</label>
              </div>
            </div>
            <div class = "mdl-cell mdl-cell--4-col">
               <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" name="per_day" id="per_day_edit">
                <label class="mdl-textfield__label" for="sample3">Quantity Per Day</label>
              </div>
            </div>
            <div class = "mdl-cell mdl-cell--4-col">
             Refill Check: 
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                
               <select  name="refill_check" id="refill_check_edit" class="mdl-selectfield__select">
                    <option  name="refill_check" value="Minor">Minor</option>
                    <option  name="refill_check" value="Major">Major</option>
                    <option  name="refill_check" value="Critical">Critical</option>         
                </select>
              </div>
            </div>
              </div>

            <button type="button" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" id="edit">
              <i class="material-icons">arrow_forward</i>
            </button>
               
            </form>
              </div>
              <!-- FAB button with ripple -->
              

            </div>
              

             
          </div>
        </div>
      </div>

    </div>
   

 

<div class="content">  <!-- For Demo Only -->
      <div id="modal" class="modal modal__bg">
        <div class="modal__dialog">
          <div class="modal__content">
            <div class="modal__header">
              <div class="modal__title">
                <h2 class="modal__title-text">Add Prescription</h2>
              </div>
 
              <span class="mdl-button mdl-button--icon mdl-js-button  material-icons  modal__close"></span>
            </div>
 
 
            <div class="modal__text">
              <div class="mdl-card__supporting-text">
                <form action="POST" name="add_prescription_form" id="add_prescription_form">
                  
              <div id="medicine" class = "mdl-grid">
              <div class = "mdl-cell mdl-cell--4-col">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" name="generic_name" id="generic_name">
                <label class="mdl-textfield__label" for="sample3">Generic Name</label>
              </div>
            </div>
              <div class = "mdl-cell mdl-cell--4-col">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" name="brand_name" id="brand_name">
                <label class="mdl-textfield__label" for="sample3">Brand Name</label>
                <input type="" name="user_id" id="user_id" hidden="" value="{{ $user->id }}">
                <input type="" name="pres_id" id="pres_id" hidden="" value="">
              </div>
            </div>
            <div class = "mdl-cell mdl-cell--4-col">
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" name="dosage_form" id="dosage_form">
                <label class="mdl-textfield__label" for="sample3">Dosage Form</label>
              </div>
            </div>
            <div class = "mdl-cell mdl-cell--4-col">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" name="dosage_strength" id="dosage_strength">
                <label class="mdl-textfield__label" for="sample3">Dosage Strength</label>
              </div>
            </div>
            <div class = "mdl-cell mdl-cell--4-col">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="number" name="pres_quantity" id="pres_quantity" >
                <label class="mdl-textfield__label" for="sample3">Prescription Quantity</label>
              </div>
            </div>
            <div class = "mdl-cell mdl-cell--4-col">
               <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="number" name="quantity" id="quantity">
                <label class="mdl-textfield__label" for="sample3">Oh-Hand Quantity</label>
              </div>
            </div>
            <div class = "mdl-cell mdl-cell--4-col">
               <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" name="signa" id="signa">
                <label class="mdl-textfield__label" for="sample3">Signa</label>
              </div>
            </div>
            <div class = "mdl-cell mdl-cell--4-col">
               <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" name="allergy" id="allergy">
                <label class="mdl-textfield__label" for="sample3">Allergy</label>
              </div>
            </div>
            <div class = "mdl-cell mdl-cell--4-col">
               <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" name="time" id="time">
                <label class="mdl-textfield__label" for="sample3">Time</label>
              </div>
            </div>
            <div class = "mdl-cell mdl-cell--4-col">
               <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" name="per_day" id="per_day">
                <label class="mdl-textfield__label" for="sample3">Quantity Per Day</label>
              </div>
            </div>
            <div class = "mdl-cell mdl-cell--4-col">
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
               <select id="refill_check" name="refill_check" class="mdl-selectfield__select">
                    <option  name="refill_check" value="Minor">Minor</option>
                    <option  name="refill_check" value="Major">Major</option>
                    <option  name="refill_check" value="Critical">Critical</option>         
                </select>
              </div>
            </div>
              </div>

            <button type="submit" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" id="add_prescription">
              <i class="material-icons">arrow_forward</i>
            </button>
               
            </form>
              </div>
              <!-- FAB button with ripple -->
              

            </div>
              

            <div class="modal__footer">
              <a class="mdl-button mdl-button--colored mdl-js-button  modal__close">
                Close
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>
@endsection

 
@include('dialogs.dialog-delete')
@section('footer_scripts')
@include('scripts.highlighter-script')
@include('scripts.mdl-datatables')
<script src="{{ asset('css/dist/js/moment.js') }}"></script>
<script src="{{ asset('css/dist/js/material-modal.min.js') }}"></script>
<script src="{{ asset('css/dist/js/mdl-jquery-modal-dialog.js') }}"></script>
 <style>
        form {
            padding: 20px;
        }
        .left-side {
            margin-right: 100px;
            display: inline-block;
        }
        .left-side div {
            display: block;
        }
        .left-side fieldset {
            margin: 20px 0;
        }
        .left-side fieldset > label {
            padding-right: 20px;
        }
        .right-side {
            vertical-align: top;
            display: inline-block;
        }
        .toolbar-section {
            width: 100%;
            margin-top: 50px;
        }
        .info-section {
            margin: 15px 0;
        }
        .info-section > * {
            display: inline-block;
            vertical-align: top;
        }
        .info-section table {
            margin-right: 200px;
        }
        .info-section ul li {
            padding: 0;
        }
    </style>
<style type="text/css">
  .dialog-container,
.loading-container {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    overflow: scroll;
    background: rgba(0, 0, 0, 0.4);
    z-index: 9999;
    opacity: 0;
    -webkit-transition: opacity 400ms ease-in;
    -moz-transition: opacity 400ms ease-in;
    transition: opacity 400ms ease-in;
}

.dialog-container > div {
    position: relative;
    width: 90%;
    max-width: 500px;
    min-height: 25px;
    margin: 10% auto;
    z-index: 99999;
    padding: 16px 16px 0;
}

.dialog-button-bar {
    text-align: right;
    margin-top: 8px;
}

.loading-container > div {
    position: relative;
    width: 50px;
    height: 50px;
    margin: 10% auto;
    z-index: 99999;
}

.loading-container > div > div {
    width: 100%;
    height: 100%;
}
</style>
  <script type="text/javascript">
     
   
     
  // var  employeetable = $('#medicine').DataTable({
  //       destroy: true,
  //       processing: true,
  //       columnDefs: [{
  //           "targets": "_all", // your case first column
  //           "className": "text-center",
  //       }],
  //       ajax: "/edit_prescription",
  //       autoWidth: false,
  //       order: [ 1 ],
  //       columns: [
  //           {data: 'id', name: 'id'},
  //           {data: brand_name, name: 'brand_name'},
  //           {data: dosage_form, name: 'dosage_form'},
  //           {data: dosage_strength, name: 'dosage_strength'},
  //           {data: pres_quantity, name: 'pres_quantity'},
  //           {data: quantity, name: 'quantity'},
  //           {data: signa, name: 'signa'},
  //           {data: allergy, name: 'allergy'}
           
  //       ]
         
  //   }); 

  if ( $.fn.DataTable.isDataTable('#precription_table') ) {
  $('#precription_table').DataTable().destroy();
}
  
 
  //    $('.edit_quantity').click(function () {
  //       showDialog({
  //           title: 'Action',
  //           text:'<div class="mdl-card__supporting-text">'+
  //       '<form action="#">'+
  //         '<div class="mdl-textfield mdl-js-textfield">'+
  //           '<input class="mdl-textfield__input" type="text" id="username" />'+
  //           '<label class="mdl-textfield__label" for="username">Username</label>'+
  //         '</div>'+
  //         '<div class="mdl-textfield mdl-js-textfield">'+
  //           '<input class="mdl-textfield__input" type="password" id="userpass" />'+
  //           '<label class="mdl-textfield__label" for="userpass">Password</label>'+
  //         '</div>'+
  //      '</form>'+
  //     '</div>'
  //     // '<div class="mdl-card__actions mdl-card--border">'+
  //     //   '<button class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">Log in</button>'+
  //     // '</div>'
  // ,
  //           negative: {
  //               title: 'Nope'
  //           },
  //           positive: {
  //               title: 'Yay',
  //               onClick: function (e) {
  //                   alert('Action performed!');
  //               }
  //           }
  //       });
  //   });
  //   mdl_dialog('.dialog-button-delete','.dialog-delete-close','#dialog_delete');

    $(document).on("click", "#add_prescription", function(){

    if($('#user_id').val()!=""){
    var input = $(this);
    var button =this;
    button.disabled = true;
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/add_prescription",
        method: 'POST',
        dataType:'text',
        data: $('#add_prescription_form').serialize(),
        success:function(data){
          console.log(data);
            $('#add_pres_modal').modal('hide');
            $("#brand_name").val('').trigger('change');
            $("#dosage_strength").val('').trigger('change');
            $("#dosage_form").val('').trigger('change');
            $("#pres_quantity").val('').trigger('change');
            $("#quantity").val('').trigger('change');
            $("#signa").val('').trigger('change');
            $("#allergy").val('').trigger('change');
            $("#time").val('').trigger('change');
            $("#per_day").val('').trigger('change');

          button.disabled = false;   
        },
        error: function(data){
            swal(data);
            button.disabled = false;   
        }
    })
    }
    else{
        alert('maoni');
    }
});
  var dialog = document.querySelector("#edit_modal");
  dialog.addEventListener('show', function() {
       
    });

    $(document).on("click", ".edit_prescription", function(){

    if($('#user_id').val()!=""){
    var pres_id = $(this).attr("value");
    
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/fetch_prescription",
        method: 'POST',
        dataType:'text',
        data: {id:pres_id},
        success:function(data){
          var obj = JSON.parse(data);
          console.log(obj);
            $("#pres_id_edit").val(obj.id);
            $("#generic_name_edit").val(obj.generic_name).parent().addClass('is-focused');
            $("#brand_name_edit").val(obj.brand_name).parent().addClass('is-focused');
            $("#dosage_strength_edit").val(obj.dosage_strength).parent().addClass('is-focused');
            $("#dosage_form_edit").val(obj.dosage_form).parent().addClass('is-focused');
            $("#pres_quantity_edit").val(obj.pres_quantity).parent().addClass('is-focused');
            $("#quantity_edit").val(obj.quantity).parent().addClass('is-focused');
            $("#signa_edit").val(obj.signa).parent().addClass('is-focused');
            $("#allergy_edit").val(obj.allergy).parent().addClass('is-focused');
            $("#time_edit").val(obj.time).parent().addClass('is-focused');
            $("#per_day_edit").val(obj.per_day).parent().addClass('is-focused');

          // button.disabled = false;   
        },
        error: function(data){
            // swal(data);
            // button.disabled = false;   
        }
    })
    }
    else{
        alert('maoni');
    }
});
    $(document).on("click", ".delete_prescreption", function(){   
    var pres_id = $(this).attr("value");  
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url:"/delete_prescription",
        method: 'POST',
        dataType:'text',
        data: {id:pres_id},
        success:function(data){
           var obj = JSON.parse(data);
           console.log(obj);
              swal({
                type: 'success',
                title: obj.brand_name+' has been deleted',
                showConfirmButton: false,
                timer: 1500
              })
              
              $.getJSON( '5', null, function ( json ) {
                  $('#precription_table').DataTable().destroy();
                  $('#precription_table').DataTable().empty(); // empty in case the columns change
           
                 $('#precription_table').DataTable( {
                      columns: json.columns,
                      data:    json.rows
                  } );
              } );
        },
        error: function(data){
          swal({
            type: 'error',
            title: 'Oops...',
            text: 'Deleting Error!',
          })

        }
    })  
});


   $(document).on("click", "#edit", function(){

      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          url:"/edit_prescription",
          method: 'POST',
          dataType:'text',
          data: $('#edit_prescription_form').serialize(),
          success:function(data){
            swal({
              type: 'success',
              title: 'Your work has been saved',
              showConfirmButton: false,
              customClass: 'animated tada',
              timer: 1500
            })

          },
          error: function(data){
              // swal(data);
              // button.disabled = false;   
          }
      })
      
  });
  </script>

@endsection