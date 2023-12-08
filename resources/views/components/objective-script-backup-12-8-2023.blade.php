<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // function Updated by Usama Start
    function editepicflag(id) {
        $.ajax({
            type: "POST",
            url: "{{ url('dashboard/flags/getepicflag') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
            },
            success: function(res) {
                $('.flagmodalbody').html(res)
                $('#edit-epic-flag').modal('show');
            }
        });

    }

    function updateepicflag() {
        $('#updateflagmodalbuton').html('<i class="fa fa-spin fa-spinner"></i>')
        var flag_type = $('#flag_type').val();
        var flag_title = $('#flag_title').val();
        var flag_description = $('#flag_description').val();
        var flag_assign = $('#flag_assign').val();
        var org_id = "{{ $organization->org_id }}";
        var slug = "{{ $organization->slug }}";
        var unit_id = "{{ $organization->id }}";
        var flag_epic_id = $('#flag_epic_id').val();
        var flag_ini_epic_id = $('#flag_ini_epic_id').val();
        var flag_epic_key = $('#flag_epic_key').val();
        var flag_epic_obj = $('#flag_epic_obj').val();
        var buisness_unit_id = $('#buisness_unit_id').val();
        var type = "{{ $organization->type }}";
        var board_type = $('#board_type').val();
        if ($('#flag_type').val() != '') {
            $.ajax({
                type: "POST",
                url: "{{ url('dashboard/flags/updateepicflag') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    flag_type: flag_type,
                    flag_title: flag_title,
                    flag_description: flag_description,
                    org_id: org_id,
                    slug: slug,
                    flag_epic_id: flag_epic_id,
                    flag_assign: flag_assign,
                    unit_id: unit_id,
                    type: type,
                    buisness_unit_id: buisness_unit_id,
                    board_type: board_type
                },
                success: function(res) {
                    $('#success-flag').html(
                        '<div class="alert alert-success" role="alert">Epic Flag Updated successfully</div>'
                    );
                    $('#updateflagmodalbuton').html('<i class="fa fa-check"></i> Success');
                    $('#updateflagmodalbuton').css('background-color', 'green');
                    $('#success-flag-error').html('');
                    setTimeout(function() {
                        $('#edit-epic-flag').modal('hide');
                        $('#success-flag').html('');
                    }, 3000);
                    $('#parentCollapsible').html(res);
                    $("#nestedCollapsible" + flag_epic_obj).collapse('toggle');
                    $("#key-result" + flag_epic_key).collapse('toggle');
                    $("#initiative" + flag_ini_epic_id).collapse('toggle');
                    handleDivClick(flag_ini_epic_id);
                }
            });
        } else {
            $('#updateflagmodalbuton').html('Add Flag')
            $('#success-flag-error').html(
                '<div class="alert alert-danger" role="alert">Please fill out all required fields.</div>');
        }
    }
    // Function Updated by Usama end



    function get_date(val, id) {
        var selectedDate = new Date(val);
        selectedDate.setDate(selectedDate.getDate() + 1);
        var newDateStr = selectedDate.toISOString().slice(0, 10);
        $('#' + id).attr('min', val);
    }


    function saveObjective() {

        var objective_name = $('#objective_name').val();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var detail = $('#obj_small_description').val();
        var org_id = "{{ $organization->org_id }}";
        var slug = "{{ $organization->slug }}";
        var unit_id = "{{ $organization->id }}";
        var type = "{{ $organization->type }}";
        var objective_status = $('#obj_status').val();


        if ($('#objective_name').val() == '') {
            $('#obj-feild-error').html('Please fill out all required fields.');
            return false;
        }

        var unitid = [];
        $('.unitobj').each(function() {
            unitid.push($(this).val());
        });

        var unitObj = [];
        $('.bu-obj').each(function() {
            unitObj.push($(this).val());
        });

        var unitObjkey = [];
        $('.key-BU').each(function() {
            unitObjkey.push($(this).val());
        });



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
                slug: slug,
                unit_id: unit_id,
                type: type,
                objective_status: objective_status,
                unitid: unitid,
                unitObj: unitObj,
                unitObjkey: unitObjkey,


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

    }

    function editobjective(obj_id, obj_name, obj_start_date, obj_end_date, obj_detail, obj_status) {
        $('#edit_obj_id').val(obj_id);
        $('#edit_objective_name').val(obj_name);
        $('#edit_start_date').val(obj_start_date);
        $('#edit_end_date').val(obj_end_date);
        $('#edit_obj_small_description').val(obj_detail);
        $('#edit_obj_status').val(obj_status);
    }

    function UpdateObjective() {

        var edit_obj_id = $('#edit_obj_id').val();
        var edit_objective_name = $('#edit_objective_name').val();
        var edit_start_date = $('#edit_start_date').val();
        var edit_end_date = $('#edit_end_date').val();
        var edit_obj_small_description = $('#edit_obj_small_description').val();
        var org_id = "{{ $organization->org_id }}";
        var slug = "{{ $organization->slug }}";
        var unit_id = "{{ $organization->id }}";
        var status = $('#edit_obj_status').val();
        var type = "{{ $organization->type }}";


        if ($('#edit_objective_name').val() != '' || $('#edit_start_date').val() != '' || $('#edit_end_date').val() !=
            '') {
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
                    edit_obj_small_description: edit_obj_small_description,
                    edit_obj_id: edit_obj_id,
                    org_id: org_id,
                    slug: slug,
                    status: status,
                    unit_id: unit_id,
                    type: type
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
                    $("#nestedCollapsible" + edit_obj_id).collapse('toggle');



                }
            });
        } else {

            $('#obj-feild-error-edit').html('Please fill out all required fields.');

        }
    }


    function deleteobj(obj_id) {
        $('#obj_delete_id').val(obj_id);

    }

    function DeleteObjective() {

        var delete_obj_id = $('#obj_delete_id').val();
        var org_id = "{{ $organization->org_id }}";
        var slug = "{{ $organization->slug }}";
        var unit_id = "{{ $organization->id }}";
        var type = "{{ $organization->type }}";

        $.ajax({
            type: "POST",
            url: "{{ url('Delete-objective') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                delete_obj_id: delete_obj_id,
                org_id: org_id,
                slug: slug,
                unit_id: unit_id,
                type: type
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
                $("#nestedCollapsible" + delete_obj_id).collapse('toggle');




            }
        });

    }



    function objective(key_obj_id, w_count, start_date, end_date) {
        $('#key_obj_id').val(key_obj_id);
        $('#key_start_date').attr('min', start_date);
        $('#key_start_date').attr('max', end_date);
        $('#key_end_date').attr('max', end_date);

        $('#weight').html('');
        if (w_count == 0) {
            $(".check").prop("checked", false);

        } else {
            $('#weight').append(
                '<div class="col-md-8"><input style="margin-top:10px;" class="range-slider__range-two  ml-4"  type="range" value="0" min="1" max="100"></div><div class="col-md-4"><input id="sliderValue" class="w-25 mt-2" readonly type="text" min="1" value="1"></div>'
                ); // Add field html
            $(".check").hide();


        }

        $('#key_result_unit').val('');
        $('#key_result_type').val('');
        $('#init_value').val('');
        $('#target_number').val('');
        $('.target_value').val('');
        $('.field_wrapper_key').html('');


        getteam();

    }

    $(document).ready(function() {
        $('.check').on('click', function() {
            var isChecked = $(this).is(':checked');
            $('#wieght-error').html('');
            if (isChecked) {
                // Show the weight div
                $('#weight').html('');
                $('#weight').append(
                    '<div class="col-md-8"><input style="margin-top:10px;" class="range-slider__range-two  ml-4"  type="range" value="1" min="1" max="100"></div><div class="col-md-4"><input id="sliderValue" class="w-25 mt-2 range-slider__range-two"  type="text" min="1" value="1"></div>'
                    ); // Add field html


            } else {
                $('#weight').html(''); // Hide the weight div
            }
        });
    });





    $(document).ready(function() {
        $(document).on('input', '.range-slider__range-two', function() {
            $('.range-slider__range-two').val($(this).val());
            $('#sliderValue').val($(this).val());
            var slider = $('#sliderValue').val();

            var obj = $('#key_obj_id').val();
            $.ajax({
                type: "GET",
                url: "{{ url('check-key-weight') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    obj: obj,
                    slider: slider,

                },
                success: function(res) {

                    if (res.key > 100) {
                        $('#wieght-error').html(
                            '<small class="text-danger ml-2">Combined weight percentage must not be greater than 100</small>'
                            );

                    } else {
                        $('#wieght-error').html('');
                    }



                }
            });

        });
    });


    function saveKeyObjective() {

        var key_name = $('#key_name').val();
        var key_start_date = $('#key_start_date').val();
        var key_end_date = $('#key_end_date').val();
        var key_detail = $('#key_detail').val();
        var org_id = "{{ $organization->org_id }}";
        var slug = "{{ $organization->slug }}";
        var unit_id = "{{ $organization->id }}";
        var obj_id = $('#key_obj_id').val();
        var weight = $('#sliderValue').val();
        var type = "{{ $organization->type }}";
        var k_status = $('#key_status').val();
        var key_result_type = $('#key_result_type').val();
        var key_result_unit = $('#key_result_unit').val();
        var init_value = $('#init_value').val();
        var target_number = $('#target_number').val();



        var Target = [];

        $('.target_value').each(function() {
            Target.push($(this).val());
        });

        var selectedOptionsteam = [];
        $('.key-team').each(function() {
            selectedOptionsteam.push($(this).val());
        });

        var teamObj = [];
        $('.obj-team').each(function() {
            teamObj.push($(this).val());
        });





        if ($('#key_name').val() == '') {
            $('#key-feild-error').html('Please fill out all required fields.');
            return false;
        }


        if (key_result_type == 'Should Increase to') {

            if (target_number <= init_value) {
                $('#target-error').html('The target value should be greater than the initial value');
                return false;
            } else if (target_number >= init_value) {
                $('#target-error').html('');

            } else {}
        }

        if (key_result_type == 'Should decrease to') {

            if (target_number >= init_value) {
                $('#target-error').html('The target value should be less than the initial value');
                return false;
            } else if (target_number <= init_value) {
                $('#target-error').html('');

            } else {}
        }

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
                slug: slug,
                obj_id: obj_id,
                weight: weight,
                unit_id: unit_id,
                type: type,
                k_status: k_status,
                Target: Target,
                target_number: target_number,
                init_value: init_value,
                key_result_type: key_result_type,
                key_result_unit: key_result_unit,
                selectedOptionsteam: selectedOptionsteam,
                teamObj: teamObj,


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
                $('.range-slider__value-two').attr('min', 1);
                $('#sliderValue').val(1);
                $(".check").prop("checked", false);
                $('#weight').html('');

                $('#key_result_unit').val('');
                $('#key_result_type').val('');
                $('#init_value').val('');
                $('#target_number').val('');
                $('.target_value').val('');
                $('.field_wrapper_key').html('');


                $('#success-obj-key').html(
                    '<div class="alert alert-success" role="alert"> Key Result Created successfully</div>'
                );
                $('#key-feild-error').html('');
                setTimeout(function() {
                    $('#create-key-result').modal('hide');
                    $('#success-obj-key').html('');
                }, 3000);
                $('#parentCollapsible').html(res);
                $("#nestedCollapsible" + obj_id).collapse('toggle');
                $('#wieght-error').html('');


                // }

            }
        });

    }



    function editobjectivekey(key_id, key_name, key_start_date, key_end_date, key_detail, key_weight, obj_id, key_type,
        key_unit, key_init_value, key_target) {
        $('#edit_key_obj_id').val(key_id);
        $('#edit_key_name').val(key_name);
        $('#edit_key_start_date').val(key_start_date);
        $('#edit_key_end_date').val(key_end_date);
        $('#edit_key_detail').val(key_detail);
        $('#edit_key_obj').val(obj_id);
        $('#weight-edit').html('');
        $('#wieght-error-edit').html('');

        $('#edit_key_result_type').val(key_type);
        $('#edit_key_result_unit').val(key_unit);
        $('#edit_init_value').val(key_init_value);
        $('#edit_target_number').val(key_target);

        getkeyweight(key_id);
        getkeychart();
        console.log(getkeychart());


    }


    function getkeychart() {



        var obj = $('#edit_key_obj_id').val();
        var unit_id = "{{ $organization->id }}";

        $.ajax({
            type: "GET",
            url: "{{ url('get-key-chart') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                unit_id: unit_id,
                obj: obj

            },
            success: function(res) {

                $('.key-chart-data').html(res);



            }
        });

    }


    function getkeyweight(id) {



        var obj = $('#edit_key_obj').val();

        $.ajax({
            type: "GET",
            url: "{{ url('weight-check-edit') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                obj: obj

            },
            success: function(res) {

                $('#weight-edit').html(res);



            }
        });

    }


    function getsliderrange(keyId) {
        var sliderContainer = $('#sliderContainer' + keyId);
        var rangeSlider = $('#rangeSlider' + keyId);
        var sliderValue = $('#sliderValue' + keyId);

        if ($('.checkedit').is(':checked')) {
            sliderContainer.show();
            $('#wieght-error-edit').html('');
            sliderValue.val(1);
        } else {
            sliderContainer.hide();
            $('#wieght-error-edit').html('');
            sliderValue.val(null);

        }

        rangeSlider.on('input', function() {
            var value = $(this).val();
            sliderValue.val(value);


            var obj = $('#edit_key_obj').val();
            var key = $('#edit_key_obj_id').val();
            $.ajax({
                type: "GET",
                url: "{{ url('check-key-weight-edit') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    obj: obj,
                    value: value,
                    key: key

                },
                success: function(res) {


                    if (res.key > 100) {
                        $('#wieght-error-edit').html(
                            '<small class="text-danger ml-2">Combined weight percentage must not be greater than 100</small>'
                            );

                    } else {
                        $('#wieght-error-edit').html('');
                    }



                }
            });
        });
    }




    $(document).on('input', '.range-slider__range-one', function() {

        var sliderValue = $(this).val();

        // Update the corresponding text input
        $(this).closest('.col-md-8').next('.col-md-4').find('#sliderValueEdit').val(sliderValue);
        var key = $('#edit_key_obj_id').val();
        $('#rangevalue' + key).val(sliderValue);
        var weightedit = $('#sliderValueEdit').val();


        var obj = $('#edit_key_obj').val();

        $.ajax({
            type: "GET",
            url: "{{ url('check-key-weight-edit-first') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                obj: obj,
                weightedit: weightedit,
                key: key

            },
            success: function(res) {


                if (res.key > 100) {
                    $('#wieght-error-edit').html(
                        '<small class="text-danger ml-2">Combined weight percentage must not be greater than 100</small>'
                        );

                } else {
                    $('#wieght-error-edit').html('');
                }



            }
        });
    });

    function updateKeyObjective() {

        var edit_key_name = $('#edit_key_name').val();
        var edit_key_start_date = $('#edit_key_start_date').val();
        var edit_key_end_date = $('#edit_key_end_date').val();
        var edit_key_detail = $('#edit_key_detail').val();
        var org_id = "{{ $organization->org_id }}";
        var slug = "{{ $organization->slug }}";
        var unit_id = "{{ $organization->id }}";
        var key_id = $('#edit_key_obj_id').val();
        var obj_id = $('#edit_key_obj').val();
        var edit_key_status = $('#edit_key_status').val();

        var weightedit = $('#sliderValue' + key_id).val();
        var weightedit_1 = $('#sliderValueEdit').val();
        var type = "{{ $organization->type }}";

        var edit_key_result_type = $('#edit_key_result_type').val();
        var edit_key_result_unit = $('#edit_key_result_unit').val();
        var edit_init_value = $('#edit_init_value').val();
        var edit_target_number = $('#edit_target_number').val();




        if ($('#edit_key_name').val() != '' || $('#edit_key_start_date').val() != '' || $('#edit_key_end_date').val() !=
            '') {
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
                    edit_key_detail: edit_key_detail,
                    org_id: org_id,
                    slug: slug,
                    key_id: key_id,
                    weightedit: weightedit,
                    weightedit_1: weightedit_1,
                    obj_id: obj_id,
                    edit_key_status: edit_key_status,
                    unit_id: unit_id,
                    type: type,
                    edit_key_result_type: edit_key_result_type,
                    edit_key_result_unit: edit_key_result_unit,
                    edit_init_value: edit_init_value,
                    edit_target_number: edit_target_number,
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
                    $("#nestedCollapsible" + obj_id).collapse('toggle');
                    $('#wieght-error-edit').html('');




                }
            });
        } else {

            $('#key-feild-error-edit').html('Please fill out all required fields.');

        }
    }

    function deleteobjkey(key_id, obj) {
        $('#key_delete_id').val(key_id);
        $('#key_delete_obj_id').val(obj);

    }

    function DeleteObjectivekey() {

        var key_delete_id = $('#key_delete_id').val();
        var org_id = "{{ $organization->org_id }}";
        var slug = "{{ $organization->slug }}";
        var unit_id = "{{ $organization->id }}";
        var obj = $('#key_delete_obj_id').val();
        var type = "{{ $organization->type }}";


        $.ajax({
            type: "POST",
            url: "{{ url('Delete-objective-key') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                key_delete_id: key_delete_id,
                org_id: org_id,
                slug: slug,
                unit_id: unit_id,
                type: type
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
                $("#nestedCollapsible" + obj).collapse('toggle');




            }
        });

    }


    function initiative(key_id, obj_id, count, start_date, end_date) {
        $('#key_id_initiative').val(key_id);
        $('#obj_id_initiative').val(obj_id);

        $('#wieght-error-initiative').html('');

        $('#weight-initiative').html('');
        if (count == 0) {
            $(".checkweight").prop("checked", false);


        } else {
            $('#weight-initiative').append(
                '<div class="col-md-8"><input style="margin-top:10px;" class="range-slider__range  ml-4"  type="range" value="0" min="1" max="100"></div><div class="col-md-4"><input id="sliderValueInit" class="w-25 mt-2" readonly type="text" min="1" value="1"></div>'
                ); // Add field html
            $(".checkweight").hide();


        }

        $('#initiative_start_date').attr('min', start_date);
        $('#initiative_start_date').attr('max', end_date);
        $('#initiative_end_date').attr('max', end_date);
        // var currentDate = new Date();

        // var firstDayOfMonth = new Date(currentDate.getFullYear(), month, 1);
        // firstDayOfMonth.setDate(firstDayOfMonth.getDate() + 1);
        // var formattedDate = firstDayOfMonth.toISOString().slice(0, 10);
        // document.getElementById('initiative_start_date').min = formattedDate;
        // $('.monthdate').val(formattedDate);

    }

    $(document).ready(function() {
        $('.checkweight').on('click', function() {
            var isChecked = $(this).is(':checked');
            $('#wieght-error-initiative').html('');
            if (isChecked) {
                // Show the weight div
                $('#weight-initiative').html('');
                $('#weight-initiative').append(
                    '<div class="col-md-8"><input style="margin-top:10px;" class="range-slider__range  ml-4"  type="range" value="0" min="1" max="100"></div><div class="col-md-4"><input id="sliderValueInit" class="w-25 mt-2 range-slider__range"  type="text" min="1" value="1"></div>'
                    ); // Add field html


            } else {
                $('#weight-initiative').html(''); // Hide the weight div
            }
        });
    });

    $(document).ready(function() {
        $(document).on('input', '.range-slider__range', function() {

            $('.range-slider__range').val($(this).val());
            $('#sliderValueInit').val($(this).val());
            var slider = $('#sliderValueInit').val();
            var obj = $('#key_id_initiative').val();
            $.ajax({
                type: "GET",
                url: "{{ url('check-initiative-weight') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    obj: obj,
                    slider: slider,

                },
                success: function(res) {

                    if (res.key > 100) {
                        $('#wieght-error-initiative').html(
                            '<small class="text-danger ml-2">Combined weight percentage must not be greater than 100</small>'
                            );

                    } else {
                        $('#wieght-error-initiative').html('');
                    }



                }
            });

        });
    });


    function saveKeyinitiative() {

        var initiative_name = $('#initiative_name').val();
        var initiative_start_date = $('#initiative_start_date').val();
        var initiative_end_date = $('#initiative_end_date').val();
        var initiative_detail = $('#initiative_detail').val();
        var org_id = "{{ $organization->org_id }}";
        var slug = "{{ $organization->slug }}";
        var unit_id = "{{ $organization->id }}";
        var key_id_initiative = $('#key_id_initiative').val();
        var obj_id_initiative = $('#obj_id_initiative').val();
        var slider = $('#sliderValueInit').val();
        var type = "{{ $organization->type }}";
        var init_status = $('#init_status').val();


        if ($('#initiative_name').val() == '' || $('#initiative_start_date').val() == '' || $('#initiative_end_date')
            .val() == '') {
            $('#initiative-feild-error').html('Please fill out all required fields.');
            return false;

        }
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
                slug: slug,
                obj_id_initiative: obj_id_initiative,
                key_id_initiative: key_id_initiative,
                slider: slider,
                unit_id: unit_id,
                type: type,
                init_status: init_status

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
                $("#nestedCollapsible" + obj_id_initiative).collapse('toggle');
                $("#key-result" + key_id_initiative).collapse('toggle');

                $('.range-slider__range').attr('min', 1);
                $('#sliderValueInit').val(1);
                $(".checkweight").prop("checked", false);
                $('#weight-initiative').html('');
                $('#wieght-error-initiative').html('');





                // }

            }
        });

    }


    function deletekeyinitiative(initiative_id, key_id, obj_id) {
        $('#initiative_delete_id').val(initiative_id);
        $('#initiative_delete_key_id').val(key_id);
        $('#initiative_delete_obj_id').val(obj_id);

    }

    function Deletekeyinitiative() {

        var initiative_delete_id = $('#initiative_delete_id').val();
        var org_id = "{{ $organization->org_id }}";
        var slug = "{{ $organization->slug }}";
        var unit_id = "{{ $organization->id }}";
        var initiative_delete_key_id = $('#initiative_delete_key_id').val();
        var initiative_delete_obj_id = $('#initiative_delete_obj_id').val();
        var type = "{{ $organization->type }}";


        $.ajax({
            type: "POST",
            url: "{{ url('Delete-key-initiative') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                initiative_delete_id: initiative_delete_id,
                org_id: org_id,
                slug: slug,
                unit_id: unit_id,
                type: type
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
                $("#nestedCollapsible" + initiative_delete_obj_id).collapse('toggle');
                $("#key-result" + initiative_delete_key_id).collapse('toggle');




            }
        });

    }

    function editinitiative(initiative_id, initiative_name, initiative_start_date, initiative_end_date,
        initiative_detail, initiative_weight, initiative_key, initiative_obj) {


        $('#edit_id_initiative').val(initiative_id);
        $('#edit_initiative_name').val(initiative_name);
        $('#edit_initiative_start_date').val(initiative_start_date);
        $('#edit_initiative_end_date').val(initiative_end_date);
        $('#edit_initiative_detail').val(initiative_detail);
        $('#edit_id_initiative_key').val(initiative_key);
        $('#edit_id_initiative_obj').val(initiative_obj);

        $('.edit_initiative_start_date').attr('min', initiative_start_date);
        getinitiativweight(initiative_id);
        $('#wieght-error-edit-init').html('');

    }

    function getinitiativweight(id) {

        $('#initiative-edit-weight').html('');

        var obj = $('#edit_id_initiative_key').val();

        $.ajax({
            type: "GET",
            url: "{{ url('weight-initiative-edit') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                obj: obj

            },
            success: function(res) {

                $('#initiative-edit-weight').html(res);



            }
        });

    }

    function getsliderrangeinit(keyId) {
        var sliderContainer = $('#sliderContainerinit' + keyId);
        var rangeSlider = $('#rangeSliderinit' + keyId);
        var sliderValue = $('#sliderValueinit' + keyId);

        if ($('.checkeditinit').is(':checked')) {
            sliderContainer.show();
            $('#wieght-error-edit-init').html('');
            sliderValue.val(1);
        } else {
            sliderContainer.hide();
            $('#wieght-error-edit-init').html('');
            sliderValue.val(null);

        }

        rangeSlider.on('input', function() {
            var value = $(this).val();
            sliderValue.val(value);



            var key = $('#edit_id_initiative_key').val();

            $.ajax({
                type: "GET",
                url: "{{ url('check-init-weight-edit') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    keyId: keyId,
                    value: value,
                    key: key

                },
                success: function(res) {


                    if (res.key > 100) {
                        $('#wieght-error-edit').html(
                            '<small class="text-danger ml-2">Combined weight percentage must not be greater than 100</small>'
                            );

                    } else {
                        $('#wieght-error-edit').html('');
                    }



                }
            });
        });
    }


    $(document).on('input', '.range-slider__range_init', function() {

        var sliderValue = $(this).val();

        // Update the corresponding text input
        $(this).closest('.col-md-8').next('.col-md-4').find('#sliderValueEditinit').val(sliderValue);
        var weightedit = $('#sliderValueEditinit').val();
        var key = $('#edit_id_initiative_key').val();
        var init = $('#edit_id_initiative').val();
        $('#init_weight' + init).val(sliderValue);

        $.ajax({
            type: "GET",
            url: "{{ url('check-init-weight-edit-first') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                init: init,
                sliderValue: sliderValue,
                key: key

            },
            success: function(res) {


                if (res.key > 100) {
                    $('#wieght-error-edit-init').html(
                        '<small class="text-danger ml-2">Combined weight percentage must not be greater than 100</small>'
                        );

                } else {
                    $('#wieght-error-edit-init').html('');
                }



            }
        });
    });

    function UpdateKeyinitiative() {

        var edit_id_initiative = $('#edit_id_initiative').val();
        var edit_initiative_name = $('#edit_initiative_name').val();
        var edit_initiative_start_date = $('#edit_initiative_start_date').val();
        var edit_initiative_end_date = $('#edit_initiative_end_date').val();
        var org_id = "{{ $organization->org_id }}";
        var slug = "{{ $organization->slug }}";
        var unit_id = "{{ $organization->id }}";
        var edit_initiative_detail = $('#edit_initiative_detail').val();
        var sliderValue = $('#sliderValueinit' + edit_id_initiative).val();
        var weightedit = $('#sliderValueEditinit').val();
        var edit_initiative_status = $('#edit_initiative_status').val();

        var key_edit = $('#edit_id_initiative_key').val();
        var obj_edit = $('#edit_id_initiative_obj').val();
        var type = "{{ $organization->type }}";


        if ($('#edit_initiative_name').val() != '' || $('#edit_initiative_start_date').val() != '' || $(
                '#edit_initiative_end_date').val() != '') {
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
                    slug: slug,
                    edit_id_initiative: edit_id_initiative,
                    sliderValue: sliderValue,
                    weightedit: weightedit,
                    key_edit: key_edit,
                    edit_initiative_status: edit_initiative_status,
                    unit_id: unit_id,
                    type: type

                },
                success: function(res) {


                    if (res == 1) {
                        $('#initiative-date-error').html(
                            'There are some items planned for this quarter. They need be removed.');

                    } else {
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

                        $("#nestedCollapsible" + obj_edit).collapse('toggle');
                        $("#key-result" + key_edit).collapse('toggle');
                    }


                }
            });
        } else {

            $('#initiative-feild-error-edit').html('Please fill out all required fields.');

        }
    }






    function addepic(ini_epic_id, epic_key, epic_obj) {
        $('#ini_epic_id').val(ini_epic_id);
        $('#epic_key').val(epic_key);
        $('#epic_obj').val(epic_obj);

    }

    function saveEpic() {

        var epic_name = $('#epic_name').val();
        var epic_start_date = $('#epic_start_date').val();
        var epic_end_date = $('#epic_end_date').val();
        var epic_description = $('#epic_description').val();
        var epic_story = $('#epic_story').val();
        var org_id = "{{ $organization->org_id }}";
        var slug = "{{ $organization->slug }}";
        var unit_id = "{{ $organization->id }}";
        var ini_epic_id = $('#ini_epic_id').val();
        var epic_status = $('#epic_status').val();

        var epic_key = $('#epic_key').val();
        var epic_obj = $('#epic_obj').val();
        var type = "{{ $organization->type }}";

        var epicData = [];
        $('.epic-input').each(function() {
            epicData.push($(this).val());
        });

        if ($('#epic_name').val() != '') {
            $.ajax({
                type: "POST",
                url: "{{ url('save-epic') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    epic_name: epic_name,
                    epic_start_date: epic_start_date,
                    epic_end_date: epic_end_date,
                    epic_description: epic_description,
                    org_id: org_id,
                    slug: slug,
                    ini_epic_id: ini_epic_id,
                    epicData: epicData,
                    epic_status: epic_status,
                    unit_id: unit_id,
                    type: type,
                    epic_obj: epic_obj
                },
                success: function(res) {
                    // if (res == 1) {

                    //     $('#obj-key-name-error').html(
                    //         '<strong class="text-danger">Key Name Already Taken</strong>');

                    // } else {
                    $('#obj-key-name-error').html('');
                    $('#epic_name').val('');
                    $('#epic_start_date').val('');
                    $('#epic_end_date').val('');
                    $('#epic_description').val('');
                    $('#epic_story').val('');


                    $('#success-epic').html(
                        '<div class="alert alert-success" role="alert"> Epic Created successfully</div>'
                    );
                    $('#epic-feild-error').html('');
                    setTimeout(function() {
                        $('#create-epic').modal('hide');
                        $('#success-epic').html('');
                    }, 3000);
                    $('#parentCollapsible').html(res);

                    $("#nestedCollapsible" + epic_obj).collapse('toggle');
                    $("#key-result" + epic_key).collapse('toggle');
                    $("#initiative" + ini_epic_id).collapse('toggle');
                    handleDivClick(ini_epic_id);


                    // }

                }
            });
        } else {

            $('#epic-feild-error').html('Please fill out all required fields.');

        }
    }


    function DeleteEpic(epicid, ini_epic, edit_epic_key, edit_epic_obj) {


        var org_id = "{{ $organization->org_id }}";
        var slug = "{{ $organization->slug }}";
        var unit_id = "{{ $organization->id }}";
        var type = "{{ $organization->type }}";

        $.ajax({
            type: "POST",
            url: "{{ url('delete-epic') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                epicid: epicid,
                org_id: org_id,
                slug: slug,
                unit_id: unit_id,
                type: type,
                edit_epic_key: edit_epic_key,
                edit_epic_obj: edit_epic_obj,
                ini_epic: ini_epic

            },
            success: function(res) {



                $('#parentCollapsible').html(res);
                $("#nestedCollapsible" + edit_epic_obj).collapse('toggle');
                $("#key-result" + edit_epic_key).collapse('toggle');
                $("#initiative" + ini_epic).collapse('toggle');
                handleDivClick(ini_epic);




            }
        });

    }




    function editepic(epic_id, epic_name, epic_start_date, epic_end_date, epic_detail, epic_status, ini_epic_id,
        epic_key, epic_obj) {
        $('#epic_story_edit').html('');
        $('#edit_epic_id').val(epic_id);
        $('#edit_epic_name').val(epic_name);
        $('#edit_epic_start_date').val(epic_start_date);
        $('#edit_epic_end_date').val(epic_end_date);
        $('#edit_epic_status').val(epic_status);

        $('#edit_ini_epic_id').val(ini_epic_id);
        $('#edit_epic_key').val(epic_key);
        $('#edit_epic_obj').val(epic_obj);


        $('#edit_epic_description').val(epic_detail);

        var type = "{{ $organization->type }}";
        var unit_id = "{{ $organization->id }}";

        $.ajax({
            type: "GET",
            url: "{{ url('get-epic-team') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                epic_id: epic_id,
                type: type,
                unit_id: unit_id


            },
            success: function(res) {

                $('#all-team').html(res);


            }
        });

        getpicstory();
        getpiccomment();

    }

    function getpicstory() {
        var edit_epic_id = $('#edit_epic_id').val();

        $.ajax({
            type: "GET",
            url: "{{ url('edit-epic') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                edit_epic_id: edit_epic_id,

            },
            success: function(res) {



                $('#epic_story_edit').html(res);



            }
        });

    }


    function getpiccomment() {
        var edit_epic_id = $('#edit_epic_id').val();

        $.ajax({
            type: "GET",
            url: "{{ url('get-epic-comment') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                edit_epic_id: edit_epic_id,

            },
            success: function(res) {



                $('#edit-comment_area').html(res);



            }
        });

    }



    function UpdateEpic() {

        var edit_epic_name = $('#edit_epic_name').val();
        var edit_epic_start_date = $('#edit_epic_start_date').val();
        var edit_epic_end_date = $('#edit_epic_end_date').val();
        var edit_epic_description = $('#edit_epic_description').val();
        var org_id = "{{ $organization->org_id }}";
        var slug = "{{ $organization->slug }}";
        var unit_id = "{{ $organization->id }}";
        var edit_epic_id = $('#edit_epic_id').val();
        var edit_epic_status = $('#edit_epic_status').val();

        var edit_ini_epic_id = $('#edit_ini_epic_id').val();
        var edit_epic_key = $('#edit_epic_key').val();
        var edit_epic_obj = $('#edit_epic_obj').val();
        var type = "{{ $organization->type }}";

        var selectedOptions = $('#edit-team').val();



        if ($('#edit_epic_name').val() != '') {
            $.ajax({
                type: "POST",
                url: "{{ url('update-epic') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    edit_epic_name: edit_epic_name,
                    edit_epic_start_date: edit_epic_start_date,
                    edit_epic_end_date: edit_epic_end_date,
                    edit_epic_description: edit_epic_description,
                    org_id: org_id,
                    slug: slug,
                    edit_epic_id: edit_epic_id,
                    edit_epic_status: edit_epic_status,
                    edit_ini_epic_id: edit_ini_epic_id,
                    unit_id: unit_id,
                    type: type,
                    edit_epic_key: edit_epic_key,
                    edit_epic_obj: edit_epic_obj,
                    selectedOptions: selectedOptions
                },
                success: function(res) {
                    // if (res == 1) {

                    //     $('#obj-key-name-error').html(
                    //         '<strong class="text-danger">Key Name Already Taken</strong>');

                    // } else {

                    $('#edit_epic_name').val('');
                    $('#edit_epic_start_date').val('');
                    $('#edit_epic_end_date').val('');
                    $('#edit_epic_description').val('');
                    $('#success-epic-edit').html(
                        '<div class="alert alert-success" role="alert"> Epic Updated successfully</div>'
                    );
                    $('#epic-feild-error-edit').html('');
                    setTimeout(function() {
                        $('#edit-epic').modal('hide');
                        $('#success-epic-edit').html('');
                    }, 3000);
                    $('#parentCollapsible').html(res);

                    $("#nestedCollapsible" + edit_epic_obj).collapse('toggle');
                    $("#key-result" + edit_epic_key).collapse('toggle');
                    $("#initiative" + edit_ini_epic_id).collapse('toggle');
                    handleDivClick(edit_ini_epic_id);





                    // }

                }
            });
        } else {

            $('#epic-feild-error-edit').html('Please fill out all required fields.');

        }
    }




    function getprogress(id) {

        var epicid = $('#edit_epic_id').val();
        var key = $('#edit_epic_key').val();
        var obj = $('#edit_epic_obj').val();

        $.ajax({
            type: "POST",
            url: "{{ url('story-check') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                key: key,
                obj: obj

            },
            success: function(res) {

                $('#epic_story_edit').html(res);
                getalldata(epicid);



            }
        });

    }

    function updateprogress(id) {

        var epicid = $('#edit_epic_id').val();
        var key = $('#edit_epic_key').val();
        var obj = $('#edit_epic_obj').val();

        $.ajax({
            type: "POST",
            url: "{{ url('update-story-check') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                key: key,
                obj: obj

            },
            success: function(res) {

                $('#epic_story_edit').html(res);
                getalldata(epicid);


            }
        });

    }


    $(document).ready(function() {
        var maxField = 20; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML =
            '<div class="d-flex w-75 mb-3"><br><br><input type="text" class="form-control epic-input"  id="epic_story" placeholder="Add Story" required><a href="javascript:void(0);"  class="remove_button btn btn-danger  mt-3  ml-3"><i class="fa fa-minus"></i></a></div>';

        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function() {
            //Check maximum number of input fields
            if (x < maxField) {
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });






    //Initial field counter is 1

    //Once add button is clicked
    function addButton(epic) {
        var maxField = 1; // Allow only one input field
        var x = $('#field_wrapper_edit' + epic + ' .epic-input-edit').length;

        if (x < maxField) {
            var wrapper = $('#field_wrapper_edit' + epic); // Input field wrapper
            var fieldHTML = `
            <div class="w-75 mb-3">
                <br><br>
                <input type="hidden">
                <input type="text" class="form-control epic-input-edit" id="" placeholder="Add Story" required>
                <button class="btn btn-primary btn-lg btn-theme mt-3" type="button" onclick="addnewstory(${epic})">Add</button>
                <a href="javascript:void(0);" class="btn btn-danger  mt-3 ml-3" id="remove_button_edit${epic}" onclick="removeButton(${epic})">Cancel</a>
            </div>
        `;

            $(wrapper).append(fieldHTML); // Add field html
            $('#item' + epic).hide();
        }
    }

    function removeButton(epic) {
        $('#field_wrapper_edit' + epic + ' .w-75').remove();
        $('#item' + epic).show();
    }


    function addnewstory(id) {

        // var name = $('.epic-input-edit').val();
        var title = $('#story_title' + id).val();
        var story_status = $('#story_status' + id).val();
        var story_assign = $('#story_assign' + id).val();

        var key = $('#edit_epic_key').val();
        var obj = $('#edit_epic_obj').val();

        if (title != '') {
            $.ajax({
                type: "POST",
                url: "{{ url('add-story-new') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: id,
                    title: title,
                    story_status: story_status,
                    story_assign: story_assign,
                    key: key,
                    obj: obj

                },
                success: function(res) {

                    //  $('#field_wrapper_edit' + id + ' .w-75').remove();
                    $('#story_title' + id).val('');
                    $('#epic_story_edit').html(res);

                    getalldata(id);



                }
            });

        }

    }

    function editstory(story_id, name) {
        $('.form-check' + story_id).addClass('d-none');
        $('#editbutton' + story_id).addClass('d-none');
        $('#' + story_id).append('<input type="text" class="form-control d-flex ml-3" id="title' + story_id +
            '" value="' + name +
            '"><div class="col-md-3 mt-2"><button class="btn btn-primary btn-sm update-button" onclick="updatestory(' +
            story_id + ')" type="button">Update</button></div>');
    }

    function updatestory(s_id) {

        // var title = $('#title'+s_id).val();

        var title = $('#edit_story_title' + s_id).val();
        var story_status = $('#edit_story_status' + s_id).val();
        var story_assign = $('#edit_story_assign' + s_id).val();

        var key = $('#edit_epic_key').val();
        var obj = $('#edit_epic_obj').val();

        if (title != '') {
            $.ajax({
                type: "POST",
                url: "{{ url('update-story') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    s_id: s_id,
                    title: title,
                    story_status: story_status,
                    story_assign: story_assign,
                    key: key,
                    obj: obj

                },
                success: function(res) {

                    $('#epic_story_edit').html(res);




                }
            });

        }

    }


    function deletestory(id) {


        var key = $('#edit_epic_key').val();
        var obj = $('#edit_epic_obj').val();
        var epicid = $('#edit_epic_id').val();
        $.ajax({
            type: "POST",
            url: "{{ url('delete-story') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                key: key,
                obj: obj

            },
            success: function(res) {

                $('#epic_story_edit').html(res);
                getalldata(epicid);




            }
        });



    }



    function getalldata(id) {



        $.ajax({
            type: "GET",
            url: "{{ url('get-all-data') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,

            },
            success: function(res) {


                $('#progepic' + res.epic.id).width(res.epic.epic_progress + '%');
                $('#proginit' + res.initiative.id).width(res.initiative.initiative_prog + '%');
                $('#comp' + res.initiative.id).html(res.initiative.initiative_prog + '%');

                $('#keycomp' + res.key.id).html(res.key.key_prog + '%');
                $('#keyprog' + res.key.id).width(res.key.key_prog + '%');

                $('#obj_comp' + res.obj.id).html(res.obj.obj_prog + '% ');
                $('#obj_prog' + res.obj.id).width(res.obj.obj_prog + '%');

                //   $('#qcomp'+res.initiative.id).html(res.initiative.q_initiative_prog +'% ');
                $('#qkeycomp' + res.key.id).html(res.key.q_key_prog + '%');

            }
        });



    }


    function getMonthStartAndEndDates(monthName, year) {

        const monthNames = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];


        const monthIndex = monthNames.indexOf(monthName);

        if (monthIndex === -1) {

            return null;
        }

        const startDate = new Date(year, monthIndex, 1);


        const endDate = new Date(year, monthIndex + 1, 0);

        return {
            start: startDate,
            end: endDate
        };
    }

    function formatDate(inputDate) {

        const dateObj = new Date(inputDate);


        if (!isNaN(dateObj.getTime())) {

            const year = dateObj.getFullYear();
            const month = String(dateObj.getMonth() + 1).padStart(2, '0');
            const day = String(dateObj.getDate()).padStart(2, '0');

            const formattedDate = `${year}-${month}-${day}`;

            return formattedDate;
        } else {

            return null;
        }
    }


    function addepicmonth(month_id, month_name, q_id, ini_epic_id, epic_key, epic_obj) {

        $('#ini_epic_id_month').val(ini_epic_id);
        $('#epic_key_month').val(epic_key);
        $('#epic_obj_month').val(epic_obj);
        $('#month_id').val(month_id);
        $('#q_id').val(q_id);

        const monthName = month_name;
        const year = 2023;
        const {
            start,
            end
        } = getMonthStartAndEndDates(monthName, year);

        // console.log("Start Date:", start.toDateString());
        // console.log("End Date:", end.toDateString());


        const formattedDate = formatDate(start.toDateString());
        const endformattedDate = formatDate(end.toDateString());

        $('#epic_start_date_month').attr('min', formattedDate);

        $('#epic_start_date_month').val(formattedDate);
        $('#epic_end_date_month').val(endformattedDate);

        // if (formattedDate) {
        //   console.log(formattedDate); // Output: "2023-07-01"
        // } else {
        //   console.log("Invalid date.");
        $('.story-data').html('');
        $('#comment_area').html('');
        var randomInteger = getRandomInt(100, 999);
        $('#r_id').val(randomInteger);
        // }

    }



    function saveEpicMonth() {



        var epic_name = $('#epic_name_month').val();
        var epic_start_date = $('#epic_start_date_month').val();
        var epic_end_date = $('#epic_end_date_month').val();
        var epic_description = $('#epic_description_month').val();
        var org_id = "{{ $organization->org_id }}";
        var slug = "{{ $organization->slug }}";
        var unit_id = "{{ $organization->id }}";
        var ini_epic_id = $('#ini_epic_id_month').val();
        var epic_status = $('#epic_status_month').val();

        var epic_key = $('#epic_key_month').val();
        var epic_obj = $('#epic_obj_month').val();


        var buisness_unit_id = $('#buisness_unit_id').val();
        var epic_type = $('#epic_type').val();

        var epic_month = $('#month_id').val();
        var epic_quartar = $('#q_id').val();
        var type = "{{ $organization->type }}";

        var selectedOptions = $('#team').val();

        var epicData = [];
        $('.epic-input').each(function() {
            epicData.push($(this).val());
        });
        var epicStory = [];
        $('.story_id').each(function() {
            epicStory.push($(this).val());
        });

        var epicComment = [];
        $('.comment_id').each(function() {
            epicComment.push($(this).val());
        });




        if ($('#epic_name_month').val() != '') {
            $.ajax({
                type: "POST",
                url: "{{ url('save-epic-month') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    epic_name: epic_name,
                    epic_start_date: epic_start_date,
                    epic_end_date: epic_end_date,
                    epic_description: epic_description,
                    org_id: org_id,
                    slug: slug,
                    ini_epic_id: ini_epic_id,
                    epicData: epicData,
                    epic_status: epic_status,
                    epic_month: epic_month,
                    epic_quartar: epic_quartar,
                    unit_id: unit_id,
                    type: type,
                    epic_obj: epic_obj,
                    selectedOptions: selectedOptions,
                    epic_key: epic_key,
                    epicStory: epicStory,
                    epicComment: epicComment,
                    buisness_unit_id: buisness_unit_id,
                    epic_type: epic_type

                },
                success: function(res) {
                    // if (res == 1) {

                    //     $('#obj-key-name-error').html(
                    //         '<strong class="text-danger">Key Name Already Taken</strong>');

                    // } else {

                    $('#epic_name_month').val('');
                    $('#epic_start_date_month').val('');
                    $('#epic_end_date_month').val('');
                    $('#epic_description_month').val('');



                    $('#success-epic-month').html(
                        '<div class="alert alert-success" role="alert"> Epic Created successfully</div>'
                    );
                    $('#epic-feild-error-month').html('');
                    setTimeout(function() {
                        $('#create-epic-month').modal('hide');
                        $('#success-epic-month').html('');
                    }, 3000);
                    $('#parentCollapsible').html(res);

                    $("#nestedCollapsible" + epic_obj).collapse('toggle');
                    $("#key-result" + epic_key).collapse('toggle');
                    $("#initiative" + ini_epic_id).collapse('toggle');
                    $("#AddStory").collapse('toggle');
                    handleDivClick(ini_epic_id);

                    // }

                }
            });
        } else {

            $('#epic-feild-error-month').html('Please fill out all required fields.');

        }
    }



    var currentSectionIndex = 0;

    function handleDivClick(x) {
        $.ajax({
            type: "GET",
            url: "{{ url('get-month') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                x: x,

            },
            success: function(response) {

                // $("#initiative"+x).collapse('toggle');    
                currentSectionIndex = response.loop_index;
                var container = document.querySelector("#container-scroll-" + x);
                var sections = Array.from(document.querySelectorAll("#section-" + x));

                if (currentSectionIndex < sections.length - 1) {
                    currentSectionIndex;

                    var sectionWidth = sections[0].offsetWidth;
                    container.style.transform = `translateX(-${sectionWidth * currentSectionIndex}px)`;

                }
            }
        });


    }

    // $(document).ready(function(){
    // 	var maxLength = 240;
    // 	$(".show-read-more").each(function(){
    // 		var myStr = $(this).text();
    // 		if($.trim(myStr).length > maxLength){
    // 			var newStr = myStr.substring(0, maxLength);
    // 			var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
    // 			$(this).empty().html(newStr);
    // 			$(this).append(' <a href="javascript:void(0);" class="read-more" style="color:black;">Read More...</a>');
    // 			$(this).append('<span class="more-text">' + removedStr + '</span>');

    // 		}
    // 	});
    // 	$(".read-more").click(function(){
    // 		$(this).siblings(".more-text").contents().unwrap();
    // 		$(this).remove();
    // 	});
    // });

    function loadmore(x) {

        const toggleButton = document.getElementById("toggle-button" + x);
        const moreContent = document.getElementById("more-content");
        const LoadmoreContent = document.getElementById("load-more" + x);

        toggleButton.addEventListener("click", function() {
            // moreContent.style.display = "block";
            // LoadmoreContent.style.display = "none";

            $('#more-content' + x).show();
            $('#load-more' + x).hide();

        });
    }

    function seeless(x) {

        const toggleButton = document.getElementById("toggle-button-less" + x);
        const moreContent = document.getElementById("more-content");
        const LoadmoreContent = document.getElementById("load-more" + x);

        toggleButton.addEventListener("click", function() {
            // moreContent.style.display = "none";
            // LoadmoreContent.style.display = "block";

            $('#more-content' + x).hide();
            $('#load-more' + x).show();

        });
    }

    function loadmoretext(x) {
        const toggleButton = document.getElementById("toggle-button-text" + x);
        const moreContent = document.getElementById("show-read-more" + x);
        const LoadmoreContent = document.getElementById("show-read" + x);

        toggleButton.addEventListener("click", function() {
            // moreContent.style.display = "block";
            // LoadmoreContent.style.display = "none";

            $('#show-read-more' + x).show();
            $('#show-read' + x).hide();

        });
    }

    function seelesstext(x) {
        const toggleButton = document.getElementById("toggle-button-less-text" + x);
        const moreContent = document.getElementById("show-read-more" + x);
        const LoadmoreContent = document.getElementById("show-read" + x);

        toggleButton.addEventListener("click", function() {
            // moreContent.style.display = "none";
            // LoadmoreContent.style.display = "block";


            $('#show-read-more' + x).hide();
            $('#show-read' + x).show();

        });
    }

    function saveQuarter() {


        var org_id = "{{ $organization->org_id }}";
        var slug = "{{ $organization->slug }}";
        var unit_id = "{{ $organization->id }}";
        var type = "{{ $organization->type }}";

        var startdate = $('#q_start_date').val();
        var enddate = $('#q_end_date').val();
        var title = $('#q_title').val();
        var detail = $('#q_description').val();

        if ($('#q_title').val() == '' || $('#q_start_date').val() == '') {
            $('#sprint-error').html('Please fill out all required fields.');
            return false;
        }


        $.ajax({
            type: "POST",
            url: "{{ url('save-sprint') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                startdate: startdate,
                enddate: enddate,
                title: title,
                detail: detail,
                org_id: org_id,
                slug: slug,
                unit_id: unit_id,
                type: type,

            },
            success: function(res) {

                $('#success-sprint').html(
                    '<div class="alert alert-success" role="alert">Sprint Added successfully</div>'
                );
                setTimeout(function() {
                    $('#create-report').modal('hide');
                    $('#success-sprint').html('');
                    $('#sprint-error').html('');
                }, 3000);

                $('#sprint-end').html(
                    '<button class="button mr-1" onclick="endquarter();">End Quarter</button>');






            }
        });

    }


    function endquarter() {

        var unit_id = "{{ $organization->id }}";
        var type = "{{ $organization->type }}";
        $.ajax({
            type: "POST",
            url: "{{ url('end-sprint') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                unit_id: unit_id,
                type: type
            },
            success: function(res) {

                $('#sprint-end').html(
                    '<button class="button mr-1" data-toggle="modal" data-target="#create-report">Start Quarter</button>'
                    );



            }
        });



    }

    function onlyNumberKey(evt) {

        var ASCIICode = (evt.which) ? evt.which : evt.keyCode
        if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
            return false;
        return true;
    }

    $(document).ready(function() {
        var maxField = 10;
        var addButton = $('.add_value');
        var wrapper = $('.field_wrapper_key');

        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function() {
            //Check maximum number of input fields
            if (x < maxField) {
                x++; //Increment field counter
                var fieldHTML =
                    '<div class="d-flex w-75 mb-3">  <div class="form-group mb-0"><input type="text" placeholder="" onkeypress="return onlyNumberKey(event)"  id="customFile" class="form-control target_value"/><label for="objective-name">Quarter ' +
                    x +
                    ' Target Value</label></div><a href="javascript:void(0);"  class="remove_button btn btn-light-danger"><i class="fa fa-minus"></i></a></div>';

                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

    function GetFagEpic() {

        var org_id = "{{ $organization->org_id }}";
        var slug = "{{ $organization->slug }}";
        var unit_id = "{{ $organization->id }}";
        var type = "{{ $organization->type }}";
        var chartId = $('#chkveg').val();
        if (chartId != '') {
            $.ajax({
                type: "GET",
                url: "{{ url('Get-Epic-Flag') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {

                    org_id: org_id,
                    slug: slug,
                    unit_id: unit_id,
                    type: type,
                    chartId: chartId,

                },
                success: function(res) {

                    $('#parentCollapsible').html(res);






                }
            });
        }

    }



    function SaveNewStory() {


        var title = $('#story_title').val();
        var story_assign = $('#story_assign').val();
        var story_type = $('#story_type').val();
        var story_status = $('#story_status').val();
        var unit_id = "{{ $organization->id }}";
        var RID = $('#r_id').val();

        $.ajax({
            type: "POST",
            url: "{{ url('save-story') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                title: title,
                story_assign: story_assign,
                story_type: story_type,
                story_status: story_status,
                unit_id: unit_id,
                RID: RID,

            },
            success: function(res) {

                $('#story_title').val('');
                $('#story_assign').val('');
                $('#story_type').val('');
                $('#story_status').val('');
                // $('#AddStory').slideUp();    
                $('.story-data').html(res);

            }
        });



    }

    function deletestorynew(id) {

        var unit_id = "{{ $organization->id }}";
        var RID = $('#r_id').val();

        $.ajax({
            type: "POST",
            url: "{{ url('delete-story-new') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                unit_id: unit_id,
                RID: RID,

            },
            success: function(res) {


                $('.story-data').html(res);

            }
        });

    }

    function editstorynew(id) {
        $('#story_edit_id').val(id);
    }

    function UpdateNewStory(id) {


        var title = $('#edit_story_title' + id).val();
        var story_assign = $('#edit_story_assign' + id).val();
        var story_status = $('#edit_story_status' + id).val();
        var unit_id = "{{ $organization->id }}";
        var RID = $('#r_id').val();

        $.ajax({
            type: "POST",
            url: "{{ url('update-story-new') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                title: title,
                story_assign: story_assign,
                story_status: story_status,
                unit_id: unit_id,
                RID: RID,

            },
            success: function(res) {


                $('.story-data').html(res);

            }
        });

    }

    function SaveComment() {

        var epic_comment = $('#epic-comment').val();

        var unit_id = "{{ $organization->id }}";
        var RID = $('#r_id').val();
        var epic = $('#edit_ini_epic_id').val();

        $.ajax({
            type: "POST",
            url: "{{ url('add-epic-comment') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                epic_comment: epic_comment,
                unit_id: unit_id,
                RID: RID,
                epic: epic,

            },
            success: function(res) {

                $('#epic-comment').val('');
                $('#comment_area').html(res);

            }
        });

    }

    function editcomment(id, comment) {
        $('#edit-c' + id).html('<input type="text" class="form-control" id="title' + id + '" value="' + comment +
            '" onfocusout="updateComment(' + id + ')">');
    }

    function updateComment(id) {
        var title = $('#title' + id).val();

        var unit_id = "{{ $organization->id }}";
        var RID = $('#r_id').val();

        $.ajax({
            type: "POST",
            url: "{{ url('update-epic-comment') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                title: title,
                unit_id: unit_id,
                RID: RID,

            },
            success: function(res) {

                $('#edit-c' + id).html('<p>' + title + '</p>');

            }
        });

    }

    function SaveEditComment() {

        var epic_comment = $('#edit-epic-comment').val();

        var unit_id = "{{ $organization->id }}";
        var epic = $('#edit_epic_id').val();

        $.ajax({
            type: "POST",
            url: "{{ url('save-edit-epic-comment') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                epic_comment: epic_comment,
                unit_id: unit_id,
                epic: epic,

            },
            success: function(res) {

                $('#edit-epic-comment').val('');
                $('#edit-comment_area').html(res);

            }
        });

    }


    function deleteepiccomment(id) {


        var unit_id = "{{ $organization->id }}";

        $.ajax({
            type: "POST",
            url: "{{ url('delete-epic-comment') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                unit_id: unit_id,

            },
            success: function(res) {

                // $('#edit-comment_area').html(res);
                $('#delete-comment' + id).remove();

            }
        });

    }


    function addnewquartervalue(id, key_chart_id, sprint_id) {

        var value = $('#new-chart-value' + id).val();

        var unit_id = "{{ $organization->id }}";

        if (value == '') {
            return false;
        }
        $.ajax({
            type: "POST",
            url: "{{ url('add-new-quarter-value') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                value: value,
                key_chart_id: key_chart_id,
                unit_id: unit_id,
                sprint_id: sprint_id,

            },
            success: function(res) {



                $('#new-chart-value' + id).val('');
                $('.key-chart-data').html(res);


            }
        });

    }

    function editquartervalue(id, val) {
        $('#edit-val' + id).html('<input type="text" class="form-control w-50" style="font-size:12px" id="value' + id +
            '" value="' + val + '" onfocusout="updateQvalue(' + id + ')">');
    }

    function updateQvalue(id) {
        var title = $('#value' + id).val();
        var unit_id = "{{ $organization->id }}";

        $.ajax({
            type: "POST",
            url: "{{ url('update-new-quarter-value') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                title: title,
                unit_id: unit_id,

            },
            success: function(res) {

                $('#edit-val' + id).html(title);
                $('#edit-button-val' + id).html(
                    '<button class="btn-circle btn-tolbar" type="button" onclick="editquartervalue(' +
                    id + ',' + "'" + title + "'" +
                    ')"><img src="{{ url('public/assets/images/icons/edit.svg') }}"></button>  <button class="btn-circle btn-tolbar" type="button" onclick="deletequartervalue(' +
                    id + ')"><img src="{{ url('public/assets/images/icons/delete.svg') }}"></button>');

                $('#q-value' + res.key_chart_id).html(res.value);

            }
        });

    }

    function deletequartervalue(id) {


        var unit_id = "{{ $organization->id }}";

        $.ajax({
            type: "POST",
            url: "{{ url('delete-new-quarter-value') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                unit_id: unit_id,

            },
            success: function(res) {

                $('#delete-val' + id).remove();


            }
        });

    }

    function getteam() {
        var unit_id = "{{ $organization->id }}";
        var type = "{{ $organization->type }}";
        $.ajax({
            type: "GET",
            url: "{{ url('get-team') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                unit_id: unit_id,
                type: type,
            },
            success: function(res) {

                if (res) {
                    $('#key-team').empty();
                    $('#key-team').append('<option hidden value="">Select Team</option>');
                    $.each(res, function(key, course) {
                        $('select[name="key-team"]').append('<option value="' + course.id + '">' +
                            course.team_title + '</option>');
                    });
                } else {
                    $('#key-team').empty();
                }

            }
        });

    }

    function getteamobj(id, x) {

        var unit_id = "{{ $organization->id }}";
        var type = "{{ $organization->type }}";
        $.ajax({
            type: "GET",
            url: "{{ url('get-team-obj') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                unit_id: unit_id,
                id: id,
                type: type,
            },
            success: function(res) {

                if (res) {
                    $('#obj-team' + x).empty();
                    $('#obj-team' + x).append('<option hidden value="">Select Objective</option>');
                    $.each(res, function(key, course) {
                        $('#obj-team' + x).append('<option value="' + course.id + '">' + course
                            .objective_name + '</option>');
                    });
                } else {
                    $('#obj-team' + x).empty();
                }

            }
        });

    }

    function getUnitObj(id, val) {

        var type = "{{ $organization->type }}";

        $.ajax({
            type: "GET",
            url: "{{ url('get-unit-obj') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                type: type,
            },
            success: function(res) {

                if (res) {
                    $('#bu-obj' + val).empty();
                    $('#bu-obj' + val).append('<option hidden>Choose Obective</option>');
                    $.each(res, function(key, course) {
                        $('#bu-obj' + val).append('<option value="' + course.id + '">' + course
                            .objective_name + '</option>');
                    });
                } else {
                    $('#bu-obj' + val).empty();
                }

            }
        });

    }


    function getBUKey(id, val) {

        $.ajax({
            type: "GET",
            url: "{{ url('get-BU-key') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
            },
            success: function(res) {

                if (res) {
                    $('#key-BU' + val).empty();
                    $('#key-BU' + val).append('<option hidden>Choose Key Result</option>');
                    $.each(res, function(key, course) {
                        $('#key-BU' + val).append('<option value="' + course.id + '">' + course
                            .key_name + '</option>');
                    });
                } else {
                    $('#key-BU' + val).empty();
                }

            }
        });

    }

    function editkeyqvalue(id, val) {
        $('#edit-q-val' + id).html('<input type="text" class="form-control w-50" style="font-size:12px" id="q-value' +
            id + '" value="' + val + '" onfocusout="updateKeyQvalue(' + id + ')">');
    }

    function updateKeyQvalue(id) {
        var title = $('#q-value' + id).val();
        var unit_id = "{{ $organization->id }}";

        $.ajax({
            type: "POST",
            url: "{{ url('update-key-quarter-value') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                title: title,
                unit_id: unit_id,

            },
            success: function(res) {

                $('#edit-q-val' + id).html(title);
                $('#edit-button-qval' + id).html(
                    '<button class="btn-circle btn-tolbar" type="button" onclick="editkeyqvalue(' + id +
                    ',' + "'" + title + "'" +
                    ')"><img src="{{ url('public/assets/images/icons/edit.svg') }}"></button> ');
                $('#q-sprint' + res.id).html(res.quarter_value);


            }
        });

    }


    function addepicreply(id, val) {
        $('#epic-reply' + id).html(
            '<input type="text" placeholder="Type..." class="form-control w-50" style="font-size:12px" id="reply' +
            id + '"><button type="button" class="btn btn-default btn-sm ml-2 mt-1" onclick="savereply(' + id + ',' +
            val + ')">save</button>');
    }

    function savereply(id, val)

    {

        var title = $('#reply' + id).val();
        var unit_id = "{{ $organization->id }}";

        $.ajax({
            type: "POST",
            url: "{{ url('epic-reply-edit') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                title: title,
                unit_id: unit_id,

            },
            success: function(res) {

                $('#epic-reply' + id).html('');
                if (val == 1) {
                    $('#comment_area').html(res);
                }
                if (val == 0) {
                    $('#edit-comment_area').html(res);
                }

            }
        });

    }

    function gettarget(target) {

        var typeV = $('#key_result_type').val();
        var iniV = $('#init_value').val();
        if (typeV == 'Should Increase to') {

            if (target <= iniV) {
                $('#target-error').html('The target value should be greater than the initial value');
            } else if (target >= iniV) {
                $('#target-error').html('');

            } else {}
        }


        if (typeV == 'Should stay above') {

            if (target <= iniV) {
                $('#target-error').html('The target value should be greater than the initial value');
            } else if (target >= iniV) {
                $('#target-error').html('');

            } else {}
        }

        if (typeV == 'Should decrease to') {

            if (target >= iniV) {
                $('#target-error').html('The target value should be less than the initial value');
            } else if (target <= iniV) {
                $('#target-error').html('');

            } else {}
        }

        if (typeV == 'Should stay below') {

            if (target >= iniV) {
                $('#target-error').html('The target value should be less than the initial value');
            } else if (target <= iniV) {
                $('#target-error').html('');

            } else {}
        }


    }

    var x = 1;

    function appendteam() {

        x++;

        var unit_id = "{{ $organization->id }}";
        var type = "{{ $organization->type }}";
        $.ajax({
            type: "GET",
            url: "{{ url('append-team') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                unit_id: unit_id,
                type: type,
                x: x,
            },
            success: function(res) {
                $('.field_wrapper_bu_team').append(res);
            }
        });

    }

    function remove_div(div) {
        $('#remove_button' + div).remove();
    }

    var y = 1;

    function appendBu() {

        y++;
        var org_id = "{{ $organization->org_id }}";
        var type = "{{ $organization->type }}";
        $.ajax({
            type: "GET",
            url: "{{ url('append-bu') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                org_id: org_id,
                type: type,
                y: y,
            },
            success: function(res) {
                $('.field_wrapper_bu').append(res);
            }
        });

    }

    function remove_div_unit(div) {
        $('#remove-unit' + div).remove();
    }



    function addnewquarterval(epic) {

        var wrapper = $('#field_wrapper' + epic); // Input field wrapper
        var fieldHTML = `
            <div class="w-100 mb-3 d-flex mt-1">
                <br><br>
                <input type="hidden">
                <input type="text" class="form-control  mr-2" onkeypress="return onlyNumberKey(event)"  id="q-val${epic}" placeholder="Add Quarter Value" required>
                <button class="btn btn-primary btn-sm btn-theme ml-2 mt-2" type="button" onclick="addnewQval(${epic})">Add</button>
                <a href="javascript:void(0);" class="btn btn-danger btn-sm  mt-2 ml-3"  onclick="removeButtonQ(${epic})">Cancel</a>
            </div>
        `;

        $(wrapper).html(fieldHTML);


    }

    function removeButtonQ(epic) {
        $('#field_wrapper' + epic + ' .w-100').remove();

    }

    function addnewQval(id) {

        var unit_id = "{{ $organization->id }}";
        var value = $('#q-val' + id).val();
        $.ajax({
            type: "POST",
            url: "{{ url('add-key-quarter-value') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id: id,
                unit_id: unit_id,
                value: value,

            },
            success: function(res) {

                $('.key-chart-data').html(res);
                $('#field_wrapper' + id + ' .w-100').remove();

            }
        });

    }


    function getRandomInt(min, max) {
        min = Math.ceil(min);
        max = Math.floor(max);
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }
</script>
