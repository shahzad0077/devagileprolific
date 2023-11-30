<!-- Parent Collapsible -->
@if(count($objective) > 0)
@foreach($objective as $obj)

@php
$keyResultcount  = DB::table('key_result')->where('obj_id',$obj->id)->count();
$keyweightcounte = DB::table('key_result')->where('obj_id',$obj->id)->sum('weight');
@endphp
<div class="card bg-transparent shadow-none">
    <div class="card-header objective-header active-header bg-white border-bottom" id="parentHeading">
        <div class="d-flex flex-row header-objective align-items-center"
            data-toggle="collapse" data-target="#nestedCollapsible{{$obj->id}}">
            <div class="title">
                <h5 data-toggle="tooltip" data-placement="top" data-original-title="Objective">
                    <div class="d-flex flex-row align-items-center">
                        <div>
                            <img src="{{ url('public/assets/svg/svgone.svg') }}">
                            </svg>
                        </div>
                        <div class="ml-2">
                            {{$obj->objective_name}}
                        </div>
                    </div>
                </h5>
            </div>
            <div class="d-flex flex-row content align-items-center">
                <div class="content-item">
                    <p>{{$keyResultcount}} Key Results</p>
                </div>
                <div class="content-item">
                    <p>{{ \Carbon\Carbon::parse($obj->start_date)->format('M d')}} - {{ \Carbon\Carbon::parse($obj->end_date)->format('M d')}}</p>
                </div>
                <div class="content-item">
                    @if($obj->status == 'In progress')
                    <span class="badge-cs warning" style="width:80%">In progress</span>
                    @endif
                    @if($obj->status == 'Done')
                    <span class="badge-cs success">Done</span>
                    @endif
                    @if($obj->status == 'To Do')
                    <span class="badge-cs bg-secondary">To Do</span>
                    @endif

                </div>
                
                 
                
                   <div class="content-item" style="width:10%">
                        <div class="d-flex flex-row progress-section">
                            <!-- <div class="d-flex justify-content-between">
                                <span class="tasks"></span>
                                @if($obj->q_obj_prog > 0)
                                <span class="completion" id="obj_comp_q{{$obj->id}}">{{$obj->q_obj_prog}}% Completed</span>
                                @else
                                <span class="completion" id="obj_comp_q{{$obj->id}}">0% Completed</span>
                                @endif
                            </div> -->
                            
                            @if($obj->q_obj_prog > 0)
                            <div role="progressbar" id="obj_comp_q{{$obj->id}}" aria-valuenow="{{$obj->q_obj_prog}}" aria-valuemin="0" aria-valuemax="100" style="--value:{{round($obj->q_obj_prog,0)}}"></div>
                            @else
                            <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="--value:0"></div>
                            @endif

                        </div>
                    </div>
                
                <div class="content-item" style="width:10%">
                       
                           @if($obj->obj_prog > 0)
                            <div role="progressbar" id="obj_prog{{$obj->id}}" aria-valuenow="{{$obj->obj_prog}}" aria-valuemin="0" aria-valuemax="100" style="--value:{{round($obj->obj_prog,0)}}"></div>
                            @else
                            <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="--value:0"></div>
                            @endif
                </div>
                 
            </div>
              @if($keyweightcounte > 0)
                    @if($keyweightcounte > 100)
                    <div class=" text-danger w-25" role="">
                      <small>Adjust Key Weight to 100 ({{$keyweightcounte}})</small>
                    </div>
                    @endif
                     @if($keyweightcounte < 100)
                    <div class=" text-danger" role="">
                     <small>Adjust Key Weight to 100  ({{$keyweightcounte}})</small>
                    </div>
                    @endif
                    @endif
                    
                     @php
                    $objedit = preg_replace('/[^\p{L}\p{N}\s]/u', '',$obj->detail);
                    $trimmedStringobj = trim($objedit);
                    @endphp
            <div class="action ml-0">
                <button class="btn btn-icon btn-circle btn-tolbar ml-auto " onclick="editobjective({{$obj->id}},'{{$obj->objective_name}}','{{$obj->start_date}}','{{$obj->end_date}}','{{$trimmedStringobj}}','{{$obj->status}}')" data-toggle="modal" data-target="#edit-objective">
                    <img src="{{ asset('public/assets/images/icons/edit.svg') }}" alt="Edit"
                        style="border-radius: 50%; width: 18px; height: 18px;">
                </button>
                <button class="btn btn-icon btn-circle btn-tolbar delete-obj mr-2" onclick="deleteobj({{$obj->id}})" data-toggle="modal" data-target="#delete-objective">
                    <img src="{{ asset('public/assets/images/icons/delete.svg') }}" alt="Delete"
                        style="border-radius: 50%; width: 18px; height: 18px;">
                </button>
            </div>
        </div>
    </div>
    
    <div id="nestedCollapsible{{$obj->id}}" class="collapse">
        <div class="card-body p-0">
            <!-- begin Key Results -->
            <div>
                <!-- begin Item -->
                @php
                $keyResult  = DB::table('key_result')->where('obj_id',$obj->id)->get();
                @endphp

                <div class="row">
                    <div class="col-md-12">
                        @if(count($keyResult) > 0)
                        @foreach($keyResult as $key)

                        
                            @php
                            $initiativeResultCount  = DB::table('initiative')->where('key_id',$key->id)->count();
                            $initiativeweightcount = DB::table('initiative')->where('key_id',$key->id)->sum('initiative_weight');
                            @endphp
                        <div class="card bg-transparent shadow-none">
                            <div class="card-header keyresult-header bg-light-gray">
                                <div class="d-flex flex-row justify-content-between header-objective align-items-center"
                                    data-toggle="collapse" data-target="#key-result{{$key->id}}">
                                    <div class="title ">
                                        <h5 data-toggle="tooltip" data-placement="top" data-original-title="Key Result">
                                            <div class="d-flex flex-row align-items-center">
                                                <div>
                                                    <img src="{{ url('public/assets/svg/svgtwo.svg') }}">
                                                </div>
                                                <div class="ml-2">
                                                    {{$key->key_name}}
                                                </div>
                                            </div>
                                        </h5>
                                    </div>
                                    <div
                                        class="d-flex flex-row content align-items-center">
                                        <div class="content-item">
                                            <p style="margin-left:-9px">{{$initiativeResultCount}} Initiatives</p>
                                        </div>
                                        <div class="content-item">
                                            <p>{{ \Carbon\Carbon::parse($key->key_start_date)->format('M d')}} - {{ \Carbon\Carbon::parse($key->key_end_date)->format('M d')}}</p>
                                        </div>
                                        <div class="content-item">
                                            
                                           
                                            
                                              @if($key->key_status == 'In progress')
                                                <span class="badge-cs warning " style="width:80%">In progress</span>
                                                @endif
                                                @if($key->key_status == 'Done')
                                                <span class="badge-cs success">Done</span>
                                                @endif
                                                @if($key->key_status == 'To Do')
                                                <span class="badge-cs bg-secondary">To Do</span>
                                                @endif

                                        </div>
                                        
                                    <div class="content-item" style="width:10%">
                                            
                           @if($key->q_key_prog > 0)
                            <div role="progressbar" id="qkeycomp{{$key->id}}" aria-valuenow="{{$key->q_key_prog}}" aria-valuemin="0" aria-valuemax="100" style="--value:{{round($key->q_key_prog,0)}}"></div>
                            @else
                            <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="--value:0"></div>
                            @endif            
                                            
                                           
                                </div>
                                        
                                        <div class="content-item" style="width:10%">
                                            
                                                              
                           @if($key->key_prog > 0)
                            <div role="progressbar" id="keyprog{{$key->id}}" aria-valuenow="{{$key->key_prog}}" aria-valuemin="0" aria-valuemax="100" style="--value:{{round($key->key_prog,0)}}"></div>
                            @else
                            <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="--value:0"></div>
                            @endif 


                                </div>
                                
                                    </div>
                                    
                                      @if($initiativeweightcount > 0)
                                        @if($initiativeweightcount > 100)
                                        <div class=" text-danger w-25" role="">
                                          <small>Adjust Key Weight to 100 ({{$initiativeweightcount}})</small>
                                        </div>
                                        @endif
                                         @if($initiativeweightcount < 100)
                                        <div class=" text-danger" role="">
                                         <small>Adjust Key Weight to 100  ({{$initiativeweightcount}})</small>
                                        </div>
                                        @endif
                                        @endif
                                        
                                        @php
                                        $keyedit = preg_replace('/[^\p{L}\p{N}\s]/u', '',$key->key_detail);
                                        $trimmedStringkey = trim($keyedit);
                                        @endphp
                                    <div class="action ml-0">
                                        <button
                                            class="btn btn-icon btn-circle bg-white btn-tolbar ml-auto" onclick="editobjectivekey({{$key->id}},'{{$key->key_name}}','{{$key->key_start_date}}','{{$key->key_end_date}}','{{$trimmedStringkey}}','{{$key->weight}}','{{$obj->id}}')" data-toggle="modal" data-target="#edit-key-result">
                                            <img src="{{ asset('public/assets/images/icons/edit.svg') }}"
                                                alt="Edit"
                                                style="border-radius: 50%; width: 18px; height: 18px;">
                                        </button>
                                        <button class="btn btn-icon btn-circle bg-white btn-tolbar" onclick="deleteobjkey({{$key->id}},'{{$obj->id}}')" data-toggle="modal" data-target="#delete-objective-key">
                                            <img src="{{ asset('public/assets/images/icons/delete.svg') }}"
                                                alt="Delete"
                                                style="border-radius: 50%; width: 18px; height: 18px;">
                                        </button>
                                    </div>
                                </div>
                                
                                
                            </div>

                            @php
                            $initiativeResult  = DB::table('initiative')->where('key_id',$key->id)->get();
                            @endphp

                            <div id="key-result{{$key->id}}" class="collapse">
                                <div class="card-body p-0">
                                    <!-- begin Initiative -->
                                    <div>
                                        <!-- begin Item -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                @if(count($initiativeResult) > 0)
                                                @foreach($initiativeResult as $initiative)
                                                
                                                @php
                                                $InitiativeProgress = 0;
                                                $EpicCount;
                                                $EpicCount = DB::table('epics')->where('initiative_id',$initiative->id)->where('trash',NULL)->count();
                                                $monthIds = DB::table('epics')->where('initiative_id',$initiative->id)->pluck('id');

                                                    $epicData = [];
                                                    foreach ($monthIds as $monthId) {
                                                        $epicData[] = $monthId;
                                                    }
                                                   $EpicStory  = DB::table('epics_stroy')->whereIn('epic_id',$epicData)->sum('progress');
                                                   if($EpicCount > 0)
                                                   {
                                                   $InitiativeProgress = round($EpicStory/$EpicCount,2);
                                                   }else
                                                   {
                                                   $InitiativeProgress = 0;
                                                   }
                                             
                                                   @endphp

                                                <div class="card bg-transparent shadow-none">
                                                    <div class="card-header initiative-header"
                                                        style="background: #f9   f9f9 !important;">
                                                        <div class="d-flex flex-row justify-content-between header-objective align-items-center"
                                                            data-toggle="collapse"
                                                            data-target="#initiative{{$initiative->id}}" onclick="handleDivClick({{$initiative->id}})">
                                                            <div class="title" >
                                                                <h5 data-toggle="tooltip" data-placement="top" data-original-title="initiative">
                                                                    <div class="d-flex flex-row align-items-center">
                                                                        <div>
                                                                            <img src="{{ asset('public/assets/svg/svgthree.svg') }}">
                                                                        </div>
                                                                        <div class="ml-2">
                                                                            {{$initiative->initiative_name}}
                                                                        </div>
                                                                    </div>
                                                                </h5>
                                                            </div>
                                                            <div
                                                                class="d-flex flex-row content align-items-center" >
                                                                <div class="content-item">
                                                                    <p style="margin-left:-38px">{{$EpicCount}} Epics</p>
                                                                </div>
                                                                <div class="content-item">
                                                                    <p>{{ \Carbon\Carbon::parse($initiative->initiative_start_date)->format('M d')}} - {{ \Carbon\Carbon::parse($initiative->initiative_end_date)->format('M d')}}</p>
                                                                </div>
                                                                <div class="content-item">
                                                                                 
                                                                      @if($initiative->initiative_status == 'In progress')
                                                                        <span class="badge-cs warning" style="width:80%">In progress</span>
                                                                        @endif
                                                                        @if($initiative->initiative_status == 'Done')
                                                                        <span class="badge-cs success">Done</span>
                                                                        @endif
                                                                        @if($initiative->initiative_status == 'To Do')
                                                                        <span class="badge-cs bg-secondary">To Do</span>
                                                                        @endif
                                                                </div>
                                                                
                                                             
                                                                
                                                                         <div class="content-item" style="width:10%">

                                                                    
                                                                    @if($initiative->q_initiative_prog > 0)
                                                                    <div role="progressbar" id="qcomp{{$initiative->id}}" aria-valuenow="{{$initiative->q_initiative_prog}}" aria-valuemin="0" aria-valuemax="100" style="--value:{{round($initiative->q_initiative_prog,0)}}"></div>
                                                                    @else
                                                                    <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="--value:0"></div>
                                                                    @endif  
                                                                                                                             
                                                                </div>
                                                                
                                                                
                                                                <div class="content-item" style="width:10%">
                                                                
                                                                @if($initiative->initiative_prog > 0)
                                                                <div role="progressbar" id="proginit{{$initiative->id}}" aria-valuenow="{{$initiative->initiative_prog}}" aria-valuemin="0" aria-valuemax="100" style="--value:{{round($initiative->initiative_prog,0)}}"></div>
                                                                @else
                                                                <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="--value:0"></div>
                                                                @endif 
                                                                </div>
                                                            </div>
                                                            
                                                            @php
                                                            $initedit = preg_replace('/[^\p{L}\p{N}\s]/u', '',$initiative->initiative_detail);
                                                            $trimmedStringinit = trim($initedit);
                                                            @endphp
                            
                                                            <div class="action ml-0">
                                                                <button
                                                                    class="btn btn-icon btn-circle bg-white btn-tolbar ml-auto" onclick="editinitiative({{$initiative->id}},'{{$initiative->initiative_name}}','{{$initiative->initiative_start_date}}','{{$initiative->initiative_end_date}}','{{$trimmedStringinit}}','{{$initiative->initiative_weight}}','{{$key->id}}','{{$obj->id}}')" data-toggle="modal" data-target="#edit-initiative">
                                                                    <img src="{{ asset('public/assets/images/icons/edit.svg') }}"
                                                                        alt="Edit"
                                                                        style="border-radius: 50%; width: 18px; height: 18px;">
                                                                </button>
                                                                <button
                                                                    class="btn btn-icon btn-circle bg-white btn-tolbar" onclick="deletekeyinitiative({{$initiative->id}},'{{$key->id}}','{{$obj->id}}')" data-toggle="modal" data-target="#delete-initiative-key">
                                                                    <img src="{{ asset('public/assets/images/icons/delete.svg') }}"
                                                                        alt="Delete"
                                                                        style="border-radius: 50%; width: 18px; height: 18px;">
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @php
                                                    $quarter  = DB::table('quarter')->where('initiative_id',$initiative->id)->get();
                                                    @endphp
                                                    <div id="initiative{{$initiative->id}}" class="collapse" >
                                                             
                                                    <div class="container-fluid py-7" style="width: 96%; margin: 0px auto;">
                                                        <div class="row">
                                                        <div class="col-md-12">
                                                        <div class="card">
                                                        <div class="card-body" style="overflow-x:auto">
                                                            <div class="board-kanban">
                                                                <div class="container-scroll" id="container-scroll-{{$initiative->id}}">
                                                                @if(count($quarter) > 0)    
                                                                @foreach($quarter as $q)
                                                                @php
                                                                   $quarterMonth  = DB::table('quarter_month')->where('quarter_id',$q->id)->get();
                                                                   $quarterMonthCount  = DB::table('quarter_month')->where('quarter_id',$q->id)->count();
                                                                  @endphp
                                                                   @if($quarterMonthCount > 0) 
                                                                        <div id="section-{{$initiative->id}}" class="section-scroll">
                                                                        <div
                                                                            class="card bg-transparent shadow-none">
                                                                            <div class="row">
                                                                                <div
                                                                                    class="col-md-12">
                                                                                    <div
                                                                                        class="card-header bg-white align-items-center">
                                                                                        <div
                                                                                            class="d-flex justify-content-between">
                                                                                            <div>
                                                                                                <button
                                                                                                     onclick="shiftLeft({{$initiative->id}})"
                                                                                                    class="btn-circle btn-tolbar"><img
                                                                                                        src="{{asset('public/assets/images/icons/angle-left.svg')}}"></button>
                                                                                            </div>
                                                                                            <div>
                                                                                                <h3
                                                                                                    class="title" >
                                                                                                    {{$q->quarter_name}}  {{$q->year}}
                                                                                
                                                                                                </h3>
                                                                                            </div>
                                                                                            <div>
                                                                                                <button
                                                                                                    onclick="shiftRight({{$initiative->id}})"
                                                                                                    class="btn-circle btn-tolbar"><img
                                                                                                        src="{{asset('public/assets/images/icons/angle-right.svg')}}"></button>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            @php
                                                                            $currentDate = \Carbon\Carbon::now();
                                                                            $currentYear = $currentDate->year;
                                                                            $currentMonth = $currentDate->month;
                                                                            $yearMonthString = $currentDate->format('Y');
                                                                            $yearMonth = $currentDate->format('F');
                                                                            $CurrentQuarter = '';
                                                                            $CurrentQuarter = DB::table('quarter_month')->where('initiative_id',$initiative->id)->where('month',$yearMonth)->where('year',$yearMonthString)->first();
                                                                            @endphp
                                                                            <div
                                                                                class="card-body p-0">
                                                                                <div class="board-body"
                                                                                    style="height:80vh">
                                                                                    <div
                                                                                        class="board-cards p-5" id="">
                                                                                        <div
                                                                                            id="scroller">
                                                                                            
                                                                                           @if(count($quarterMonth) > 0)    
                                                                                           @foreach($quarterMonth as $month)
                                                                                            @php
                                                                                            $epic  = DB::table('epics')->where('month_id',$month->id)->where('trash',NULL)->get();
                                                                                            @endphp
                                                                                            <div  @if($CurrentQuarter) @if($q->id < $CurrentQuarter->quarter_id) class="board-flex" @else class="board" @endif @endif   style="width:280px"
                                                                                                id="{{$month->id}}">
                                                                                                <header
                                                                                                    class="noselect">
                                                                                                    {{$month->month}}
                                                                                                </header>
                                                                                                @if(count($epic) > 0)
                                                                                                @foreach($epic as $e)
                                                                                                
                    
                                                                                                <div class="cards target"
                                                                                                   id="{{$e->id}}"
                                                                                                    draggable="true" >
                                                                                                    <div
                            class="card" style="width:102.7%">
                            <div
                               class="card card-epic border-radius" style="margin-bottom:0px !important">
                               <div class="card-header bg-white border-bottom-radius pt-2 pl-4 pr-4 pb-2">
                                  @include('objective.includes.epictoogle')
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
                                        <img src="{{ url('public/assets/svg/svgsix.svg') }}">
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
                                    <img src="{{ url('public/assets/svg/svgteam.svg') }}">
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
                                    <img src="{{ url('public/assets/svg/svgfive.svg') }}">
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
                                    <img src="{{ url('public/assets/svg/svgteam.svg') }}">
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
                    </div>
                    
                  
                    @endforeach
                    @endif
                       
                  <button
                        class="btn  btn-primary border-1 ml-3 no-drag" @if($CurrentQuarter) @if($q->id < $CurrentQuarter->quarter_id) disabled @endif @endif onclick="addepicmonth({{$month->id}},'{{$month->month}}','{{$q->id}}','{{$initiative->id}}','{{$key->id}}','{{$obj->id}}')" data-toggle="modal" data-target="#create-epic-month" draggable="false">
                         Add Epics
                    </button>

                    
                </div>
                  
              
                @endforeach
                @endif
       
            </div>
        </div>
        <div
            class="d-flex flex-row-reverse zoom-btn-section">
            <div>
                <button
                    class="btn-circle btn-zoom-buttons zoom">
                    <img width="20px"
                        height="20px"
                        src="{{asset('public/assets/images/icons/search-zoom-in.svg')}}"
                        alt="zoom-In">
                </button>
            </div>
            <div
                class="mr-2">
                <button
                    class="btn-circle btn-zoom-buttons zoom-out">
                    <img width="20px"
                        height="20px"
                        src="{{asset('public/assets/images/icons/search-zoom-out.svg')}}"
                        alt="zoom-Out">
                </button>
            </div>
            <div
                class="mr-2">
                <button
                    class="btn-circle btn-zoom-buttons zoom-init">
                    <img width="20px"
                        height="20px"
                        src="{{asset('public/assets/images/icons/maximize.svg')}}"
                        alt="zoom-Out">
                </button>
            </div>
        </div>
    </div>
</div>

</div>
</div>
@endif
@endforeach
@endif

                                                                </div>
                                                            </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                              @php
                                              $initiativeweightcounte = DB::table('initiative')->where('key_id',$key->id)->sum('initiative_weight');
                                              $monthnumber = DB::table('organization')->where('user_id',Auth::id())->first();
                                              $number = 0;
                                              if($monthnumber)
                                              {
                                              $number = $monthnumber->month;
                                              }else
                                              {
                                               $number = 0;
                                              }

                                              @endphp
                                        <!-- end Item -->
                                        <!-- begin Add New -->
                                        <div class="row py-2">
                                            <div class="col-md-12">
                                                <a href="" data-toggle="modal" onclick="initiative({{$key->id}},'{{$obj->id}}','{{$initiativeweightcounte}}','{{$key->key_start_date}}','{{$key->key_end_date}}')"
                                                    data-target="#create-initiative"
                                                    class="col-action"><img
                                                        src="{{ asset('public/assets/images/icons/add-circle.svg') }}"
                                                        class="mr-1"> Add Initiative</a>
                                            </div>
                                        </div>
                                        <!-- end Add New -->
                                    </div>
                                    <!-- end Initiative -->
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                <!-- end Item -->
                <!-- begin Add New -->
                @php
                $keyweightcount = DB::table('key_result')->where('obj_id',$obj->id)->sum('weight');
                @endphp
                
                <div class="row py-2">
                    <div class="col-md-12">
                        <a href="" onclick="objective({{$obj->id}},'{{$keyweightcount}}','{{$obj->start_date}}','{{$obj->end_date}}')" data-toggle="modal" data-target="#create-key-result"
                            class="col-action key_obj"><img
                                src="{{ asset('public/assets/images/icons/add-circle.svg') }}"
                                class="mr-1"> Add Key Result</a>
                    </div>
                </div>
                <!-- end Add New -->
            </div>
            <!-- end Key Results -->
        </div>
    </div>
</div>
@endforeach
@else
No objective found.
@endif




<script>
var containers = Array.from(document.getElementsByClassName("board"));
var drake = dragula(containers);
drake.on("drop", function(el, target, source, sibling) {
    var parentElId = target.id;
    var droppedElId = el.id;
    $.ajax({
        type: "POST",
        url: "{{ url('change-epic-month') }}",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            parentElId: parentElId,
            droppedElId: droppedElId,
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