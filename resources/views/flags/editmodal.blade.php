<div class="modal-header">
    <div class="row positionrelative">
        <div class="col-md-12">
            <h5 class="modal-title newmodaltittle marginleftthirty" id="create-epic">
                <img src="{{ url('public/assets/svg/traffic-cone-svgrepo-com.svg') }}">
            Impediment</h5>
        </div>
        <div class="col-md-12 marginleftthirty newmodalsubtittle">
            <p>Fill out the form, submit and hit the save button.</p>
        </div>
        <div class="col-md-12 displayflex">
            <div class="btn-group">
                <button type="button" class="btn btn-default statuschangebutton" id="showboardbutton">
                    @if($data->flag_status == 'todoflag')
                        To Do
                    @endif
                    @if($data->flag_status == 'inprogress')
                        In Progress
                    @endif
                    @if($data->flag_status == 'doneflag')
                        Done
                    @endif
                </button>
                <button type="button" class="statuschangebuttonarrow btn btn-danger dropdown-toggle dropdown-toggle-split archivebeardcimbgbutton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{url('public/assets/svg/arrow-down-white.svg')}}" width="20">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">
                    @if($data->flag_status == 'todoflag')
                        <a class="dropdown-item" onclick="changeflagstatus('inprogress',{{$data->id}})" href="javascript:void(0)">In Progress</a>
                        <a class="dropdown-item" onclick="changeflagstatus('doneflag',{{$data->id}})" href="javascript:void(0)">Done</a>
                    @endif
                    @if($data->flag_status == 'inprogress')
                        <a class="dropdown-item" onclick="changeflagstatus('todoflag',{{$data->id}})" href="javascript:void(0)">To Do</a>
                        <a class="dropdown-item" onclick="changeflagstatus('doneflag',{{$data->id}})" href="javascript:void(0)">Done</a>
                    @endif
                    @if($data->flag_status == 'doneflag')
                        <a class="dropdown-item" onclick="changeflagstatus('todoflag',{{$data->id}})" href="javascript:void(0)">To Do</a>
                        <a class="dropdown-item" onclick="changeflagstatus('inprogress',{{$data->id}})" href="javascript:void(0)">In Progress</a>
                    @endif
                </div>
            </div>
            <div class="members-list">
                <div class="member-list-image">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTv1Tt9_33HyVMm_ZakYQy-UgsLjE00biEArg&usqp=CAU">
                </div>
                <div class="member-list-image">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTv1Tt9_33HyVMm_ZakYQy-UgsLjE00biEArg&usqp=CAU">
                </div>
                <div class="member-list-image">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTv1Tt9_33HyVMm_ZakYQy-UgsLjE00biEArg&usqp=CAU">
                </div>
                <div onclick="showmemberbox()" class="member-list-image">
                    <img src="{{url('public/assets/svg/plussmember.svg')}}">
                </div>
                <div class="memberadd-box">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Members</h4>
                        </div>
                        <div class="col-md-6 text-right">
                            <img onclick="showmemberbox()" class="memberclose" src="{{url('public/assets/svg/memberclose.svg')}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-2 positionrelative">
                                <input type="text" placeholder="Search Member" class="form-control" name="flag_title" id="objective-name" required>
                                <div class="membersearchiconforinput">
                                    <img src="{{ url('public/assets/images/searchiconsvg.svg') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 memberprofile">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="memberprofileimage">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTv1Tt9_33HyVMm_ZakYQy-UgsLjE00biEArg&usqp=CAU">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="membername">Test Name</div>
                                    <div class="memberdetail">Test Deatail</div>
                                </div>
                                <div class="col-md-2 text-center mt-3">
                                    <img src="{{ url('public/assets/svg/smalltick.svg') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 memberprofile">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="memberprofileimage">
                                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTv1Tt9_33HyVMm_ZakYQy-UgsLjE00biEArg&usqp=CAU">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="membername">Test Name</div>
                                    <div class="memberdetail">Test Deatail</div>
                                </div>
                                <div class="col-md-2 text-center mt-3">
                                    <img src="{{ url('public/assets/svg/smalltick.svg') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rightside" >
        <img src="{{url('public/assets/svg/maximize.svg')}}">
        <img data-dismiss="modal" class="closeimage" aria-label="Close" src="{{url('public/assets/svg/cross.svg')}}">
    </div>
</div>
<div class="modal-body" id="showformforedit">
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="menuettitle">
                <h4>Menu</h4>
                <ul>
                    <li id="general" onclick="showtab({{$data->id}} , 'general')" class="tabsclass active"><img src="{{ url('public/assets/svg/edit-2.svg') }}"> General</li>
                    <li id="comment" onclick="showtab({{$data->id}} , 'comment')" class="tabsclass"><img src="{{ url('public/assets/svg/comment.svg') }}"> Comments</li>
                    <li id="activites" onclick="showtab({{$data->id}} , 'activites')" class="tabsclass"><img src="{{ url('public/assets/svg/activites.svg') }}"> Activities</li>
                    <li id="attachment" onclick="showtab({{$data->id}} , 'attachment')" class="tabsclass"><img src="{{ url('public/assets/svg/attachment.svg') }}"> Attachments</li>
                </ul>
                <h4>Action</h4>
                <ul>
                    <li><img src="{{ url('public/assets/svg/escalate-action.svg') }}"> Escalate</li>
                    <li><img src="{{ url('public/assets/svg/share-action.svg') }}"> Share</li>
                    <li><img src="{{ url('public/assets/svg/arrow-right-action.svg') }}"> Move</li>
                    <li><img src="{{ url('public/assets/svg/archive-action.svg') }}"> Archive</li>
                    <li><img src="{{ url('public/assets/svg/trash-action.svg') }}"> Delete</li>
                </ul>
            </div>
        </div>
        <div class="col-md-9 secondportion loaderdisplay">
            
        </div>
    </div>
</div>
<script type="text/javascript">
    function changeflagstatus(status,id) {
        $.ajax({
            type: "POST",
            url: "{{ url('dashboard/flags/change-flag-status') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                parentElId:status,
                droppedElId:id,
            },
            success: function(response) {
                editflag(id);
                viewboards($('#viewboards').val());
            },
            error: function(error) {
                console.log('Error updating card position:', error);
            }
        });
    }
    function showtab(id , tab) {
        $('.secondportion').addClass('loaderdisplay');
        $('.secondportion').html('<i class="fa fa-spin fa-spinner"></i>');
        $.ajax({
            type: "POST",
            url: "{{ url('dashboard/flags/showtab') }}",
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
    function showorderby(id,flag_id,table) {
        $.ajax({
            type: "POST",
            url: "{{ url('dashboard/flags/showorderby') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id:id,
                flag_id:flag_id,
                table:table,
            },
            success: function(res) {
                if(id == 'desc')
                {
                    $('.orderbybutton').html('Order By Latest <svg xmlns="http://www.w3.org/2000/svg" width="11" height="7" viewBox="0 0 11 7" fill="none"> <path d="M10.8339 0.644857C10.6453 0.456252 10.3502 0.439106 10.1422 0.593419L10.0826 0.644857L5.49992 5.2273L0.917236 0.644857C0.72863 0.456252 0.433494 0.439106 0.225519 0.593419L0.165935 0.644857C-0.0226701 0.833463 -0.0398163 1.1286 0.114497 1.33657L0.165935 1.39616L5.12427 6.35449C5.31287 6.5431 5.60801 6.56024 5.81599 6.40593L5.87557 6.35449L10.8339 1.39616C11.0414 1.18869 11.0414 0.852323 10.8339 0.644857Z" fill="#787878"/> </svg>')
                }
                if(id == 'asc')
                {
                    $('.orderbybutton').html('Order By Older <svg xmlns="http://www.w3.org/2000/svg" width="11" height="7" viewBox="0 0 11 7" fill="none"> <path d="M10.8339 0.644857C10.6453 0.456252 10.3502 0.439106 10.1422 0.593419L10.0826 0.644857L5.49992 5.2273L0.917236 0.644857C0.72863 0.456252 0.433494 0.439106 0.225519 0.593419L0.165935 0.644857C-0.0226701 0.833463 -0.0398163 1.1286 0.114497 1.33657L0.165935 1.39616L5.12427 6.35449C5.31287 6.5431 5.60801 6.56024 5.81599 6.40593L5.87557 6.35449L10.8339 1.39616C11.0414 1.18869 11.0414 0.852323 10.8339 0.644857Z" fill="#787878"/> </svg>')
                }
                $('.secondportion').html(res);
            },
            error: function(error) {
                console.log('Error updating card position:', error);
            }
        });
    }
</script>