@php
$var_objective = 'Report-'.$type;
@endphp
@extends('components.main-layout')
<title>Report</title>
@section('content')
 <div class="container-fluid py-7" style="width: 96%; margin: 0px auto;">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body p-10">
                                    <table id="example" class="table">
                                        <thead>
                                            <tr>
                                                <td>Report Title</td>
                                                <td>Business Unit</td>
                                                <td>Start Date</td>
                                                <td>End Date</td>
                                                <td class="text-center">Quarter Status</td>
                                                <td class="text-center">Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($report as $r )
                                            @php
                                            $sprint = DB::table('sprint_report')->where('q_id',$r->id)->first();
                                            $key = array();
                                            if($sprint)
                                            {
                                            $key =   json_decode($sprint->key_result);
                                            }
                                            @endphp
                                            <tr>
                                                <td>
                                                    {{$r->title}}
                                                </td>
                                                <td>{{$organization->business_name}}</td>
                                                <td>{{ \Carbon\Carbon::parse($r->start_data)->format('M d Y')}}</td>
                                                <td>{{ \Carbon\Carbon::parse($r->end_date)->format('M d Y')}}</td>
                                                <td class="text-center">
                                                    @if($r->status == 1)
                                                    <span class="badge badge-pill badge-success">Ended</span>
                                                    @else
                                                    <span class="badge badge-pill badge-warning">Running</span>
                                                    @endif
                                                    <!-- <span class="badge badge-pill badge-warning">Pending Invite</span>
                                                    <span class="badge badge-pill badge-danger">Blocked</span> -->
                                                </td>
                                                
                                                <td class="text-center">
                                                    @if($r->status == 1)
                                                    <button class="btn-circle btn-tolbar" data-toggle="modal" data-target=".bd-example-modal-lg{{$r->id}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
                                                              <path d="M11.9999 16.3299C9.60992 16.3299 7.66992 14.3899 7.66992 11.9999C7.66992 9.60992 9.60992 7.66992 11.9999 7.66992C14.3899 7.66992 16.3299 9.60992 16.3299 11.9999C16.3299 14.3899 14.3899 16.3299 11.9999 16.3299ZM11.9999 9.16992C10.4399 9.16992 9.16992 10.4399 9.16992 11.9999C9.16992 13.5599 10.4399 14.8299 11.9999 14.8299C13.5599 14.8299 14.8299 13.5599 14.8299 11.9999C14.8299 10.4399 13.5599 9.16992 11.9999 9.16992Z" fill="#292D32"/>
                                                              <path d="M12.0001 21.02C8.24008 21.02 4.69008 18.82 2.25008 15C1.19008 13.35 1.19008 10.66 2.25008 8.99998C4.70008 5.17998 8.25008 2.97998 12.0001 2.97998C15.7501 2.97998 19.3001 5.17998 21.7401 8.99998C22.8001 10.65 22.8001 13.34 21.7401 15C19.3001 18.82 15.7501 21.02 12.0001 21.02ZM12.0001 4.47998C8.77008 4.47998 5.68008 6.41998 3.52008 9.80998C2.77008 10.98 2.77008 13.02 3.52008 14.19C5.68008 17.58 8.77008 19.52 12.0001 19.52C15.2301 19.52 18.3201 17.58 20.4801 14.19C21.2301 13.02 21.2301 10.98 20.4801 9.80998C18.3201 6.41998 15.2301 4.47998 12.0001 4.47998Z" fill="#292D32"/>
                                                            </svg>
                                                    </button>
                                                    <div class="modal fade bd-example-modal-lg{{$r->id}}" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h5 class="modal-title" id="create-objective">Choose Report Type</h5>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <p>Select the report type you want to generate.</p>
                                                                        </div>
                                                                        <div id="success-obj" role="alert"></div>
                                                                        <span id="obj-feild-error" class="ml-3 text-danger"></span>
                                                        
                                                                    </div>
                                                    
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <!-- Report 1 -->
                                                                        <div class="col-md-12">
                                                                            <a href="#">
                                                                                <div class="card report-parent-card mb-3">
                                                                                    <div class="card-body">
                                                                                        <div class="d-flex flex-row justify-content-between align-items-center">
                                                                                            <div class="mb-2">
                                                                                                <img width="100" src="https://cdn3d.iconscout.com/3d/premium/thumb/line-growth-chart-7684536-6220979.png?f=webp">
                                                                                            </div>
                                                                                            <div class="d-flex flex-column content-area">
                                                                                                <div>
                                                                                                    <a href="{{url('Okr-report/'.$r->id.'/'.$type)}}"><h4>OKR Epics</h4></a>
                                                                                                </div>
                                                                                                <div>
                                                                                                    <p>Tracks completion of planned Epics for a Quarter against Objectives and Key Results.</p>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="d-flex flex-row">
                                                                                                <div class="mr-2"><a href="{{url('Okr-report/'.$r->id.'/'.$type)}}" class="btn btn-default">See Report</a></div>
                                                                                                <div><button class="btn btn-default">Download</button></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                        <!-- Report 2 -->
                                                                        <div class="col-md-12">
                                                                            <a href="#">
                                                                                <div class="card report-parent-card mb-3">
                                                                                    <div class="card-body">
                                                                                        <div class="d-flex flex-row justify-content-between align-items-center">
                                                                                            <div class="mb-2">
                                                                                                <img width="100" src="https://cdn3d.iconscout.com/3d/premium/thumb/horizontal-line-chart-7684538-6220981.png?f=webp">
                                                                                            </div>
                                                                                            <div class="d-flex flex-column content-area">
                                                                                                <div>
                                                                                                     <a href="{{url('dashboard/organization/Okr-report-all/'.$r->id.'/'.$type)}}"><h4>Epics Completed</h4></a>
                                                                                                </div>
                                                                                                <div>
                                                                                                    <p>Tracks completion of planned Epics for a Quarter against Objectives and Key Results.</p>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="d-flex flex-row">
                                                                                                <div class="mr-2"> 
                                                                                                 <a href="{{url('dashboard/organization/Okr-report-all/'.$r->id.'/'.$type)}}" class="btn btn-default">See Report</a>
                                                                                                </div>
                                                                                                <div><button class="btn btn-default">Download</button></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                    
                                                                        <!-- Report 3 -->
                                                                        <div class="col-md-12">
                                                                            <a href="#">
                                                                                <div class="card report-parent-card mb-3">
                                                                                    <div class="card-body">
                                                                                        <div class="d-flex flex-row justify-content-between align-items-center">
                                                                                            <div class="mb-2">
                                                                                                <img width="100" src="https://cdn3d.iconscout.com/3d/premium/thumb/data-analysis-chart-7684537-6220980.png?f=webp">
                                                                                            </div>
                                                                                            <div class="d-flex flex-column content-area">
                                                                                                <div>
                                                                                                    <a href="{{url('Okr-report-3/'.$r->id.'/'.$type)}}"><h4>OKR Epics</h4></a>
                                                                                                </div>
                                                                                                <div>
                                                                                                    <p>Tracks completion of planned Epics for a Quarter against Objectives and Key Results.</p>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="d-flex flex-row">
                                                                                                <div class="mr-2"><a href="{{url('Okr-report-3/'.$r->id.'/'.$type)}}" class="btn btn-default">See Report</a></div>
                                                                                                <div><button class="btn btn-default">Download</button></div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                      </div>
                                                    </div>
                                                    @else
                                                    <button class="btn-circle btn-tolbar"  data-placement="top" title="Generate Report"  data-toggle="modal" data-target="#delete{{$r->id}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
                                                          <path d="M17.4409 15.3699C17.2509 15.3699 17.0609 15.2999 16.9109 15.1499C16.6209 14.8599 16.6209 14.3799 16.9109 14.0899L18.9409 12.0599L16.9109 10.0299C16.6209 9.73994 16.6209 9.25994 16.9109 8.96994C17.2009 8.67994 17.6809 8.67994 17.9709 8.96994L20.5309 11.5299C20.8209 11.8199 20.8209 12.2999 20.5309 12.5899L17.9709 15.1499C17.8209 15.2999 17.6309 15.3699 17.4409 15.3699Z" fill="#292D32"/>
                                                          <path d="M19.9298 12.8101H9.75977C9.34977 12.8101 9.00977 12.4701 9.00977 12.0601C9.00977 11.6501 9.34977 11.3101 9.75977 11.3101H19.9298C20.3398 11.3101 20.6798 11.6501 20.6798 12.0601C20.6798 12.4701 20.3398 12.8101 19.9298 12.8101Z" fill="#292D32"/>
                                                          <path d="M11.7598 20.75C6.60977 20.75 3.00977 17.15 3.00977 12C3.00977 6.85 6.60977 3.25 11.7598 3.25C12.1698 3.25 12.5098 3.59 12.5098 4C12.5098 4.41 12.1698 4.75 11.7598 4.75C7.48977 4.75 4.50977 7.73 4.50977 12C4.50977 16.27 7.48977 19.25 11.7598 19.25C12.1698 19.25 12.5098 19.59 12.5098 20C12.5098 20.41 12.1698 20.75 11.7598 20.75Z" fill="#292D32"/>
                                                        </svg>
                                                    </button>
                                                    <div class="modal fade" id="delete{{$r->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <h5 class="modal-title text-center" id="exampleModalLabel">End Quarter</h5>
                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                              </button>
                                                            </div>
                                                          
                                                    
                                                        
                                                            <div class="modal-body">
                                                              
                                                            Are you sure you want to End this Quarter?
                                                    
                                                            </div>
                                                            <div class="modal-footer">
                                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                              <button type="button" onclick="endquarter();" class="btn btn-danger">Confirm</button>
                                                            </div>
                                                       
                                                          </div>
                                                        </div>
                                                      </div>
                                                    @endif
                                                    
                                                    @if($r->status == 1)
                                                    <button class="btn-circle btn-tolbar" data-toggle="modal" disabled>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
                                                          <path d="M9 17.75C8.9 17.75 8.81 17.73 8.71 17.69C8.43 17.58 8.25 17.3 8.25 17V11C8.25 10.59 8.59 10.25 9 10.25C9.41 10.25 9.75 10.59 9.75 11V15.19L10.47 14.47C10.76 14.18 11.24 14.18 11.53 14.47C11.82 14.76 11.82 15.24 11.53 15.53L9.53 17.53C9.39 17.67 9.19 17.75 9 17.75Z" fill="#292D32"/>
                                                          <path d="M8.99945 17.7499C8.80945 17.7499 8.61945 17.6799 8.46945 17.5299L6.46945 15.5299C6.17945 15.2399 6.17945 14.7599 6.46945 14.4699C6.75945 14.1799 7.23945 14.1799 7.52945 14.4699L9.52945 16.4699C9.81945 16.7599 9.81945 17.2399 9.52945 17.5299C9.37945 17.6799 9.18945 17.7499 8.99945 17.7499Z" fill="#292D32"/>
                                                          <path d="M15 22.75H9C3.57 22.75 1.25 20.43 1.25 15V9C1.25 3.57 3.57 1.25 9 1.25H14C14.41 1.25 14.75 1.59 14.75 2C14.75 2.41 14.41 2.75 14 2.75H9C4.39 2.75 2.75 4.39 2.75 9V15C2.75 19.61 4.39 21.25 9 21.25H15C19.61 21.25 21.25 19.61 21.25 15V10C21.25 9.59 21.59 9.25 22 9.25C22.41 9.25 22.75 9.59 22.75 10V15C22.75 20.43 20.43 22.75 15 22.75Z" fill="#292D32"/>
                                                          <path d="M22 10.75H18C14.58 10.75 13.25 9.41999 13.25 5.99999V1.99999C13.25 1.69999 13.43 1.41999 13.71 1.30999C13.99 1.18999 14.31 1.25999 14.53 1.46999L22.53 9.46999C22.74 9.67999 22.81 10.01 22.69 10.29C22.57 10.57 22.3 10.75 22 10.75ZM14.75 3.80999V5.99999C14.75 8.57999 15.42 9.24999 18 9.24999H20.19L14.75 3.80999Z" fill="#292D32"/>
                                                        </svg>
                                                    </button>
                                                    @else
                                                     <button class="btn-circle btn-tolbar" data-toggle="modal" data-target="#create-report{{$r->id}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
                                                          <path d="M9 17.75C8.9 17.75 8.81 17.73 8.71 17.69C8.43 17.58 8.25 17.3 8.25 17V11C8.25 10.59 8.59 10.25 9 10.25C9.41 10.25 9.75 10.59 9.75 11V15.19L10.47 14.47C10.76 14.18 11.24 14.18 11.53 14.47C11.82 14.76 11.82 15.24 11.53 15.53L9.53 17.53C9.39 17.67 9.19 17.75 9 17.75Z" fill="#292D32"/>
                                                          <path d="M8.99945 17.7499C8.80945 17.7499 8.61945 17.6799 8.46945 17.5299L6.46945 15.5299C6.17945 15.2399 6.17945 14.7599 6.46945 14.4699C6.75945 14.1799 7.23945 14.1799 7.52945 14.4699L9.52945 16.4699C9.81945 16.7599 9.81945 17.2399 9.52945 17.5299C9.37945 17.6799 9.18945 17.7499 8.99945 17.7499Z" fill="#292D32"/>
                                                          <path d="M15 22.75H9C3.57 22.75 1.25 20.43 1.25 15V9C1.25 3.57 3.57 1.25 9 1.25H14C14.41 1.25 14.75 1.59 14.75 2C14.75 2.41 14.41 2.75 14 2.75H9C4.39 2.75 2.75 4.39 2.75 9V15C2.75 19.61 4.39 21.25 9 21.25H15C19.61 21.25 21.25 19.61 21.25 15V10C21.25 9.59 21.59 9.25 22 9.25C22.41 9.25 22.75 9.59 22.75 10V15C22.75 20.43 20.43 22.75 15 22.75Z" fill="#292D32"/>
                                                          <path d="M22 10.75H18C14.58 10.75 13.25 9.41999 13.25 5.99999V1.99999C13.25 1.69999 13.43 1.41999 13.71 1.30999C13.99 1.18999 14.31 1.25999 14.53 1.46999L22.53 9.46999C22.74 9.67999 22.81 10.01 22.69 10.29C22.57 10.57 22.3 10.75 22 10.75ZM14.75 3.80999V5.99999C14.75 8.57999 15.42 9.24999 18 9.24999H20.19L14.75 3.80999Z" fill="#292D32"/>
                                                        </svg>
                                                    </button>
                                                    @endif
                                                     <div class="modal fade" id="create-report{{$r->id}}" tabindex="-1" role="dialog" aria-labelledby="create-report" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content" style="width: 526px !important;">
                                                            <div class="modal-header">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <h5 class="modal-title" id="create-epic">Update Quarter/Sprint </h5>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <p>Fill out the form, submit and hit the save button.</p>
                                                                    </div>
                                                                      <div id="success-sprint"  role="alert"></div>
                                                                    <span id="sprint-error" class="ml-3 text-danger"></span>
                                                                </div>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="needs-validation" action="{{url('update-sprint')}}" method="POST" novalidate>
                                                                @csrf
                                                                <input type="hidden" value="{{$r->id}}" name="s_id">
                                                            
                                                                    <div class="row">
                                                                        
                                                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                                                            <div class="form-group mb-0">
                                                                                <input type="date" class="form-control" value="{{$r->start_data}}" id="" readonly>
                                                                                <label for="start-date" style="bottom:72px;">Start Date</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                                                            <div class="form-group mb-0">
                                                                                <input type="date" class="form-control" value="{{$r->end_date }}" name="end_date">
                                                                                <label for="end-date">End Date</label>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        
                                                
                                                                        <div class="col-md-12">
                                                                            <button class="btn btn-primary btn-lg btn-theme btn-block ripple mt-3" type="submit"  type="button">Update</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                    <button class="btn-circle btn-tolbar" data-placement="top" title="Delete Report" data-toggle="modal" data-target="#delete-report{{$r->id}}">
                                                        <img src="{{asset('public/assets/images/icons/delete.svg')}}">
                                                    </button>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="delete-report{{$r->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title text-center" id="exampleModalLabel">Delete Quarter</h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>
                                                  
                                            
                                                    <form method="POST" action="{{url('delete-report')}}">

                                                        @csrf
                                                        <input type="hidden" name="sprint_id" value="{{$r->id}}">  
                                                       <div class="modal-body">
                                                         
                                                       Are you sure you want to Delete this Quarter?
                                               
                                                       </div>
                                                       <div class="modal-footer">
                                                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                         <button type="submit"  class="btn btn-danger">Confirm</button>
                                                       </div>
                                                    </form>
                                                   
                                                    
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
                
                
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    
      function endquarter()
       {
   
        var unit_id = "{{ $organization->id }}";
        var type = "{{ $type}}";    
        $.ajax({
        type: "POST",
        url: "{{ url('end-sprint') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
        unit_id:unit_id,
        type:type
        },
        success: function(res) {
          
        location.reload();


        }
    });
    
        

        }
</script>                
   @endsection                
