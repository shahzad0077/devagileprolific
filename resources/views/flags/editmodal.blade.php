<form class="needs-validation" method="POST" id="updateflag{{ $data->id }}" action="{{ url('dashboard/flags/updateflag') }}" novalidate>
    @csrf         
    <input type="hidden" id="cardid" value="{{ $data->id }}" name="id">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="form-group mb-0">
                <input type="text" value="{{ $data->flag_title }}" class="form-control" name="flag_title" id="objective-name" required>
                <label for="objective-name">Flag Title</label>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-6">
            <div class="form-group mb-0">
               <select name="flag_type" class="form-control" id="flag_type">
                   <option value="">Select Flag Type</option>
                   <option value="Risk" @if($data->flag_type == 'Risk') selected @endif >Risk</option>
                   <option value="Impediment" @if($data->flag_type == 'Impediment') selected @endif>Impediment</option>
                   <option value="Blocker" @if($data->flag_type == 'Blocker') selected @endif>Blocker</option>
                   <option value="Action" @if($data->flag_type == 'Action') selected @endif>Action</option>
               </select>
                <label for="small-description">Flag Type</label>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-6">
            <div class="form-group mb-0">
                <select required class="form-control" name="flag_assign" id="flag_assign">
                    <option  value="">Select Flag Assignee</option>
                    @foreach(DB::table('members')->where('org_user',Auth::id())->get() as $r)                
                      <option @if($r->id  == $data->flag_assign) selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                    @endforeach
                </select>
                <label for="lead-manager">Flag Assignee</label>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="form-group mb-0">
                
                <textarea name="flag_description" id="editor{{ $r->id }}">{{ $data->flag_description }}</textarea> 
                <label>Small Description</label>           
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary btn-lg btn-theme btn-block ripple" id="updatebutton">Update</button>
        </div>
    </div>
</form>
<script type="text/javascript">
    $('#editor{{ $r->id }}').summernote({
        height: 300,
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
                $('#updatebutton').html('Update');
                $('#'+cardid).html(data)         
            }
        });
    }));
</script>
<form method="POST" id="savecomment{{ $data->id }}" action="{{ url('dashboard/flags/savecomment') }}">
    @csrf
    <input type="hidden" value="{{ $data->id }}" name="flag_id">
    <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
    <div class="row mt-3">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="d-flex flex-row align-items-center justify-content-between comment-header">
                <div>
                    <h4>Comments</h4>
                </div>
                <div class="dropdown">
                  <button class="btn btn-default btn-sm dropdown-toggle orderbybutton" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="7" viewBox="0 0 11 7" fill="none">
                      <path d="M10.8339 0.644857C10.6453 0.456252 10.3502 0.439106 10.1422 0.593419L10.0826 0.644857L5.49992 5.2273L0.917236 0.644857C0.72863 0.456252 0.433494 0.439106 0.225519 0.593419L0.165935 0.644857C-0.0226701 0.833463 -0.0398163 1.1286 0.114497 1.33657L0.165935 1.39616L5.12427 6.35449C5.31287 6.5431 5.60801 6.56024 5.81599 6.40593L5.87557 6.35449L10.8339 1.39616C11.0414 1.18869 11.0414 0.852323 10.8339 0.644857Z" fill="#787878"/>
                    </svg> Order By
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" onclick="orderbycomment('desc',{{$data->id}})" href="javascript:void(0)">Latest</a>
                    <a class="dropdown-item" onclick="orderbycomment('asc',{{$data->id}})" href="javascript:void(0)">Older</a>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="d-flex flex-column">
                <div>
                    <div class="form-group mb-0">
                        <input type="text" class="form-control" name="comment" id="objective-name" required>
                        <label for="objective-name">Write Comment</label>
                    </div>
                </div>
                <div>
                    <!-- <button class="btn btn-default btn-sm">Cancel</button> -->
                    <button type="submit" id="savecommentbutton{{ $data->id }}" class="btn btn-primary btn-sm">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $('#savecomment{{ $data->id }}').on('submit',(function(e) {
        $('#savecommentbutton{{ $data->id }}').html('<i class="fa fa-spin fa-spinner"></i>');
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
                $('#savecommentbutton{{ $data->id }}').html('Save');
                $("#savecomment{{ $data->id }}")[0].reset();
                $('#updateflag{{ $data->id }}').submit();
                $('.comment-area').html(data);
            }
        });
    }));
    function orderbycomment(id,flag_id) {
        $.ajax({
            type: "POST",
            url: "{{ url('dashboard/flags/orderbycomment') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id:id,
                flag_id:flag_id,
            },
            success: function(res) {
                if(id == 'desc')
                {
                    $('.orderbybutton').html('<svg xmlns="http://www.w3.org/2000/svg" width="11" height="7" viewBox="0 0 11 7" fill="none"> <path d="M10.8339 0.644857C10.6453 0.456252 10.3502 0.439106 10.1422 0.593419L10.0826 0.644857L5.49992 5.2273L0.917236 0.644857C0.72863 0.456252 0.433494 0.439106 0.225519 0.593419L0.165935 0.644857C-0.0226701 0.833463 -0.0398163 1.1286 0.114497 1.33657L0.165935 1.39616L5.12427 6.35449C5.31287 6.5431 5.60801 6.56024 5.81599 6.40593L5.87557 6.35449L10.8339 1.39616C11.0414 1.18869 11.0414 0.852323 10.8339 0.644857Z" fill="#787878"/> </svg> Order By Latest')
                }
                if(id == 'asc')
                {
                    $('.orderbybutton').html('<svg xmlns="http://www.w3.org/2000/svg" width="11" height="7" viewBox="0 0 11 7" fill="none"> <path d="M10.8339 0.644857C10.6453 0.456252 10.3502 0.439106 10.1422 0.593419L10.0826 0.644857L5.49992 5.2273L0.917236 0.644857C0.72863 0.456252 0.433494 0.439106 0.225519 0.593419L0.165935 0.644857C-0.0226701 0.833463 -0.0398163 1.1286 0.114497 1.33657L0.165935 1.39616L5.12427 6.35449C5.31287 6.5431 5.60801 6.56024 5.81599 6.40593L5.87557 6.35449L10.8339 1.39616C11.0414 1.18869 11.0414 0.852323 10.8339 0.644857Z" fill="#787878"/> </svg> Order By Older')
                }
                $('.comment-area').html(res);
            },
            error: function(error) {
                console.log('Error updating card position:', error);
            }
        });
    }
</script>
<div class="row mt-4 comment-area">
    @include('flags.allcomments')
</div>