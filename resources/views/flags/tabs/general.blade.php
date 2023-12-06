<div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="d-flex flex-row align-items-center justify-content-between block-header">
            <div>
                <h4><img src="{{ url('public/assets/svg/editsvg.svg') }}"> Basic Details</h4>
            </div>
        </div>
    </div>
</div>
<form class="needs-validation mt-5" method="POST" id="updateflag{{ $data->id }}" action="{{ url('dashboard/flags/updateflag') }}" novalidate>
@csrf         
    <input type="hidden" id="cardid" value="{{ $data->id }}" name="id">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="form-group mb-0">
                <label for="objective-name">Flag Title</label>
                <input type="text" value="{{ $data->flag_title }}" class="form-control" name="flag_title" id="flag_tittle" required>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-xl-12" id="epicinputtoshow">
            <input type="hidden" id="epic_id" value="{{ $data->epic_id }}" name="epic_id">
            <div class="form-group mb-0 positionrelative">
                <label for="objective-name">Epic (Optional)</label>
                <input onkeyup="searchepic(this.value)" type="text" placeholder="Search Epic" class="form-control">
                <div class="searchiconforinput">
                    <img src="{{ url('public/assets/images/searchiconsvg.svg') }}">
                </div>
                @if($data->epic_id)
                <div class="selectepic">
                    <p>{{ DB::Table('epics')->where('id' , $data->epic_id)->first()->epic_name }}</p>
                    <a onclick="removeepic({{ $data->id }})" href="javascript:void(0)"><img class="closeimage" src="{{url('public/assets/svg/cross.svg')}}"></a>
                </div>
                @endif
            </div>
            <div class="searchepic-box">
                
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="form-group mb-0">
                <label>Description</label>
                <div class="textareaformcontrol">
                    <textarea name="flag_description" id="editor{{ $data->id }}">{{ $data->flag_description }}</textarea> 
                </div>
            </div>
        </div>
    </div>
    <div class="row margintopfourtypixel">
        <div class="col-md-12 text-right">
            <button type="submit" class="btn btn-primary btn-theme ripple savechangebutton" id="updatebutton">Save Changes</button>
        </div>
    </div>
</form>
<script>

    $('#editor{{ $data->id }}').summernote({
        height: 180,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['view', ['fullscreen', 'codeview']],
        ],
    });
    $('#updateflag{{ $data->id }}').on('submit',(function(e) {
        $('#updatebutton').html('<i class="fa fa-spin fa-spinner"></i>');
        e.preventDefault();
        var formData = new FormData(this);
        var cardid = $('#cardid').val();
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(data){
                $('#updatebutton').html('Save Changes');
                $('#'+cardid).html(data)         
            }
        });
    }));
    function removeepic(id) {
        $.ajax({
            type: "POST",
            url: "{{ url('dashboard/flags/removeepic') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id:id,
            },
            success: function(res) {
                $('#epicinputtoshow').html(res);
            },
            error: function(error) {
                console.log('Error updating card position:', error);
            }
        });
    }
    function selectepic(id) {
        var flagid = '{{ $data->id }}';
        $.ajax({
            type: "POST",
            url: "{{ url('dashboard/flags/selectepic') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id:id,
                flagid:flagid,
            },
            success: function(res) {
                $('#epicinputtoshow').html(res);
            },
            error: function(error) {
                console.log('Error updating card position:', error);
            }
        });
    }
</script>