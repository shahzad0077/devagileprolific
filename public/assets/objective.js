    

             function get_date(val,id)
             {
        

                    var selectedDate = new Date(val);
                    selectedDate.setDate(selectedDate.getDate() + 1);
                    var newDateStr = selectedDate.toISOString().slice(0, 10);
                    $('#' + id).attr('min',newDateStr);


                 
             }

		
        function saveObjective() {

            var objective_name = $('#objective_name').val();
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();        
            var detail = $('#obj_small_description').val();
            var org_id = "{{ $organization->id }}";
            var slug = "{{ $organization->slug }}";
            
   

            if($('#objective_name').val() != '' || $('#start_date').val() != '' || $('#end_date').val() != '') {
                $.ajax({
                    type: "POST",
                    url: "{{ url('save-objective') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        objective_name: objective_name,
                        start_date: start_date,
                        end_date: end_date,
                        detail: detail,
                        org_id: org_id,
                        slug:slug,
                    },
                    success: function(res) {
                        // if (res == 1) {

                        //     $('#obj-name-error').html(
                        //         '<strong class="text-danger">Ojective Name Already Taken</strong>');

                        // } else {
                            $('#obj-name-error').html('');
                            $('#objective_name').val('');
                            $('#start_date').val('');
                            $('#end_date').val('');
                            $('#obj_small_description').val('');
                            $('#success-obj').html(
                                '<div class="alert alert-success" role="alert"> Objective Created successfully</div>'
                                );
                            $('#obj-feild-error').html('');
                            setTimeout(function() { 
                                $('#create-objective').modal('hide');
                                $('#success-obj').html('');
                                 }, 3000);
                              $('#parentCollapsible').html(res);

                        // }

                    }
                });
            } else {

                $('#obj-feild-error').html('Please fill out all required fields.');

            }
        }
        function editobjective(obj_id,obj_name,obj_start_date,obj_end_date,obj_detail)
        {
         $('#edit_obj_id').val(obj_id);   
         $('#edit_objective_name').val(obj_name);   
         $('#edit_start_date').val(obj_start_date);   
         $('#edit_end_date').val(obj_end_date);   
         $('#edit_obj_small_description').val(obj_detail);   

        }

function UpdateObjective() {

        var edit_obj_id =  $('#edit_obj_id').val();   
        var edit_objective_name  = $('#edit_objective_name').val();   
        var edit_start_date = $('#edit_start_date').val();   
        var edit_end_date = $('#edit_end_date').val();   
        var edit_obj_small_description = $('#edit_obj_small_description').val();
        var org_id = "{{ $organization->id }}";
        var slug = "{{ $organization->slug }}";
   

if ($('#edit_objective_name').val() != '' || $('#edit_start_date').val() != '' || $('#edit_end_date').val() != '') {
    $.ajax({
        type: "POST",
        url: "{{ url('update-objective') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            edit_objective_name: edit_objective_name,
            edit_start_date: edit_start_date,
            edit_end_date: edit_end_date,
            edit_obj_small_description:edit_obj_small_description,
            edit_obj_id:edit_obj_id,
            org_id:org_id,
            slug:slug
        },
        success: function(res) {
          
                $('#edit_objective_name').val('');
                $('#edit_start_date').val('');
                $('#edit_end_date').val('');
                $('#edit_obj_small_description').val('');
                $('#success-obj-edit').html(
                    '<div class="alert alert-success" role="alert"> Objective Updated successfully</div>'
                    );
                $('#oobj-feild-error-edit').html('');
                setTimeout(function() { 
                    $('#edit-objective').modal('hide');
                    $('#success-obj-edit').html('');
                     }, 3000);

                  $('#parentCollapsible').html(res);
                  $("#nestedCollapsible"+edit_obj_id).collapse('toggle');

            

        }
    });
} else {

    $('#obj-feild-error-edit').html('Please fill out all required fields.');

}
}


function deleteobj(obj_id)
{
    $('#obj_delete_id').val(obj_id);

}

function DeleteObjective() {

var delete_obj_id =  $('#obj_delete_id').val();   
var org_id = "{{ $organization->id }}";
var slug = "{{ $organization->slug }}";

$.ajax({
type: "POST",
url: "{{ url('Delete-objective') }}",
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},
data: {
    delete_obj_id:delete_obj_id,
    org_id:org_id,
    slug:slug
},
success: function(res) {
  
        $('#success-obj-delete').html(
            '<div class="alert alert-success" role="alert"> Objective Deleted successfully</div>'
            );

        setTimeout(function() { 
            $('#delete-objective').modal('hide');
            $('#success-obj-delete').html('');
             }, 3000);

          $('#parentCollapsible').html(res);
          $("#nestedCollapsible"+delete_obj_id).collapse('toggle');


    

}
});

}



function objective(key_obj_id)
{
    $('#key_obj_id').val(key_obj_id);

}
function saveKeyObjective() {

var key_name = $('#key_name').val();
var key_start_date = $('#key_start_date').val();
var key_end_date = $('#key_end_date').val();
var key_detail = $('#key_detail').val();
var org_id = "{{ $organization->id }}";
var slug = "{{ $organization->slug }}";
var obj_id = $('#key_obj_id').val();


if ($('#key_name').val() != '' || $('#key_start_date').val() != '' || $('#key_end_date').val() != '') {
    $.ajax({
        type: "POST",
        url: "{{ url('save-objective-key') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            key_name: key_name,
            key_start_date: key_start_date,
            key_end_date: key_end_date,
            key_detail: key_detail,
            org_id: org_id,
            slug:slug,
            obj_id:obj_id
        },
        success: function(res) {
            // if (res == 1) {

            //     $('#obj-key-name-error').html(
            //         '<strong class="text-danger">Key Name Already Taken</strong>');

            // } else {
                $('#obj-key-name-error').html('');
                $('#key_name').val('');
                $('#key_start_date').val('');
                $('#key_end_date').val('');
                $('#key_detail').val('');
                $('#success-obj-key').html(
                    '<div class="alert alert-success" role="alert"> Key Result Created successfully</div>'
                    );
                $('#key-feild-error').html('');
                setTimeout(function() { 
                    $('#create-key-result').modal('hide');
                    $('#success-obj-key').html('');
                     }, 3000);
                  $('#parentCollapsible').html(res);
                  $("#nestedCollapsible"+obj_id).collapse('toggle');


            // }

        }
    });
} else {

    $('#key-feild-error').html('Please fill out all required fields.');

}
}

function editobjectivekey(key_id,key_name,key_start_date,key_end_date,key_detail,obj_id)
        {
         $('#edit_key_obj_id').val(key_id);   
         $('#edit_key_name').val(key_name);   
         $('#edit_key_start_date').val(key_start_date);   
         $('#edit_key_end_date').val(key_end_date);   
         $('#edit_key_detail').val(key_detail);   
         $('#edit_key_obj').val(obj_id);   

        }

function updateKeyObjective() {

var edit_key_name = $('#edit_key_name').val();
var edit_key_start_date = $('#edit_key_start_date').val();
var edit_key_end_date = $('#edit_key_end_date').val();
var edit_key_detail = $('#edit_key_detail').val();
var org_id = "{{ $organization->id }}";
var slug = "{{ $organization->slug }}";
var key_id = $('#edit_key_obj_id').val();
var obj_id = $('#edit_key_obj').val();   


if ($('#edit_key_name').val() != '' || $('#edit_key_start_date').val() != '' || $('#edit_key_end_date').val() != '') {
    $.ajax({
        type: "POST",
        url: "{{ url('update-objective-key') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            edit_key_name: edit_key_name,
            edit_key_start_date: edit_key_start_date,
            edit_key_end_date: edit_key_end_date,
            edit_key_detail:edit_key_detail,
            org_id: org_id,
            slug:slug,
            key_id:key_id
        },
        success: function(res) {


                $('#key_name').val('');
                $('#key_start_date').val('');
                $('#key_end_date').val('');
                $('#key_detail').val('');
                $('#success-obj-key-edit').html(
                    '<div class="alert alert-success" role="alert"> Key Result Updated successfully</div>'
                    );
                $('#key-feild-error-edit').html('');
                setTimeout(function() { 
                    $('#edit-key-result').modal('hide');
                    $('#success-obj-key-edit').html('');
                     }, 3000);
                  $('#parentCollapsible').html(res);
                  $("#nestedCollapsible"+obj_id).collapse('toggle');


            

        }
    });
} else {

    $('#key-feild-error-edit').html('Please fill out all required fields.');

}
}

function deleteobjkey(key_id,obj)
{
    $('#key_delete_id').val(key_id);
    $('#key_delete_obj_id').val(obj);

}

function DeleteObjectivekey() {

var key_delete_id =  $('#key_delete_id').val();   
var org_id = "{{ $organization->id }}";
var slug = "{{ $organization->slug }}";
var obj = $('#key_delete_obj_id').val();


$.ajax({
type: "POST",
url: "{{ url('Delete-objective-key') }}",
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},
data: {
    key_delete_id:key_delete_id,
    org_id:org_id,
    slug:slug
},
success: function(res) {
  
        $('#success-key-delete').html(
            '<div class="alert alert-success" role="alert"> Key Result Deleted successfully</div>'
            );

        setTimeout(function() { 
            $('#delete-objective-key').modal('hide');
            $('#success-key-delete').html('');
             }, 3000);

          $('#parentCollapsible').html(res);
          $("#nestedCollapsible"+obj).collapse('toggle');


    

}
});

}


function initiative(key_id,obj_id)
{
    $('#key_id_initiative').val(key_id);
    $('#obj_id_initiative').val(obj_id);



}

function saveKeyinitiative() {

var initiative_name = $('#initiative_name').val();
var initiative_start_date = $('#initiative_start_date').val();
var initiative_end_date = $('#initiative_end_date').val();
var initiative_detail = $('#initiative_detail').val();
var org_id = "{{ $organization->id }}";
var slug = "{{ $organization->slug }}";
var key_id_initiative = $('#key_id_initiative').val();
var obj_id_initiative = $('#obj_id_initiative').val();


if ($('#initiative_name').val() != '' || $('#initiative_start_date').val() != '' || $('#initiative_end_date').val() != '') {
    $.ajax({
        type: "POST",
        url: "{{ url('save-key-initiative') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            initiative_name: initiative_name,
            initiative_start_date: initiative_start_date,
            initiative_end_date: initiative_end_date,
            initiative_detail: initiative_detail,
            org_id: org_id,
            slug:slug,
            obj_id_initiative:obj_id_initiative,
            key_id_initiative:key_id_initiative

        },
        success: function(res) {
            // if (res == 1) {

            //     $('#initiative-name-error').html(
            //         '<strong class="text-danger">initiative Name Already Taken</strong>');

            // } else {
                $('#initiative-name-error').html('');
                $('#initiative_name').val('');
                $('#initiative_start_date').val('');
                $('#initiative_end_date').val('');
                $('#initiative_detail').val('');
                $('#success-initiative').html(
                    '<div class="alert alert-success" role="alert"> initiative Created successfully</div>'
                    );
                $('#initiative-feild-error').html('');
                setTimeout(function() { 
                    $('#create-initiative').modal('hide');
                    $('#success-initiative').html('');
                     }, 3000);
                  $('#parentCollapsible').html(res);
                  $("#nestedCollapsible"+obj_id_initiative).collapse('toggle');
                  $("#key-result"+key_id_initiative).collapse('toggle');

                  


            // }

        }
    });
} else {

    $('#initiative-feild-error').html('Please fill out all required fields.');

}
}


function deletekeyinitiative(initiative_id,key_id,obj_id)
{
    $('#initiative_delete_id').val(initiative_id);
    $('#initiative_delete_key_id').val(key_id);
    $('#initiative_delete_obj_id').val(obj_id);

}

function Deletekeyinitiative() {

var initiative_delete_id =  $('#initiative_delete_id').val();   
var org_id = "{{ $organization->id }}";
var slug = "{{ $organization->slug }}";
var initiative_delete_key_id = $('#initiative_delete_key_id').val();
var initiative_delete_obj_id =   $('#initiative_delete_obj_id').val();


$.ajax({
type: "POST",
url: "{{ url('Delete-key-initiative') }}",
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
},
data: {
    initiative_delete_id:initiative_delete_id,
    org_id:org_id,
    slug:slug
},
success: function(res) {
  
        $('#success-initiative-delete').html(
            '<div class="alert alert-success" role="alert"> Initiative Deleted successfully</div>'
            );

        setTimeout(function() { 
            $('#delete-initiative-key').modal('hide');
            $('#success-initiative-delete').html('');
             }, 3000);

          $('#parentCollapsible').html(res);
          $("#nestedCollapsible"+initiative_delete_obj_id).collapse('toggle');
          $("#key-result"+initiative_delete_key_id).collapse('toggle');


    

}
});

}

function editinitiative(initiative_id,initiative_name,initiative_start_date,initiative_end_date,initiative_detail)
        {
         $('#edit_id_initiative').val(initiative_id);   
         $('#edit_initiative_name').val(initiative_name);   
         $('#edit_initiative_start_date').val(initiative_start_date);   
         $('#edit_initiative_end_date').val(initiative_end_date);   
         $('#edit_initiative_detail').val(initiative_detail);   

        }

function UpdateKeyinitiative() {

var edit_id_initiative = $('#edit_id_initiative').val();
var edit_initiative_name = $('#edit_initiative_name').val();
var edit_initiative_start_date = $('#edit_initiative_start_date').val();
var edit_initiative_end_date = $('#edit_initiative_end_date').val();
var org_id = "{{ $organization->id }}";
var slug = "{{ $organization->slug }}";
var edit_initiative_detail = $('#edit_initiative_detail').val();


if ($('#edit_initiative_name').val() != '' || $('#edit_initiative_start_date').val() != '' || $('#edit_initiative_end_date').val() != '') {
    $.ajax({
        type: "POST",
        url: "{{ url('update-key-initiative') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            edit_initiative_name: edit_initiative_name,
            edit_initiative_start_date: edit_initiative_start_date,
            edit_initiative_end_date: edit_initiative_end_date,
            edit_initiative_detail: edit_initiative_detail,
            org_id: org_id,
            slug:slug,
            edit_id_initiative:edit_id_initiative

        },
        success: function(res) {
          

                $('#initiative_name').val('');
                $('#initiative_start_date').val('');
                $('#initiative_end_date').val('');
                $('#initiative_detail').val('');
                $('#success-initiative-edit').html(
                    '<div class="alert alert-success" role="alert"> initiative Updated successfully</div>'
                    );
                $('#initiative-feild-error-edit').html('');
                setTimeout(function() { 
                    $('#edit-initiative').modal('hide');
                    $('#success-initiative-edit').html('');
                     }, 3000);
                  $('#parentCollapsible').html(res);

            

        }
    });
} else {

    $('#initiative-feild-error-edit').html('Please fill out all required fields.');

}
}

  