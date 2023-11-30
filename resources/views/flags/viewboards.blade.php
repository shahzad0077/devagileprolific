<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
        <div class="content d-flex flex-column flex-column-fluid">
            <!-- begin page Content -->
            <div class="container-fluid py-7" style="width: 96%; margin: 0px auto;">
                @if (session('message'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Success!</strong> {{ session('message') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div id="todo" class="col-md-4 kanban-column">
                                        <div class="card bg-light-gray shadow-none">
                                            <div class="card-body pt-3">
                                                <div class="kanban-header">
                                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                                        <div class="d-flex flex-column">
                                                            <div>
                                                                <h4>To Do</h4>
                                                                <small>Subtitle goes here</small>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <button onclick="toggleSearch('todo')" class="btn btn-circle">
                                                                <img src="{{ url('public/assets/images/searchiconsvg.svg') }}">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kanban-search-bar">
                                                    <input onkeyup="searchflag(this.value,'todoflag')" type="text" class="form-control input-sm" placeholder="Search...">
                                                </div>
                                                <div class="kanban-content" id="todoflag">
                                                    @foreach($todoflag as $r)
                                                        @include('flags.card')
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="in-progress" class="col-md-4 kanban-column">
                                        <div class="card bg-light-gray shadow-none">
                                            <div class="card-body pt-3">
                                                <div class="kanban-header">
                                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                                        <div class="d-flex flex-column">
                                                            <div>
                                                                <h4>In Progress</h4>
                                                                <small>Subtitle goes here</small>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <button onclick="toggleSearch('in-progress')" class="btn btn-circle">
                                                                <img src="{{ url('public/assets/images/searchiconsvg.svg') }}">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kanban-search-bar">
                                                    <input onkeyup="searchflag(this.value,'inprogress')" type="text" class="form-control input-sm" placeholder="Search...">
                                                </div>
                                                <div class="kanban-content"  id="inprogress">
                                                    @foreach($inprogress as $r)
                                                        @include('flags.card')
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="done" class="col-md-4 kanban-column">
                                        <div class="card bg-light-gray shadow-none">
                                            <div class="card-body pt-3">
                                                <div class="kanban-header">
                                                    <div class="d-flex flex-row justify-content-between align-items-center">
                                                        <div class="d-flex flex-column">
                                                            <div>
                                                                <h4>Done</h4>
                                                                <small>Subtitle goes here</small>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <button onclick="toggleSearch('done')" class="btn btn-circle">
                                                                <img src="{{ url('public/assets/images/searchiconsvg.svg') }}">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kanban-search-bar">
                                                    <input onkeyup="searchflag(this.value,'doneflag')" type="text" class="form-control input-sm" placeholder="Search...">
                                                </div>
                                                <div class="kanban-content" id="doneflag">
                                                    @foreach($doneflag as $r)
                                                        @include('flags.card')
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page content -->
        </div>
    </div>
</div>
<script type="text/javascript">
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
</script>