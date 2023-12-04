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
<script type="text/javascript">
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
</script>