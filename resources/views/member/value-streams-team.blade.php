@php
$var_objective = "Stream-team";
@endphp
@extends('components.main-layout')
<title>Teams-{{$organization->value_name}}</title>
@section('content')
 <div class="d-flex flex-column flex-root">
        <!-- begin topbar -->
    
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid body-cont">
            <!-- begin Sidebar -->
         
          
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
                                                        <td>Name</td>
                                                        <td>Members</td>
                                                        <td>Lead</td>
                                                        <td>Action</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    @if (session('message'))
                                                      <div class="alert alert-success mt-1" role="alert">
                                                          {{ session('message') }}
                                                      </div>
                                                       @endif
                                                       
                                                    @if(count($Team) > 0)
                                                   @foreach($Team as $team)
                                                   
                                                    @php
                                                    $dataArray = explode(",", $team->member);
                                                    $dataCount = count($dataArray);
                                                    @endphp
                                                
                                                    <tr>
                                                        <td>
                                                            <label class="form-checkbox">
                                                                <input type="checkbox">
                                                                <span class="checkbox-label"></span>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <a class="nav-link" href="{{url('dashboard/organization/'.$team->slug.'/portfolio/VS')}}">{{$team->team_title}}</a>
                                                        </td>
                                                        
                                                        <td>{{$dataCount}}</td>
                                               
                                                        @foreach(DB::table('members')->get() as $r)
                                                        @if($r->id == $team->lead_id)
                                                        <td class="image-cell">
                                                            @if($r->image != NULL)
                                                            <img src="{{asset('public/assets/images/'.$r->image)}}" alt="Example Image">
                                                            @else
                                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTv1Tt9_33HyVMm_ZakYQy-UgsLjE00biEArg&usqp=CAU" alt="Example Image">
                                                            @endif
                                                            <div>
                                                                <div class="title">{{$r->name}} {{$r->last_name}}</div>
                                                            </div>
                                                        </td>
                                                        @endif
                                                        @endforeach
                                                        
                                                        <td>
                                                              <button class="btn-circle btn-tolbar" data-toggle="modal" data-target="#add-team-stream-edit{{$team->id}}">
                                                                <img src="{{asset('public/assets/images/icons/edit.svg')}}" data-toggle="tooltip" data-placement="top" data-original-title="Edit">
                                                            </button>
                                                            <button class="btn-circle btn-tolbar" data-toggle="modal" data-target="#delete{{$team->id}}">
                                                                <img src="{{asset('public/assets/images/icons/delete.svg')}}" data-toggle="tooltip" data-placement="top" data-original-title="Delete">
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    
                                                         <div class="modal fade" id="delete{{$team->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Delete Team</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                          </button>
                                                        </div>
                                                      
                                                
                                                        <form method="POST" action="{{url('delete-value-team')}}">
                                                         @csrf   
                                                         <input type="hidden" name="delete_id" value="{{$team->id}}">
                                                       
                                                
                                                        <div class="modal-body">
                                                          
                                                        Are you sure you want to delete this Team?
                                                
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                          <button type="submit" class="btn btn-danger">Confirm</button>
                                                        </div>
                                                        </form>
                                                      </div>
                                                    </div>
                                                  </div>
                                                    
                                                    
                                        <div class="modal fade" id="add-team-stream-edit{{$team->id}}" tabindex="-1" role="dialog" aria-labelledby="add-team" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                        <div class="modal-content" style="width: 526px !important;">
                                            <div class="modal-header">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="modal-title" id="create-epic">Create Team</h5>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <p>Lorem ipsum dummy text for printing</p>
                                                    </div>
                                                </div>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="needs-validation" action="{{url('update-stream-team')}}"  method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{$team->id}}">
                                                    <div class="row">
                                                        <div class="col-md-12 col-lg-12 col-xl-12">
                                                            <div class="form-group mb-0">
                                                                <input type="text" class="form-control" name="team_title_edit" value="{{$team->team_title}}" id="team-title" required>
                                                                <label for="team-title">Name</label>
                                                            </div>
                                                        </div>
                                                         <div class="col-md-12 col-lg-12 col-xl-12">
                                                            <div class="form-group mb-0">
                                                                <select class="form-control" name="edit_lead_manager_team">
                                                                    @foreach(DB::table('members')->where('org_user',Auth::id())->get() as $r)
                                                                      <option  @if($r->id == $team->lead_id) selected @endif value="{{ $r->id }}">{{ $r->name }} {{ $r->last_name }}</option>
                                                                     @endforeach
                                                                </select>
                                                                <label for="lead-manager">Lead</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-lg-12 col-xl-12">
                                                            <div class="d-flex flex-row align-items-center justify-content-between mt-4">
                                                                <div>
                                                                    Organization Member
                                                                </div>
                                                                <div>
                                                                    <input type="text" class="form-control input-sm" placeholder="Search..." name="">
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        </div>
                                                        <div class="col-md-12 col-lg-12 col-xl-12 member-area">
                                                          
                                                            @foreach(DB::table('members')->where('org_user',Auth::id())->get() as $r)
                                                            <div class="d-flex flex-row align-items-center justify-content-between single-member">
                                                                <div class="d-flex flex-row align-items-center ">
                                                                    <div>
                                                                         @if($r->image != NULL)
                                                                        <img width="45px" height="45px" src="{{asset('public/assets/images/'.$r->image)}}" alt="Example Image">
                                                                        @else
                                                                        <img width="45px" height="45px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTv1Tt9_33HyVMm_ZakYQy-UgsLjE00biEArg&usqp=CAU" alt="Example Image">
                                                                        @endif
                                                                        
                                                                    </div>
                                                                    <div class="d-flex flex-column ml-3">
                                                                        <p>{{$r->name}} {{$r->last_name}}</p>
                                                                        <small>{{$r->email}}</small>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <input type="checkbox" @foreach(explode(',',$team->member) as $t) @if($r->id == $t) checked @endif @endforeach value="{{$r->id}}" name="edit_member[]">
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="col-md-12">
                                                            <button class="btn btn-primary btn-lg btn-theme btn-block ripple" type="submit">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                    @endforeach
                                                    @endif
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
    
    
    <!-- Create Business Unit -->
<!-- Create Business Unit -->
<div class="modal fade" id="add-team-stream" tabindex="-1" role="dialog" aria-labelledby="add-team" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 526px !important;">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="create-epic">Create Team</h5>
                    </div>
                    <div class="col-md-12">
                        <p>Lorem ipsum dummy text for printing</p>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" action="{{url('add-stream-team')}}"  method="POST">
                    @csrf
                    <input type="hidden" name="org_stream_id" value="{{$organization->id}}">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" name="team_title" id="team-title" required>
                                <label for="team-title">Name</label>
                            </div>
                        </div>
                         <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <select class="form-control" name="lead_manager_team">
                                    <?php foreach(DB::table('members')->where('org_user',Auth::id())->get() as $r){ ?>
                                      <option value="{{ $r->id }}">{{ $r->name }} {{ $r->last_name }}</option>
                                    <?php }  ?>
                                </select>
                                <label for="lead-manager">Lead</label>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="d-flex flex-row align-items-center justify-content-between mt-4">
                                <div>
                                    Add User
                                </div>
                                <div>
                                    <input type="text" class="form-control input-sm" onkeyup="search_member(this.value);" placeholder="Search..." name="">
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12 member-area" id="member">
                          
                            @foreach(DB::table('members')->where('org_user',Auth::id())->get() as $r)
                            <div class="d-flex flex-row align-items-center justify-content-between single-member">
                                <div class="d-flex flex-row align-items-center ">
                                    <div>
                                         @if($r->image != NULL)
                                        <img width="45px" height="45px" src="{{asset('public/assets/images/'.$r->image)}}" alt="Example Image">
                                        @else
                                        <img width="45px" height="45px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTv1Tt9_33HyVMm_ZakYQy-UgsLjE00biEArg&usqp=CAU" alt="Example Image">
                                        @endif
                                        
                                    </div>
                                    <div class="d-flex flex-column ml-3">
                                        <p>{{$r->name}} {{ $r->last_name }}</p>
                                        <small>{{$r->email}}</small>
                                    </div>
                                </div>
                                <div>
                                    <input type="checkbox" value="{{$r->id}}" name="member[]">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-lg btn-theme btn-block ripple" type="submit">Create Team</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
   
<script>
function search_member(val)
{
           
           $.ajax({
            type: "GET",
            url:"{{url('get-user')}}", 
            data:{val:val},
            success: function(res) {
                
            $('#member').html(res);    

            }
        });
    
}
 $(document).ready(function() {
 setTimeout(function(){$('.alert-success').slideUp();},3000); 
}); 
</script>  
@endsection