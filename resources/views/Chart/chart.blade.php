@php
$var_objective = 'Page-'.$type;
@endphp
@extends('components.main-layout')
@if($organization->type == 'unit')
<title>Performance Dashboard-{{$organization->business_name}}</title>
@endif
@if($organization->type == 'stream')
<title>Performance Dashboard-{{$organization->value_name}}</title>
@endif
@section('content')
    <style>
        .tab {
            display: none;
        }
    </style>

    @if (count($data) > 0)
        <div class="row" id="chart-update">
            @foreach ($data as $chart_data)
                @php
                      $chart = DB::table('chart_data')
                        ->where('kpi_setting_id', $chart_data->id)
                        ->whereNotNull('target_value')
                        ->orderby('id','DESC')
                        ->first();
    
                    
                    $alldata = DB::table('chart_data')
                        ->whereNotNull('target_value')
                        ->whereRaw('target_value REGEXP "^[0-9]+$"')
                        ->get();                   
                @endphp

                
                    <div class="col-md-6 mb-5">
                        <div class="card p-3 mt-2">
                            <div class="card-body">
                                <div class="row chart-header mb-5">
                                    <div class="col-md-12">
                                        <div class="d-flex flex-row title-area">
                                            <div style="width:55% !important">
                                                <h3 class="title mb-1">{{$chart_data->chart_title}}</h3>
                                                <small class="subtitle">{{$chart_data->chart_subtitle}}</small>
                                            </div>
                                            <div class="d-flex justify-content-between ml-auto">
                                                <div>
                                                    <div class="dropdown">
                                                        
                                                        <button onclick="resetZoom({{$chart_data->id}})" class="btn btn-circle btn-xl btn-tolbar">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20" fill="none">
                                                              <path d="M18.3327 10.0001C18.3327 14.6001 14.5993 18.3334 9.99935 18.3334C5.39935 18.3334 2.59102 13.7001 2.59102 13.7001M2.59102 13.7001H6.35768M2.59102 13.7001V17.8667M1.66602 10.0001C1.66602 5.40008 5.36602 1.66675 9.99935 1.66675C15.5577 1.66675 18.3327 6.30008 18.3327 6.30008M18.3327 6.30008V2.13341M18.3327 6.30008H14.6327" stroke="#292D32" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </button>
                                                        
                                                        <button class="btn btn-circle btn-xl btn-tolbar dropdown-toggle"
                                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false">
                                                            <img src="{{ asset('public/assets/images/icons/dots.svg') }}">
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="javascript:void(0);"
                                                                onclick="editchart({{ $chart_data->id }});" data-toggle="modal"
                                                                data-target="#edit-chart">Edit Values</a>
                                                                <a class="dropdown-item" href="javascript:void(0);"
                                                                onclick="editbasicchart({{$chart_data->id}})"
                                                                data-toggle="modal" data-target="#edit-basic-chart">Edit Basic Detail</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"
                                                                onclick="deletechart({{ $chart_data->id }});"
                                                                data-toggle="modal" data-target="#delete-chart">Delete chart</a>
                                                               
                                                            <a class="dropdown-item" href="{{url('download/'.$chart_data->csv)}}">Download csv</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row justify-content-between target-area">
                                            <div class="d-flex flex-row align-items-center stats-section mt-3">
                                                <div><small>Target Value:</small></div>
                                                @if($chart_data->t_value)
                                                <div class="ml-2"><b>{{ $chart_data->t_value }}</b></div>
                                                @else
                                                <div class="ml-2"><b>None</b></div>
                                                @endif
                                            </div>
                                            @php
                                            $date = \Carbon\Carbon::parse($chart_data->t_date)->format('M d Y');
                                            @endphp
                                            <div class="d-flex flex-row align-items-center stats-section mt-3">
                                                <div><small class="">Target Date:</small></div>
                                                <div class="ml-2">
                                                    @if($chart_data->t_date)
                                                    <b>{{ $date }}</b>
                                                    @else
                                                    <b>TBC</b>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @php
                                    $months = [];
                                    $value = [];
                                    foreach ($alldata as $month) {
                                        if ($month->kpi_setting_id == $chart_data->id) {
                                            $months[] = $month->target_month;
                                            $value[] = $month->target_value;
                                        }
                                    }
                                @endphp
                                <div class="card-body" style="height: 400px;">
                                    <canvas id="lineChart{{ $chart_data->id }}"></canvas>
                                </div>
                                @foreach ($alldata as $graph)
                                    @if ($graph->kpi_setting_id == $chart_data->id)
                                        @php
                                            $max = max($value);
                                            $trend = 0;
                                            if ($chart_data->trend_line == 'Yes') {
                                                $trend = $max;
                                            }
                                            
                                            $maxlinebar = 0;
                                            $maxlinebar = max($value);
                                        $extraLineData = 0;    
                                        if($chart_data->t_value != NULL)
                                        {
                                        $extraLineData = $chart_data->t_value;
                                        }
                                        
                                        $extraLineDataG = 0;
                                        $color = '';
                                        if($chart_data->target_opt == 'Greater')
                                        {
                                        $extraLineDataG = $chart_data->green;
                                        $color = 'green';
                                        }
                                        if($chart_data->target_opt == 'Less')
                                        {
                                        $extraLineDataG = $chart_data->green;
                                        $color = 'red';
                                        } 
                                        @endphp

                                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@1.0.1"></script>
                                            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8/hammer.min.js"></script>
                                            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
                                        <script>
                                            var chartData{{ $graph->id }} = @json($graph);

                                            var ctxLine{{ $graph->id }} = document.getElementById('lineChart{{ $graph->kpi_setting_id }}').getContext(
                                                '2d');

                                            var trendLineValue = "{{ $trend }}";
                                             var maxLinebar = @json($maxlinebar);
                                        
                                              var calculatedMaxbar = Math.ceil(maxLinebar / 25) * 25;
                                              var calculatedMaxbarNew = (calculatedMaxbar + 100);
                                              var extraLineData = "{{$extraLineData}}";
                                              var extraLineDataG = "{{$extraLineDataG}}";
                                              var extraLineDataS = [0,extraLineData,extraLineData];

                                             
                                              var color = "{{$color}}";
                                               
                                                var maxValue = Math.max(...@json($value), ...extraLineData, ...extraLineDataG);
                                                extraLineDataS[extraLineDataS.length - 1] = maxValue;

                                              

                                               var lineChart= new Chart(ctxLine{{ $graph->id }}, {
                                                type: 'line', // Corrected to create a line chart
                                                data: {
                                                    labels: @json($months),
                                                    datasets: [{
                                                            label: 'Actual Line',
                                                            data: @json($value),
                                                            borderColor: 'darkblue',
                                                            fill: false,
                                                            borderWidth: 1.5,
                                                        },
                                                        {
                                                            label: 'Trend Line',
                                                            data: Array.from({
                                                                length: @json($months).length
                                                            }, () => trendLineValue),
                                                            fill: false,
                                                            borderWidth: 1.5,
                                                            borderColor: 'gray',
                                                        },
                                                         {
                                                            label: 'Ideal (Target) Line',
                                                            data:extraLineDataS,
                                                            borderColor: 'gray', // Hex code for red
                                                            borderWidth: 1.5,
                                                            fill: false,
                                                            borderDash: [5, 5],// No fill for trend line
                                                          
                                                        },
                                                        
                                                         {
                                                            label: 'Green Value',
                                                             data: Array.from({
                                                            length: @json($months).length
                                                            }, () => extraLineDataG),
                                                    
                                                            borderColor:color,
                                                            fill: false,
                                                            borderWidth: 1.5,
                                                          
                                                        },
                                                    ]
                                                },
                                                options: {
                                                        responsive: true,
                                                        maintainAspectRatio: false,
                                                        scales: {
                                                            x: {
                                                                beginAtZero: true,
                                                            },
                                                            y: {
                                                                beginAtZero: true,
                                                            },
                                                        },
                                                        plugins: {
                                                            zoom: {
                                                                pan: {
                                                                    enabled: true,
                                                                    mode: 'xy',
                                                                    speed: 10, // Adjust the speed of dragging
                                                                },
                                                                zoom: {
                                                                    wheel: {
                                                                        enabled: true,
                                                                    },
                                                                    drag: {
                                                                        enabled: true,
                                                                    },
                                                                    pinch: {
                                                                        enabled: true,
                                                                    },
                                                                    mode: 'xy',
                                                                }
                                                            }
                                                        }
                                                    }
                                            });
                                            
                                                 

                                             function resetZoom(val) {
                                    
                                                lineChart.resetZoom(val);
                                            }
                                        </script>
                                    @endif
                                @endforeach
                            </div>
                            <div class="card-footer">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center">
                                        <div class="mr-2"><b>Updated on</b></div>
                                        <div class="">
                                            <small>{{ \Carbon\Carbon::parse($chart_data->updated_at)->format('M d Y') }}</small>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center">
                                        @if($chart_data)
                                        @if ($chart_data->target_option == 'null')
                                        <div class="mr-2">
                                          <div class="circle white"></div>
                                         </div>
                                        <div><small>No Status</small></div>
                                        @elseif ($chart_data->target_option == 'yes')
                                        @if ($chart_data->target_opt == 'Greater')
                                            @if ($chart->target_value > $chart_data->green)
                                                 <div class="mr-2">
                                                    <div class="circle green"></div>
                                                </div>
                                                <div><small>Status (Green)</small></div>
                                               @else        
                                                <div class="mr-2">
                                                    <div class="circle red"></div>
                                                </div>
                                                <div><small>Status (Red)</small></div>
                                            @endif
                                            @endif
                                            
                                            @if ($chart_data->target_opt == 'Less')
                                            @if ($chart->target_value < $chart_data->green)
                                                <div class="mr-2">
                                                    <div class="circle green"></div>
                                                </div>
                                                <div><small>Status (Green)</small></div>
                                            @else
                                             <div class="mr-2">
                                                    <div class="circle red"></div>
                                                </div>
                                                <div><small>Status (Red)</small></div>
                                            @endif
                                            @endif
                                            @else
                                            @if ($chart->target_value < $chart_data->green)
                                                <div class="mr-2">
                                                    <div class="circle green"></div>
                                                </div>
                                                <div><small>Status (Green)</small></div>
                                            @elseif($chart->target_value > $chart_data->red)
                                                <div class="mr-2">
                                                    <div class="circle red"></div>
                                                </div>
                                                <div><small>Status (Red)</small></div>
                                            @else
                                                <div class="mr-2">
                                                    <div class="circle amber"></div>
                                                </div>
                                                <div><small>Status (Amber)</small></div>
                                            @endif
                                           @endif
                                       
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
              
            @endforeach



        

        </div>
    @endif

    <div class="modal fade" id="create-chart" tabindex="-1" role="dialog" aria-labelledby="create-chart"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 526px !important;">
                {{-- <div class="modal-header">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="modal-title" id="">New KPI</h5>
                        </div>
                        <div class="col-md-12">
                            <p>Add a Kpi CVC file</p>
                        </div>
                       
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                    </button>
                </div> --}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="success-chart" role="alert"></div>
                            <span id="chart-feild-error" class="ml-3 text-danger"></span>
                            <span id="green-feild-error" class="ml-3 text-danger"></span>
                        </div>
                    </div>
                    <div class="tab">
                        <div class="d-flex flex-row">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="modal-title" id="">New KPI</h5>
                                </div>
                                <div class="col-md-12">
                                    <p>Add a Kpi CVC file</p>
                                </div>
                                <div id="success-chart" role="alert"></div>
                                <span id="chart-feild-error" class="ml-3 text-danger"></span>
                            </div>
                            <div class="ml-auto">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <img src="{{ asset('public/assets/images/icons/minus.svg') }}">
                                </button>
                            </div>
                        </div>
                        <form class="needs-validation" action="{{url('save-chart-data')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                    
                        <input type="hidden" value="{{$organization->id}}" id="stream_id" name="stream_id">
                        <input type="hidden" value="{{$type}}" id="type" name="type">
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xl-12 mb-2">
                                <div class="form-group mb-0">
                                    <input type="text" class="form-control" name="title" required id="title">
                                    <label for="objective-name">Chart Title</label>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-12 mb-2">
                                <div class="form-group mb-0">
                                    <input type="text" class="form-control" required name="subtitle" id="subtitle">
                                    <label for="start-date">SubTitle</label>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group mb-0">
                                    <input type="file" class="form-control" required name="file"
                                        accept=".xls,.csv,.xlsx" id="profile">
                                      <label for="profile" style="bottom:72px">Upload CSV file</label>
                                </div>
                            </div>
                            
                         
                        </div>

                    </div>

                    <div class="tab" id="step_2">
                        <div class="d-flex flex-row mb-5">
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="modal-title" id="">KPI Settings</h5>
                                </div>
                                <div class="col-md-12">
                                    <p>Set Kpi properties</p>
                                </div>
                                <div id="success-chart" role="alert"></div>
                                <span id="chart-feild-error" class="ml-3 text-danger"></span>
                            </div>
                            <div class="ml-auto">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <img src="{{ asset('public/assets/images/icons/minus.svg') }}">
                                </button>
                            </div>
                        </div>
                        
                        <div class="row">
                                <div class="col-md-6 col-lg-6 col-xl-6">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" onkeypress="return onlyNumberKey(event)"
                                             name="t_value" id="t_value">

                                        <label for="objective-name">Target Value</label>
                                    </div>
                                </div>
                               
                                <!--  <div class="col-md-6 col-lg-6 col-xl-6">-->
                                <!--    <div class="form-group mb-0">-->
                                <!--        <select class="form-control" id="t_display">-->
                                            
                                <!--            <option value="No">No</option>-->
                                <!--            <option value="Yes">Yes</option>-->
                                <!--        </select>-->
                                <!--        <label for="objective-name">Display Guide Line</label>-->
                                <!--    </div>-->
                                <!--</div>-->
                                
                                <div class="col-md-6 col-lg-6 mb-2 col-xl-6">
                                    <div class="form-group mb-0">
                                        <input type="date" class="form-control"  min="{{ date('Y-m-d') }}"
                                            name="t_date" id="t_date">
                                        <label for="start-date" style="bottom:72px">Target Date</label>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6 mb-2 col-xl-6">
                                    <div class="form-group mb-0">
                                        <select class="form-control" name="t_line" id="t_line">
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>

                                        </select>
                                        <label for="objective-name">Trend Line</label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 mb-2 col-xl-6">
                                    <div class="form-group mb-0">
                                        <select class="form-control" name="t_bar" id="t_bar">
                                            <option value="Bar">Vertical Bar</option>
                                            <option value="Line">Line</option>

                                        </select>
                                        <label for="objective-name">Chart Type</label>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-5">
                                    <div class="form-check">
                                        <input name="collapseGroup" type="radio" value="yes" class="yes collapseGroup mr-2 form-check-input" data-toggle="collapse" id="option1" checked data-target="#collapseOne" />
                                        <label class="form-check-label ml-2 mt-1" for="option1">Option 1 <small>Green/Red Status</small></label>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6 col-xl-6 option_1">
                                    <div class="form-group mb-0">
                                        
                                        <select class="form-control" name="target_opt" id="target_opt">
                                        <option value="Greater">Greater than</option>
                                        <option value="Less">Less than</option>
                                        </select>
                                        <label for="">Select Value </label>
                                    </div>
                                </div>
                            
                                <div class="col-md-6 col-lg-6 col-xl-6 option_1">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" onkeyup="get_val(this.value)"
                                            value="" name="greenvalue" id="g_value_opt_1">
                                        <label for="objective-name">Green (Value)</label>
                                    </div>
                                </div>
                                
                                <!-- <div class="col-md-6 col-lg-6 col-xl-6 option_1" >-->
                                <!--    <div class="form-group mb-0">-->
                                <!--        <select class="form-control" id="g_display">-->
                                            
                                <!--            <option value="No">No</option>-->
                                <!--            <option value="Yes">Yes</option>-->
                                <!--        </select>-->
                                <!--        <label for="objective-name">Display Green Guide Line</label>-->
                                <!--    </div>-->
                                <!--</div>-->
                                
                                <!--<div class="col-md-6 col-lg-6 col-xl-6 option_1">-->
                                <!--    <div class="form-group mb-0">-->
                                <!--        <input type="text" class="form-control" id="r_value_opt_1">-->
                                <!--        <label for="objective-name">Red (Value)</label>-->
                                <!--    </div>-->
                                <!--</div>-->

                                <div class="col-md-12 mb-5">
                                    <div class="form-check">
                                        <input name="collapseGroup" value="no" type="radio"
                                            class="no collapseGroup mr-2 form-check-input" id="option2" data-toggle="collapse"
                                            data-target="#collapseOne" />
                                        <label class="form-check-label ml-2 mt-1" for="option2">
                                            Option 2 Green/Red/Amber Status
                                        </label>
                                        </div>
                                </div>
                                <!--<div class="col-md-12 col-lg-12 col-xl-6 option_2" >-->
                                <!--    <div class="form-group mb-0">-->
                                <!--        <select class="form-control" id="g_display_2">-->
                                            
                                <!--            <option value="No">No</option>-->
                                <!--            <option value="Yes">Yes</option>-->
                                <!--        </select>-->
                                <!--        <label for="objective-name">Display Green Guide Line</label>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <div class="col-md-6 col-lg-6 col-xl-6 option_2">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" onkeypress="return onlyNumberKey(event)"
                                            value="" name="greenvalueopt" id="g_value_opt_2">
                                        <label for="objective-name">Green (Value)</label>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6 col-xl-6 option_2">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" onkeypress="return onlyNumberKey(event)"
                                            value="" name="redvalueopt" id="r_value_opt_2">
                                        <label for="objective-name">Red (Value)</label>
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-12 col-xl-12 option_2">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" name="ambervalue" value="" id="a_value_opt_2">
                                        <label for="objective-name">Amber (Value)</label>
                                    </div>
                                </div>
                                
                                   <div class="col-md-12 mb-5">
                                    <div class="form-check">
                                        <input name="collapseGroup" value="null" type="radio"
                                            class="collapseGroup mr-2 form-check-input" id="option3" data-toggle="collapse"
                                            data-target="#collapseOne" />
                                        <label class="form-check-label ml-2 mt-1" for="option2">
                                            Option 3 To be defined (No Status will be displayed)
                                        </label>
                                        </div>
                                </div>

                            </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <div class="d-flex align-items-end">
                        <button type="button" id="prevBtn" class="btn btn-default btn-sm ml-4" onclick="nextPrev(-1)">Previous</button>
                        <button type="button" id="nextBtn" class="btn btn-primary btn-lg ml-4" onclick="nextPrev(1)">Next</button>
                        <button type="submit" id="save"  onclick="saveChartData();" style="display: none;" class="btn btn-primary  btn-sm ml-4">Submit</button>
                    </div>
                    </form>
                    <!-- Circles which indicates the steps of the form: -->
                    <div style="text-align:center;margin-top:40px;">
                        <span class="step"></span>
                        <span class="step"></span>
                    </div>
                </div>

            </div>
        </div>
    </div>


    @include('components.chart_script')




@endsection
