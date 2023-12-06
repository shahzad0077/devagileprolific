<div class="row" id="remove-unit{{$index}}">
@if($type == 'BU')    
<div class="col-md-6 col-lg-6 col-xl-6">
    <div class="form-group mb-0">
       <select class="form-control unitobj" onchange="getUnitObj(this.value,'{{$index}}')">
        <option value="">Select Business Unit</option>
        @foreach($Team as $r)
          <option value="{{ $r->id }}">{{ $r->business_name }}</option>
        @endforeach

       </select>
        <label for="small-description">Choose Business Unit</label>
    </div>
</div>
@endif

@if($type == 'VS')    
<div class="col-md-6 col-lg-6 col-xl-6">
    <div class="form-group mb-0">
       <select class="form-control unitobj" onchange="getUnitObj(this.value,'{{$index}}')">
        <option value="">Select Value Stream</option>
        @foreach($Team as $r)
          <option value="{{ $r->id }}">{{ $r->value_name }}</option>
        @endforeach

       </select>
        <label for="small-description">Choose Value Stream</label>
    </div>
</div>
@endif

<div class="col-md-6 col-lg-6 col-xl-6">
    <div class="form-group mb-0">
     <select name="" id="bu-obj{{$index}}" onchange="getBUKey(this.value,'{{$index}}')"  class="form-control bu-obj" value="" required>
                            
    </select>
        <label for="small-description" >Choose Objective</label>
    </div>
</div>

<div class="col-md-6 col-lg-6 col-xl-6">
    <div class="form-group mb-0">
     <select name="" id="key-BU{{$index}}"   class="form-control key-BU" value="" required>
                            
    </select>
        <label for="small-description" >Choose Key Result</label>
    </div>
</div>
<div class="col-md-6 col-lg-6 col-xl-6" >
    <button type="button" onclick="remove_div_unit({{$index}});"  class="btn btn-danger mt-3 ml-1"><i class="fa fa-trash"></i></button>
    </div>  
</div>