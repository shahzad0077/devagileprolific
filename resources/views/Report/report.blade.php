@php
$var_objective = 'Report-'.$type;
@endphp
@extends('components.main-layout')
<title>Report</title>
@section('content')
    <div class="content d-flex flex-column flex-column-fluid">
                <!-- begin breadcrums -->
                <!-- end breadcrums -->
                <!-- begin page Content -->
                <div class="container-fluid py-7" style="width: 96%; margin: 0px auto;">
                    <div class="row">
                       
                        
                       
                       
                
                
                     
              
    
                        @foreach($obj as $o)
                        <div class="col-md-6">
                            <div class="card report-card mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="d-flex flex-row align-items-center report-header">
                                                <h4>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                                      <g clip-path="url(#clip0_2230_23543)">
                                                        <path d="M32 16C32 7.16344 24.8366 0 16 0C7.16344 0 0 7.16344 0 16C0 24.8366 7.16344 32 16 32C24.8366 32 32 24.8366 32 16Z" fill="#3699FF"/>
                                                        <path d="M25 16H21.4M10.6 16H7M16 10.6V7M16 25V21.4M23.2 16C23.2 19.9765 19.9765 23.2 16 23.2C12.0235 23.2 8.8 19.9765 8.8 16C8.8 12.0235 12.0235 8.8 16 8.8C19.9765 8.8 23.2 12.0235 23.2 16ZM18.7 16C18.7 17.4912 17.4912 18.7 16 18.7C14.5088 18.7 13.3 17.4912 13.3 16C13.3 14.5088 14.5088 13.3 16 13.3C17.4912 13.3 18.7 14.5088 18.7 16Z" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                      </g>
                                                      <defs>
                                                        <clipPath id="clip0_2230_23543">
                                                          <rect width="32" height="32" fill="white"/>
                                                        </clipPath>
                                                      </defs>
                                                    </svg> 
                                                    <span class="ml-1">{{ $loop->iteration  }}. {{$o->objective_name}}</span>
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
                                                            <td class="key-result-cell">Key Results</td>
                                                            <td>Completed</td>
                                                            <td>Not Completed</td>
                                                            <td>Completion</td>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                              
                                                        @php
                                                        $id = 0;
                                                        @endphp

                                                       @foreach($key as $k)
                                                       @if($k->obj_id == $o->id)
                                                       @php
                                                       $Completion = 0;
                                                       if($k->key_epic_count > 0)
                                                       {
                                                       $Completion = ($k->key_epic_comp/$k->key_epic_count * 100);
                                                       }
                                                       
                                                       $id++;
                                                       @endphp
                                                        <tr>
                                                            <td class="key-result-cell">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                  <g clip-path="url(#clip0_2266_571)">
                                                                    <path d="M24 12C24 5.37258 18.6274 0 12 0C5.37258 0 0 5.37258 0 12C0 18.6274 5.37258 24 12 24C18.6274 24 24 18.6274 24 12Z" fill="#3699FF"/>
                                                                    <path d="M14.625 10.125C14.625 9.83708 14.5151 9.54915 14.2955 9.32947C14.0758 9.1098 13.7879 9 13.5 9M13.5 13.5C15.364 13.5 16.875 11.989 16.875 10.125C16.875 8.26102 15.364 6.75 13.5 6.75C11.636 6.75 10.125 8.26102 10.125 10.125C10.125 10.279 10.1353 10.4305 10.1553 10.579C10.1881 10.8232 10.2045 10.9453 10.1935 11.0225C10.1819 11.103 10.1673 11.1463 10.1276 11.2173C10.0895 11.2855 10.0225 11.3525 9.88823 11.4868L7.0136 14.3614C6.91632 14.4587 6.86768 14.5073 6.83289 14.5641C6.80205 14.6144 6.77932 14.6692 6.76554 14.7267C6.75 14.7914 6.75 14.8602 6.75 14.9978V15.975C6.75 16.29 6.75 16.4476 6.81131 16.5679C6.86524 16.6737 6.95129 16.7597 7.05713 16.8137C7.17745 16.875 7.33497 16.875 7.65 16.875H9V15.75H10.125V14.625H11.25L12.1382 13.7368C12.2725 13.6025 12.3395 13.5355 12.4077 13.4974C12.4787 13.4577 12.522 13.4431 12.6025 13.4315C12.6797 13.4205 12.8018 13.4369 13.046 13.4697C13.1945 13.4897 13.346 13.5 13.5 13.5Z" stroke="white" stroke-width="1.0125" stroke-linecap="round" stroke-linejoin="round"/>
                                                                  </g>
                                                                  <defs>
                                                                    <clipPath id="clip0_2266_571">
                                                                      <rect width="24" height="24" fill="white"/>
                                                                    </clipPath>
                                                                  </defs>
                                                                </svg>
                                                                <span class="ml-2"><a href="{{url('dashboard/organization/report-2/'.$k->id.'/'.$report->id)}}"> {{ $id}}.{{$k->key_name}}</span></a>
                                                            </td>
                                                            <td class="center">{{$k->key_epic_comp}}</td>
                                                            <td class="center">{{$k->key_epic_incopm}}</td>
                                                            @if($Completion == 100)
                                                            <td class="center text-success">{{round($Completion,2)}}%</td>
                                                            @else
                                                            <td class="center text-danger">{{round($Completion,2)}}%</td>
                                                            @endif
                                                        </tr>
                                                          @endif
                                                          @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    @if(count($key) > 10)
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <button class="btn btn-default">
                                                See More
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach

                 
                    </div>
                </div>
                <!-- end page content -->
            </div>
    @endsection
