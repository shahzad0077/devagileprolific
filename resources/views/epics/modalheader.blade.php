<div class="row positionrelative">
    <div class="col-md-12">
        <h5 class="modal-title newmodaltittle marginleftthirty" id="create-epic">
            <img src="{{ url('public/assets/svg/epicheaderheader.svg') }}">{{ $data->epic_name }}
        </h5>
    </div>
    <div class="col-md-12 marginleftthirty newmodalsubtittle">
        <p>Organization/Business Unit/Value Stream/Portfolio</p>
    </div>
    <div class="col-md-12 displayflex">
        <div class="btn-group epicheaderborderleft">
            <button type="button" class="btn btn-default statuschangebutton" id="showboardbutton">
                @if($data->epic_status == 'To Do')
                    To Do
                @endif
                @if($data->epic_status == 'In progress')
                    In Progress
                @endif
                @if($data->epic_status == 'Done')
                    Done
                @endif
            </button>
            <button type="button" class="statuschangebuttonarrow btn btn-danger dropdown-toggle dropdown-toggle-split archivebeardcimbgbutton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="{{url('public/assets/svg/arrow-down-white.svg')}}" width="20">
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu">
                @if($data->epic_status == 'To Do')
                    <a class="dropdown-item" onclick="changeflagstatus('In progress',{{$data->id}})" href="javascript:void(0)">In Progress</a>
                    <a class="dropdown-item" onclick="changeflagstatus('Done',{{$data->id}})" href="javascript:void(0)">Done</a>
                @endif
                @if($data->epic_status == 'In progress')
                    <a class="dropdown-item" onclick="changeflagstatus('To Do',{{$data->id}})" href="javascript:void(0)">To Do</a>
                    <a class="dropdown-item" onclick="changeflagstatus('Done',{{$data->id}})" href="javascript:void(0)">Done</a>
                @endif
                @if($data->epic_status == 'Done')
                    <a class="dropdown-item" onclick="changeflagstatus('To Do',{{$data->id}})" href="javascript:void(0)">To Do</a>
                    <a class="dropdown-item" onclick="changeflagstatus('In progress',{{$data->id}})" href="javascript:void(0)">In Progress</a>
                @endif
            </div>
        </div>
        <a href="javascript:vodi(0)" class="epic-header-buttons" id="showboardbutton">
            <img src="{{url('public/assets/svg/btnteamsvg.svg')}}" width="20"> Add Team
        </a>
        <a href="javascript:vodi(0)" class="epic-header-buttons" id="showboardbutton">
            <img src="{{url('public/assets/svg/btnflagsvg.svg')}}" width="20"> Raise Flag
        </a>

        <div class="moverightside">
            <h1 class="epic-percentage">80 % Completed</h1>
            <div class="dashboard-card-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img  src="{{url('public/assets/svg/more.svg')}}" width="20">
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="javascript:void(0)">Action One</a>
                    <a class="dropdown-item" href="javascript:void(0)">Action Two</a>
                    <a class="dropdown-item" href="javascript:void(0)">Action Three</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="rightside" >
    <span onclick="maximizemodal()">
        <img  src="{{url('public/assets/svg/maximize.svg')}}">
    </span>
    <img data-dismiss="modal" class="closeimage" aria-label="Close" src="{{url('public/assets/svg/cross.svg')}}">
</div>