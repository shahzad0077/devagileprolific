<!-- jQuery & jQuery UI are required -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<!-- Flowchart CSS and JS -->
<link rel="stylesheet" href="{{ url('public/assets/flowchart/jquery.flowchart.css') }}">
<script src="{{ url('public/assets/flowchart/jquery.flowchart.js') }}"></script>

<!-- Zoom -->
<script type="text/javascript">
    /* global $ */
    $(document).ready(function() {
        var $flowchart = $('#flowchartworkspace');
        var $container = $flowchart.parent();


        // Apply the plugin on a standard, empty div...
        $flowchart.flowchart({
            data: defaultFlowchartData,
            defaultSelectedLinkColor: '#000055',
            grid: 10,
            multipleLinksOnInput: true,
            multipleLinksOnOutput: true
        });


        function getOperatorData($element) {
            var nbInputs = parseInt($element.data('nb-inputs'), 10);
            var nbOutputs = parseInt($element.data('nb-outputs'), 10);
            var data = {
                properties: {
                    title: $element.text(),
                    inputs: {},
                    outputs: {}
                }
            };

            var i = 0;
            for (i = 0; i < nbInputs; i++) {
                data.properties.inputs['input_' + i] = {
                    label: 'Input ' + (i + 1)
                };
            }
            for (i = 0; i < nbOutputs; i++) {
                data.properties.outputs['output_' + i] = {
                    label: 'Output ' + (i + 1)
                };
            }

            return data;
        }



        //-----------------------------------------
        //--- operator and link properties
        //--- start
        var $operatorProperties = $('#operator_properties');
        $operatorProperties.hide();
        var $linkProperties = $('#link_properties');
        $linkProperties.hide();
        var $operatorTitle = $('#operator_title');
        var $linkColor = $('#link_color');

        $flowchart.flowchart({
            onOperatorSelect: function(operatorId) {
                $operatorProperties.show();
                $operatorTitle.val($flowchart.flowchart('getOperatorTitle', operatorId));
                return true;
            },
            onOperatorUnselect: function() {
                $operatorProperties.hide();
                return true;
            },
            onLinkSelect: function(linkId) {
                $linkProperties.show();
                $linkColor.val($flowchart.flowchart('getLinkMainColor', linkId));
                return true;
            },
            onLinkUnselect: function() {
                $linkProperties.hide();
                return true;
            }
        });

        $operatorTitle.keyup(function() {
            var selectedOperatorId = $flowchart.flowchart('getSelectedOperatorId');
            if (selectedOperatorId != null) {
                $flowchart.flowchart('setOperatorTitle', selectedOperatorId, $operatorTitle.val());
            }
        });

        $linkColor.change(function() {
            var selectedLinkId = $flowchart.flowchart('getSelectedLinkId');
            if (selectedLinkId != null) {
                $flowchart.flowchart('setLinkMainColor', selectedLinkId, $linkColor.val());
            }
        });
        //--- end
        //--- operator and link properties
        //-----------------------------------------

        //-----------------------------------------
        //--- delete operator / link button
        //--- start
        $flowchart.parent().siblings('.delete_selected_button').click(function() {
            $flowchart.flowchart('deleteSelected');
        });
        //--- end
        //--- delete operator / link button
        //-----------------------------------------



        //-----------------------------------------
        //--- create operator button
        //--- start
        var operatorI = 0;
        $flowchart.parent().siblings('.create_operator').click(function() {
            var operatorId = 'created_operator_' + operatorI;
            var operatorData = {
                top: ($flowchart.height() / 2) - 30,
                left: ($flowchart.width() / 2) - 100 + (operatorI * 10),
                properties: {
                    title: 'Operator ' + (operatorI + 3),
                    inputs: {
                        input_1: {
                            label: 'Input 1',
                        }
                    },
                    outputs: {
                        output_1: {
                            label: 'Output 1',
                        }
                    }
                }
            };

            operatorI++;

            $flowchart.flowchart('createOperator', operatorId, operatorData);

        });
        //--- end
        //--- create operator button
        //-----------------------------------------




        //-----------------------------------------
        //--- draggable operators
        //--- start
        //var operatorId = 0;
        var $draggableOperators = $('.draggable_operator');
        $draggableOperators.draggable({
            cursor: "move",
            opacity: 0.7,

            // helper: 'clone',
            appendTo: 'body',
            zIndex: 1000,

            helper: function(e) {
                var $this = $(this);
                var data = getOperatorData($this);
                return $flowchart.flowchart('getOperatorElement', data);
            },
            stop: function(e, ui) {
                var $this = $(this);
                var elOffset = ui.offset;
                var containerOffset = $container.offset();
                if (elOffset.left > containerOffset.left &&
                    elOffset.top > containerOffset.top &&
                    elOffset.left < containerOffset.left + $container.width() &&
                    elOffset.top < containerOffset.top + $container.height()) {

                    var flowchartOffset = $flowchart.offset();

                    var relativeLeft = elOffset.left - flowchartOffset.left;
                    var relativeTop = elOffset.top - flowchartOffset.top;

                    var positionRatio = $flowchart.flowchart('getPositionRatio');
                    relativeLeft /= positionRatio;
                    relativeTop /= positionRatio;

                    var data = getOperatorData($this);
                    data.left = relativeLeft;
                    data.top = relativeTop;

                    $flowchart.flowchart('addOperator', data);
                }
            }
        });
        //--- end
        //--- draggable operators
        //-----------------------------------------


        //-----------------------------------------
        //--- save and load
        //--- start
        function Flow2Text() {
            var data = $flowchart.flowchart('getData');
            $('#flowchart_data').val(JSON.stringify(data, null, 2));
        }
        $('#get_data').click(Flow2Text);

        function Text2Flow() {
            var data = JSON.parse($('#flowchart_data').val());
            $flowchart.flowchart('setData', data);
        }
        $('#set_data').click(Text2Flow);

        /*global localStorage*/
        function SaveToLocalStorage() {
            if (typeof localStorage !== 'object') {
                alert('local storage not available');
                return;
            }
            Flow2Text();
            localStorage.setItem("stgLocalFlowChart", $('#flowchart_data').val());
        }
        $('#save_local').click(SaveToLocalStorage);

        function LoadFromLocalStorage() {
            if (typeof localStorage !== 'object') {
                alert('local storage not available');
                return;
            }
            var s = localStorage.getItem("stgLocalFlowChart");
            if (s != null) {
                $('#flowchart_data').val(s);
                Text2Flow();
            }
            else {
                alert('local storage empty');
            }
        }
        $('#load_local').click(LoadFromLocalStorage);
        //--- end
        //--- save and load
        //-----------------------------------------


    });

    @php
    $key = [];
    $team = [];
    $obj = [];
    $Data = DB::table('team_link_parent')->where('buisness_unit_id',$organization->id)->get();
    foreach($Data as $k)
    {
        $key[] = $k->key_id;
        $team[] = $k->link_team_id;
        $obj[] = $k->link_obj_id;
    }
    
    if($organization->type == 'unit')
    {
    
    $Team = DB::table('unit_team')->whereIn('id',$team)->where('org_id',$organization->id)->get();
    $Objective = DB::table('objectives')->whereIn('id',$obj)->where('type','BU')->get();
    
    }

    if($organization->type == 'stream')
    {
    $Team = DB::table('value_team')->whereIn('id',$team)->where('org_id',$organization->id)->get();
    $Objective = DB::table('objectives')->whereIn('id',$obj)->where('type','VS')->get();

    }

    @endphp


    var defaultFlowchartData = {
        operators: {
            @foreach(DB::table('key_result')->whereIn('id',$key)->get() as $key=>$r)
            operator{{ $r->id }}: {
                top: 20,
                left: 20,
                properties: {
                    title: '{{ $r->key_name }}',
                    inputs: {},
                    outputs: {
                        output_1: {
                            label: '',
                        }
                    },
                    body:'<div class="row"> <div class="col-md-12"> <h3 style=" font-size: 16px; font-weight: 600; margin-bottom: 15px; "></h3> </div> </div> <div class="row mb-3"> <div class="col-md-2"> <div class="badge badge-primary" style=" padding-bottom: 5px !important; padding-top: 5px !important; ">{{ $r->key_prog }} %</div> </div> <div class="col-md-8" style=" font-size: 13px; font-weight: 600; margin-top: 4px; "> {{ $r->key_name }}</div> <div class="col-md-2 text-center"> <i class="fa fa-spinner"></i> </div> </div>'
                }
            },
            @endforeach

            @foreach($Team as $key=>$r)
            operator{{ $r->id }}: {
                top: 80,
                left: 660,
                properties: {
                    title: '{{ $r->team_title }}',
                    inputs: {
                        input_1: {
                            label: '',
                        }
                    },
                    body: '@foreach($Objective as $OBJ) @if($OBJ->unit_id == $r->id) <div class="row"> <div class="col-md-12"> <h3 style="font-size: 16px; font-weight: 600; margin-bottom: 15px;"></h3> </div> </div> <div class="row mb-3"> <div class="col-md-2"> <div class="badge badge-primary" style="padding-bottom: 5px !important; padding-top: 5px !important;">{{ $OBJ->obj_prog }} %</div> </div> <div class="col-md-8" style="font-size: 13px; font-weight: 600; margin-top: 4px;">{{ $OBJ->objective_name }}</div> <div class="col-md-2 text-center"> <i class="fa fa-spinner"></i> </div> </div>@endif @endforeach',                    
                    outputs: {}
                }
            },
            @endforeach
        },
        links: {
            link_1: {
                fromOperator: 'operator1',
                fromConnector: 'output_1',
                toOperator: 'operator2',
                toConnector: 'input_2',
            },
        }
    };
    if (false) console.log('remove lint unused warning', defaultFlowchartData);
</script>




<!-- Zoom -->

<script>
document.addEventListener('DOMContentLoaded', function() {
    const panelLink = document.querySelector('.nav-link[href="#panel"]');
    const sidePanel = document.getElementById('panel');
    const closeBtn = document.getElementById('closeBtn');

    panelLink.addEventListener('click', function(event) {
        event.preventDefault();
        sidePanel.classList.add('open');
    });

    closeBtn.addEventListener('click', function(event) {
        event.preventDefault();
        sidePanel.classList.remove('open');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const panelLink = document.querySelector('.nav-link[href="#panel-new"]');
    const sidePanel = document.getElementById('panel-new');
    const closeBtn = document.getElementById('closeBtn');

    panelLink.addEventListener('click', function(event) {
        event.preventDefault();
        sidePanel.classList.add('open');
    });

    closeBtn.addEventListener('click', function(event) {
        event.preventDefault();
        sidePanel.classList.remove('open');
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const panelLink = document.querySelector('.nav-link[href="#panel-unit"]');
    const sidePanel = document.getElementById('panel-unit');
    const closeBtn = document.getElementById('closeBtn');

    panelLink.addEventListener('click', function(event) {
        event.preventDefault();
        sidePanel.classList.add('open');
    });

    closeBtn.addEventListener('click', function(event) {
        event.preventDefault();
        sidePanel.classList.remove('open');
    });
});
</script>