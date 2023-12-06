
<div class="row mt-2" id="remove_button{{$index}}">
<div class="col-md-5 col-lg-5 col-xl-5">
<div class="form-group mb-0">
<select name="key-team"  onchange="getteamobj(this.value,'{{$index}}')"  class="form-control key-team" value="" required>
<option value="">Select Team</option>
 @foreach($Team as $team)   
 <option value="{{$team->id}}">{{$team->team_title }}</option> 
 @endforeach 
</select>
<label for="small-description" style="bottom:72px">Choose Team</label>
</div>
</div>

<div class="col-md-5 col-lg-5 col-xl-5">
    <div class="form-group mb-0">
     <select name="obj-team"  id="obj-team{{$index}}"  class="form-control obj-team"  required>
                            
    </select>
        <label for="small-description" style="bottom:72px">Choose Objective</label>
    </div>
</div>
<div class="col-md-2 col-lg-2 col-xl-2" >
<button type="button" onclick="remove_div({{$index}});"  class="btn btn-danger mt-3 ml-1"><i class="fa fa-trash"></i></button>
</div>    
</div>