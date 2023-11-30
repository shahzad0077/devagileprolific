      <div class="progress mb-2">
      <div class="progress-bar bg-primay" role="progressbar" style="width:{{$epic->epic_progress}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
      @if(count($epicstory) > 0)
      @foreach ($epicstory as $s) 
      <div class="row mt-2">
      <div class="col-md-6">
      <div class="form-check{{$s->id}}">
       <input class="form-check-input"  type="checkbox" @if($s->progress > 0) checked onclick="updateprogress(this.value);" @else onclick="getprogress(this.value);" @endif  value="{{$s->id}}"  id="flexCheckDefault">
       <label class="form-check-label ml-3" id="editlabel{{$s->id}}" for="flexCheckDefault">{{$s->epic_story_name}}</label>
       
        </div>
           <div class="col-md-12 d-flex" id="{{$s->id}}"></div>
        </div>
       
        <div class="col-md-6" id="editbutton{{$s->id}}">
        <div class="dropdown">
        <button class="btn-circle btn-tolbar dropdown-toggle bg-white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
        <img src="{{ asset('public/assets/images/icons/dots.svg') }}">
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
         <a class="dropdown-item" href="#" onclick="editstory({{$s->id}},'{{$s->epic_story_name}}')">Edit</a>
        <a class="dropdown-item" href="#" onclick="deletestory({{$s->id}})" class="" >Delete</a>'
        </div>
        </div>
        
        </div>
        </div>
      
        @endforeach
        @endif
        
       <div class="col-md-12 w-100" id="field_wrapper_edit{{$epic->id}}"></div>

        <div class="col-md-12">
            <button class="btn btn-primary w-50 mt-2 add_button_edit" id="item{{$epic->id}}" onclick="addButton({{$epic->id}})" type="button">Add on item</button>
        </div>
        
        
   
     