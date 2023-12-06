<div class="subheader py-2 py-lg-2 px-lg-8 subheader-solid breadcrums" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-start flex-column flex-wrap mr-2">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                Impediments Flags
            </h5>
            <!-- Breadcrum Items -->
           <div class="d-flex flex-row page-sub-titles">
                <div class="mr-2">
                    <a style="text-decoration: none;" href="{{ url('dashboard/organizations') }}">Dashboard</a>
                </div>
                @if($type == 'unit')
                <div class="mr-2">
                    <a style="text-decoration: none;" href="{{ url('dashboard/organization/Business-Units') }}">
                        Buisness Units
                    </a>
                </div>
                <div class="mr-2">
                    <a  href="{{url('dashboard/organization/'.$organization->slug.'/portfolio/'.$organization->type)}}" style="text-decoration: none;" >{{$organization->business_name}}</a>
                </div>
                <div class="mr-2">
                    <p>Impediments Flags</p>
                </div>
                @endif
                @if($type == 'stream')
                @php
                    $unit  = DB::table('business_units')->where('id' , $organization->unit_id)->first();
                @endphp
                <div class="mr-2">
                    <a style="text-decoration: none;" href="{{ url('dashboard/organization') }}/{{ $unit->slug }}/Value-Streams">Value Streams</a>
                </div>
                <div class="mr-2">
                    <a  href="{{url('dashboard/organization/'.$organization->slug.'/portfolio/'.$organization->type)}}" style="text-decoration: none;" >{{$organization->value_name}}</a>
                </div>
                <div class="mr-2">
                    <p>Impediments Flags</p>
                </div>
                @endif
                @if($type == 'BU')
                <div class="mr-2">
                    <a  href="{{url('dashboard/organization/'.$organization->slug.'/portfolio/'.$organization->type)}}" style="text-decoration: none;" >{{$organization->team_title}}</a>
                </div>
                <div class="mr-2">
                    <p>Impediments Flags</p>
                </div>
                @endif
            </div>
            <!--End Breadcrum Items -->
        </div>
        <!--end::Info-->
        <!--begin::Toolbar-->
        <div>
            <div class="btn-group">
              <button type="button" class="btn btn-default" style="border-top-right-radius:0px !important; border-bottom-right-radius:0px !important;" id="showboardbutton"> 
                    <img src="{{url('public/assets/images/icons/filter.svg')}}" width="20">
                    View All
                </button>
              <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split archivebeardcimbgbutton" style=""  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{url('public/assets/images/icons/angle-down.svg')}}" width="20">
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="javascript:void(0)" onclick="viewboards('all')">View All</a>
                <a class="dropdown-item" href="javascript:void(0)" onclick="viewboards('archived')">Archived</a>
              </div>
            </div>
            <button onclick="addnewflag({{ $organization->id }} , '{{$organization->type}}' , 'Impediment')" class="btn btn-primary">Add New</button>
            <input id="viewboards" value="all" type="hidden" name="">
        </div>
    </div>
</div>
<div class="modal" id="edit-epic" tabindex="-1" role="dialog" aria-labelledby="edit-epic" aria-hidden="true">
    <div class="modal-dialog modal-lg" id="modaldialog" role="document">
        <div class="modal-content newmodalcontent" id="newmodalcontent">
            
        </div>
    </div>
</div>
<div class="modal fade" id="deleteflagmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Impediments Flag</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" id="deleteflagform" action="{{ url('dashboard/flags/deleteflag') }}">
             @csrf   
            <input type="hidden" name="delete_id" id="deleteid">
            <div class="modal-body">
                Are you sure you want to Delete this Impediments Flag?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" id="deleteflagbutton" class="btn btn-danger btn-sm">Confirm</button>
            </div>
        </form>
      </div>
    </div>
</div>
<!-- MDB -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dragula@3.7.3/dist/dragula.min.js"></script>
<script>
function addnewflag(id,type,flag_type) {
    $.ajax({
        type: "POST",
        url: "{{ url('dashboard/flags/createimpediment') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id:id,
            type:type,
            flag_type:flag_type
        },
        success: function(res) {
            viewboards($('#viewboards').val());
            editflag(res);
        }
    });
}
function showmemberbox() {
    $('.memberadd-box').slideToggle();
}
function escalateflag(id) {
    $.ajax({
        type: "POST",
        url: "{{ url('dashboard/flags/escalateflag') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id:id,
        },
        success: function(res) {
            viewboards($('#viewboards').val())
        }
    });
}
function showepicdetails(id) {
    if(id == '')
    {
        $('#epicresult').html('')
    }
    $.ajax({
        type: "POST",
        url: "{{ url('dashboard/flags/showepicdetail') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id:id,
        },
        success: function(res) {
            $('#epicresult').html(res.message)
        },
        error: function(error) {
            console.log('Error updating card position:', error);
        }
    });
}
function loadmoretext(x){
    const toggleButton = document.getElementById("toggle-button-text" + x);
    const moreContent = document.getElementById("show-read-more" + x);
    const LoadmoreContent = document.getElementById("show-read" + x);
    toggleButton.addEventListener("click", function () {    
        $('#show-read-more' + x).show();
        $('#show-read' + x).hide();    
        
    });
}
function seelesstext(x){
    const toggleButton = document.getElementById("toggle-button-less-text" + x);
    const moreContent = document.getElementById("show-read-more" + x);
    const LoadmoreContent = document.getElementById("show-read" + x);
    toggleButton.addEventListener("click", function () {
        $('#show-read-more' + x).hide();
        $('#show-read' + x).show();
    });
}
var drakeflags = dragula([
    document.getElementById('todoflag'), 
    document.getElementById('inprogress'), 
    document.getElementById('doneflag')
]);


drakeflags.on("drop", function (el, target, source, sibling) {
    var parentElId = target.id;
    var droppedElId = el.id;
    // Perform additional operations or AJAX request here
    // Example: Update the position of the card using AJAX
    $.ajax({
        type: "POST",
        url: "{{ url('dashboard/flags/change-flag-status') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            parentElId:parentElId,
            droppedElId:droppedElId,
        },
        success: function(response) {
            console.log('Card position updated successfully.');
        },
        error: function(error) {
            console.log('Error updating card position:', error);
        }
    });
});

function toggleSearch(columnId) {
    var searchBar = document.getElementById(columnId).getElementsByClassName('kanban-search-bar')[0];
    searchBar.classList.toggle('kanban-search-bar-expanded');
}
function searchflag(value,id) {
    var organization = '{{ $organization->id }}';
    $.ajax({
        type: "POST",
        url: "{{ url('dashboard/flags/searchflag') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            value:value,
            id:id,
            organization_id:organization,
        },
        success: function(res) {
            $('#'+id).html(res);
        },
        error: function(error) {
            console.log('Error updating card position:', error);
        }
    });
}
function editflag(id) {
    var new_url="{{ url()->current() }}?flag="+id;
    window.history.pushState("data","Title",new_url);
    $.ajax({
        type: "POST",
        url: "{{ url('dashboard/flags/getflagmodal') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id:id,
        },
        success: function(res) {
            $('#newmodalcontent').html(res);
            $('#edit-epic').modal('show');
            showtab(id , 'general');
        },
        error: function(error) {
            console.log('Error updating card position:', error);
        }
    });
}
function archiveflag(id) {
    $.ajax({
        type: "POST",
        url: "{{ url('dashboard/flags/archiveflag') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id:id,
        },
        success: function(res) {
            viewboards($('#viewboards').val());
            editflag(id);
        },
        error: function(error) {
            console.log('Error updating card position:', error);
        }
    });
}
function unarchiveflag(id) {
    $.ajax({
        type: "POST",
        url: "{{ url('dashboard/flags/unarchiveflag') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id:id,
        },
        success: function(res) {
            viewboards($('#viewboards').val());
            editflag(id);
        },
        error: function(error) {
            console.log('Error updating card position:', error);
        }
    });
}
function deleteflag(id) {
    $('#deleteid').val(id);
    $('#deleteflagmodal').modal('show');
}
function maximizemodal() {
    $('#modaldialog').toggleClass('modalfullscreen')
    $('#edit-modal').css('padding-right' , '0px')
}
$('#deleteflagform').on('submit',(function(e) {
    $('#deleteflagbutton').html('<i class="fa fa-spin fa-spinner"></i>');
    e.preventDefault();
    var value = $('#deleteid').val();
    var formData = new FormData(this);
    $.ajax({
        type:'POST',
        url: $(this).attr('action'),
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: function(data){
            $('#deleteflagbutton').html('Confirm');
            $('#'+value).remove();
            $('#deleteflagmodal').modal('hide');
        }
    });
}));
function viewboards(id) {
    var slug = '{{ $organization->slug }}';
    $.ajax({
        type: "POST",
        url: "{{ url('dashboard/flags/viewboards') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id:id,
            slug:slug,
            type:'{{ $type }}',
        },
        success: function(res) {
            if(id == 'all')
            {
                $('#showboardbutton').html('<img src="{{url("public/assets/images/icons/filter.svg")}}" width="20"> View All');
                $('#viewboards').val('all')
            }
            if(id == 'archived')
            {
                $('#showboardbutton').html('<img src="{{url("public/assets/images/icons/filter.svg")}}" width="20"> Archived');
                $('#viewboards').val('archived')
            }
           $('#showboards').html(res);
        },
        error: function(error) {
            
        }
    });
}
$(document).ready(function() {
    $('#epics').select2({
        width: '100%'
    });
    @if(isset($_GET['flag']))
        editflag("{{ $_GET['flag'] }}")
    @endif
    $("#edit-epic").on('hidden.bs.modal', function(){
       if($('#flag_tittle').val() == '')
       {
            var cardid = $('#cardid').val();
            $('#'+cardid).remove();
            deleteflag($('#cardid').val())
       }
       var new_url="{{ url()->current() }}";
       window.history.pushState("data","Title",new_url);
    });
});
function searchepic(id) {
    var type = '{{ $type }}';
    var organizationid = '{{ $organization->slug }}';
    $.ajax({
        type: "POST",
        url: "{{ url('dashboard/flags/searchepic') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id:id,
            type:type,
            organizationid:organizationid,
        },
        success: function(res) {
            if(id == '')
            {
                $('.searchepic-box').hide();
            }else{
                $('.searchepic-box').show();
                $('.searchepic-box').html(res);
            }
            
        },
        error: function(error) {
            console.log('Error updating card position:', error);
        }
    });
}
</script>