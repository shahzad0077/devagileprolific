<!-- This Class is Created By Usama -->
<div>
   <div class="d-flex flex-row justify-content-between align-items-center">
      <div class="d-flex flex-row">
         <div class="mr-2">
            <img src="{{ url('public/assets/svg/svgseven.svg') }}">
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
               <a class="dropdown-item" href="javascript:void(0)" data-toggle="modal" onclick="editepic({{$organization->id}},{{$e->id}},'{{$e->epic_name}}','{{$e->epic_start_date}}','{{$e->epic_end_date}}','{{$trimmedString}}','{{$e->epic_status}}','{{$initiative->id}}','{{$key->id}}','{{$obj->id}}')" data-target="#edit-epic">Edit</a>
               <a class="dropdown-item" href="javascript:void(0)" onclick="DeleteEpic({{$e->id}},'{{$initiative->id}}','{{$key->id}}','{{$obj->id}}')">Delete</a>
               <a class="dropdown-item" href="javascript:void(0)" onclick="editepicflag({{$e->id}})">Flag A Risk</a>
            </div>
         </div>
      </div>
   </div>
</div>