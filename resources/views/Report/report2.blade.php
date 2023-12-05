@php
$var_objective = 'Report-'.$type;
@endphp
@extends('components.main-layout')
<title>Report</title>
@section('content')
  <div class="container-fluid py-7" style="width: 96%; margin: 0px auto;">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="d-flex flex-row justify-content-between">
                                <div class="d-flex flex-column">
                                    <div>
                                        @foreach($key as $k)
                                        @foreach($obj as $o)
                                        @if($k->obj_id == $o->id && $k->id == $id)
                                        <h4 class="pb-0 mb-0">{{$o->objective_name}}</h4>
                                        @endif
                                        @endforeach
                                        @endforeach
                                    </div>
                                    <div class="d-flex flex-row">
                                        <div>
                                        @foreach($key as $k)
                                      
                                        @if($k->id == $id)
                                            <small>{{$k->key_name}}</small>
                                        @endif
                                        @endforeach
                                       
                                        </div>
                                        <div>
                                            <div class="dropdown">
                                              <button class="btn bg-white btn-circle dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <svg width="16" height="17" viewBox="0 0 16 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <g id="vuesax/outline/arrow-down">
                                                        <g id="arrow-down">
                                                            <path id="Vector" d="M8.00001 11.7004C7.53335 11.7004 7.06668 11.5204 6.71335 11.1671L2.36668 6.82042C2.17335 6.62708 2.17335 6.30708 2.36668 6.11375C2.56001 5.92042 2.88001 5.92042 3.07335 6.11375L7.42001 10.4604C7.74001 10.7804 8.26001 10.7804 8.58001 10.4604L12.9267 6.11375C13.12 5.92042 13.44 5.92042 13.6333 6.11375C13.8267 6.30708 13.8267 6.62708 13.6333 6.82042L9.28668 11.1671C8.93335 11.5204 8.46668 11.7004 8.00001 11.7004Z" fill="#292D32" />
                                                        </g>
                                                    </g>
                                                </svg>
                                              </button>
                                              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">

                                                @foreach($obj as $o)
                                                @foreach($key as $k)
                                                @if($k->obj_id == $o->id)
                                                <a class="dropdown-item" href="{{url('dashboard/organization/report-2/'.$k->id.'/'.$sprint)}}" type="button">{{$k->key_name}}</a>
                                                @endif
                                                @endforeach
                                                @endforeach  
                                        </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center">
                                    <div>
                                        <small>Choose Initiative</small>
                                    </div>
                                    <div class="dropdown dropleft ml-3">
                                        <button class="btn btn-default bg-white dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            All
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            @foreach($SprintInit as $keyInt)
                                            @foreach($key as $k)
                                            @if($keyInt->initiative_key_id == $k->id)
                                            <a class="dropdown-item"href="{{url('dashboard/organization/report-init/'.$keyInt->initiative_id.'/'.$sprint)}}">{{$keyInt->initiative_name}}</a>
                                            @endif
                                            @endforeach
                                            @endforeach  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="card report-card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="d-flex flex-row align-items-center report-header">
                                                <h4>
                                                    Completed
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-borde table-sm">
                                                    <thead>
                                                        <tr>
                                                            <td>Key</td>
                                                            <td class="cell-20-percent">Summary</td>
                                                            <td>Added</td>
                                                            <td>Due Date</td>
                                                            <td>Completed Date</td>
                                                            <td>Status</td>
                                                            <td>Initiative Key</td>
                                                            <td class="cell-30-percent">Initiative Title</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                               
                                                    @foreach($SprintInit as $init)
                                                    @php
                                                    
                                                    $SprintEpic = DB::table('sprint_report')->where('epic_init_id',$init->initiative_id)->where('epic_prog','=',100)->where('epic_trash','=',NULL)->where('q_id',$sprint)->get();
                                                    @endphp
                                                    @foreach($SprintEpic as $epic)
                                                    @if($init->initiative_key_id == $id)

                                                    
                                                        <tr>
                                                            <td>
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
                                                                <span class="ml-2"><a href="javascript:void(0)">SSP-{{$k->id}}</span></a>
                                                            </td>
                                                            <td class="cell-20-percent"><a href="javascript:void(0)">{{$epic->epic_name}}</a></td>
                                                            <td>Added</td>
                                                            <td>{{$epic->epic_date}}</td>
                                                            <td>{{\Carbon\Carbon::parse($epic->epic_done)->format('M d,Y')}}</td>
                                                            <td>Done</td>
                                                            <td><a href="javascript:void(0)">IN{{$init->id}}</a></td>
                                                            <td class="cell-30-percent"><a href="javascript:void(0)"></a>{{$init->initiative_name}}</td>
                                                        </tr>
                                                        @endif
                                                        @endforeach
                                                        @endforeach
                                                      
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if(count($SprintInit) > 0 )
                                    @if(count($SprintEpic) > 10 )
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-default">
                                                See More
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="card report-card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="d-flex flex-row align-items-center report-header">
                                                <h4>
                                                    Not Completed
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-borde table-sm">
                                                    <thead>
                                                        <tr>
                                                            <td>Key</td>
                                                            <td class="cell-20-percent">Summary</td>
                                                            <td>Added</td>
                                                            <td>Due Date</td>
                                                    
                                                            <td>Status</td>
                                                            <td>Initiative Key</td>
                                                            <td class="cell-30-percent">Initiative Title</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       
                                                    @foreach($SprintInit as $init)
                                                    @php
                                                    $SprintEpic = DB::table('sprint_report')->where('epic_init_id',$init->initiative_id)->where('epic_prog','!=',100)->where('epic_trash','=',NULL)->where('q_id',$sprint)->get();
                                                    @endphp
                                                    @foreach($SprintEpic as $epic)
                                                    @if($init->initiative_key_id == $id)

                                                    
                                                        <tr>
                                                            <td>
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
                                                                <span class="ml-2"><a href="javascript:void(0)">SSP-{{$k->id}}</span></a>
                                                            </td>
                                                            <td class="cell-20-percent"><a href="javascript:void(0)">{{$epic->epic_name}}</a></td>
                                                            <td>Added</td>
                                                            <td>{{$epic->epic_date}}</td>
                                                           
                                                            <td>{{$epic->epic_status}}</td>
                                                            <td><a href="javascript:void(0)">IN{{$init->id}}</a></td>
                                                            <td class="cell-30-percent"><a href="javascript:void(0)"></a>{{$init->initiative_name}}</td>
                                                        </tr>
                                                        @endif
                                                        @endforeach
                                                        @endforeach
                                                      

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    @if(count($SprintInit) > 0 )
                                    @if(count($SprintEpic) > 10 )
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-default">
                                                See More
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="card report-card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="d-flex flex-row align-items-center report-header">
                                                <h4>
                                                    Removed
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-borde table-sm">
                                                    <thead>
                                                        <tr>
                                                            <td>Key</td>
                                                            <td class="cell-20-percent">Summary</td>
                                                            <td>Added</td>
                                                            <td>Due Date</td>
                                                          
                                                            <td>Status</td>
                                                            <td>Initiative Key</td>
                                                            <td class="cell-30-percent">Initiative Title</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       @foreach($SprintInit as $init)
                                                    @php
                                                    $SprintEpic = DB::table('sprint_report')->where('epic_init_id',$init->initiative_id)->where('epic_trash','!=',NULL)->where('q_id',$sprint)->get();
                                                    @endphp
                                                    @foreach($SprintEpic as $epic)
                                                    @if($init->initiative_key_id == $id)

                                                    
                                                        <tr>
                                                            <td>
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
                                                                <span class="ml-2"><a href="javascript:void(0)">SSP-{{$k->id}}</span></a>
                                                            </td>
                                                            <td class="cell-20-percent"><a href="javascript:void(0)">{{$epic->epic_name}}</a></td>
                                                            <td>Added</td>
                                                            <td>{{$epic->epic_date}}</td>
                                                        
                                                            <td>{{$epic->epic_status}}</td>
                                                            <td><a href="javascript:void(0)">IN{{$init->id}}</a></td>
                                                            <td class="cell-30-percent"><a href="javascript:void(0)"></a>{{$init->initiative_name}}</td>
                                                        </tr>
                                                        @endif
                                                        @endforeach
                                                        @endforeach
                                                        
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>


                                    @if(count($SprintInit) > 0 )
                                    @if(count($SprintEpic) > 10 )
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-default">
                                                See More
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    @endsection            