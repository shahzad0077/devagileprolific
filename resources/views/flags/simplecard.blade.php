<div class="card-body">
    <div class="d-flex flex-column">
        <div class="d-flex flex-row" onclick="editflag({{$r->id}})">
            <div class="d-flex flex-row mb-2">
                @if($r->epic_id)
                <a href="javascript:void(0)">
                    <img src="{{ url('public/assets/svg/arrow.svg') }}">
                     EPIC{{ $r->epic_id }}
                </a>
                @endif
            </div>
            @php
                $check_escalate = DB::table('escalate_cards')->where('flag_id' , $r->id)
            @endphp
            @if($check_escalate->count() > 0)
                @if(DB::table('flags')->where('escalate' , $check_escalate->first()->id)->first()->flag_status == 'doneflag')
                    <div class="un-blocked ml-2">
                        <img src="{{ url('public/assets/svg/unblocked.svg') }}">
                        Unblocked
                    </div>
                @endif
            @endif
        </div>
        @if($r->archived == 1)
        <a onclick="unarchiveflag({{$r->id}})" href="javascript:void(0)">
            Un Archived
        </a>
        @endif

        @if($r->escalate)
        <a href="javascript:void(0)">
            Escalated Flag
        </a>
        @endif
        @php
            $str = strlen($r->flag_title);
            $strl = strlen($r->flag_description);
        @endphp
        <div onclick="editflag({{$r->id}})">
            <h5>
                {{ \Illuminate\Support\Str::limit($r->flag_title,40, $end='') }}
                @if($str > 40)
                    <a href="javascript:void(0);" onclick="loadmore({{$r->id}});" id="toggle-button{{$r->id}}" class="" style="font-size:10px;">More</a>
                @endif
            </h5>
        </div>
        <div onclick="editflag({{$r->id}})">
            <p class="content show-read-more" id="show-read{{$r->id}}">
               {{ \Illuminate\Support\Str::limit(strip_tags($r->flag_description),122, $end='') }}
                @if($strl > 122 )
                <a href="javascript:void(0);" onclick="loadmoretext({{$r->id}});" id="toggle-button-text{{$r->id}}" class="" style="font-size:10px;">More</a>
                @endif

            </p>
            <p class="content show-read-more-text" id="show-read-more{{$r->id}}" style="display:none">
                {{$r->flag_description}}
                <a href="javascript:void(0);" onclick="seelesstext({{$r->id}});" id="toggle-button-less-text{{$r->id}}" class="" style="font-size:10px">Less</a>
            </p>
        </div>
        <div class="d-flex flex-row justify-content-between align-items-center">
            <div class="d-flex flex-row align-items-center">
                @if(DB::table('flag_members')->where('flag_id' , $r->id)->first())
                <div class="d-flex flex-row align-items-center image-cont pr-3">
                    <div class="pr-1">
                        @php
                            $member_id = DB::table('flag_members')->where('flag_id' , $r->id)->first();
                            $user = DB::table('members')->where('id' , $member_id->member_id)->first();
                        @endphp
                        @if($user->image != NULL)
                        <img class="user-image" src="{{asset('public/assets/images/'.$user->image)}}" alt="Example Image">
                        @else
                        <div class="namecountersmallforsimplecard">{{ substr($user->name, 0, 1); }}</div>
                        @endif
                    </div>
                    <div>
                        {{ $user->name }}
                    </div>
                </div>
                @endif
                <div class="vertical-line pr-2">
                </div>
                <div class="d-flex flex-row align-items-center">
                    <div class="pr-1">
                        <small>{{ DB::Table('flag_comments')->where('flag_id' , $r->id)->where('type' , 'comment')->count() }}</small>
                    </div>
                    <div>
                        <img src="{{ url('public/assets/svg/comments.svg') }}">
                    </div>
                </div>
            </div>
            <div class="d-flex flex-row">
                @if($r->board_type != 'unit')
                    @php
                        $checkescalate = DB::table('escalate_cards')->where('flag_id' , $r->id)->count();
                    @endphp
                    @if($checkescalate > 0)
                    <div>
                        <button style="background-color: #3661ec !important;" class="btn btn-circle btn-tolbar bg-transparent">
                            <img src="{{ url('public/assets/svg/uparrow-white.svg') }}">
                        </button>
                    </div>
                    @else
                    <div>
                        <button onclick="escalateflag({{$r->id}})" class="btn btn-circle btn-tolbar bg-transparent">
                            <img src="{{ url('public/assets/svg/uparrow.svg') }}">
                        </button>
                    </div>
                    @endif
                @endif
                <div>
                    <div class="dropdown d-flex">
                        <button class="btn btn-circle dropdown-toggle btn-tolbar bg-transparent" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ url('public/assets/svg/dropdowndots.svg') }}">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @if($r->archived == 1)
                            <a class="dropdown-item" onclick="unarchiveflag({{$r->id}})" href="javascript:void(0)">Un Archive</a>
                            @else
                            <a class="dropdown-item" onclick="archiveflag({{$r->id}})" href="javascript:void(0)">Archive</a>
                            @endif
                            <a class="dropdown-item" onclick="editflag({{$r->id}})" href="javascript:void(0)">Edit</a>
                            <a class="dropdown-item" onclick="deleteflag({{$r->id}})" href="javascript:void(0)">Delete</a>
                            @if($r->board_type != 'unit')
                                @if($checkescalate > 0)
                                    <a class="dropdown-item" href="javascript:void(0)">Escalated</a>
                                @else
                                    <a onclick="escalateflag({{$r->id}})" class="dropdown-item" href="javascript:void(0)">Escalate</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>