@php
$var_objective = "Backlog";
@endphp
@extends('components.main-layout')
<title>Backlog-{{$organization->value_name}}</title>
@section('content')
<style>

</style>

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
                <div class="container-fluid py-5 w-96" id="assign-epic">
                    <div class="row">
                        <div class="col-md-12 p-0">
                            <div class="card">
                                <div class="card-body p-10">
                                
                                   <table class="table data-table example" id="olddata">
                                                <thead>
                                                    <tr>
                                                        <td>
                                                            <label class="form-checkbox">
                                                                <input type="checkbox" id="checkAll">
                                                                <span class="checkbox-label"></span>
                                                            </label>
                                                        </td>
                                                        <td>Title</td>
                                                        <td>Quarter</td>
                                                        <td>Start/End Date</td>
                                                        <td>Status</td>
                                                        <td>Progress</td>
                                                        <td>Action</td>
                                                    </tr>
                                                </thead>
                                                <tbody class="boards" id="backlog-board">

                                                    
                                                    @if (session('message'))
                                                      <div class="alert alert-success mt-1" role="alert">
                                                          {{ session('message') }}
                                                      </div>
                                                       @endif
                                                       
                                                    @foreach($Backlog as $backlog)       
                                                    <tr id="backlog-{{$backlog->id}}">
                                                        <td>
                                                    <label class="form-checkbox">
                                                    <input type="checkbox" class="checkbox" value="{{$backlog->id}}">
                                                    <span class="checkbox-label"></span>
                                                  </label>
                                                        </td>
                                                        <td class="draggable">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
                                                                    <g clip-path="url(#clip0_2251_29600)">
                                                                        <path d="M22 11C22 4.92487 17.0751 0 11 0C4.92487 0 0 4.92487 0 11C0 17.0751 4.92487 22 11 22C17.0751 22 22 17.0751 22 11Z" fill="#EFEFEF" />
                                                                        <path d="M9.7267 17.1115C9.60672 17.1115 9.48675 17.0895 9.37199 17.0456C8.98075 16.8917 8.73036 16.507 8.73036 16.0674V12.523H7.50971C7.11326 12.523 6.76896 12.2868 6.60725 11.9076C6.44554 11.5284 6.50814 11.0998 6.76896 10.7866L10.7178 6.06072C10.9943 5.73101 11.4221 5.61561 11.8133 5.77497C12.2045 5.92884 12.4549 6.3135 12.4549 6.75311V10.2975H13.6756C14.072 10.2975 14.4163 10.5338 14.578 10.913C14.7397 11.2921 14.6771 11.7207 14.4163 12.034L10.4674 16.7598C10.2744 16.9906 10.0032 17.1115 9.7267 17.1115ZM11.4533 6.52781C11.4064 6.52781 11.349 6.5443 11.3021 6.60474L7.3532 11.3361C7.26974 11.435 7.30105 11.5339 7.3167 11.5724C7.33235 11.6108 7.38451 11.7043 7.50971 11.7043H9.12159C9.33547 11.7043 9.51283 11.8911 9.51283 12.1164V16.0729C9.51283 16.2103 9.60673 16.2653 9.64846 16.2817C9.69019 16.2982 9.79451 16.3257 9.87797 16.2213L13.8268 11.49C13.9103 11.391 13.879 11.2921 13.8634 11.2537C13.8477 11.2152 13.7955 11.1218 13.6703 11.1218H12.0585C11.8446 11.1218 11.6672 10.9349 11.6672 10.7096V6.75311C11.6672 6.61573 11.5733 6.56078 11.5316 6.5443C11.5159 6.53331 11.4846 6.52781 11.4533 6.52781Z" fill="#292D32" />
                                                                    </g>
                                                                    <defs>
                                                                        <clipPath id="clip0_2251_29600">
                                                                            <rect width="22" height="22" fill="white" />
                                                                        </clipPath>
                                                                    </defs>
                                                                </svg>
                                                          {{$backlog->epic_title}}
                                                        </td>
                                                         <td> 
                                                      
                                                        @if($backlog->assign_status == NULL)
                                                    
                                                 
                                                        Assign
                                                        
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" data-toggle="modal"  data-target="#assign-unitbacklog-epic{{$backlog->id}}">
                                                              <path d="M4.72421 14.1377C4.29212 14.1377 3.88837 13.989 3.59796 13.7127C3.22962 13.3656 3.05254 12.8415 3.11629 12.2748L3.37837 9.9798C3.42796 9.54772 3.69004 8.97397 3.99462 8.6623L9.81004 2.50688C11.2621 0.969799 12.778 0.9273 14.315 2.37938C15.8521 3.83147 15.8946 5.3473 14.4425 6.88438L8.62712 13.0398C8.32962 13.3585 7.77712 13.656 7.34504 13.7269L5.06421 14.1165C4.94379 14.1235 4.83754 14.1377 4.72421 14.1377ZM12.0838 2.3723C11.5384 2.3723 11.0638 2.7123 10.5821 3.2223L4.76671 9.3848C4.62504 9.53355 4.46212 9.88772 4.43379 10.0931L4.17171 12.3881C4.14337 12.6219 4.20004 12.8131 4.32754 12.9335C4.45504 13.054 4.64629 13.0965 4.88004 13.061L7.16087 12.6715C7.36629 12.6361 7.70629 12.4519 7.84796 12.3031L13.6634 6.14772C14.5417 5.21272 14.8605 4.34855 13.5784 3.14438C13.0117 2.59897 12.523 2.3723 12.0838 2.3723Z" fill="#292D32"/>
                                                              <path d="M13.0824 8.06722C13.0683 8.06722 13.047 8.06722 13.0329 8.06722C10.8229 7.84764 9.04495 6.16889 8.70495 3.97305C8.66245 3.68264 8.86078 3.41347 9.1512 3.36389C9.44162 3.32139 9.71078 3.51972 9.76037 3.81014C10.0295 5.5243 11.4179 6.8418 13.1462 7.0118C13.4366 7.04014 13.6491 7.30222 13.6208 7.59264C13.5854 7.8618 13.3516 8.06722 13.0824 8.06722Z" fill="#292D32"/>
                                                              <path d="M15.6748 16.4255H2.9248C2.63439 16.4255 2.39355 16.1847 2.39355 15.8943C2.39355 15.6039 2.63439 15.363 2.9248 15.363H15.6748C15.9652 15.363 16.2061 15.6039 16.2061 15.8943C16.2061 16.1847 15.9652 16.4255 15.6748 16.4255Z" fill="#292D32"/>
                                                              </svg>
                                                        @endif      
                                                              
                                                   </td>
                                                   
                                                <div class="modal fade" id="assign-unitbacklog-epic{{$backlog->id}}" tabindex="-1" role="dialog" aria-labelledby="create-epic" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content" style="width: 526px !important;">
                                                            <div class="modal-header">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <h5 class="modal-title" id="create-epic">Assign Backlog Epic</h5>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <p>Fill out the form, submit and hit the save button.</p>
                                                                    </div>
                                                                      <div id=""  role="alert"></div>
                                                                    <span id="" class="ml-3 text-danger"></span>
                                                                </div>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <form class="needs-validation" action="{{url('assign-backlog-epic')}}" method="POST">
                                                            @csrf   
                                                               
                                                                <input type="hidden" name="backlog_id" value="{{$backlog->id}}">
                                                
                                                              <div class="row">
                                                              <div class="col-md-12 col-lg-12 col-xl-12">
                                                                <div class="form-group mb-0">
                                                                   <select class="form-control category" id="" name="stream_obj" required>
                                                                    <option value="" >Select Value Stream</option>
                                                                    <?php foreach(DB::table('value_stream')->where('user_id',Auth::id())->get() as $r){ ?>
                                                                      <option value="{{ $r->id }}">{{ $r->value_name }}</option>-->
                                                                       <?php }  ?>
                                    
                                                                   </select>
                                                                    <label for="small-description">Choose Value Stream</label>
                                                                </div>
                                                            </div>
                                                
                                                 <div class="col-md-12 col-lg-12 col-xl-12">
                                                    <div class="form-group mb-0">
                                                     <select name="locstate" id="" onchange="getvaluekey(this.value)"  class="form-control obj" value="" required>
                                                                            
                                                    </select>
                                                        <label for="small-description">Choose Objective</label>
                                                    </div>
                                                </div>
                                                
                                                      <div class="col-md-12 col-lg-12 col-xl-12">
                                                    <div class="form-group mb-0">
                                                     <select name="lockey" id="" onchange="getvalueintit(this.value)"  class="form-control key" value="" required>
                                                                            
                                                    </select>
                                                        <label for="small-description">Choose Key Result</label>
                                                    </div>
                                                </div>
                                                
                                                  <div class="col-md-12 col-lg-12 col-xl-12">
                                                    <div class="form-group mb-0">
                                                     <select name="locinit" id="" class="form-control init"  value="" required>
                                                                            
                                                    </select>
                                                        <label for="small-description" style="bottom:72px;">Choose Initiative</label>
                                                    </div>
                                                </div>
                                                
                                              
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group mb-0">
                                                        <input type="date" class="form-control" name="start_date[]" @if($backlog->epic_start_date) value="{{$backlog->epic_start_date}}" @else value="{{date('Y-m-d')}}" @endif required>
                                                        <label for="start-date">Start Date</label>
                                                    </div>
                                                </div>
                                                
                                                  <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group mb-0">
                                                        <input type="date" class="form-control" name="end_date[]"  @if($backlog->epic_end_date) value="{{$backlog->epic_end_date}}" @else value="{{date('Y-m-d')}}" @endif  required>
                                                        <label for="start-date">End Date</label>
                                                    </div>
                                                </div>
                                               @if($backlog->quarter != NULL)
                                                                       
                                                                        <div class="col-md-12 col-lg-12 col-xl-12">
                                                                        <div class="form-group mb-0">
                                                                            <input type="text" class="form-control"  name="" value="{{$backlog->quarter}}" >
                                                                            <label for="start-date">Quarter</label>
                                                                        </div>
                                                                    </div>
                                                       
                                                                     @endif
                                                
                                                    <div class="col-md-12">
                                                        <button class="btn btn-primary btn-lg btn-theme btn-block ripple mt-3"  type="submit">Add</button>
                                                    </div>
                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                $startdate = json_decode($backlog->epic_start_date);
                                                $enddate = json_decode($backlog->epic_end_date);
                                                @endphp
                                                        <td> 
                                                        @if($backlog->epic_end_date != '')
                                                       {{ \Carbon\Carbon::parse($backlog->epic_start_date)->format('M d')}}
                                                     
                                                        - {{ \Carbon\Carbon::parse($backlog->epic_end_date)->format('M d')}}
                                                    
                                                        @else
                                                         Epic Date Not Selected
                                                         @endif
                                                          </td>
                                                        <td>
                                                          <div class="text-center">
                                                                                          
                                                        @if($backlog->epic_status == 'In Progress')
                                                        <span class="badge-cs warning w-100">{{$backlog->epic_status}}</span>
                                                        @endif
                                                        @if($backlog->epic_status == 'Done')
                                                        <span class="badge-cs success">Done</span>
                                                        @endif
                                                        @if($backlog->epic_status == 'To Do')
                                                        <span class="badge-cs bg-primary">To Do</span>
                                                        @endif
                                                        </div>
                                                        </td>
                                                     
                                                        <td> 
                                                        <div class="d-flex flex-column">
                                                            <div class="ml-auto">
                                                                {{round($backlog->progress,2)}}%
                                                            </div>
                                                            <div>
                                                                <div class="progress">
                                                                  <div class="progress-bar" role="progressbar" style="width: {{$backlog->progress}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </td>
                                                        <td>
                                                            <button class="btn-circle btn-tolbar" data-toggle="modal" data-target="#create{{$backlog->id}}" >
                                                                <img src="{{asset('public/assets/images/icons/edit.svg')}}" data-toggle="tooltip" data-placement="top" data-original-title="Edit">
                                                            </button>
                                                            <button class="btn-circle btn-tolbar" data-toggle="modal" data-target="#delete{{$backlog->id}}">
                                                                <img src="{{asset('public/assets/images/icons/delete.svg')}}" data-toggle="tooltip" data-placement="top" data-original-title="Delete">
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    
                                                    <div class="modal fade" id="delete{{$backlog->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Delete Backlog</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                          </button>
                                                        </div>
                                                      
                                                
                                                        <form method="POST" action="{{url('delete-stream-backlog')}}">
                                                         @csrf   
                                                         <input type="hidden" name="delete_id" value="{{$backlog->id}}">
                                                       
                                                
                                                        <div class="modal-body">
                                                          
                                                        Are you sure you want to delete this Backlog?
                                                
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                          <button type="submit" class="btn btn-danger">Confirm</button>
                                                        </div>
                                                        </form>
                                                      </div>
                                                    </div>
                                                  </div>


                            <div class="modal fade" id="create{{$backlog->id}}" tabindex="-1" role="dialog" aria-labelledby="create-epic" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" style="width: 526px !important;">
                                    <div class="modal-header">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5 class="modal-title" id="create-epic">Update Backlog Epic</h5>
                                            </div>
                                            <div class="col-md-12">
                                                <p>Fill out the form, submit and hit the save button.</p>
                                            </div>
                                              <div id=""  role="alert"></div>
                                            <span id="" class="ml-3 text-danger"></span>
                                        </div>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="needs-validation" action="{{url('update-backlog-epic')}}" method="POST" >
                                        @csrf
                                            <input type="hidden" name="backlog_id" value="{{$backlog->id}}">
                                            <div class="row">
                                                <div class="col-md-12 col-lg-12 col-xl-12">
                                                    <div class="form-group mb-0">
                                                        <input type="text" class="form-control" value="{{$backlog->epic_title}}" name="epic_name" id="" required>
                                                        <label for="objective-name">Epic Title</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group mb-0">
                                                        <input type="date" class="form-control"  name="epic_start_date" value="{{$backlog->epic_start_date}}">
                                                        <label for="start-date">Start Date</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group mb-0">
                                                        <input type="date" class="form-control"  name="epic_end_date" value="{{$backlog->epic_end_date}}">
                                                        <label for="end-date">End Date</label>
                                                    </div>
                                                </div>
                                                  <div class="col-md-12 col-lg-12 col-xl-12">
                                                    <div class="form-group mb-0">
                                                       <select class="form-control" name="epic_status">
                                                            <option value="To Do">To Do</option>
                                                          <option value="In progress">In Progress</option>
                                                           <option value="Done">Done</option>
                        
                                                       </select>
                                                        <label for="small-description">Status</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-lg-12 col-xl-12">
                                                    <div class="form-group mb-0">
                                                        <input type="text" class="form-control" value="{{$backlog->epic_detail}}"  name="epic_description">
                                                        <label for="small-description">Small Description</label>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12 col-lg-12 col-xl-12">
                                                <div class="form-group mb-0">
                                                <select class="form-control" name ="team"  class="">
                                                <option value="">Assign Team</option>
                                                @foreach(DB::table('value_team')->where('org_id',$organization->id)->get() as $r)
                                                <option value="{{$r->id}}">{{$r->team_title}}</option>
                                                @endforeach
                                                </select>
                                                </div>
                                                </div>
                                        
                                                
                                                <div class="col-md-12">
                                                    <button class="btn btn-primary btn-lg btn-theme btn-block ripple mt-3"  type="submit">Update</button>
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
    
  <div class="modal fade" id="create-backlog-epic" tabindex="-1" role="dialog" aria-labelledby="create-epic" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 526px !important;">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="create-epic">Create Backlog Epic</h5>
                    </div>
                    <div class="col-md-12">
                        <p>Fill out the form, submit and hit the save button.</p>
                    </div>
                      <div id=""  role="alert"></div>
                    <span id="" class="ml-3 text-danger"></span>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" action="{{url('add-backlog-epic')}}" method="POST" >
                @csrf
                <input type="hidden" name="Stream_id" value="{{$organization->id}}">
      
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" name="epic_name" id="" required>
                                <label for="objective-name">Epic Title</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <input type="date" class="form-control"  name="epic_start_date" id=""  >
                                <label for="start-date">Start Date</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <input type="date" class="form-control"  name="epic_end_date" id="" >
                                <label for="end-date">End Date</label>
                            </div>
                        </div>
                          <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                               <select class="form-control" name="epic_status">
                                    <option value="To Do">To Do</option>
                                  <option value="In progress">In Progress</option>
                                   <option value="Done">Done</option>

                               </select>
                                <label for="small-description">Status</label>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control"  name="epic_description">
                                <label for="small-description">Small Description</label>
                            </div>
                        </div>
                        
                        <!--<h5 class="ml-3">Stories</h5>-->
                        
                        <!--  <div class="col-md-12 col-lg-12 col-xl-12">-->
                        <!--    <div class="form-group mb-0">-->
                        <!--        <input type="text" class="form-control epic-input" id="epic_story" required>-->
                        <!--        <label for="small-description">Add Story</label>-->
                        <!--    </div>-->
                        <!--</div>-->
                        
                        <div class="col-md-12 field_wrapper w-100"></div>
                        
                        
                        <!-- <div class="col-md-12">-->
                        <!--    <button class="btn btn-primary  w-50 mt-2 add_button" type="button">Add on item</button>-->
                        <!--</div>-->
                        
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-lg btn-theme btn-block ripple mt-3"  type="submit">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="assign-backlog-epic" tabindex="-1" role="dialog" aria-labelledby="create-epic" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 526px !important;">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="create-epic">Assign Backlog Epic</h5>
                    </div>
                    <div class="col-md-12">
                        <p>Fill out the form, submit and hit the save button.</p>
                    </div>
                      <div id=""  role="alert"></div>
                    <span id="" class="ml-3 text-danger"></span>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                </button>
            </div>
            <div class="modal-body">
            <form class="needs-validation" action="{{url('assign-backlog-epic')}}" method="POST">
            @csrf   
               
                <input type="hidden" name="backlog_id" id="values">

                    <div class="row">
                        <!--<div class="col-md-12 col-lg-12 col-xl-12">-->
                        <!--    <div class="form-group mb-0">-->
                        <!--        <input type="text" class="form-control" name="epic_name" id="" required>-->
                        <!--        <label for="objective-name">Epic Title</label>-->
                        <!--    </div>-->
                        <!--</div>-->
                    
                         <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group mb-0">
                        <select class="form-control category" id="" name="stream_obj" required>
                        <option value="" >Select Value Stream</option>
                        <?php foreach(DB::table('value_stream')->where('user_id',Auth::id())->get() as $r){ ?>
                        <option value="{{ $r->id }}">{{ $r->value_name }}</option>
                        <?php }  ?>
                        
                        </select>
                        <label for="small-description">Choose Value Stream</label>
                        </div>
                        </div>
                        
                         <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                             <select name="locstate" id="" onchange="getvaluekey(this.value)"  class="form-control obj" value="" required>
                                                    
                            </select>
                                <label for="small-description">Choose Objective</label>
                            </div>
                        </div>
                        
                              <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                             <select name="lockey" id="" onchange="getvalueintit(this.value)"  class="form-control key" value="" required>
                                                    
                            </select>
                                <label for="small-description">Choose Key Result</label>
                            </div>
                        </div>
                        
                          <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                             <select name="locinit" id="" class="form-control init"  value="" required>
                                                    
                            </select>
                                <label for="small-description">Choose Initiative</label>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group mb-0">
                        <input type="date" class="form-control" name="start_date[]" value="{{ date('Y-m-d') }}" required>
                         <label for="start-date">Start Date</label>
                        </div>
                        </div>
                                                
                        <div class="col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group mb-0">
                        <input type="date" class="form-control" name="end_date[]" required>
                        <label for="start-date">End Date</label>
                        </div>
                        </div>
                     
                        
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-lg btn-theme btn-block ripple mt-3"  type="submit">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="create-jira-epic" tabindex="-1" role="dialog" aria-labelledby="create-epic" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 526px !important;">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="create-epic">Download Epics from Jira</h5>
                    </div>
                    <div class="col-md-12">
                        <p>Fill out the form, submit and hit the save button.</p>
                    </div>
                      <div id=""  role="alert"></div>
                    <span id="" class="ml-3 text-danger"></span>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                </button>
            </div>
            <div class="modal-body">
            <form class="needs-validation" action="{{url('assign-jira-epic')}}" method="POST">
            @csrf   
               
                <input type="hidden" name="backlog_id" value="{{$organization->id}}">
                <input type="hidden" name="type" value="{{$organization->type}}">
                
                  <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                               <select class="form-control"  onchange="get_jira_project(this.value)"  id="JIRA" name="jira_name" required>
                                <option value="" >Select Jira Connect</option>
                                <?php foreach(DB::table('jira_setting')->where('user_id',Auth::id())->get() as $r){ ?>
                                  <option value="{{ $r->id }}">{{ $r->jira_name }}</option>-->
                                   <?php }  ?>

                               </select>
                                <label for="small-description">Choose Jira Connect</label>
                            </div>
                        </div>
                        
                    <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                               <select class="form-control" onchange="c_jira(this.value)" id="jira-project" name="jira_project" required>

                               </select>
                                <label for="small-description">Choose Jira Project</label>
                            </div>
                        </div>    

                    <div class="row" id="jita-data">
            
                        
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
      // DataTables initialization
     var table = $('.example').DataTable({
    "pagingType": "full_numbers",
    "language": {
        "paginate": {
            "previous": "&lsaquo;", // Custom previous arrow
            "next": "&rsaquo;" // Custom next arrow
        }
    },
   "columnDefs": [
    { "orderable": false, "targets": [0, 6] } // Disable ordering for the first and third columns
]
});

      // Check All checkbox functionality
      $('#checkAll').change(function() {
        $(':checkbox', 'tbody').prop('checked', this.checked);
      });
    });
    
    function get_epic()
    {
  
    var selectedOptions = [];
    $('.checkbox:checked').each(function() {
     selectedOptions.push($(this).val());
     
      });
      
      var selectedOptionsString = selectedOptions.join(',');

       $('#values').val(selectedOptionsString);
      
      if(selectedOptions.length > 0 )
      {
      $('#assign-backlog-epic').modal('show');
      $('.category').val('');
      }



   }
   
       $('.category').on('change', function() {
        var id = $(this).val();
        var type = "{{$organization->type}}";
        if(id) {
        $.ajax({
        type: "GET",
        url: "{{ url('get-value-obj') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
        id:id,
        type:type,
        },
        success: function(res) {
          
        if(res)
        {
        $('.obj').empty();
        $('.obj').append('<option hidden>Choose Objective</option>'); 
        $.each(res, function(key, course){
        $('select[name="locstate"]').append('<option value="'+ course.id +'">' + course.objective_name+ '</option>');
        });
        }else{
        $('.obj').empty();
        
        }

        }
        });
      }else
      {
         $('.init').empty();
         $('.key').empty();
         $('.obj').empty();
      }

       });
        
       function getvaluekey(id)
        {
   
        $.ajax({
        type: "GET",
        url: "{{ url('get-value-key') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
        id:id,
        },
        success: function(res) {
          
        if(res)
        {
        $('.key').empty();
        $('.key').append('<option hidden>Choose Key Result</option>'); 
        $.each(res, function(key, course){
        $('select[name="lockey"]').append('<option value="'+ course.id +'">' + course.key_name+ '</option>');
        });
        }else{
        $('.key').empty();
        }

        }
        });

        }
        
         function getvalueintit(id)
        {
   
        $.ajax({
        type: "GET",
        url: "{{ url('get-value-init') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
        id:id,
        },
        success: function(res) {
          
        if(res)
        {
        $('.init').empty();
        $('.init').append('<option hidden value="">Choose Initiative</option>'); 
        $.each(res, function(key, course){
        $('select[name="locinit"]').append('<option value="'+ course.id +'">' + course.initiative_name+ '</option>');
        });
        }else{
        $('.init').empty();
        }

        }
        });

        }
        
        function assign_epic(val)
        {
            
        var slug = "{{$organization->slug}}";   
        var id = "{{$organization->id}}"; 
         
        $.ajax({
        type: "GET",
        url: "{{ url('get-assign-epic') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
        id:id,
        slug:slug,
        val:val
        },
        success: function(res) {
          
        $('#olddata').html(res);
        // $('#olddata').hide();
        

        }
        });

        }
        
        function c_jira(id)
        {
            
        var y = $('#JIRA').val();
        var unit_id = "{{$organization->id}}"; 

        $('#jita-data').html('');    
       
        $.ajax({
        type: "GET",
        url: "{{ url('get-jira-epic') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
        id:id,
        y:y,
        unit_id:unit_id
        },
        success: function(res) {
          
        if(res == 1)
        {
        $('#jita-data').html('<span class="ml-7 text-danger">Backlog of Project '+id+' Already Assinged</span>');
        }else
        {
        $('#jita-data').html(res);
   
        }          

        }
        });

        }
        
        
        function get_jira_project(id)
        {
           
        if(id != '')
        {
        $('#JIRA').val(id);    
        $.ajax({
        type: "GET",
        url: "{{ url('get-jira-project') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
        id:id,
        },
        success: function(res) {
          
        if(res)
        {
        $('#jira-project').empty();
        $('#jira-project').append('<option hidden value="">Choose Jira Project</option>'); 
        $.each(res, function(key, course){
        $('select[name="jira_project"]').append('<option value="'+ course.project_name +'">' + course.project_name+ '</option>');
        });
        }else{
        $('#jira-project').empty();
        }

        }
        });
        
        }
       

       }
        
        
        
       $(document).ready(function() {
        setTimeout(function(){$('.alert-success').slideUp();},3000); 
        });

        

  </script>


@endsection