@php
$var_objective = "Org";
@endphp
@extends('components.main-layout')
<title>Dashboard</title>
@section('content')
<div class="row">
    <div class="col-md-12 py-3 p-0">
        <div class="card">
            <div class="card-body p-10">
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <button class="btn btn-sm btn-dark" style="display:none;" id="delete-button" onclick="delete_record();" type="button">Delete All</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
  // Select the form element

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