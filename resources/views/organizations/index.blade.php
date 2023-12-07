@php
$var_objective = "Org";
@endphp
@extends('components.main-layout')
<title>Dashboard</title>
@section('content')
<div class="row">
    <div class="col-md-12 py-3 p-0">
        <div class="row">
            <div class="col-md-2">
                <div class="dashboard-card">
                    <div class="card-svg">
                        <img src="{{ url('public/assets/svg/portfoliosvg.svg') }}">
                    </div>
                    <div class="dashboard-card-tittle">
                        <h4>Portfolio</h4>
                    </div>
                    <div class="dashboard-card-number">
                        <h3>25</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="dashboard-card">
                    <div class="card-svg">
                        <img src="{{ url('public/assets/svg/epicsbacklogsvg.svg') }}">
                    </div>
                    <div class="dashboard-card-tittle">
                        <h4>Epics Backlog</h4>
                    </div>
                    <div class="dashboard-card-number">
                        <h3>25</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="dashboard-card">
                    <div class="card-svg">
                        <img src="{{ url('public/assets/svg/performancesvg.svg') }}">
                    </div>
                    <div class="dashboard-card-tittle">
                        <h4>Performance</h4>
                    </div>
                    <div class="dashboard-card-number">
                        <h3>25</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="dashboard-card">
                    <div class="card-svg">
                        <img src="{{ url('public/assets/svg/teamssvg.svg') }}">
                    </div>
                    <div class="dashboard-card-tittle">
                        <h4>Teams</h4>
                    </div>
                    <div class="dashboard-card-number">
                        <h3>25</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="dashboard-card">
                    <div class="card-svg">
                        <img src="{{ url('public/assets/svg/reportingsvg.svg') }}">
                    </div>
                    <div class="dashboard-card-tittle">
                        <h4>Reporting</h4>
                    </div>
                    <div class="dashboard-card-number">
                        <h3>25</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="dashboard-card">
                    <div class="card-svg">
                        <img src="{{ url('public/assets/svg/impedimentssvg.svg') }}">
                    </div>
                    <div class="dashboard-card-tittle">
                        <h4>Impediments</h4>
                    </div>
                    <div class="dashboard-card-number">
                        <h3>25</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-7">
            <div class="col-md-4">
                <div class="dashboard-card-second">
                    <div class="dashboard-card-tittle-second row">
                        <div class="col-md-10">
                            <h4>Performance</h4>
                        </div>
                        <div class="col-md-2 text-right">
                            <div class="dashboard-card-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img  src="{{url('public/assets/svg/more.svg')}}" width="20">
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0)">Action One</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Action Two</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Action Three</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="dashboard-card-subtittle">
                                <p>Measure How Fast Your teams are growing</p>
                            </div>
                        </div>
                    </div>
                    <div class="performance">
                        <div class="row">
                            <div class="col-md-6 percentagetittle">
                                Design Team
                            </div>
                            <div class="col-md-6 text-right percentagenumber">
                                90%
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="progress">
                                    <div class="progress-bar color-3F51B5" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width:90%">
                                      <span class="sr-only">90% Complete</span>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="performance">
                        <div class="row">
                            <div class="col-md-6 percentagetittle">
                                Design Team
                            </div>
                            <div class="col-md-6 text-right percentagenumber">
                                20%
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="progress">
                                    <div class="progress-bar color-0AF30A" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%">
                                      <span class="sr-only">20% Complete</span>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="performance">
                        <div class="row">
                            <div class="col-md-6 percentagetittle">
                                Design Team
                            </div>
                            <div class="col-md-6 text-right percentagenumber">
                                20%
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="progress">
                                    <div class="progress-bar color-FFC100" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width:20%">
                                      <span class="sr-only">20% Complete</span>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="performance">
                        <div class="row">
                            <div class="col-md-6 percentagetittle">
                                Design Team
                            </div>
                            <div class="col-md-6 text-right percentagenumber">
                                60%
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="progress">
                                    <div class="progress-bar color-red" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
                                      <span class="sr-only">60% Complete</span>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="performance">
                        <div class="row">
                            <div class="col-md-6 percentagetittle">
                                Design Team
                            </div>
                            <div class="col-md-6 text-right percentagenumber">
                                70%
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="progress">
                                    <div class="progress-bar color-black" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
                                      <span class="sr-only">70% Complete</span>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                    <div class="performance">
                        <div class="row">
                            <div class="col-md-6 percentagetittle">
                                Design Team
                            </div>
                            <div class="col-md-6 text-right percentagenumber">
                                50%
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <div class="progress">
                                    <div class="progress-bar color-green" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">
                                      <span class="sr-only">50% Complete</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-card-second">
                    <div class="dashboard-card-tittle-second row">
                        <div class="col-md-10">
                            <h4>Activities</h4>
                        </div>
                        <div class="col-md-2 text-right">
                            <div class="dashboard-card-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img  src="{{url('public/assets/svg/more.svg')}}" width="20">
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0)">Action One</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Action Two</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Action Three</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="dashboard-card-subtittle">
                                <p>Tracking 30 objectives and mentioning.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="activity mb-4">
                              <div class="profile-image-container">
                                <img src="{{ url('public/assets/svg/trend-up.svg') }}" alt="User Profile">
                              </div>
                              <div class="dotted-line"></div>
                              <div class="activity-content">
                                <div class="activity-header">Johne Dow<span> has be Updated With 10% Progress Progress</span></div>
                                <div class="activity-time">Today , 12:00 am</div>
                              </div>
                            </div>
                            <div class="activity mb-4">
                              <div class="profile-image-container">
                                <img src="{{ url('public/assets/svg/trend-up.svg') }}" alt="User Profile">
                              </div>
                              <div class="dotted-line"></div>
                              <div class="activity-content">
                                <div class="activity-header">Johne Dow<span> has be Updated With 10% Progress Progress</span></div>
                                <div class="activity-time">Today , 12:00 am</div>
                              </div>
                            </div>
                            <div class="activity mb-4">
                              <div class="profile-image-container">
                                <img src="{{ url('public/assets/svg/trend-up.svg') }}" alt="User Profile">
                              </div>
                              <div class="dotted-line"></div>
                              <div class="activity-content">
                                <div class="activity-header">Johne Dow<span> has be Updated With 10% Progress Progress</span></div>
                                <div class="activity-time">Today , 12:00 am</div>
                              </div>
                            </div>
                            <div class="activity mb-5">
                              <div class="profile-image-container">
                                <img src="{{ url('public/assets/svg/trend-up.svg') }}" alt="User Profile">
                              </div>
                              <div class="dotted-line"></div>
                              <div class="activity-content">
                                <div class="activity-header">Johne Dow<span> has be Updated With 10% Progress Progress</span></div>
                                <div class="activity-time">Today , 12:00 am</div>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="dashboard-card-second">
                    <div class="dashboard-card-tittle-second row">
                        <div class="col-md-6">
                            <h4>Objectives</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <div class="dashboard-card-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img  src="{{url('public/assets/svg/more.svg')}}" width="20">
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0)">Action One</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Action Two</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Action Three</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="dashboard-card-subtittle">
                                <p>Tracking 30 objectives</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 row">
                        <div class="col-md-6">
                            <h4 class="dashboard-object-tittle">Total:</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <h4 class="dashboard-object-tittle-points">121</h4>
                        </div>
                    </div>
                    <div class="progress-container">
                        <div class="custom-progress-bar progress-bar-green" style="width: 70%;"></div>
                        <div class="custom-progress-bar progress-bar-blue" style="width: 50%;"></div>
                        <div class="custom-progress-bar progress-bar-yellow" style="width: 30%;"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="objectivepoints">
                                <div class="d-flex">
                                    <div class="flex-grow-1 d-flex">
                                        <span class="dotforobjectivedashboard progress-bar-green"></span>
                                        <span class="objectivepointtittle">Done (30%)</span>
                                   </div>
                                    <div class="flex-grow-1 text-right">
                                        <span class="objectivepointanswer">12</span>
                                    </div>
                                </div>
                            </div>
                            <div class="objectivepoints">
                                <div class="d-flex">
                                    <div class="flex-grow-1 d-flex">
                                        <span class="dotforobjectivedashboard progress-bar-green"></span>
                                        <span class="objectivepointtittle">In Progress (30%)</span>
                                   </div>
                                    <div class="flex-grow-1 text-right">
                                        <span class="objectivepointanswer">30</span>
                                    </div>
                                </div>
                            </div>
                            <div class="objectivepoints">
                                <div class="d-flex">
                                    <div class="flex-grow-1 d-flex">
                                        <span class="dotforobjectivedashboard progress-bar-blue"></span>
                                        <span class="objectivepointtittle">To Do (30%)</span>
                                   </div>
                                    <div class="flex-grow-1 text-right">
                                        <span class="objectivepointanswer">40</span>
                                    </div>
                                </div>
                            </div>
                            <div class="objectivepoints">
                                <div class="d-flex">
                                    <div class="flex-grow-1 d-flex">
                                        <span class="dotforobjectivedashboard progress-bar-blue"></span>
                                        <span class="objectivepointtittle">Done</span>
                                   </div>
                                    <div class="flex-grow-1 text-right">
                                        <span class="objectivepointanswer">50</span>
                                    </div>
                                </div>
                            </div>
                            <div class="objectivepoints">
                                <div class="d-flex">
                                    <div class="flex-grow-1 d-flex">
                                        <span class="dotforobjectivedashboard progress-bar-blue"></span>
                                        <span class="objectivepointtittle">Risks</span>
                                   </div>
                                    <div class="flex-grow-1 text-right">
                                        <span class="objectivepointanswer">60</span>
                                    </div>
                                </div>
                            </div>
                            <div class="objectivepoints">
                                <div class="d-flex">
                                    <div class="flex-grow-1 d-flex">
                                        <span class="dotforobjectivedashboard progress-bar-yellow"></span>
                                        <span class="objectivepointtittle">Action</span>
                                   </div>
                                    <div class="flex-grow-1 text-right">
                                        <span class="objectivepointanswer">70</span>
                                    </div>
                                </div>
                            </div>
                            <div class="objectivepoints">
                                <div class="d-flex">
                                    <div class="flex-grow-1 d-flex">
                                        <span class="dotforobjectivedashboard progress-bar-yellow"></span>
                                        <span class="objectivepointtittle">Impediments</span>
                                   </div>
                                    <div class="flex-grow-1 text-right">
                                        <span class="objectivepointanswer">80</span>
                                    </div>
                                </div>
                            </div>
                            <div class="objectivepoints">
                                <div class="d-flex">
                                    <div class="flex-grow-1 d-flex">
                                        <span class="dotforobjectivedashboard progress-bar-yellow"></span>
                                        <span class="objectivepointtittle">Blocker</span>
                                   </div>
                                    <div class="flex-grow-1 text-right">
                                        <span class="objectivepointanswer">80</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-7">
            <div class="col-md-6">
                <div class="dashboard-card-third">
                    <div class="dashboard-card-tittle-second row">
                        <div class="col-md-10">
                            <h4>Statistics</h4>
                        </div>
                        <div class="col-md-2 text-right">
                            <div class="dashboard-card-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img  src="{{url('public/assets/svg/more.svg')}}" width="20">
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0)">Action One</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Action Two</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Action Three</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="dashboard-card-subtittle">
                                <p>All Key Results</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="chartforkeyresult">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card-third">
                    <div class="dashboard-card-tittle-second row">
                        <div class="col-md-10">
                            <h4>Targets</h4>
                        </div>
                        <div class="col-md-2 text-right">
                            <div class="dashboard-card-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img  src="{{url('public/assets/svg/more.svg')}}" width="20">
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0)">Action One</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Action Two</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Action Three</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="dashboard-card-subtittle">
                                <p>All Key Results</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="circleprogressbar" role="circleprogressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="--value:90"></div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <div class="targetprice">$124,301 <small>+3.5 %</small></div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <button class="seereportdashboard">See Report</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-card-third">
                    <div class="dashboard-card-tittle-second row">
                        <div class="col-md-10">
                            <h4>Targets</h4>
                        </div>
                        <div class="col-md-2 text-right">
                            <div class="dashboard-card-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img  src="{{url('public/assets/svg/more.svg')}}" width="20">
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="javascript:void(0)">Action One</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Action Two</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Action Three</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="dashboard-card-subtittle">
                                <p>All Key Results</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- <div class="row">
    <div class="col-md-12 mb-2">
        <button class="btn btn-sm btn-dark" id="delete-button" onclick="delete_record();" type="button">Delete All</button>
    </div>
</div> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/easypiechart.min.js" integrity="sha512-1yldf7W5suy0ko2u4OGU1qyeGrzh9+A3uyWGH4ws8MbndaWxZsgnzy6uqqBq7NUU/ImI1Js5kqDbunovCN1JqA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>
// Select the form element
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ["Jan","Feb","Mar","Apr","May","Jun","July","Aug","Sep","Oct","Nov","Dec"],
    datasets: [{
      label: '',
      data: [12, 19, 3, 17, 28, 24, 7, 17, 67, 47, 27, 87],
      backgroundColor: "rgba(54,153,255,1)",
      borderWidth: 1,
      barThickness: 1
    }]
  }
});
  function saveOrganization(){

    var file_data = $('#add_logo').prop('files')[0];
    var form_data = new FormData();
    form_data.append('add_logo', file_data);
    form_data.append('organization_name', $('#organization_name').val());
    form_data.append('phone', $('#phone').val());
    form_data.append('email', $('#email').val());
    form_data.append('_token', $('meta[name="csrf-token"]').attr('content'));
    form_data.append('small_description',$('#small_description').val());
    
      if (file_data) {
    form_data.append('add_logo', file_data);
        } else {
    form_data.append('add_logo', '');
        }


    if($('#organization_name').val()!='' || $('#phone').val()!='' || $('#email').val()!=''){
        $.ajax({
            type: "POST",
            url:"{{url('save-organization')}}", 
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
              if(res == 1)
              {

              $('#email-error').html('<strong class="text-danger">Email Already Taken</strong>');

              }else if(res == 2)
              {
                $('#phone-error').html('<strong class="text-danger">Phone Number Already Taken</strong>');
                $('#email-error').html('');
              }else
              {
              $('#email-error').html(''); 
              $('#phone-error').html('');   
              $('#objective_name').val('');
              $('#email').val('');
              $('#phone').val('');
              $('#small_description').val('');
              $('#success').html('<div class="alert alert-success" role="alert"> Organization Created successfully</div>');
              $('#org-feild-error').html('');
              setTimeout(function() { 
                $('#create-org').modal('hide');

                location.reload();
            }, 3000);
              }
            
            }
        });
    }else{
           
        $('#org-feild-error').html('Please fill out all required fields.');

    }
}

$('.org-delete').click(function(){

  var org_id = $(this).attr('data-id');

  $('#org-id').val(org_id);

});

// function UpdateOrganization(){
//     var file_data = $('#logo').prop('files')[0];
//     var form_data = new FormData();
//     if (file_data) {
//         form_data.append('logo', file_data);
//         } else {
//     var oldImageFilePath = $('#old_image').val();
//     form_data.append('old_image', oldImageFilePath);
//         }

//     form_data.append('objective_name', $('#objective_name').val());
//     form_data.append('phone', $('#phone').val());
//     form_data.append('email', $('#email').val());
//     form_data.append('_token', $('meta[name="csrf-token"]').attr('content'));
//     form_data.append('small_description',$('#small_description').val());
//     form_data.append('org_edit_id', $('#org_edit_id').val());



//     if($('#objective_name').val()!='' || file_data!=undefined || $('#phone').val()!='' || $('#email').val()!=''){
//         $.ajax({
//             type: "POST",
//             url:"{{url('update-organization')}}", 
//             data: form_data,
//             cache: false,
//             contentType: false,
//             processData: false,
//             success: function(res) {
           
//               $('#edit_message').html('<div class="alert alert-success" role="alert"> Organization Updated successfully</div>');
         

//               setTimeout(function() { 
//                 $('#edit-org').modal('hide');
//                 location.reload();
//             }, 2000);
              
            
//             }
//         });
//     }
// }

$("#checkAll").click(function () {
$('input:checkbox').not(this).prop('checked', this.checked);
if(this.checked)
{
 $('#delete-button').show();
   
}else
{
$('#delete-button').hide();
    
}
});

$('.check').on('click', function(){
  isChecked = $(this).is(':checked')
  
  if(isChecked){ 
   $('#delete-button').show();
  }
  else{ 
    $('#delete-button').hide();
  
  }
})
			
function delete_record()
{
  
     var selectedOptions = [];
    $('.checkbox:checked').each(function() {
     selectedOptions.push($(this).val());
     
});

  $.ajax({
            type: "POST",
            url:"{{url('delete-mutiple-organization')}}", 
             data:{selectedOptions:selectedOptions,_token:'{{ csrf_token() }}'},
            success: function(res) {
                
             location.reload();
            }
        });
}
		
$(document).ready(function() {
 setTimeout(function(){$('.alert-success').slideUp();},3000); 
}); 			
</script>


@endsection