@php
if($type == 'unit')
{
$var_objective = 'PageU-'.$type;
}
if($type == 'stream')
{
$var_objective = 'PageV-'.$type;
}
if($type == 'BU')
{
$var_objective = 'PageT-'.$type;
}
if($type == 'VS')
{
$var_objective = 'PageT-'.$type;
}
@endphp
@extends('components.main-layout')
<style>
   .show-read-more .more-text{
   display: none;
   }
   .kanban-board {
   display: flex;
   gap: 20px;
   }
   .board {
   flex: 1;
   padding: 10px;
   background-color: #f5f5f5;
   border-radius: 5px;
   position: relative;
   }
   .cards {
   min-height: 100px; /* Add a minimum height to enable Dragula */
   }
   .board-flex {
   float: left;
   position: relative;
   width: 300px;
   min-height: 100vh;
   margin: 8px;
   border-right: 1px solid lightgray;
   flex: 1;
   padding: 10px;
   border: 1px solid #ccc;
   background-color: #f5f5f5;
   border-radius: 5px;
   position: relative;
   }
   .board-flex header {
   text-align: center;
   width: 100%;
   padding: 0.5em;
   text-transform: capitalize;
   border-radius: 3px 3px 0 0;
   }
   .board-flex .cards {
   list-style-type: none;
   float: left;
   width: 100%;
   padding: 14px;
   min-height: 100px; /* Add a minimum height to enable Dragula */
   }
   /* Vertical bar representing today's date */
   #today-marker {
   position: absolute;
   width: 2px; /* Adjust the width as needed */
   background-color: red; /* Choose a suitable color */
   top: 0;
   bottom: 0;
   left: 0;
   }
   div[role="progressbar"] {
   --size: 3.5rem;
   --fg: #3FE1A7 ;
   --bg: #eeeeee;
   --pgPercentage: var(--value);
   animation: growProgressBar 3s 1 forwards;
   width: var(--size);
   height: var(--size);
   border-radius: 50%;
   display: grid;
   place-items: center;
   background: 
   radial-gradient(closest-side, white 80%, transparent 0 99.9%, white 0),
   conic-gradient(var(--fg) calc(var(--pgPercentage) * 1%), var(--bg) 0)
   ;
   font-family: Helvetica, Arial, sans-serif;
   font-size: calc(var(--size) / 5);
   color: gray;
   }
   div[role="progressbar"]::before {
   counter-reset: percentage var(--value);
   content: counter(percentage) '%';
   }
   .select2-container {
   min-width: 230px;
   height:46px !important;
   }
   .select2-results__option {
   padding-right: 20px;
   vertical-align: middle;
   }
   .select2-results__option:before {
   content: "";
   display: inline-block;
   position: relative;
   height: 20px;
   width: 20px;
   border: 2px solid #e9e9e9;
   border-radius: 4px;
   background-color: #fff;
   margin-right: 20px;
   vertical-align: middle;
   }
   .select2-container--default .select2-selection--multiple {
   margin-bottom: 10px;
   }
   .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
   border-radius: 4px;
   }
   .select2-container--default.select2-container--focus .select2-selection--multiple {
   border-color: #f77750;
   border-width: 2px;
   }
   .select2-container--default .select2-selection--multiple {
   border-width: 2px;
   }
   .select2-container--open .select2-dropdown--below {
   border-radius: 6px;
   box-shadow: 0 0 10px rgba(0,0,0,0.5);
   }
   .select2-selection .select2-selection--multiple:after {
   content: 'hhghgh';
   }
   /* select with icons badges single*/
   .select-icon .select2-selection__placeholder .badge {
   display: none;
   }
   .select-icon .placeholder {
   /*   display: none; */
   }
   .select-icon .select2-results__option:before,
   .select-icon .select2-results__option[aria-selected=true]:before {
   display: none !important;
   /* content: "" !important; */
   }
   .select-icon  .select2-search--dropdown {
   display: none;
   }
</style>
@if($type == 'unit')
<title>Portfolio-{{$organization->business_name}}</title>
@endif
@if($type == 'stream')
<title>Portfolio-{{$organization->value_name}}</title>
@endif
@section('content')
<div class="row">
   <div class="col-md-12">
      <div class="card">
         <div class="card-body">
            <div id="parentCollapsible">
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
                                    <img src="{{ url('public/assets/svg/objectives/one.svg') }}">
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
                              <span class="badge-cs warning" style="width:100%">In progress</span>
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
                                                      <img src="{{ url('public/assets/svg/objectives/two.svg') }}">
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
                                                <span class="badge-cs warning " style="width:100%">In progress</span>
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
                                                class="btn btn-icon btn-circle bg-white btn-tolbar ml-auto" onclick="editobjectivekey({{$key->id}},'{{$key->key_name}}','{{$key->key_start_date}}','{{$key->key_end_date}}','{{$trimmedStringkey}}','{{$key->weight}}','{{$obj->id}}','{{$key->key_result_type}}','{{$key->key_unit}}','{{$key->init_value}}','{{$key->target_number}}')" data-toggle="modal" data-target="#edit-key-result">
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
                                                                        <img src="{{ url('public/assets/svg/objectives/three.svg') }}">
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
                                                                  <span class="badge-cs warning" style="width:100%">In progress</span>
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
                                                                                                    @include('epics.index')
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
      </div>
   </div>
</div>
</div>
</div>
<div class="modal fade" id="create-epic-month" tabindex="-1" role="dialog" aria-labelledby="create-epic-month" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content" style="width: 626px !important;">
         <div class="modal-header">
            <div class="row">
               <div class="col-md-12">
                  <h5 class="modal-title" id="create-epic">Create Epic</h5>
               </div>
               <div class="col-md-12">
                  <p>Fill out the form, submit and hit the save button.</p>
               </div>
               <div class="col-md-12">
                  <div id="success-epic-month"  role="alert"></div>
                  <span id="epic-feild-error-month" class="ml-3 text-danger"></span>
               </div>
            </div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <img src="{{asset('public/assets/images/icons/minus.svg')}}">
            </button>
         </div>
         <div class="modal-body">
            <form class="needs-validation" action="#" method="POST" novalidate>
               @csrf
               <input type="hidden" id="ini_epic_id_month">
               <input type="hidden" id="epic_obj_month">
               <input type="hidden" id="epic_key_month">
               <input type="hidden" id="month_id">
               <input type="hidden" id="q_id">
               <input type="hidden" id="buisness_unit_id" value="{{ $organization->id }}">
               <input type="hidden" id="epic_type" value="{{ $organization->type }}">
               <div class="row">
                  <div class="col-md-12 col-lg-12 col-xl-12">
                     <div class="form-group mb-0">
                        <input type="text" class="form-control" id="epic_name_month" required>
                        <label for="objective-name">Epic Title</label>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-6 col-xl-6">
                     <div class="form-group mb-0">
                        <input type="date" class="form-control"   id="epic_start_date_month"  required>
                        <label for="start-date">Start Date</label>
                     </div>
                  </div>
                  <div class="col-md-6 col-lg-6 col-xl-6">
                     <div class="form-group mb-0">
                        <input type="date" class="form-control"  id="epic_end_date_month" required>
                        <label for="end-date" class="lable-bottom-imp">End Date</label>
                     </div>
                  </div>
                  <div class="col-md-12 col-lg-12 col-xl-12">
                     <div class="form-group mb-0">
                        <select class="form-control" id="epic_status_month">
                           <option value="To Do">To Do</option>
                           <option value="In progress">In Progress</option>
                           <option value="Done">Done</option>
                        </select>
                        <label for="small-description">Status</label>
                     </div>
                  </div>
                  <div class="col-md-12 col-lg-12 col-xl-12">
                     <div class="form-group mb-0">
                        <input type="text" class="form-control" name="" id="epic_description_month" required>
                        <label for="small-description">Small Description</label>
                     </div>
                  </div>
                  @if($organization->type == 'unit')
                  <div class="col-md-12 col-lg-12 col-xl-12">
                     <div class="form-group mb-0">
                        <select class="form-control" id="team" >
                           @foreach(DB::table('unit_team')->where('org_id',$organization->id)->get() as $r)
                           <option value="{{$r->id}}">{{$r->team_title}}</option>
                           @endforeach
                        </select>
                        <label for="small-description" class="lable-bottom-imp" >Assign Team</label>
                     </div>
                  </div>
                  @endif
                  @if($organization->type == 'stream')   
                  <div class="col-md-12 col-lg-12 col-xl-12">
                     <div class="form-group mb-0">
                        <select class="form-control" id="team"  >
                           @foreach(DB::table('value_team')->where('org_id',$organization->id)->get() as $r)
                           <option value="{{$r->id}}">{{$r->team_title}}</option>
                           @endforeach
                        </select>
                        <label for="small-description">Assign Team</label>
                     </div>
                  </div>
                  @endif
               </div>
               <div class="row">
                  <div class="col-md-12 col-lg-12 col-xl-12">
                     <div class="d-flex flex-row align-items-center justify-content-between comment-header">
                        <div>
                           <h4>Stories</h4>
                        </div>
                        <div>
                           <div class="d-flex flex-row align-items-center">
                              <div class="dropdown">
                                 <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="7" viewBox="0 0 11 7" fill="none">
                                       <path d="M10.8339 0.644857C10.6453 0.456252 10.3502 0.439106 10.1422 0.593419L10.0826 0.644857L5.49992 5.2273L0.917236 0.644857C0.72863 0.456252 0.433494 0.439106 0.225519 0.593419L0.165935 0.644857C-0.0226701 0.833463 -0.0398163 1.1286 0.114497 1.33657L0.165935 1.39616L5.12427 6.35449C5.31287 6.5431 5.60801 6.56024 5.81599 6.40593L5.87557 6.35449L10.8339 1.39616C11.0414 1.18869 11.0414 0.852323 10.8339 0.644857Z" fill="#787878"/>
                                    </svg>
                                    Order By
                                 </button>
                                 <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Status</a>
                                    <a class="dropdown-item" href="#">Type</a>
                                    <a class="dropdown-item" href="#">Created</a>
                                    <a class="dropdown-item" href="#">Assignee</a>
                                 </div>
                              </div>
                              <button class="btn btn-primary btn-sm" id="ButtonCollaps" type="button" data-toggle="collapse" data-target="#AddStory" aria-expanded="false" aria-controls="AddStory">
                              Add Story
                              </button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Stories Module -->
               <input type="hidden" id="r_id">
               <div class="row mt-4 collapse" id="AddStory">
                  <div class="col-md-12 col-lg-12 col-xl-12">
                     <div class="card comment-card">
                        <div class="card-body">
                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group mb-0">
                                    <input type="text" class="form-control" id="story_title" required>
                                    <label for="objective-name">Title</label>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group mb-0">
                                    <select class="form-control" id="story_assign">
                                       <option value="">Select Assignee</option>
                                       <?php foreach(DB::table('members')->where('org_user',Auth::id())->get() as $r){ ?>
                                       <option value="{{ $r->id }}">{{ $r->name }}</option>
                                       <?php }  ?>
                                    </select>
                                    <label for="small-description">Assignee</label>
                                 </div>
                              </div>
                              {{-- 
                              <div class="col-md-6">
                                 <div class="form-group mb-0">
                                    <select class="form-control" id="story_type">
                                       <option value="Story">Story</option>
                                       <option value="Task">Task</option>
                                       <option value="Defect">Defect</option>
                                    </select>
                                    <label for="small-description">Type</label>
                                 </div>
                              </div>
                              --}}
                              <div class="col-md-6">
                                 <div class="form-group mb-0">
                                    <select class="form-control" id="story_status">
                                       <option value="">Select Status</option>
                                       <option value="To Do">To Do</option>
                                       <option value="In progress">In Progress</option>
                                       <option value="Done">Done</option>
                                    </select>
                                    <label for="small-description">Status</label>
                                 </div>
                              </div>
                           </div>
                           <div>
                              <button type="button" onclick="SaveNewStory();" class="btn btn-primary btn-sm">Save</button>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 {{-- 
                                 <div class="d-flex flex-row justify-content-between">
                                    <div class="dropdown">
                                       <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="11" height="7" viewBox="0 0 11 7" fill="none">
                                             <path d="M10.8339 0.644857C10.6453 0.456252 10.3502 0.439106 10.1422 0.593419L10.0826 0.644857L5.49992 5.2273L0.917236 0.644857C0.72863 0.456252 0.433494 0.439106 0.225519 0.593419L0.165935 0.644857C-0.0226701 0.833463 -0.0398163 1.1286 0.114497 1.33657L0.165935 1.39616L5.12427 6.35449C5.31287 6.5431 5.60801 6.56024 5.81599 6.40593L5.87557 6.35449L10.8339 1.39616C11.0414 1.18869 11.0414 0.852323 10.8339 0.644857Z" fill="#787878"/>
                                          </svg>
                                          Order By
                                       </button>
                                       <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                          <a class="dropdown-item" href="#">To Do</a>
                                          <a class="dropdown-item" href="#">In Progress</a>
                                          <a class="dropdown-item" href="#">Done</a>
                                       </div>
                                    </div>
                                    <div>
                                       <button class="btn btn-default btn-sm">Cancel</button>
                                       <button class="btn btn-primary btn-sm">Save Story</button>
                                    </div>
                                 </div>
                                 --}}
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <!-- Basil Put the progress bar here kindly -->
                  </div>
               </div>
               <div class="row ">
                  <div class="col-md-12 story-data">
                  </div>
               </div>
               <!-- Comments, Basil This module been already created on the impediment board so you may simply copy and paste it here -->
               <div class="row">
                  <div class="col-md-12 col-lg-12 col-xl-12">
                     <div class="d-flex flex-row align-items-center justify-content-between comment-header">
                        <div>
                           <h4>Comments</h4>
                        </div>
                        <div class="dropdown">
                           <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <svg xmlns="http://www.w3.org/2000/svg" width="11" height="7" viewBox="0 0 11 7" fill="none">
                                 <path d="M10.8339 0.644857C10.6453 0.456252 10.3502 0.439106 10.1422 0.593419L10.0826 0.644857L5.49992 5.2273L0.917236 0.644857C0.72863 0.456252 0.433494 0.439106 0.225519 0.593419L0.165935 0.644857C-0.0226701 0.833463 -0.0398163 1.1286 0.114497 1.33657L0.165935 1.39616L5.12427 6.35449C5.31287 6.5431 5.60801 6.56024 5.81599 6.40593L5.87557 6.35449L10.8339 1.39616C11.0414 1.18869 11.0414 0.852323 10.8339 0.644857Z" fill="#787878"/>
                              </svg>
                              Order By
                           </button>
                           <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="#">Latest</a>
                              <a class="dropdown-item" href="#">Older</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-12 col-lg-12 col-xl-12">
                     <div class="d-flex flex-column">
                        <div>
                           <div class="form-group mb-0">
                              <input type="text" class="form-control" id="epic-comment" required>
                              <label for="objective-name">Write Comment</label>
                           </div>
                        </div>
                        <div>
                           <button type="button" class="btn btn-default btn-sm">Cancel</button>
                           <button type="button" onclick="SaveComment();" class="btn btn-primary btn-sm">Save</button>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row mt-4 comment-area" id="comment_area">
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <button class="btn btn-primary btn-lg btn-theme btn-block ripple mt-3" onclick="saveEpicMonth();"  type="button">Save Epic</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- Change text on the story button when it's toggled and when not -->
<script>
   document.addEventListener('DOMContentLoaded', function () {
     var toggleButton = document.getElementById('ButtonCollaps');
     var collapseElement = document.getElementById('AddStory');
   
     collapseElement.addEventListener('show.bs.collapse', function () {
       toggleButton.innerText = 'Cancel';
     });
   
     collapseElement.addEventListener('hide.bs.collapse', function () {
       toggleButton.innerText = 'Add Story';
     });
   });
</script>
@endsection