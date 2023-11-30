
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                                      <rect width="32" height="32" rx="16" fill="#3699FF"/>
                                                      <path d="M25 16H21.4M10.6 16H7M16 10.6V7M16 25V21.4M23.2 16C23.2 19.9765 19.9765 23.2 16 23.2C12.0235 23.2 8.8 19.9765 8.8 16C8.8 12.0235 12.0235 8.8 16 8.8C19.9765 8.8 23.2 12.0235 23.2 16ZM18.7 16C18.7 17.4912 17.4912 18.7 16 18.7C14.5088 18.7 13.3 17.4912 13.3 16C13.3 14.5088 14.5088 13.3 16 13.3C17.4912 13.3 18.7 14.5088 18.7 16Z" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
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
                                            <!-- <div class="d-flex flex-row progress-section">
                                                <div class="d-flex justify-content-between">
                                                    <span class="tasks"></span>
                                                    <span class="completion" id="obj_comp{{$obj->id}}">{{round($obj->obj_prog,2)}}% Completed</span>
                                                </div>
                                            </div>
                                         
                                             <div class="progress">
                                                <div class="progress-bar bg-primay" id="obj_prog{{$obj->id}}"  role="progressbar" style="width:{{$obj->obj_prog}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                
                                                </div>
                                            </div> -->
                                            
                                                   @if($obj->obj_prog > 0)
                                                    <div role="progressbar" id="obj_prog{{$obj->id}}" aria-valuenow="{{$obj->obj_prog}}" aria-valuemin="0" aria-valuemax="100" style="--value:{{round($obj->obj_prog,0)}}"></div>
                                                    @else
                                                    <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="--value:0"></div>
                                                    @endif

                                            <!--<div class="custom-progress"   id="obj_prog{{$obj->id}}"  data-percentage="{{$obj->obj_prog}}" >-->
                                            <!--    <span class="custom-progress-left">-->
                                            <!--        <span class="custom-progress-bar" style="border-color:#3fe1a7;"></span>-->
                                            <!--    </span>-->
                                            <!--    <span class="custom-progress-right">-->
                                            <!--        <span class="custom-progress-bar" style="border-color:#3fe1a7;"></span>-->
                                            <!--    </span>-->
                                            <!--    <div class="custom-progress-value" id="obj_comp{{$obj->id}}">-->
                                            <!--        <div>-->
                                                      
                                            <!--             @if($obj->obj_prog > 0)-->
                                            <!--              <small>{{round($obj->obj_prog,2)}}%</small>-->
                                            <!--               @else-->
                                            <!--              <small >0%</small>-->
                                            <!--            @endif-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</div>-->

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
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                                                              <rect width="32" height="32" rx="16" fill="#3699FF"/>
                                                                              <path d="M19.5 13.5C19.5 13.1161 19.3535 12.7322 19.0607 12.4393C18.7678 12.1464 18.3839 12 18 12M18 18C20.4853 18 22.5 15.9853 22.5 13.5C22.5 11.0147 20.4853 9 18 9C15.5147 9 13.5 11.0147 13.5 13.5C13.5 13.7053 13.5137 13.9073 13.5404 14.1053C13.5841 14.4309 13.606 14.5937 13.5913 14.6967C13.5759 14.804 13.5564 14.8618 13.5035 14.9564C13.4527 15.0473 13.3633 15.1367 13.1843 15.3157L9.35147 19.1485C9.22176 19.2782 9.1569 19.3431 9.11052 19.4188C9.0694 19.4859 9.0391 19.559 9.02072 19.6356C9 19.7219 9 19.8136 9 19.9971V21.3C9 21.72 9 21.9301 9.08175 22.0905C9.15365 22.2316 9.26839 22.3463 9.40951 22.4183C9.56994 22.5 9.77996 22.5 10.2 22.5H12V21H13.5V19.5H15L16.1843 18.3157C16.3633 18.1367 16.4527 18.0473 16.5436 17.9965C16.6382 17.9436 16.696 17.9241 16.8033 17.9087C16.9063 17.894 17.0691 17.9159 17.3947 17.9596C17.5927 17.9863 17.7947 18 18 18Z" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                            </svg>
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
                                                                    <!--@if($key->key_status == 1)-->
                                                                    <!--<span class="badge-cs success">Running</span>-->
                                                                    <!--@else-->
                                                                    <!--<span class="badge-cs warning">Paused</span>-->
                                                                    <!--@endif-->
                                                                    
                                                                   
                                                                    
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
                                                                    <!--<div class="d-flex flex-row progress-section">-->
                                                                        
                                                                    <!--    <div class="d-flex justify-content-between">-->
                                                                    <!--        <span class="tasks"></span>-->
                                                                    <!--        @if($key->q_key_prog > 0)-->
                                                                    <!--        <span class="completion" id="qkeycomp{{$key->id}}">{{$key->q_key_prog}}% Completed</span>-->
                                                                    <!--        @else-->
                                                                    <!--        <span class="completion" id="qkeycomp{{$key->id}}">0% Completed</span>-->
                                                                    <!--        @endif-->
                                                                    <!--    </div>-->
                                                                    <!--</div>-->
                                                                    
                                                   @if($key->q_key_prog > 0)
                                                    <div role="progressbar" id="qkeycomp{{$key->id}}" aria-valuenow="{{$key->q_key_prog}}" aria-valuemin="0" aria-valuemax="100" style="--value:{{round($key->q_key_prog,0)}}"></div>
                                                    @else
                                                    <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="--value:0"></div>
                                                    @endif            
                                                                    
                                                    <!--    <div class="custom-progress" id="qkeycomp{{$key->id}}" data-percentage="{{$key->q_key_prog}}">-->
                                                    <!--    <span class="custom-progress-left">-->
                                                    <!--        <span class="custom-progress-bar" style="border-color:#3fe1a7;"></span>-->
                                                    <!--    </span>-->
                                                    <!--    <span class="custom-progress-right">-->
                                                    <!--        <span class="custom-progress-bar" style="border-color:#3fe1a7;"></span>-->
                                                    <!--    </span>-->
                                                    <!--    <div class="custom-progress-value">-->
                                                            
                                                    <!--        <div>-->
                                                    <!--            @if($key->q_key_prog > 0)-->
                                                    <!--            {{round($key->q_key_prog,2)}}%-->
                                                    <!--            @else-->
                                                    <!--            0%-->
                                                    <!--            @endif-->
                                                                
                                                                <!--<span>completed</span>-->
                                                    <!--        </div>-->
                                                    <!--    </div>-->
                                                    <!--</div>-->
                                                                   
                                                        </div>
                                                                
                                                                <div class="content-item" style="width:10%">
                                                                    <!-- <div class="d-flex flex-row progress-section">
                                                                        <div class="d-flex justify-content-between">
                                                                            <span class="tasks"></span>
                                                                            <span class="completion mr-1" id="keycomp{{$key->id}}">{{round($key->key_prog,2)}}% Completed</span>
                                                                        </div>
                                                                    </div>
                                                                     <div class="progress">
                                                                         <div class="progress-bar bg-primay" id="keyprog{{$key->id}}" role="progressbar" style="width:{{$key->key_prog}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                                             
                                                                         </div>
                                                                    </div> -->
                                                                    
                                                                                      
                                                   @if($key->key_prog > 0)
                                                    <div role="progressbar" id="keyprog{{$key->id}}" aria-valuenow="{{$key->key_prog}}" aria-valuemin="0" aria-valuemax="100" style="--value:{{round($key->key_prog,0)}}"></div>
                                                    @else
                                                    <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="--value:0"></div>
                                                    @endif 

                                                                    <!--<div class="custom-progress"   data-percentage="{{$key->key_prog}}"  id="keyprog{{$key->id}}" >-->
                                                                    <!--    <span class="custom-progress-left" >-->
                                                                    <!--        <span class="custom-progress-bar" style="border-color:#3fe1a7;"  ></span>-->
                                                                    <!--    </span>-->
                                                                    <!--    <span class="custom-progress-right">-->
                                                                    <!--        <span class="custom-progress-bar" style="border-color:#3fe1a7;"></span>-->
                                                                    <!--    </span>-->
                                                                    <!--    <div class="custom-progress-value" id="keycomp{{$key->id}}">-->
                                                                    <!--        <div >-->
                                                                    <!--            @if($key->key_prog > 0)-->
                                                                    <!--            <small>{{round($key->key_prog,2)}}%</small>-->
                                                                    <!--            @else-->
                                                                    <!--            <small>0%</small>-->
                                                                    <!--            @endif-->
                                                                    <!--        </div>-->
                                                                    <!--    </div>-->
                                                                    <!--</div>-->

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
                                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                                                                                                      <rect width="32" height="32" rx="16" fill="#3699FF"/>
                                                                                                      <path d="M18.4 19.6V21.6C18.4 22.3455 18.4 22.7183 18.2782 23.0123C18.1158 23.4043 17.8043 23.7158 17.4123 23.8782C17.1183 24 16.7455 24 16 24C15.2545 24 14.8817 24 14.5877 23.8782C14.1957 23.7158 13.8842 23.4043 13.7218 23.0123C13.6 22.7183 13.6 22.3455 13.6 21.6V19.6M18.4 19.6C20.5191 18.6741 22 16.4604 22 14C22 10.6863 19.3137 8 16 8C12.6863 8 10 10.6863 10 14C10 16.4604 11.4809 18.6741 13.6 19.6M18.4 19.6H13.6" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                                                                                                    </svg>
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
                                                                                            <!--@if($initiative->initiative_status == 1)-->
                                                                                            <!--<span-->
                                                                                            <!--    class="badge-cs warning">Paused</span>-->
                                                                                            <!--@else-->
                                                                                            <!--<span-->
                                                                                            <!--class="badge-cs success">Paused</span>-->
                                                                                            <!--@endif-->
                                                                                            
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

                                                                                            <!--<div-->
                                                                                            <!--    class="d-flex flex-row progress-section">-->
                                                                                            <!--    <div-->
                                                                                            <!--        class="d-flex justify-content-between">-->
                                                                                            <!--        <span-->
                                                                                            <!--            class="tasks"></span>-->
                                                                                            <!--        @if($initiative->q_initiative_prog > 0)    -->
                                                                                            <!--        <span class="completion mr-1"  id="qcomp{{$initiative->id}}" > {{$initiative->q_initiative_prog}}% Completed</span>-->
                                                                                            <!--        @else-->
                                                                                            <!--         <span class="completion mr-1"  id="qcomp{{$initiative->id}}" > 0% Completed</span>-->
                                                                                            <!--        @endif-->
                                                                                            <!--    </div>-->
                                                                                            <!--</div>-->
                                                                                            
                                                                                            @if($initiative->q_initiative_prog > 0)
                                                                                            <div role="progressbar" id="qcomp{{$initiative->id}}" aria-valuenow="{{$initiative->q_initiative_prog}}" aria-valuemin="0" aria-valuemax="100" style="--value:{{round($initiative->q_initiative_prog,0)}}"></div>
                                                                                            @else
                                                                                            <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="--value:0"></div>
                                                                                            @endif  
                                                                                            
                                                                                        <!--    <div class="custom-progress" id="qcomp{{$initiative->id}}" data-percentage="{{$initiative->q_initiative_prog}}">-->
                                                                                        <!--    <span class="custom-progress-left">-->
                                                                                        <!--        <span class="custom-progress-bar" style="border-color:#3fe1a7;"></span>-->
                                                                                        <!--    </span>-->
                                                                                        <!--    <span class="custom-progress-right">-->
                                                                                        <!--        <span class="custom-progress-bar" style="border-color:#3fe1a7;"></span>-->
                                                                                        <!--    </span>-->
                                                                                        <!--    <div class="custom-progress-value" id="qcomp{{$initiative->id}}">-->
                                                                                        <!--        <div>-->
                                                                                        <!--            @if($initiative->q_initiative_prog > 0)-->
                                                                                        <!--            {{round($initiative->q_initiative_prog,2)}}%<br>-->
                                                                                        <!--            @else-->
                                                                                        <!--            0%<br>-->
                                                                                        <!--            @endif-->
                                                                                                    <!--<span>completed</span>-->
                                                                                        <!--        </div>-->
                                                                                        <!--    </div>-->
                                                                                        <!--</div>-->
                                                                                 
                                                                                        </div>
                                                                                        
                                                                                        
                                                                                        <div class="content-item" style="width:10%">

                                                                                            <!-- <div
                                                                                                class="d-flex flex-row progress-section">
                                                                                               
                                                                                                
                                                                                                            
                                                                                                            
                                                                                                <div
                                                                                                    class="d-flex justify-content-between">
                                                                                                    <span
                                                                                                        class="tasks"></span>
                                                                                                    <span class="completion mr-4" id="comp{{$initiative->id}}" > {{round($initiative->initiative_prog,2)}}% Completed</span>
                                                                                                </div>
                                                                                            </div>
                                                                                    <div class="progress">
                                                                                    <div class="progress-bar bg-primay" id="proginit{{$initiative->id}}" role="progressbar" style="width: {{$initiative->initiative_prog}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                        </div> -->
                                                                                        
                                                                                        @if($initiative->initiative_prog > 0)
                                                                                        <div role="progressbar" id="proginit{{$initiative->id}}" aria-valuenow="{{$initiative->initiative_prog}}" aria-valuemin="0" aria-valuemax="100" style="--value:{{round($initiative->initiative_prog,0)}}"></div>
                                                                                        @else
                                                                                        <div role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="--value:0"></div>
                                                                                        @endif 

                                                                                        <!--<div class="custom-progress" id="proginit{{$initiative->id}}" data-percentage="{{$initiative->initiative_prog}}">-->
                                                                                        <!--    <span class="custom-progress-left">-->
                                                                                        <!--        <span class="custom-progress-bar" style="border-color:#3fe1a7;"></span>-->
                                                                                        <!--    </span>-->
                                                                                        <!--    <span class="custom-progress-right">-->
                                                                                        <!--        <span class="custom-progress-bar" style="border-color:#3fe1a7;"></span>-->
                                                                                        <!--    </span>-->
                                                                                        <!--    <div class="custom-progress-value" id="comp{{$initiative->id}}">-->
                                                                                        <!--        <div>-->
                                                                                        <!--            @if($initiative->initiative_prog > 0)-->
                                                                                        <!--            <small>{{round($initiative->initiative_prog,2)}}%</small>-->
                                                                                        <!--            @else-->
                                                                                        <!--            0%-->
                                                                                        <!--            @endif-->
                                                                                        <!--        </div>-->
                                                                                        <!--    </div>-->
                                                                                        <!--</div>-->

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
                                                                                    <!-- <button
                                                                                            class="btn  btn-primary border-1" data-toggle="modal" onclick="addepic({{$initiative->id}},'{{$key->id}}','{{$obj->id}}')" data-target="#create-epic">
                                                                                             epics
                                                                                        </button> -->
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
                                                                                                                   
                                                                                                                    $epic  = DB::table('epics')->where('month_id',$month->id)->where('trash',NULL)->whereIn('flag_type',$FladId)->get();
                                                                                                            
                                                                                                                    
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
                                                                                                                                    <div
                                                                                                                                        class="card-header bg-white border-bottom-radius pt-2 pl-4 pr-4 pb-2">
                                                                                                                                        <div>
                                                                                                                                            <div class="d-flex flex-row justify-content-between align-items-center">
                                                                                                                                            <div class="d-flex flex-row">
                                                                                                                                                <div class="mr-2">
                                                                                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                                                                                                                                      <path d="M9.99057 22.7499C9.79057 22.7499 9.63057 22.7099 9.51057 22.6599C9.11057 22.5099 8.43057 22.0199 8.43057 20.4699V14.0199H6.09057C4.75057 14.0199 4.27057 13.3899 4.10057 13.0199C3.93057 12.6399 3.78057 11.8699 4.66057 10.8599L12.2306 2.25988C13.2506 1.09988 14.0806 1.17988 14.4806 1.32988C14.8806 1.47988 15.5606 1.96988 15.5606 3.51988V9.96988H17.9006C19.2406 9.96988 19.7206 10.5999 19.8906 10.9699C20.0606 11.3499 20.2106 12.1199 19.3306 13.1299L11.7606 21.7299C11.0506 22.5399 10.4306 22.7499 9.99057 22.7499ZM13.9306 2.73988C13.9006 2.77988 13.6906 2.87988 13.3606 3.25988L5.79057 11.8599C5.51057 12.1799 5.47057 12.3799 5.47057 12.4199C5.49057 12.4299 5.67057 12.5299 6.09057 12.5299H9.18057C9.59057 12.5299 9.93057 12.8699 9.93057 13.2799V20.4799C9.93057 20.9799 10.0206 21.1999 10.0606 21.2599C10.0906 21.2199 10.3006 21.1199 10.6306 20.7399L18.2006 12.1399C18.4806 11.8199 18.5206 11.6199 18.5206 11.5799C18.5006 11.5699 18.3206 11.4699 17.9006 11.4699H14.8106C14.4006 11.4699 14.0606 11.1299 14.0606 10.7199V3.51988C14.0706 3.01988 13.9706 2.80988 13.9306 2.73988Z" fill="#292D32"/>
                                                                                                                                                    </svg>
                                                                                                                                                </div>
                                                                                                                                                <div>
                                                                                                                                                    @if($e->epic_status == 'Done')
                                                                                                                                                    <span
                                                                                                                                                        class="badge-cs-small success">{{$e->epic_status}}</span>
                                                                                                                                                    @endif
                                                                                                                                                     @if($e->epic_status == 'In progress')
                                                                                                                                                    <span
                                                                                                                                                        class="badge-cs-small warning w-100">{{$e->epic_status}}</span>
                                                                                                                                                    @endif 
                                                                                                                                                     @if($e->epic_status == 'To Do')
                                                                                                                                                    <span
                                                                                                                                                        class="badge-cs-small bg-secondary ">{{$e->epic_status}}</span>
                                                                                                                                                    @endif 
                                                                                                                                                    
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                            
                                                                                                                                            <div>
                                                                                                                                                <div
                                                                                                                                                    class="dropdown">
                                                                                                                                                    <button
                                                                                                                                                        class="btn-circle btn-tolbar dropdown-toggle bg-white"
                                                                                                                                                        type="button"
                                                                                                                                                        id="dropdownMenuButton"
                                                                                                                                                        data-toggle="dropdown"
                                                                                                                                                        aria-haspopup="true"
                                                                                                                                                        aria-expanded="false" >
                                                                                                                                                        <img
                                                                                                                                                            src="{{ asset('public/assets/images/icons/dots.svg') }}">
                                                                                                                                                    </button>
                                                                                                                                                    @php
                                                                                                                                                    $test = preg_replace('/[^\p{L}\p{N}\s]/u', '', $e->epic_detail);
                                                                                                                                                    $trimmedString = trim($test);
                                                                                                                                                    @endphp
                                                                                                                                                    <div class="dropdown-menu"
                                                                                                                                                        aria-labelledby="dropdownMenuButton">
                                                                                                                                                        <a class="dropdown-item"
                                                                                                                                                            href="#" data-toggle="modal" onclick="editepic({{$e->id}},'{{$e->epic_name}}','{{$e->epic_start_date}}','{{$e->epic_end_date}}','{{$trimmedString}}','{{$e->epic_status}}','{{$initiative->id}}','{{$key->id}}','{{$obj->id}}')" data-target="#edit-epic">Edit</a>
                                                                                                                                                        <a class="dropdown-item"
                                                                                                                                                            href="#" onclick="DeleteEpic({{$e->id}},'{{$initiative->id}}','{{$key->id}}','{{$obj->id}}')">Delete</a>
                                                                                                                                                        <a class="dropdown-item"
                                                                                                                                                            href="#" data-toggle="modal" onclick="editepicflag({{$e->id}},'{{$e->flag_type}}','{{$e->flag_title}}','{{$e->flag_description}}','{{$initiative->id}}','{{$key->id}}','{{$obj->id}}')" data-target="#edit-epic-flag">Flag A Risk</a>

                                                                                                                                                    </div>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                        </div>
                                                                                                                                        <div>
                                                                                                                                            @if($e->flag_type == 'Risk')
                                                                                                                                            <div class="d-flex flex-row align-items-center">
                                                                                                                                                <div class="mr-1">
                                                                                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                                                                                                                                      <path d="M12.0691 21.9802C10.6591 21.9802 9.23911 21.4402 8.16911 20.3702L3.63911 15.8402C2.53911 14.7402 1.95911 13.2202 2.02911 11.6702L2.26911 6.67018C2.37911 4.28018 4.26911 2.39018 6.66911 2.27018L11.6691 2.03018C13.2191 1.97018 14.7391 2.54018 15.8391 3.64018L20.3691 8.17018C22.5191 10.3202 22.5191 13.8302 20.3691 15.9802L15.9791 20.3702C14.8991 21.4402 13.4891 21.9802 12.0691 21.9802ZM4.69911 14.7702L9.22911 19.3002C9.98911 20.0602 10.9991 20.4802 12.0691 20.4802C13.1391 20.4802 14.1491 20.0602 14.9091 19.3002L19.2991 14.9102C20.0591 14.1502 20.4791 13.1402 20.4791 12.0702C20.4791 11.0002 20.0591 9.99018 19.2991 9.23018L14.7691 4.70018C13.9691 3.90018 12.8591 3.47018 11.7391 3.53018L6.73911 3.77018C5.10911 3.84018 3.83911 5.11018 3.75911 6.73018L3.51911 11.7302C3.46911 12.8602 3.89911 13.9702 4.69911 14.7702Z" fill="#FA9BCF"/>
                                                                                                                                                      <path d="M9.5 12.75C7.71 12.75 6.25 11.29 6.25 9.5C6.25 7.71 7.71 6.25 9.5 6.25C11.29 6.25 12.75 7.71 12.75 9.5C12.75 11.29 11.29 12.75 9.5 12.75ZM9.5 7.75C8.54 7.75 7.75 8.54 7.75 9.5C7.75 10.46 8.54 11.25 9.5 11.25C10.46 11.25 11.25 10.46 11.25 9.5C11.25 8.54 10.46 7.75 9.5 7.75Z" fill="#FA9BCF"/>
                                                                                                                                                    </svg>
                                                                                                                                                </div>
                                                                                                                                                <div>
                                                                                                                                                    <span style="color:#fa9bcf !important; font-size:12px">{{$e->flag_type}}</span>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                            
                                                                                                                                            @endif
                                                                                                                                            
                                                                                                                                             @if($e->flag_type == 'Impediment')
                                                                                                                                            <div class="d-flex flex-row flex-row align-items-center">
                                                                                                                                                <div class="mr-1">
                                                                                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                                                                                                                                      <path d="M12.0691 21.9802C10.6591 21.9802 9.23911 21.4402 8.16911 20.3702L3.63911 15.8402C2.53911 14.7402 1.95911 13.2202 2.02911 11.6702L2.26911 6.67018C2.37911 4.28018 4.26911 2.39018 6.66911 2.27018L11.6691 2.03018C13.2191 1.97018 14.7391 2.54018 15.8391 3.64018L20.3691 8.17018C22.5191 10.3202 22.5191 13.8302 20.3691 15.9802L15.9791 20.3702C14.8991 21.4402 13.4891 21.9802 12.0691 21.9802ZM4.69911 14.7702L9.22911 19.3002C9.98911 20.0602 10.9991 20.4802 12.0691 20.4802C13.1391 20.4802 14.1491 20.0602 14.9091 19.3002L19.2991 14.9102C20.0591 14.1502 20.4791 13.1402 20.4791 12.0702C20.4791 11.0002 20.0591 9.99018 19.2991 9.23018L14.7691 4.70018C13.9691 3.90018 12.8591 3.47018 11.7391 3.53018L6.73911 3.77018C5.10911 3.84018 3.83911 5.11018 3.75911 6.73018L3.51911 11.7302C3.46911 12.8602 3.89911 13.9702 4.69911 14.7702Z" fill="#FA9BCF"/>
                                                                                                                                                      <path d="M9.5 12.75C7.71 12.75 6.25 11.29 6.25 9.5C6.25 7.71 7.71 6.25 9.5 6.25C11.29 6.25 12.75 7.71 12.75 9.5C12.75 11.29 11.29 12.75 9.5 12.75ZM9.5 7.75C8.54 7.75 7.75 8.54 7.75 9.5C7.75 10.46 8.54 11.25 9.5 11.25C10.46 11.25 11.25 10.46 11.25 9.5C11.25 8.54 10.46 7.75 9.5 7.75Z" fill="#FA9BCF"/>
                                                                                                                                                    </svg>
                                                                                                                                                </div>
                                                                                                                                                <div>
                                                                                                                                                    <span style="color:#fa9bcf !important; font-size:12px">{{$e->flag_type}}</span>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                                
                                                                                                                                            @endif 
                                                                                                                                             @if($e->flag_type == 'Blocker')
                                                                                                                                            <div class="d-flex flex-row flex-row align-items-center">
                                                                                                                                                <div class="mr-1">
                                                                                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                                                                                                                                      <path d="M12.0691 21.9802C10.6591 21.9802 9.23911 21.4402 8.16911 20.3702L3.63911 15.8402C2.53911 14.7402 1.95911 13.2202 2.02911 11.6702L2.26911 6.67018C2.37911 4.28018 4.26911 2.39018 6.66911 2.27018L11.6691 2.03018C13.2191 1.97018 14.7391 2.54018 15.8391 3.64018L20.3691 8.17018C22.5191 10.3202 22.5191 13.8302 20.3691 15.9802L15.9791 20.3702C14.8991 21.4402 13.4891 21.9802 12.0691 21.9802ZM4.69911 14.7702L9.22911 19.3002C9.98911 20.0602 10.9991 20.4802 12.0691 20.4802C13.1391 20.4802 14.1491 20.0602 14.9091 19.3002L19.2991 14.9102C20.0591 14.1502 20.4791 13.1402 20.4791 12.0702C20.4791 11.0002 20.0591 9.99018 19.2991 9.23018L14.7691 4.70018C13.9691 3.90018 12.8591 3.47018 11.7391 3.53018L6.73911 3.77018C5.10911 3.84018 3.83911 5.11018 3.75911 6.73018L3.51911 11.7302C3.46911 12.8602 3.89911 13.9702 4.69911 14.7702Z" fill="#FA9BCF"/>
                                                                                                                                                      <path d="M9.5 12.75C7.71 12.75 6.25 11.29 6.25 9.5C6.25 7.71 7.71 6.25 9.5 6.25C11.29 6.25 12.75 7.71 12.75 9.5C12.75 11.29 11.29 12.75 9.5 12.75ZM9.5 7.75C8.54 7.75 7.75 8.54 7.75 9.5C7.75 10.46 8.54 11.25 9.5 11.25C10.46 11.25 11.25 10.46 11.25 9.5C11.25 8.54 10.46 7.75 9.5 7.75Z" fill="#FA9BCF"/>
                                                                                                                                                    </svg>
                                                                                                                                                </div>
                                                                                                                                                <div>
                                                                                                                                                    <span style="color:#fa9bcf !important; font-size:12px">{{$e->flag_type}}</span>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                            @endif 
                                                                                                                                             @if($e->flag_type == 'Action')
                                                                                                                                            <div class="d-flex flex-row flex-row align-items-center">
                                                                                                                                                <div class="mr-1">
                                                                                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                                                                                                                                      <path d="M12.0691 21.9802C10.6591 21.9802 9.23911 21.4402 8.16911 20.3702L3.63911 15.8402C2.53911 14.7402 1.95911 13.2202 2.02911 11.6702L2.26911 6.67018C2.37911 4.28018 4.26911 2.39018 6.66911 2.27018L11.6691 2.03018C13.2191 1.97018 14.7391 2.54018 15.8391 3.64018L20.3691 8.17018C22.5191 10.3202 22.5191 13.8302 20.3691 15.9802L15.9791 20.3702C14.8991 21.4402 13.4891 21.9802 12.0691 21.9802ZM4.69911 14.7702L9.22911 19.3002C9.98911 20.0602 10.9991 20.4802 12.0691 20.4802C13.1391 20.4802 14.1491 20.0602 14.9091 19.3002L19.2991 14.9102C20.0591 14.1502 20.4791 13.1402 20.4791 12.0702C20.4791 11.0002 20.0591 9.99018 19.2991 9.23018L14.7691 4.70018C13.9691 3.90018 12.8591 3.47018 11.7391 3.53018L6.73911 3.77018C5.10911 3.84018 3.83911 5.11018 3.75911 6.73018L3.51911 11.7302C3.46911 12.8602 3.89911 13.9702 4.69911 14.7702Z" fill="#FA9BCF"/>
                                                                                                                                                      <path d="M9.5 12.75C7.71 12.75 6.25 11.29 6.25 9.5C6.25 7.71 7.71 6.25 9.5 6.25C11.29 6.25 12.75 7.71 12.75 9.5C12.75 11.29 11.29 12.75 9.5 12.75ZM9.5 7.75C8.54 7.75 7.75 8.54 7.75 9.5C7.75 10.46 8.54 11.25 9.5 11.25C10.46 11.25 11.25 10.46 11.25 9.5C11.25 8.54 10.46 7.75 9.5 7.75Z" fill="#FA9BCF"/>
                                                                                                                                                    </svg>
                                                                                                                                                </div>
                                                                                                                                                <div>
                                                                                                                                                    <span style="color:#fa9bcf !important; font-size:12px">{{$e->flag_type}}</span>
                                                                                                                                                </div>
                                                                                                                                            </div>
                                                                                                                                            @endif 
                                                                                                                                        </div>
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
                                                                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none">
                                                                                                                                              <path d="M9.16055 11.62C9.13055 11.62 9.11055 11.62 9.08055 11.62C9.03055 11.61 8.96055 11.61 8.90055 11.62C6.00055 11.53 3.81055 9.25 3.81055 6.44C3.81055 3.58 6.14055 1.25 9.00055 1.25C11.8605 1.25 14.1905 3.58 14.1905 6.44C14.1805 9.25 11.9805 11.53 9.19055 11.62C9.18055 11.62 9.17055 11.62 9.16055 11.62ZM9.00055 2.75C6.97055 2.75 5.31055 4.41 5.31055 6.44C5.31055 8.44 6.87055 10.05 8.86055 10.12C8.92055 10.11 9.05055 10.11 9.18055 10.12C11.1405 10.03 12.6805 8.42 12.6905 6.44C12.6905 4.41 11.0305 2.75 9.00055 2.75Z" fill="#292D32"/>
                                                                                                                                              <path d="M16.5404 11.75C16.5104 11.75 16.4804 11.75 16.4504 11.74C16.0404 11.78 15.6204 11.49 15.5804 11.08C15.5404 10.67 15.7904 10.3 16.2004 10.25C16.3204 10.24 16.4504 10.24 16.5604 10.24C18.0204 10.16 19.1604 8.96 19.1604 7.49C19.1604 5.97 17.9304 4.74 16.4104 4.74C16.0004 4.75 15.6604 4.41 15.6604 4C15.6604 3.59 16.0004 3.25 16.4104 3.25C18.7504 3.25 20.6604 5.16 20.6604 7.5C20.6604 9.8 18.8604 11.66 16.5704 11.75C16.5604 11.75 16.5504 11.75 16.5404 11.75Z" fill="#292D32"/>
                                                                                                                                              <path d="M9.16961 22.55C7.20961 22.55 5.23961 22.05 3.74961 21.05C2.35961 20.13 1.59961 18.87 1.59961 17.5C1.59961 16.13 2.35961 14.86 3.74961 13.93C6.74961 11.94 11.6096 11.94 14.5896 13.93C15.9696 14.85 16.7396 16.11 16.7396 17.48C16.7396 18.85 15.9796 20.12 14.5896 21.05C13.0896 22.05 11.1296 22.55 9.16961 22.55ZM4.57961 15.19C3.61961 15.83 3.09961 16.65 3.09961 17.51C3.09961 18.36 3.62961 19.18 4.57961 19.81C7.06961 21.48 11.2696 21.48 13.7596 19.81C14.7196 19.17 15.2396 18.35 15.2396 17.49C15.2396 16.64 14.7096 15.82 13.7596 15.19C11.2696 13.53 7.06961 13.53 4.57961 15.19Z" fill="#292D32"/>
                                                                                                                                              <path d="M18.3402 20.75C17.9902 20.75 17.6802 20.51 17.6102 20.15C17.5302 19.74 17.7902 19.35 18.1902 19.26C18.8202 19.13 19.4002 18.88 19.8502 18.53C20.4202 18.1 20.7302 17.56 20.7302 16.99C20.7302 16.42 20.4202 15.88 19.8602 15.46C19.4202 15.12 18.8702 14.88 18.2202 14.73C17.8202 14.64 17.5602 14.24 17.6502 13.83C17.7402 13.43 18.1402 13.17 18.5502 13.26C19.4102 13.45 20.1602 13.79 20.7702 14.26C21.7002 14.96 22.2302 15.95 22.2302 16.99C22.2302 18.03 21.6902 19.02 20.7602 19.73C20.1402 20.21 19.3602 20.56 18.5002 20.73C18.4402 20.75 18.3902 20.75 18.3402 20.75Z" fill="#292D32"/>
                                                                                                                                            </svg>
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
                                                                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none">
                                                                                                                                              <path d="M9.16055 11.62C9.13055 11.62 9.11055 11.62 9.08055 11.62C9.03055 11.61 8.96055 11.61 8.90055 11.62C6.00055 11.53 3.81055 9.25 3.81055 6.44C3.81055 3.58 6.14055 1.25 9.00055 1.25C11.8605 1.25 14.1905 3.58 14.1905 6.44C14.1805 9.25 11.9805 11.53 9.19055 11.62C9.18055 11.62 9.17055 11.62 9.16055 11.62ZM9.00055 2.75C6.97055 2.75 5.31055 4.41 5.31055 6.44C5.31055 8.44 6.87055 10.05 8.86055 10.12C8.92055 10.11 9.05055 10.11 9.18055 10.12C11.1405 10.03 12.6805 8.42 12.6905 6.44C12.6905 4.41 11.0305 2.75 9.00055 2.75Z" fill="#292D32"/>
                                                                                                                                              <path d="M16.5404 11.75C16.5104 11.75 16.4804 11.75 16.4504 11.74C16.0404 11.78 15.6204 11.49 15.5804 11.08C15.5404 10.67 15.7904 10.3 16.2004 10.25C16.3204 10.24 16.4504 10.24 16.5604 10.24C18.0204 10.16 19.1604 8.96 19.1604 7.49C19.1604 5.97 17.9304 4.74 16.4104 4.74C16.0004 4.75 15.6604 4.41 15.6604 4C15.6604 3.59 16.0004 3.25 16.4104 3.25C18.7504 3.25 20.6604 5.16 20.6604 7.5C20.6604 9.8 18.8604 11.66 16.5704 11.75C16.5604 11.75 16.5504 11.75 16.5404 11.75Z" fill="#292D32"/>
                                                                                                                                              <path d="M9.16961 22.55C7.20961 22.55 5.23961 22.05 3.74961 21.05C2.35961 20.13 1.59961 18.87 1.59961 17.5C1.59961 16.13 2.35961 14.86 3.74961 13.93C6.74961 11.94 11.6096 11.94 14.5896 13.93C15.9696 14.85 16.7396 16.11 16.7396 17.48C16.7396 18.85 15.9796 20.12 14.5896 21.05C13.0896 22.05 11.1296 22.55 9.16961 22.55ZM4.57961 15.19C3.61961 15.83 3.09961 16.65 3.09961 17.51C3.09961 18.36 3.62961 19.18 4.57961 19.81C7.06961 21.48 11.2696 21.48 13.7596 19.81C14.7196 19.17 15.2396 18.35 15.2396 17.49C15.2396 16.64 14.7096 15.82 13.7596 15.19C11.2696 13.53 7.06961 13.53 4.57961 15.19Z" fill="#292D32"/>
                                                                                                                                              <path d="M18.3402 20.75C17.9902 20.75 17.6802 20.51 17.6102 20.15C17.5302 19.74 17.7902 19.35 18.1902 19.26C18.8202 19.13 19.4002 18.88 19.8502 18.53C20.4202 18.1 20.7302 17.56 20.7302 16.99C20.7302 16.42 20.4202 15.88 19.8602 15.46C19.4202 15.12 18.8702 14.88 18.2202 14.73C17.8202 14.64 17.5602 14.24 17.6502 13.83C17.7402 13.43 18.1402 13.17 18.5502 13.26C19.4102 13.45 20.1602 13.79 20.7702 14.26C21.7002 14.96 22.2302 15.95 22.2302 16.99C22.2302 18.03 21.6902 19.02 20.7602 19.73C20.1402 20.21 19.3602 20.56 18.5002 20.73C18.4402 20.75 18.3902 20.75 18.3402 20.75Z" fill="#292D32"/>
                                                                                                                                            </svg>
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

                        // Save position on drop
                        drake.on("drop", function(el, target, source, sibling) {
                            var parentElId = target.id;
                            var droppedElId = el.id;
                            // console.log("Parent ID:", parentElId);
                            // console.log("Dropped ID:", droppedElId);

                            // Perform additional operations or AJAX request here
                            // Example: Update the position of the card using AJAX
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


                    // $(document).ready(function(){
                    // 	var maxLength = 240;
                    // 	$(".show-read-more").each(function(){
                    // 		var myStr = $(this).text();
                    // 		if($.trim(myStr).length > maxLength){
                    // 			var newStr = myStr.substring(0, maxLength);
                    // 			var removedStr = myStr.substring(maxLength, $.trim(myStr).length);
                    // 			$(this).empty().html(newStr);
                    // 			$(this).append(' <a href="javascript:void(0);" class="read-more" style="color:black;">Read More...</a>');
                    // 			$(this).append('<span class="more-text">' + removedStr + '</span>');
                    // 		}
                    // 	});
                    // 	$(".read-more").click(function(){
                    // 		$(this).siblings(".more-text").contents().unwrap();
                    // 		$(this).remove();
                    // 	});
                    // });
                    
                    

                        // Event delegation for dynamically added cards
                    </script>
                    