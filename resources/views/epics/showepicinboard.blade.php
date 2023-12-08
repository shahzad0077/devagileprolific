<div class="card" style="width:102.7%">
       <div class="card card-epic border-radius" style="margin-bottom:0px !important">
            <div class="card-header bg-white border-bottom-radius pt-2 pl-4 pr-4 pb-2">
	            <div>
	               <div class="d-flex flex-row justify-content-between align-items-center">
	                  <div class="d-flex flex-row">
	                     <div class="mr-2">
	                        <img src="{{ url('public/assets/svg/objectives/four.svg') }}">
	                     </div>
	                     <div>
	                        @if($e->epic_status == 'Done')
	                        <span class="badge-cs-small success">{{$e->epic_status}}</span>
	                        @endif
	                        @if($e->epic_status == 'In progress')
	                        <span class="badge-cs-small warning w-100">{{$e->epic_status}}</span>
	                        @endif 
	                        @if($e->epic_status == 'To Do')
	                        <span class="badge-cs-small bg-secondary ">{{$e->epic_status}}</span>
	                        @endif 
	                     </div>
	                  </div>
	                  <div>
	                     <div
	                        class="dropdown">
	                        <button class="btn-circle btn-tolbar dropdown-toggle bg-white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
	                        	<img src="{{ asset('public/assets/images/icons/dots.svg') }}">
	                        </button>
	                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
	                           <a class="dropdown-item" href="javascript:void(0)" onclick="editepic({{$e->id}})">Edit</a>
	                           <a class="dropdown-item" href="javascript:void(0)" onclick="DeleteEpic({{$e->id}},{{ $e->initiative_id }},{{ $e->key_id }},{{ $e->obj_id }})">Delete</a>
	                           <a class="dropdown-item" href="javascript:void(0)" onclick="editepicflag({{$e->id}})">Flag A Risk</a>
	                        </div>
	                     </div>
	                  </div>
	               </div>
	            </div>
            @php
            $flag = DB::table('flags')->where('epic_id' , $e->id)->first();
            @endphp
            @if($flag)
            @if($flag->flag_status != 'doneflag')
            <div>
               @if($flag->flag_type == 'Risk')
               <div class="d-flex flex-row align-items-center">
                  <div class="mr-1">
                     <img src="{{ url('public/assets/svg/svgrisk.svg') }}">
                  </div>
                  <div>
                     <span style="color:#fa9bcf !important; font-size:12px">{{$flag->flag_type}}</span>
                  </div>
               </div>
               @endif
               @if($flag->flag_type == 'Impediment')
               <div class="d-flex flex-row flex-row align-items-center">
                  <div class="mr-1">
                     <img src="{{ url('public/assets/svg/svgeight.svg') }}">
                  </div>
                  <div>
                     <span style="color:#fa9bcf !important; font-size:12px">{{$flag->flag_type}}</span>
                  </div>
               </div>
               @endif 
               @if($flag->flag_type == 'Blocker')
               <div class="d-flex flex-row flex-row align-items-center">
                  <div class="mr-1">
                     <img src="{{ url('public/assets/svg/svgnine.svg') }}">
                  </div>
                  <div>
                     <span style="color:#fa9bcf !important; font-size:12px">{{$flag->flag_type}}</span>
                  </div>
               </div>
               @endif 
               @if($flag->flag_type == 'Action')
               <div class="d-flex flex-row flex-row align-items-center">
                  <div class="mr-1">
                     <img src="{{ url('public/assets/svg/svgten.svg') }}">
                  </div>
                  <div>
                     <span style="color:#fa9bcf !important; font-size:12px">{{$flag->flag_type}}</span>
                  </div>
               </div>
               @endif 
            </div>
            @endif
            @endif
         </div>
         @php
         $str = strlen($e->epic_name);
         $strl = strlen($e->epic_detail);
         @endphp
         <div
            class="card-body pt-3 pb-3">
            <h6
               class="title load-more" id="load-more{{$e->id}}"  style="line-height:15px">
               {{ \Illuminate\Support\Str::limit($e->epic_name,40, $end='') }}
               @if($str > 40)
               <a href="javascript:void(0);" onclick="loadmore({{$e->id}});" id="toggle-button{{$e->id}}" class="" style="font-size:10px;">More</a>
               @endif
            </h6>
            <h6
               class="title more-content" id="more-content{{$e->id}}"  style="line-height:15px;display:none">
               {{$e->epic_name}}
               <a href="javascript:void(0);" onclick="seeless({{$e->id}});" id="toggle-button-less{{$e->id}}" class="" style="font-size:10px;">Less</a>
            </h6>
            <p
               class="content show-read-more" id="show-read{{$e->id}}">
               {{ \Illuminate\Support\Str::limit($e->epic_detail,122, $end='') }}
               @if($strl > 122 )
               <a href="javascript:void(0);" onclick="loadmoretext({{$e->id}});" id="toggle-button-text{{$e->id}}" class="" style="font-size:10px;">More</a>
               @endif
            </p>
            <p
               class="content show-read-more-text" id="show-read-more{{$e->id}}" style="display:none">
               {{$e->epic_detail}}
               <a href="javascript:void(0);" onclick="seelesstext({{$e->id}});" id="toggle-button-less-text{{$e->id}}" class="" style="font-size:10px">Less</a>
            </p>
            <div
               class="progress">
               <div  @if($e->epic_status == 'Done') class="progress-bar bg-primary" @endif @if($e->epic_status == 'In progress') class="progress-bar bg-warning" @endif @if($e->epic_status == 'To Do') class="progress-bar bg-success" @endif
               role="progressbar"
               style="width: {{$e->epic_progress}}%;"
               aria-valuenow="70"
               aria-valuemin="0"
               aria-valuemax="100" id="progepic{{$e->id}}">
            </div>
         </div>
      </div>
      @if($organization->type == 'stream')
      @foreach(DB::table('value_team')->where('org_id',$organization->id)->get() as $r)
      @if($e->team_id == $r->id)
      <div class="ml-5" style="font-size:12px;">
         <b>
         <img src="{{ url('public/assets/svg/objectives/five.svg') }}">
         {{$r->team_title}}
         </b>
      </div>
      @endif
      @endforeach
      @endif
      @if($organization->type == 'unit')
      @foreach(DB::table('unit_team')->where('org_id',$organization->id)->get() as $r)
      @if($e->team_id == $r->id)
      <div
         class="ml-5" style="font-size:12.552px;">
         <p>
            <img src="{{ url('public/assets/svg/objectives/six.svg') }}">
            <span class="ml-1">{{$r->team_title}}</span>
         </p>
      </div>
      @endif
      @endforeach
      @endif
      @if($organization->type == 'BU')
      @foreach(DB::table('unit_team')->where('org_id',$organization->org_id)->get() as $r)
      @if($e->team_id == $r->id)
      <div
         class="ml-5" style="font-size:12.552px;">
         <p>
            <img src="{{ url('public/assets/svg/objectives/six.svg') }}">
            <span class="ml-1">{{$r->team_title}}</span>
         </p>
      </div>
      @endif
      @endforeach
      @endif
      @if($organization->type == 'VS')
      @foreach(DB::table('value_team')->where('org_id',$organization->org_id)->get() as $r)
      @if($e->team_id == $r->id)
      <div
         class="ml-5" style="font-size:12.552px;">
         <p>
            <img src="{{ url('public/assets/svg/objectives/seven.svg') }}">
            <span class="ml-1">{{$r->team_title}}</span>
         </p>
      </div>
      @endif
      @endforeach
      @endif
      <div
         class="card-footer bg-white border-none border-top-1px">
         <div
            class="d-flex flex-row justify-content-between">
            <div>
               <span>{{ \Carbon\Carbon::parse($e->epic_start_date)->format('M d')}}</span>
            </div>
            <div>
               <span>{{ \Carbon\Carbon::parse($e->epic_end_date)->format('M d')}}</span>
            </div>
         </div>
      </div>
   </div>
	</div>