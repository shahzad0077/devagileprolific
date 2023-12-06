<div class="modal-header modalheaderforapend">
    @include('flags.modalheader')
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
    function searchmember(id) {
        var dataid = '{{ $data->id }}';
        $.ajax({
            type: "POST",
            url: "{{ url('dashboard/flags/searchmember') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id:id,
                dataid:dataid,
            },
            success: function(res) {
                $('#memberstoshow').html(res)
            },
            error: function(error) {
                
            }
        });
    }
    function savemember(id,dataid) {
        $.ajax({
            type: "POST",
            url: "{{ url('dashboard/flags/savemember') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id:id,
                dataid:dataid,
            },
            success: function(res) {
                $('.modalheaderforapend').html(res);
            },
            error: function(error) {
                console.log('Error updating card position:', error);
            }
        });
    }
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
            success: function(res) {
                $('.modalheaderforapend').html(res);
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