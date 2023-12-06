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
            <div id="members">
                @foreach(DB::table('flag_members')->where('flag_id' , $data->id)->get() as $r)
                @php
                    $member = DB::table('members')->where('id' , $r->member_id)->first();
                @endphp
                <div class="member-list-image">
                    @if($member->image)
                    <img src="{{ url('public/assets/images') }}/{{ $member->image }}">
                    @else
                    <div class="namecountersmall">{{ substr($member->name, 0, 1); }}</div>
                    @endif
                </div>
                @endforeach
            </div>
            <div class="member-list-image memberlistposition">
                <img onclick="showmemberbox()" src="{{url('public/assets/svg/plussmember.svg')}}">
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
                                <input onkeyup="searchmember(this.value)" type="text" placeholder="Search Member" class="form-control" name="flag_title" id="objective-name" required>
                                <div class="membersearchiconforinput">
                                    <img src="{{ url('public/assets/images/searchiconsvg.svg') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="memberstoshow">
                        @foreach(DB::table('members')->where('org_user' , Auth::id())->limit(2)->get() as $r)
                        <div class="col-md-12 memberprofile" onclick="savemember({{$r->id}} , {{$data->id}})">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="memberprofileimage">
                                        @if($r->image)
                                        <img src="{{ url('public/assets/images') }}/{{ $r->image }}">
                                        @else
                                        <div class="namecounter">{{ substr($r->name, 0, 1); }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="membername">{{ $r->name }} {{ $r->last_name }}</div>
                                    <div class="memberdetail">{{ DB::table('users')->where('id' , $r->user_id)->first()->role }}</div>
                                </div>
                                <div class="col-md-2 text-center mt-3">
                                    @if(DB::table('flag_members')->where('flag_id' , $data->id)->where('member_id' , $r->id)->count() > 0)
                                    <img class="tickimage" src="{{ url('public/assets/svg/smalltick.svg') }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
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