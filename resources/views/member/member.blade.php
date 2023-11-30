@php
$var_objective = "Member";
@endphp
@extends('components.main-layout')
<title>Users</title>
@section('content')
<style>

</style>

 <div class="d-flex flex-column flex-root">
        <!-- begin topbar -->
     
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid body-cont">
            <!-- begin Sidebar -->
       
            <div class="flex-shrink-0 p-3 bg-white sub-nav" id="panel" style="width: 280px; margin-top: 5%;">
                <button id="closeBtn" class="close-button">
                    <img src="{{asset('public/assets/images/icons/collaps.svg')}}">
                </button>
                <h6 class="title">Menu</h6>
                <ul class="list-unstyled ps-0">
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                            All Organizations
                        </button>
                        <div class="collapse show" id="home-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small px-3 py-2 nav-root-item">
                                <li class="py-2"><a href="#" class="link-dark rounded">Organization 1</a></li>
                                <li class="py-2"><a href="#" class="link-dark rounded">Organization 2</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                            Departments
                        </button>
                        <div class="collapse" id="dashboard-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small px-3 py-2">
                                <li class="py-2"><a href="#" class="link-dark rounded">Sales & Finance</a></li>
                                <li class="py-2"><a href="#" class="link-dark rounded">Human Resources</a></li>
                                <li class="py-2"><a href="#" class="link-dark rounded">IT Departments</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- end Sidebar -->
            <div class="content d-flex flex-column flex-column-fluid">
                <!-- begin breadcrums -->
                <!-- end breadcrums -->
                <!-- begin page Content -->
                <div class="container-fluid py-5 w-96">
                    <div class="row">
                        <div class="col-md-12 p-0">
                            <div class="card">
                                <div class="card-body p-10">
                                    <table class="table data-table">
                                        <thead>
                                            <tr>
                                                <td>
                                                    <label class="form-checkbox">
                                                        <input type="checkbox" id="checkAll">
                                                        <span class="checkbox-label"></span>
                                                    </label>
                                                </td>
                                                <td>Member</td>
                                                <td>Email address</td>
                                                <td>Phone Number</td>
                                                <td>Role</td>
                                                <td>Status</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         

                                           
                                              @if (session('message'))
                                              <div class="alert alert-success mt-1" role="alert">
                                                  {{ session('message') }}
                                              </div>
                                               @endif
                                               
                                           @foreach($Member as $member)
                                            <tr>
                                                <td>
                                                    <label class="form-checkbox">
                                                        <input type="checkbox" class="checkbox check" value="{{$member->ID}}">
                                                        <span class="checkbox-label"></span>
                                                    </label>
                                                </td>
                                                <td class="image-cell">
                                                    @if($member->image != NULL)
                                                    <img src="{{asset('public/assets/images/'.$member->image)}}" alt="Example Image">
                                                    @else
                                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTv1Tt9_33HyVMm_ZakYQy-UgsLjE00biEArg&usqp=CAU" alt="Example Image">
                                                    @endif
                                                    <div>
                                                        <div class="title">{{$member->name}} {{$member->LastName}}</div>
                                                    </div>
                                                </td>
                                                <td>{{$member->email}}</td>
                                                <td>{{$member->phone}}</td>
                                                <td>{{$member->u_role}}</td>
                                                <td>
                                                    @if($member->u_status == 1)
                                                    <span class="badge badge-pill badge-success">Active</span>
                                                    @else
                                                     <span class="badge badge-pill badge-danger">Blocked</span>
                                                    @endif
                                                    <!--<span class="badge badge-pill badge-warning">Pending Invite</span>-->
                                                   
                                                </td>
                                                
                                                <td>
                                                    <button class="btn-circle btn-tolbar" data-toggle="modal" data-target="#edit-member{{$member->ID}}">
                                                        <img src="{{asset('public/assets/images/icons/edit.svg')}}" data-toggle="tooltip" data-placement="top" data-original-title="Edit">
                                                    </button>
                                                    <button class="btn-circle btn-tolbar" data-toggle="modal" onclick="deletemember({{$member->ID}},'{{$member->u_id}}')" data-target="#delete-member">
                                                        <img src="{{asset('public/assets/images/icons/delete.svg')}}" data-toggle="tooltip" data-placement="top" data-original-title="Delete">
                                                    </button>
                                                </td>
                                            </tr>
                                            
                                <div class="modal fade" id="edit-member{{$member->ID}}" tabindex="-1" role="dialog" aria-labelledby="edit-member" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content" style="width: 526px !important;">
                                        <div class="modal-header">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5 class="modal-title" id="create-epic">Edit User</h5>
                                                </div>
                                                <div class="col-md-12">
                                                    <p>Fill out the form & we'll send them an invite</p>
                                                </div>
                                                <span class="email-error-member" class="ml-3 text-danger"></span>
                                                
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="needs-validation" action="{{url('edit-member')}}" method="POST" enctype="multipart/form-data">
                                             @csrf    
                                                <input type="hidden"  name="member_id" value="{{$member->ID}}">
                                                 <input type="hidden" id="member" name="user_id" value="{{$member->u_id}}">
                                                <div class="row">
                                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                                        <div class="form-group mb-0">
                                                            <input type="text" class="form-control" value="{{$member->Name}}" name="name" >
                                                            <label for="objective-name">First Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                                        <div class="form-group mb-0">
                                                            <input type="text" class="form-control" value="{{$member->LastName}}" id="member_name" name="last_member_name" required>
                                                            <label for="objective-name">Last Name</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                                    <div class="form-group mb-0">
                                                           <input type="email" class="form-control" onchange="checkemailedit(this.value)" value="{{$member->email}}" id="email_edit">
                                                            <label for="email">Email</label>
                                                      </div>
                                                    </div>
                                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                                        <div class="form-group mb-0">
                                                            <input type="text" value="{{$member->phone}}" class="form-control" onkeypress="return onlyNumberKey(event)" name="phone" >
                                                            <label for="phone-number">Phone number</label>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                                    <div class="form-group mb-0">
                                                       <select class="form-control"  name="status">
                                                           <option @if($member->status == 1) selected @endif value="1">Active</option>
                                                            <option @if($member->status == 0) selected @endif value="0">Blocked</option>
        
                        
                                                       </select>
                                                        <label for="small-description">Status</label>
                                                    </div>
                                                </div>
                                                    
                                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                                        <div class="form-group mb-0">
                                                            <input type="text" class="form-control" value="{{$member->u_role}}"  name="role" >
                                                            <label for="role">Role</label>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <input type="hidden" id="old_image" name="old_image" value="{{ $member->image }}">
                                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                                    @if($member->image != NULL)
                                                    <img src="{{asset('public/assets/images/'.$member->image)}}" style="width:100px; height:100px; object-fit:cover" alt="Example Image">
                                                        @else
                                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTv1Tt9_33HyVMm_ZakYQy-UgsLjE00biEArg&usqp=CAU" style="width:100px; height:100px; object-fit:cover" alt="Example Image">
                                                        @endif
                                                        <div class="form-group mb-0">
                                                            <input type="file" class="form-control" name="image" >
                                                            <label for="profile">Profile Picture</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <button class="btn btn-primary btn-lg btn-theme btn-block ripple" id="edit-memeber" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         @endforeach
                                            
                                            <!-- Add more rows as needed -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page content -->
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="create-member" tabindex="-1" role="dialog" aria-labelledby="create-member" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 526px !important;">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="create-epic">Add User</h5>
                    </div>
                    <div class="col-md-12">
                        <p>Fill out the form & we'll send them an invite</p>
                    </div>
                    <div id="success-member"  role="alert"></div>
                    <span id="email-error-member" class="ml-3 text-danger"></span>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" action="{{url('save-member')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" id="member_name" name="member_name" required>
                                <label for="objective-name">First Name</label>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" id="member_name" name="last_member_name" required>
                                <label for="objective-name">Last Name</label>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="email" class="form-control" id="email" name="email" onkeyup="checkemail(this.value)" required>
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" name="phone" onchange="return onlyNumberKey(event)" id="phone_number" required>
                                <label for="phone-number">Phone number</label>
                            </div>
                        </div>
                        
                        <!--    <div class="col-md-12 col-lg-12 col-xl-12">-->
                        <!--    <div class="form-group mb-0">-->
                        <!--       <select class="form-control" id="org_id" name="org_id" required>-->
                        <!--        <option value="">Select Organization</option>-->
                        <!--            <?php foreach(DB::table('organization')->where('user_id',Auth::id())->where('trash',NULL)->get() as $r){ ?>-->
                        <!--              <option value="{{ $r->id }}">{{ $r->organization_name }}</option>-->
                        <!--            <?php }  ?>-->

                        <!--       </select>-->
                        <!--        <label for="small-description">Organization</label>-->
                        <!--    </div>-->
                        <!--</div>  -->
                        
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" id="role" name="role" required>
                                <label for="role">Role</label>
                            </div>
                        </div>
                        
                        
                        
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="file" class="form-control" id="add_image" name="add_image">
                                <label for="profile">Profile Picture</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-lg btn-theme btn-block ripple" id="button-check" type="submit">Send Invitation</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="delete-member" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="success-member-delete"  role="alert"></div>

        <form method="POST" action="">
         @csrf   
         <input type="hidden" name="" id="member-id">
         <input type="hidden" name="" id="user-id">

        <div class="modal-body">
          
        Are you sure you want to delete this Member?

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" onclick="DeleteMember();" class="btn btn-danger">Confirm</button>
        </div>
        </form>
      </div>
    </div>
  </div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

//   function SaveMember(){

//     var file_data = $('#add_image').prop('files')[0];
//     var form_data = new FormData();
//     form_data.append('add_image', file_data);
//     form_data.append('member_name', $('#member_name').val());
//     form_data.append('phone', $('#phone_number').val());
//     form_data.append('email', $('#email').val());
//     form_data.append('role', $('#role').val());
//     form_data.append('org_id', $('#org_id').val());
//     form_data.append('_token', $('meta[name="csrf-token"]').attr('content'));
 
    
//     if (file_data) 
//     {
//     form_data.append('add_image',file_data);
//     }else 
//     {
//     form_data.append('add_image', '');
//     }


//     if($('#member_name').val() =='' || $('#phone_number').val() == '' || $('#email').val() =='')
//     {
           
//       $('#email-error-member').html('Please fill out all required fields.');  
//       return false;
//     }else{
           
//         $('#email-error-member').html('');

//     }    
        
//         $.ajax({
//             type: "POST",
//             url:"{{url('save-member')}}", 
//             data: form_data,
//             cache: false,
//             contentType: false,
//             processData: false,
//             success: function(res) {
//               if(res == 1)
//               {

//               $('#email-error-member').html('<strong class="text-danger">Email Already Taken</strong>');

              
//               }else
//               {
//               $('#email-error-member').html(''); 
//               $('#member_name').val('');
//               $('#email').val('');
//               $('#role').val('');
//               $('#phone_number').val('');
//               $('#add_image').val('');
//               $('#success-member').html('<div class="alert alert-success" role="alert">Member Created successfully</div>');
//               setTimeout(function() { 
//               $('#create-member').modal('hide');
//               location.reload();

               
//             }, 1000);
//               }
            
//             }
//         });
   
// }


    // $(document).ready(function() {
    //   // DataTables initialization
    //   var table = $('#example').DataTable({
    //     "pagingType": "full_numbers",
    //     "language": {
    //       "paginate": {
    //         "previous": "&lsaquo;", // Custom previous arrow
    //         "next": "&rsaquo;" // Custom next arrow
    //       }
    //     }
    //   });

    //   // Check All checkbox functionality
 
			
    // });
    
$("#checkAll").click(function () {
$('input:checkbox').not(this).prop('checked', this.checked);

   var selectedOptions = [];
    $('.checkbox:checked').each(function() {
     selectedOptions.push($(this).val());
     
});

if(selectedOptions.length > 0){
if(this.checked)
{
  $('#delete-button-user').show();  
}else{
  $('#delete-button-user').hide();  
}
}
});

   function onlyNumberKey(evt) {
          
          var ASCIICode = (evt.which) ? evt.which : evt.keyCode
          if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
              return false;
          return true;
      }
      
       function checkemail(email)
        {
       
        $.ajax({
        type: "GET",
        url: "{{ url('check-email') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
        email:email,
   

        },
        success: function(res) {
            
        if(res == 1)
        {
        $('#button-check').attr('disabled',true); 
        $('#email-error-member').html('<strong class="text-danger">Email Already Taken</strong>');
        }
        if(res == 2)
        {
        $('#button-check').attr('disabled',false);
        $('#email-error-member').html('');
        }    
          


        }
    });

        }
        
        function deletemember(m_id,u_id)
        {
       
         $('#member-id').val(m_id);
         $('#user-id').val(u_id);

        }
        
        function DeleteMember()
        {
       
       var member_id = $('#member-id').val();
       var user_id =  $('#user-id').val();
         
        $.ajax({
        type: "POST",
        url: "{{ url('delete-member') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
        user_id:user_id,
        member_id:member_id
   

        },
        success: function(res) {
            
       
       $('#success-member-delete').html('<div class="alert alert-success" role="alert">Member Deleted successfully</div>');
        setTimeout(function() { 
        location.reload();
        
        }, 2000);

        }
    });

        }
        
function delete_record_user()
 {
  
     var selectedOptions = [];
    $('.checkbox:checked').each(function() {
     selectedOptions.push($(this).val());
     
});

  if(selectedOptions.length > 0){
  $.ajax({
            type: "POST",
            url:"{{url('delete-mutiple-user')}}", 
             data:{selectedOptions:selectedOptions,_token:'{{ csrf_token() }}'},
            success: function(res) {
                
             location.reload();
            }
        });
  }
     
}

     function checkemailedit(email)
    {
       
       var member = $('#member').val();
       
        $.ajax({
        type: "GET",
        url: "{{ url('check-email-edit') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
        email:email,
        member:member,
   

        },
        success: function(res) {
  
        if(res == 1)
        {
      
            $('#edit-memeber').attr('disabled',false);
        $('.email-error-member').html('');
        }else
        {
      
        $('#edit-memeber').attr('disabled',true); 
        $('.email-error-member').html('<strong class="text-danger">Email Already Taken</strong>');
        }
          
          


        }
    });

        }
        
         $(document).ready(function() {
          setTimeout(function(){$('.alert-success').slideUp();},3000); 
        });

  </script>


@endsection