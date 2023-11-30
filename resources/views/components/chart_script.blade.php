<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<!--Charts-->
<script>
  // $( document ).ready(function() {
  //   var url = '/chart-data';
  //   var arr1 = [];
  //   var arr2 = [];
  //   var trendLineValue = 0;
  // $.get(url,function(response){
  // chartype
  // if(response.length > 0)
  // {
  // for (var i = 0; i < response.length; i++) {
  
  // arr1.push(response[i].target_value);
  // arr2.push(response[i].target_month);
  
  // }
  // if(response[0].trend_line == 'Yes')
  // {
  //   trendLineValue = response[0].t_value;
  
  // }
  
  // if(response[0].chart_type == 'Bar')
  // {
  //   var chartype = 1;
  
  // }
  // if(response[0].chart_type == 'Line')
  // {
  
  //   var chartype = 2;
  
  // }
  // }
  
  
  
  
  //     // Line Chart
  //   if(chartype == 2)
  //   {
  //     const monthsLine = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
  //     const valuesLine = arr1;
  //     const ctxLine = document.getElementById('lineChart').getContext('2d');
  
  //     new Chart(ctxLine, {
  //       type: 'line',
  //       data: {
  //         labels: arr2,
  //         datasets: [
  //           {
  //             label: 'Value',
  //             data: valuesLine,
  //             backgroundColor: 'rgba(84, 122, 255, 0.1)', // Solid color with opacity
  //             borderColor: '#547AFF', // Hex code for blue
  //             borderWidth: 3,
  //             fill: true
  //           },
  //           {
  //             label: 'Trend Line',
  //             data: Array.from({ length: monthsLine.length }, () => trendLineValue),
  //             borderColor: '#49D518', // Hex code for red
  //             borderWidth: 2,
  //             fill: false // No fill for trend line
  //           }
  //         ]
  //       },
  //       options: {
  //         scales: {
  //           x: {
  //             grid: {
  //               color: '#fff' // Change color of horizontal grid lines
  //             },
  //             ticks: {
  //               maxRotation: 0,
  //               autoSkip: true,
  //               maxTicksLimit: 12
  //             }
  //           },
  //           y: {
  //             grid: {
  //               color: '#EAEAEA' // Change color of horizontal grid lines
  //             },
  //             beginAtZero: true,
  //             max: 300,
  //             stepSize: 50
  //           }
  //         }
  //       }
  //     });

  //   }
  
    
   
  
    
  
  //     // Bar Chart
  //     if(chartype == 1)
  //   {
  //       const monthsBar = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
  //       const valuesBar = [100, 150, 200, 250, 180, 220, 240, 270, 290, 280, 260, 230];
  //       const ctxBar = document.getElementById('barChart').getContext('2d');
  
  
  
  //       new Chart(ctxBar, {
  //         type: 'bar',
  //         data: {
  //           labels: arr2,
  //           datasets: [
  //             {
  //               label: 'Value',
  //               data: arr1,
  //               backgroundColor: '#547AFF', // Bar color
  //               borderWidth: 0, // No borders
  //               barThickness: 10, // Set custom bar width
  //               pointRadius: 100 // Remove circular dots
  //             }
  //           ]
  //         },
  //         options: {
  //           scales: {
  //             x: {
  //               grid: {
  //                 color: 'transparent', // Hide grid lines
  //               }
  //             },
  //             y: {
  //               grid: {
  //                 color: '#EAEAEA', // Horizontal grid line color
  //               },
  //               beginAtZero: true,
  //               max: 300,
  //               stepSize: 50
  //             }
  //           },
  //           plugins: {
  //             legend: {
  //               display: false // Hide legend
  //             }
  //           },
  //           layout: {
  //             padding: {
  //               left: 10, // Add some padding to the left
  //               right: 10 // Add some padding to the right
  //             }
  //           }
  //         }
  //       });
  //     }
  
  //     });
  
  //   });
    
    window.onload = window.localStorage.clear();
    </script>
<script>
  function saveChartData(){

    var upload_file = $('#addfile').val();
    var form_data = new FormData();
    form_data.append('title', $('#title').val());
    form_data.append('subtitle', $('#subtitle').val());
    form_data.append('_token', $('meta[name="csrf-token"]').attr('content'));
    form_data.append('upload_file',$('#addfile')[0].files[0]);
    form_data.append('target', $('#t_value').val());
    form_data.append('greenvalue', $('#g_value_opt_1').val());
    form_data.append('collapseGroup', $("input[name='collapseGroup']:checked").val());
    form_data.append('target_date', $('#t_date').val());
    form_data.append('target_bar', $('#t_bar').val());
    form_data.append('target_line', $('#t_line').val());
    form_data.append('greenvalueopt', $('#g_value_opt_2').val());
    form_data.append('redvalueopt', $('#r_value_opt_2').val());
    form_data.append('redvalue', $('#r_value_opt_1').val());
    form_data.append('ambervalue', $('#a_value_opt_2').val());
    form_data.append('upload_file_name',$('#addfile')[0].files[0]);
    form_data.append('target_opt',$('#target_opt').val());
    form_data.append('t_display',$('#t_display').val());
    form_data.append('g_display',$('#g_display').val());
    form_data.append('g_display_2',$('#g_display_2').val());
    form_data.append('stream_id',$('#stream_id').val());
    form_data.append('type',$('#type').val());

    var str = $("#g_value_opt_1").val();
    var str1 = $("#g_value_opt_2").val();
    var target = $("#t_value").val();
//     if(str > 0){
//     if(str >= target)
//     {
//      $('#green-feild-error').html('Green Value Should be less then target value.');
//      $('#chart-feild-error').html('');
//      return false;
//     }
// }

// if(str1 > 0){
//     if(str1 >= target)
//     {
//      $('#green-feild-error').html('Green Value Should be less then target value.');
//      $('#chart-feild-error').html('');
//      return false;
//     }
// }



    if($('#t_value').val()!='')
    {
        $.ajax({
            type: "POST",
            url:"{{url('save-chart-data')}}", 
            data: form_data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(res) {
             
             $('#title').val('');
             $('#subtitle').val('');
             $('#addfile').val('');
          
             $('#green-feild-error').html('');
              $('#success-chart').html('<div class="alert alert-success" role="alert"> Data Upload successfully</div>');
              $('#chart-feild-error').html('');
              setTimeout(function() { 
                $('#create-chart').modal('hide');
                $('#success-chart').html('');

                location.reload();
            }, 3000);
              
             
            
            }
            
        });
    }else{
           
        $('#chart-feild-error').html('Please fill out all required fields.');

    }
}

                function onlyNumberKey(evt) 
                {
                  
                 var ASCIICode = (evt.which) ? evt.which : evt.keyCode
                 if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                 return false;
                 return true;
                } 


var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("save").style.display = "inline";
    document.getElementById("nextBtn").style.display = "none";
  } else {
    document.getElementById("save").style.display = "none";
      document.getElementById("nextBtn").style.display = "inline";

  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
// function clear_data(){
//   showTab(0);

// }


			
$(document).ready(function(){
    $('.option_2').slideUp();
    $('.yes').click(function(){
        
        $('.option_2').slideUp();
        $('.option_1').slideDown();  //to show
        $("#g_value_opt_2").val('');
        $("#r_value_opt_2").val('');
        $("#a_value_opt_2").val('');

    });
    $('.no').click(function(){
        $('.option_1').slideUp();
        $('.option_2').slideDown();  //to show
        $("#g_value_opt_1").val('');
        $("#r_value_opt_1").val('');

  //to hide
    });
    
     $('#option3').click(function(){
        $('.option_1').slideUp();
        $('.option_2').slideUp();  
        $("#g_value_opt_1").val('');
        $("#r_value_opt_1").val('');
          $("#g_value_opt_2").val('');
        $("#r_value_opt_2").val('');
        $("#a_value_opt_2").val('');

  //to hide
    });
});
function get_val(val)
{
var str1 = val.replace ( /[^\d.]/g, '' ); 
var total = parseInt(str1) - 1;
var target = $('#t_value').val();
$("#g_value_opt_1").val(str1);
  
$('#r_value_opt_1').val(total + ' and below');

}

$(document).ready(function() {
    // Get references to the input fields and result field
    var input1 = $("#g_value_opt_2");
    var input2 = $("#r_value_opt_2");
    var resultField = $("#a_value_opt_2");

   
    function calculateResult() {
        var value1 = parseFloat(input1.val()) || 0; 
        var value2 = parseFloat(input2.val()) || 0;
        var result2 = 0;
        var result = 0;

        if(value1 > 0)
        {
         result = value1 + 1;
        }
        if(value2 > 0)
        {
        result2 = value2 - 1;
        }

    
        resultField.val(result+' to '+result2);
        
    }

    
    input1.on("input", calculateResult);
    input2.on("input", calculateResult);
});

   function editchart(id)
   {
   
        $('#kpi').val(id);  
        $.ajax({
        type: "GET",
        url: "{{ url('edit-chart') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
        id:id,

        },
        success: function(res) {
          
        $('#chart-data').html(res);



        }
    });

        }

    function UpdateChartData()
    {
   
    var months = [];
    var values = [];
    var chartIds = [];
    var kpi =  $('#kpi').val();
    var filter = localStorage.getItem('c_filter');

    // Loop through input elements and collect their values
    $('.month-input').each(function() {
        months.push($(this).val());
    });

    $('.value-input').each(function() {
        values.push($(this).val());
    });

    $('.chart-id').each(function() {
        chartIds.push($(this).val());
    });
    
    var id = "{{$organization->id}}";

       $.ajax({
        type: "POST",
        url: "{{ url('update-chart') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          months:months,
          values:values,
          chartIds:chartIds,
          id:id,
          kpi:kpi,
          filter:filter

        },
        success: function(res) {
          
        // $('#weight-edit').html(res);
        $('#success-chart-edit').html('<div class="alert alert-success" role="alert"> Chart Updated successfully</div>');

        setTimeout(function() { 
                $('#edit-chart').modal('hide');
                $('#success-chart-edit').html('');
                // location.reload();
            }, 2000);

             $('#chart-update').html(res);
            setInterval(function(){
              // $('#chart-update').html(res);
              // $("#chart-update").load(location.href + " #chart-update");
            },2000);

        }
    });

        }

        function addButton(epic) {
        var maxField = 1; // Allow only one input field
        var x = $('#field_wrapper_chart' + epic + ' .chart-input-month').length;

        if (x < maxField) {
            var wrapper = $('#field_wrapper_chart' + epic); // Input field wrapper
            var fieldHTML = `
                <div class="w-75 mb-2 mt-0">
           
                  <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-6">
                    <input type="text" class="form-control chart-input-month" id="" style="width:120%" placeholder="Month" required>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6">
                    <input type="text" class="form-control chart-input-value ml-5" id="" style="width:120%" placeholder="Value" required>
                    </div>
                    </div>
                    <button class="btn btn-primary btn-lg  mt-3" type="button" onclick="newchart(${epic})">Add</button>
                    <a href="javascript:void(0);" class="btn btn-danger btn-lg  mt-3 ml-3" id="remove_button_edit${epic}" onclick="removeButton(${epic})">Cancel</a>
                </div>
            `;

            $(wrapper).append(fieldHTML); // Add field html
        }
    }

    function removeButton(epic) {
        $('#field_wrapper_chart' + epic + ' .w-75').remove();
    }

    function newchart(id)
        {
   
        var month = $('.chart-input-month').val(); 
        var value = $('.chart-input-value').val();
        
        if ($('.chart-input-month').val() != '') {
        $.ajax({
        type: "POST",
        url: "{{ url('add-chart-new') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
        id:id,
        month:month,
        value:value,
       
      

        },
        success: function(res) {
          
         $('#field_wrapper_chart' + id + ' .w-75').remove();
         $('#chart-data').html(res);

         
        



        }
    });
    
        }

        }

      function deletechart(chart) {
        $('#chart_id').val(chart);
       }

       function DeleteChart()
        {
   
        var chart = $('#chart_id').val(); 
         var stream_id = "{{$organization->id}}";
        
        $.ajax({
        type: "POST",
        url: "{{ url('delete-chart') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
          chart:chart,
          stream_id:stream_id
       

        },
        success: function(res) {
          
      

         
  $('#success-delete-chart').html('<div class="alert alert-success" role="alert"> Chart Deleted successfully</div>');

setTimeout(function() { 
        $('#delete-chart').modal('hide');
        $('#success-delete-chart').html('');
        // location.reload();
    }, 2000);

$('#chart-update').html(res);   


        }
    });
    
    
     }
     
    function editbasicchart(id) {
   $.ajax({
    type: "GET",
    url: "{{ url('edit-chart-basic') }}",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: {
        id: id,

    },
    success: function(res) {

   $('#edit_t_value').val(res.t_value);
   $('#edit_t_date').val(res.t_date);
   $('#edit_t_line').val(res.trend_line);
   $('#edit_t_bar').val(res.chart_type);
   $('#chart_edit_id').val(res.id);
   $('#t_display_edit').val(res.t_display);
   $('#edit_chart_title').val(res.chart_title);
   $('#edit_chart_subtitle').val(res.chart_subtitle);
   $('#stream_id').val(res.stream_id);

   if(res.target_option == 'yes')
   {
    $('.edit_option_1').slideDown(); //to show
    $('.edit_option_2').slideUp();
    $('#edit_g_value_opt_1').val(res.green);
    $('#edit_r_value_opt_1').val(res.red);
    $('#edit_target_option_1').prop('checked', true);
    $('#target_status').val(res.target_opt);
    $('#g_display_edit').val(res.g_display);
    $('#edit_g_value_opt_2').val('');
    $('#edit_r_value_opt_2').val('');

   }
    if(res.target_option == 'no')
   {
    $('.edit_option_2').slideDown();
    $('.edit_option_1').slideUp();

    $('#edit_g_value_opt_2').val(res.green);
    $('#edit_r_value_opt_2').val(res.red);
    $('#edit_a_value_opt_2').val(res.amber);
    $('#edit_target_option').prop('checked', true);
    $('#g_display_edit_2').val(res.g_display);
    $('#edit_g_value_opt_1').val('');




   }
   
    if(res.target_option == 'null')
   {
    $('.edit_option_2').slideUp();
    $('.edit_option_1').slideUp();
    $('#edit_target_option_3').prop('checked', true);
   



   }
   
   

    }
});

}

$(document).ready(function() {
        $('.edit_option_2').slideUp();
        $('.yes_edit').click(function() {

            $('.edit_option_2').slideUp();
            $('.edit_option_1').slideDown(); //to show
            // $("#edit_g_value_opt_2").val('');
            // $("#edit_r_value_opt_2").val('');
            // $("#edit_a_value_opt_2").val('');
            $('#edit_target_option_1').prop('checked', true);
            $('#edit_target_option').prop('checked', false);

        });
        $('.no_edit').click(function() {
            $('.edit_option_1').slideUp();
            $('.edit_option_2').slideDown(); //to show
            // $("#g_value_opt_1").val('');
            // $("#r_value_opt_1").val('');
            $('#edit_target_option_1').prop('checked', false);
            $('#edit_target_option').prop('checked', true);
            //to hide
        });
    });

function get_val_edit(val) {
        var str1 = val.replace(/[^\d.]/g, '');
        var total = parseInt(str1) - 1;
        var target = $('#edit_t_value').val();
        $("#edit_g_value_opt_1").val(str1);

        $('#edit_r_value_opt_1').val(total + ' and below');

    }

    

    $(document).ready(function() {
        // Get references to the input fields and result field
        var input1 = $("#edit_g_value_opt_2");
        var input2 = $("#edit_r_value_opt_2");
        var resultField = $("#edit_a_value_opt_2");


        function calculateResult() {
            var value1 = parseFloat(input1.val()) || 0;
            var value2 = parseFloat(input2.val()) || 0;
            if (value1 > 0) {
                var result = value1 + 1;
                var result2 = value2 - 1;


                resultField.val(result + ' to ' + result2);
            }
        }


        input1.on("input", calculateResult);
        input2.on("input", calculateResult);
    });

function UpdateChartDataBasic() {

 
var form_data = new FormData();

form_data.append('_token', $('meta[name="csrf-token"]').attr('content'));
form_data.append('target', $('#edit_t_value').val());
form_data.append('greenvalue', $('#edit_g_value_opt_1').val());
form_data.append('collapseGroup', $("input[name='collapseGroupedit']:checked").val());
form_data.append('target_date', $('#edit_t_date').val());
form_data.append('target_bar', $('#edit_t_bar').val());
form_data.append('target_line', $('#edit_t_line').val());
form_data.append('greenvalueopt', $('#edit_g_value_opt_2').val());
form_data.append('redvalueopt', $('#edit_r_value_opt_2').val());
form_data.append('redvalue', $('#edit_r_value_opt_1').val());
form_data.append('ambervalue', $('#edit_a_value_opt_2').val());
form_data.append('id', $('#chart_edit_id').val());
form_data.append('target_status', $('#target_status').val());
form_data.append('t_display_edit', $('#t_display_edit').val());
form_data.append('g_display_edit', $('#g_display_edit').val());
form_data.append('g_display_edit_2', $('#g_display_edit_2').val());
form_data.append('title', $('#edit_chart_title').val());
form_data.append('subtitle', $('#edit_chart_subtitle').val());
form_data.append('stream_id', $('#stream_id').val());
form_data.append('filter',localStorage.getItem('c_filter'));






var str = $("#edit_g_value_opt_1").val();
var str1 = $("#edit_g_value_opt_2").val();
var target = $("#edit_t_value").val();
// if (str > 0) {
//     if (str >= target) {
//         $('#green-feild-error-edit').html('Green Value Should be less then target value.');
//         $('#chart-feild-error-edit').html('');
//         return false;
//     }
// }

// if (str1 > 0) {
//     if (str1 >= target) {
//         $('#green-feild-error-edit').html('Green Value Should be less then target value.');
//         $('#chart-feild-error-edit').html('');
//         return false;
//     }
// }



// if ($('#edit_t_value').val() != '') {
    $.ajax({
        type: "POST",
        url: "{{ url('update-chart-basic') }}",
        data:form_data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(res) {


            $('#green-feild-error-edit').html('');
            $('#success-basic-edit').html(
                '<div class="alert alert-success" role="alert"> Basic Detail Updated successfully</div>');
            $('#chart-feild-error-edit').html('');
            setTimeout(function() {
                $('#edit-basic-chart').modal('hide');
                $('#success-basic-edit').html('');
                // location.reload();
            }, 3000);
               
            $('#chart-update').html(res);   

        }
    });
// } else {

//     $('#chart-feild-error-edit').html('Please fill out all required fields.');

// }
}


function DeleteGraphVal(id) {



$.ajax({
    type: "POST",
    url: "{{ url('delete-graph-val') }}",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: {
        id:id,


    },
    success: function(res) {

        $('#chart-data').html(res);

    }
});



}

        function get_chart_status(val)
        {
        var filter = localStorage.setItem('c_filter',val);
        var stream_id = "{{$organization->id}}";

        $.ajax({
        type: "GET",
        url: "{{ url('get-chart-status') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
        val:val,
        stream_id:stream_id
        },
        success: function(res) {
            

        $('#chart-update').html(res);   


        }
        });

        }
        
        
 
</script>

