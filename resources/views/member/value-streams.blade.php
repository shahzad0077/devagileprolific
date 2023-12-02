 @php
$var_objective = "V-Stream";
@endphp
@extends('components.main-layout')
<title>Value Streams</title>
@section('content')
 <div class="d-flex flex-column flex-root">
        <!-- begin topbar -->
    
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid body-cont">
            <!-- begin Sidebar -->
         
            <div class="flex-shrink-0 p-3 bg-white sub-nav" id="panel" style="width: 280px; margin-top: 5%;">
                <button id="closeBtn" class="close-button">
                    <img src="../images/icons/collaps.svg">
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
                            <div class="row">
                               
                                <div class="col-md-12 pr-0">
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
                                                        <td>Value Stream</td>
                                                        <td>Business Unit</td>
                                                        <td>Lead</td>
                                                        <td>Teams</td>
                                                        
                                                        <!--<td class="text-center">Backlog</td>-->
                                                        <!--<td class="text-center">OKRs</td>-->
                                                        <td>Action</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                     @if (session('message'))
                                                   <div class="alert alert-success mt-1" role="alert">
                                                    {{ session('message') }}
                                                  </div>
                                                   @endif
                                                   
                                                   @if(count($Stream) > 0)
                                                   @foreach($Stream as $stream)
                                                   @php
                                                    $TeamCount = DB::table('value_team')->where('org_id',$stream->id)->count();
                                                    $member = DB::table('members')->where('org_user',Auth::id())->count();
                                                   @endphp
                                                    <tr>
                                                        <td>
                                                            <label class="form-checkbox">
                                                                <input type="checkbox">
                                                                <span class="checkbox-label"></span>
                                                            </label>
                                                        </td>
                                                        <td> <a  href="{{url('dashboard/organization/'.$stream->slug.'/portfolio/'.$stream->type)}}" class="nav-link text-black">{{$stream->value_name}}</a></td>
                                                        <td>{{$stream->business_name}}</td>
                                                        @if($member > 0)
                                                        @php
                                                            $lead  = DB::table('members')->where('id' , $stream->Lead_id)->first();
                                                        @endphp
                                                        @if($lead)
                                                        <td class="image-cell">
                                                            @if($lead->image)
                                                            <img src="{{asset('public/assets/images/'.$lead->image)}}" alt="Example Image">
                                                            @else
                                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTv1Tt9_33HyVMm_ZakYQy-UgsLjE00biEArg&usqp=CAU" alt="Example Image">
                                                            @endif
                                                            <div>
                                                                <div class="title">{{$lead->name}} {{ $lead->last_name }}</div>
                                                            </div>
                                                        </td>
                                                        @else
                                                        <td class="image-cell">
                                                            <button data-toggle="modal" data-target="#edit{{$unit->id}}" class="btn btn-primary">Assign</button>
                                                        </td>
                                                        @endif
                                                        @else
                                                        <td class="image-cell">
                                                            <a class="nav-link" href="{{url('dashboard/organization/users')}}"><button class="btn btn-primary">Assign</button></a>
                                                        </td>
                                                        @endif
                                                        <td>{{$TeamCount}}</td>
                                                        <!--<td class="text-center">-->
                                                        <!--    <a href="{{url('backlog/'.$stream->slug)}}" class="btn btn-default">-->
                                                        <!--        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">-->
                                                        <!--            <path d="M11.6667 5.62533H8.33341C7.53341 5.62533 6.04175 5.62533 6.04175 3.33366C6.04175 1.04199 7.53341 1.04199 8.33341 1.04199H11.6667C12.4667 1.04199 13.9584 1.04199 13.9584 3.33366C13.9584 4.13366 13.9584 5.62533 11.6667 5.62533ZM8.33341 2.29199C7.50841 2.29199 7.29175 2.29199 7.29175 3.33366C7.29175 4.37533 7.50841 4.37533 8.33341 4.37533H11.6667C12.7084 4.37533 12.7084 4.15866 12.7084 3.33366C12.7084 2.29199 12.4917 2.29199 11.6667 2.29199H8.33341Z" fill="#292D32" />-->
                                                        <!--            <path d="M11.6667 18.9582H7.5C2.81667 18.9582 1.875 16.8082 1.875 13.3332V8.33318C1.875 4.53318 3.25 2.90818 6.63333 2.73318C6.96667 2.71652 7.275 2.97485 7.29167 3.32485C7.30833 3.67485 7.04167 3.95818 6.7 3.97485C4.33333 4.10818 3.125 4.81652 3.125 8.33318V13.3332C3.125 16.4165 3.73333 17.7082 7.5 17.7082H11.6667C12.0083 17.7082 12.2917 17.9915 12.2917 18.3332C12.2917 18.6749 12.0083 18.9582 11.6667 18.9582Z" fill="#292D32" />-->
                                                        <!--            <path d="M17.4999 13.1253C17.1583 13.1253 16.8749 12.842 16.8749 12.5003V8.33368C16.8749 4.81702 15.6666 4.10868 13.2999 3.97535C12.9583 3.95868 12.6916 3.65868 12.7083 3.31702C12.7249 2.97535 13.0333 2.70868 13.3666 2.72535C16.7499 2.90868 18.1249 4.53368 18.1249 8.32535V12.492C18.1249 12.842 17.8416 13.1253 17.4999 13.1253Z" fill="#292D32" />-->
                                                        <!--            <path d="M17.5 18.958H15C14.6583 18.958 14.375 18.6747 14.375 18.333C14.375 17.9913 14.6583 17.708 15 17.708H16.875V15.833C16.875 15.4913 17.1583 15.208 17.5 15.208C17.8417 15.208 18.125 15.4913 18.125 15.833V18.333C18.125 18.6747 17.8417 18.958 17.5 18.958Z" fill="#292D32" />-->
                                                        <!--            <path d="M17.4668 18.9245C17.3084 18.9245 17.1501 18.8662 17.0251 18.7412L12.0584 13.7745C11.8168 13.5329 11.8168 13.1329 12.0584 12.8912C12.3001 12.6495 12.7001 12.6495 12.9418 12.8912L17.9084 17.8579C18.1501 18.0995 18.1501 18.4995 17.9084 18.7412C17.7834 18.8579 17.6251 18.9245 17.4668 18.9245Z" fill="#292D32" />-->
                                                        <!--        </svg>-->
                                                        <!--        Backlog</a>-->
                                                        <!--</td>-->
                                                        <!--  <td class="text-center">-->
                                                        <!--    <a  href="{{url('objective/'.$stream->slug.'/'.$stream->type)}}" class="btn btn-default">Portfolio</a>-->
                                                        <!--</td>-->
                                                        <td>
                                                            <button class="btn-circle btn-tolbar" data-toggle="modal" data-target="#edit{{$stream->ID}}">
                                                                <img src="{{asset('public/assets/images/icons/edit.svg')}}"  data-toggle="tooltip" data-placement="top" data-original-title="Edit">
                                                            </button>
                                                            <button class="btn-circle btn-tolbar" data-toggle="modal" data-target="#delete{{$stream->ID}}">
                                                                <img src="{{asset('public/assets/images/icons/delete.svg')}}" data-toggle="tooltip" data-placement="top" data-original-title="Delete">
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    
                                                     <div class="modal fade" id="delete{{$stream->ID}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Delete Value Stream</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                          </button>
                                                        </div>
                                                      
                                                
                                                        <form method="POST" action="{{url('delete-value-stream')}}">
                                                         @csrf   
                                                         <input type="hidden" name="delete_id" value="{{$stream->ID}}">
                                                       
                                                
                                                        <div class="modal-body">
                                                          
                                                        Are you sure you want to delete this Business Units?
                                                        <input type="text" name="" id="noPasteField" class="form-control" placeholder="Type  Business Name" required>
                                                
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                          <button type="submit" class="btn btn-danger">Confirm</button>
                                                        </div>
                                                        </form>
                                                      </div>
                                                    </div>
                                                  </div>
                                           <div class="modal fade" id="edit{{$stream->ID}}" tabindex="-1" role="dialog" aria-labelledby="add-business-unit" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content" style="width: 526px !important;">
                                                    <div class="modal-header">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5 class="modal-title" id="create-epic">Update Value Stream</h5>
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
                                                        <form class="needs-validation" action="{{url('update-value-stream')}}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="value_id" value="{{$stream->ID}}">
                                                            <div class="row">
                                                                <div class="col-md-12 col-lg-12 col-xl-12">
                                                                    <div class="form-group mb-0">
                                                                        <input type="text" class="form-control" name="value_name" value="{{$stream->value_name}}" required>
                                                                        <label for="Business Unit">Value Stream</label>
                                                                    </div>
                                                                </div>
                                                                  <div class="col-md-12 col-lg-12 col-xl-12">
                                                                    <div class="form-group mb-0">
                                                                        <select class="form-control" name="unit_id" required>
                                                                            <?php foreach(DB::table('business_units')->where('user_id',Auth::id())->get() as $r){ ?>
                                                                              <option @if($r->id == $stream->unit_id) selected @endif value="{{ $r->id }}">{{ $r->business_name }}</option>
                                                                            <?php }  ?>
                                                                        </select>
                                                                        <label for="lead-manager">Business Unit</label>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="col-md-12 col-lg-12 col-xl-12">
                                                                    <div class="form-group mb-0">
                                                                        <select class="form-control" name="lead_manager" required>
                                                                            <option value="">Select Lead Member</option>
                                                                            <?php foreach(DB::table('members')->where('org_user',Auth::id())->get() as $r){ ?>
                                                                              <option @if($r->id == $stream->Lead_id) selected @endif value="{{ $r->id }}">{{ $r->name }} {{$r->last_name}}</option>
                                                                            <?php }  ?>
                                                                        </select>
                                                                        <label for="lead-manager">Lead</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 col-lg-12 col-xl-12">
                                                                    <div class="form-group mb-0">
                                                                        <input type="text" class="form-control" value="{{$stream->DETAIL}}" name="detail">
                                                                        <label for="small-description">Small Description</label>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <button class="btn btn-primary btn-lg btn-theme btn-block ripple" type="submit">Submit</button>
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
                    </div>
                </div>
                <!-- end page content -->
            </div>
        </div>
    </div>
    
    
    <!-- Create Business Unit -->
<div class="modal fade" id="add-business-value" tabindex="-1" role="dialog" aria-labelledby="add-business-unit" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 526px !important;">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="create-epic">Create Value Stream</h5>
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
                <form class="needs-validation" action="{{url('add-value-stream')}}" method="POST">
                    @csrf
                    <input type="hidden" name="org_value_id" value="{{$organization->id}}">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" name="value_name" id="Business Unit" required>
                                <label for="Business Unit">Value Stream</label>
                            </div>
                        </div>
                        @php
                        $BCount = DB::table('business_units')->where('user_id',Auth::id())->count();
                        @endphp
                        <!--  <div class="col-md-12 col-lg-12 col-xl-12">-->
                        <!--    <div class="form-group mb-0">-->
                        <!--        <select class="form-control" name="unit_id" required>-->
                        <!--               <option value="">Select Business Unit</option>-->
                        <!--            <?php foreach(DB::table('business_units')->where('user_id',Auth::id())->get() as $r){ ?>-->
                        <!--              <option value="{{ $r->id }}">{{ $r->business_name }}</option>-->
                        <!--            <?php }  ?>-->
                        <!--        </select>-->
                        <!--        <label for="lead-manager">Business Unit</label>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!-- @if($BCount == 0)-->
                        <!--<div class="alert alert-danger mt-1 ml-3" role="alert">-->
                        <!--Add Business Unit before assigning <a href="{{url('dashboard/organization/Business-Units')}}" class="alert-link">Click here</a>.-->
                        <!--</div>-->
                        <!--@endif-->
                        
                        @php
                        $memberCount = DB::table('members')->where('org_user',Auth::id())->count();
                        @endphp
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <select class="form-control" name="lead_manager" required>
                                    <option value="NULL" selected>Select Lead</option>
                                    <?php foreach(DB::table('members')->where('org_user',Auth::id())->get() as $r){ ?>
                                      <option value="{{ $r->id }}">{{ $r->name }} {{$r->last_name}}</option>
                                    <?php }  ?>
                                </select>
                                <label for="lead-manager">Lead</label>
                            </div>
                        </div>
                         @if($memberCount == 0)
                        <div class="alert alert-danger mt-1 ml-3" role="alert">
                        Add users before assigning <a href="{{url('dashboard/organization/users')}}" class="alert-link">Click here</a>.
                        </div>
                        @endif
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text"  class="form-control" name="detail">
                                <label for="small-description">Small Description</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-lg btn-theme btn-block ripple" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Create Business Unit -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    
     $(document).ready(function() {
    setTimeout(function(){$('.alert-success').slideUp();},3000); 
    });
    
        document.getElementById("noPasteField").addEventListener("paste", function (e) {
    e.preventDefault();
    var text = (e.originalEvent || e).clipboardData.getData("text/plain");
});
</script>
@endsection