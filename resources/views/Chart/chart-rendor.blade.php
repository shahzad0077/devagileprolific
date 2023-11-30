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

