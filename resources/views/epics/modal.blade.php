<div class="modal-header modalheaderforapend">
    @include('epics.modalheader')
</div>
<div class="modal-body" id="showformforedit">
    <div class="row"><div class="col-md-12"><div class="border-top"></div></div></div>
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="menuettitle">
                <h4>Menu</h4>
                <ul>
                    <li id="general" onclick="showtab({{$data->id}} , 'general')" class="tabsclass active"><img src="{{ url('public/assets/svg/edit-2.svg') }}"> Basic Details</li>
                    <li id="childitems" onclick="showtab({{$data->id}} , 'childitems')" class="tabsclass"><img src="{{ url('public/assets/svg/comment.svg') }}"> Child Items</li>
                    <li id="comments" onclick="showtab({{$data->id}} , 'comments')" class="tabsclass"><img src="{{ url('public/assets/svg/comment.svg') }}"> Comments</li>
                    <li id="activites" onclick="showtab({{$data->id}} , 'activites')" class="tabsclass"><img src="{{ url('public/assets/svg/activites.svg') }}"> Activities</li>
                    <li id="checkins" onclick="showtab({{$data->id}} , 'checkins')" class="tabsclass"><img src="{{ url('public/assets/svg/activites.svg') }}"> Check-Ins</li>
                    <li id="attachment" onclick="showtab({{$data->id}} , 'attachment')" class="tabsclass"><img src="{{ url('public/assets/svg/activites.svg') }}"> Attachments</li>
                    <li id="teams" onclick="showtab({{$data->id}} , 'teams')" class="tabsclass"><img src="{{ url('public/assets/svg/attachment.svg') }}"> Teams</li>
                </ul>
                <h4>Action</h4>
                <ul class="positionrelative">
                    <li><img src="{{ url('public/assets/svg/archive-action.svg') }}"> Archive</li>
                    <li><img src="{{ url('public/assets/svg/share-action.svg') }}"> Share</li>
                    <li><img src="{{ url('public/assets/svg/arrow-right-action.svg') }}"> Move</li>
                    <li><img src="{{ url('public/assets/svg/trash-action.svg') }}"> Delete</li>
                </ul>
            </div>
        </div>
        <div class="col-md-9 secondportion">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="d-flex flex-row align-items-center justify-content-between block-header">
                        <div>
                            <h4><img src="{{ url('public/assets/svg/editsvg.svg') }}"> Basic Details</h4>
                        </div>
                    </div>
                </div>
            </div>
            <form id="updategeneral" class="needs-validation" action="{{ url('dashboard/epics/updategeneral') }}" method="POST" novalidate>
                @csrf
                <input type="hidden" value="{{ $data->id }}" name="epic_id">
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group mb-0">
                            <label for="epic_name">Epic Title</label>
                            <input type="text" required='true' value="{{ $data->epic_name }}" class="form-control" name="epic_name" id="epic_name">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group mb-0">
                            <label for="epic_start_date">Start Date</label>
                            <input id="epic_start_date" type="date" class="form-control" value="{{ date('Y-m-d',strtotime($data->epic_start_date)) }}" name="epic_start_date"  required>
                            
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group mb-0">
                            <label for="epic_end_date">End Date</label>
                            <input type="date" class="form-control" value="{{ date('Y-m-d',strtotime($data->epic_end_date)) }}" name="epic_end_date" name="edit_epic_end_date" required>
                            
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="form-group mb-0">
                            <label for="editor{{ $data->id }}">Description</label>
                            <div class="textareaformcontrol">
                                <textarea name="epic_detail" id="editor{{ $data->id }}">{{ $data->epic_detail }}</textarea> 
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
        </div>
    </div>
</div>
<script type="text/javascript">
    function showtab(id , tab) {
        $('.secondportion').addClass('loaderdisplay');
        $('.secondportion').html('<i class="fa fa-spin fa-spinner"></i>');
        $.ajax({
            type: "POST",
            url: "{{ url('dashboard/epics/showtab') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id:id,
                tab:tab,
            },
            success: function(res) {
                $('.secondportion').removeClass('loaderdisplay');
                $('.secondportion').html(res);
                $('.tabsclass').removeClass('active');
                $('#'+tab).addClass('active');
            },
            error: function(error) {
                
            }
        });
    }
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
    $('#updategeneral').on('submit',(function(e) {
        $('#updatebutton').html('<i class="fa fa-spin fa-spinner"></i>');
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type:'POST',
            url: $(this).attr('action'),
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            success: function(data){
                showepicinboard('{{ $data->id }}');
                editepic('{{ $data->id }}');
                $('#updatebutton').html('Save Changes');
            }
        });
    }));
</script>