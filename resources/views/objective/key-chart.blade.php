@if(count($keyQAll) > 0)
<div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="d-flex flex-row align-items-center justify-content-between comment-header">
            <div>
                <h4>Quarter Value</h4>
            </div>
            <div>
                <a href="javascript:void(0);" onclick="addnewquarterval({{$key->id}})" class="text-black" title="Add field"><i class="fa fa-plus" aria-hidden="true"></i></a> 
            </div>
         
        </div>
        <div class="col-md-12" id="field_wrapper{{$key->id}}"></div>
    </div>
    <hr>
</div>
<table id="" class="table table-sm">
    <thead>
        <tr>
            <td>Quarter</td>
            <td>Value</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($keyQAll as $Q)
        <tr> 
            <td>Q {{ $loop->iteration  }}</td>

            <td id="edit-q-val{{$Q->id}}">{{$Q->quarter_value}}</td>
      

            <td id="edit-button-qval{{$Q->id}}">


                <button class="btn-circle btn-tolbar" type="button" onclick="editkeyqvalue({{$Q->id}},'{{$Q->quarter_value}}')">
                    <img src="{{ url('public/assets/images/icons/edit.svg') }}">
                </button>
                  
            </td>

        </tr>
        @endforeach
    </tbody>     
</table>
@endif
@if($KEYChart)
@php
$keyqvalue = '';
$keyqfirst =  DB::table('key_quarter_value')->where('key_chart_id', $KEYChart->id)->orderby('id','DESC')->first();
if($keyqfirst)
{
$keyqvalue = $keyqfirst->value;
}        
@endphp
@endif
<p style="font-size: 14px"><b >Current Value: </b> @if($KEYChart)<b id="q-value{{$KEYChart->id}}">{{$keyqvalue}}</b>@endif  {{$key->key_result_type}} @if($KEYChart)<span id="q-sprint{{$KEYChart->id}}">{{$KEYChart->quarter_value}}</span>@endif</p>
<div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="d-flex flex-row align-items-center justify-content-between comment-header">
            <div>
                <h4>New Value</h4>
            </div>
        </div>
    </div>
    <hr>

    @if($report && $KEYChart)
    <div class="col-md-12 mt-3 col-lg-12 col-xl-12">
        <div class="d-flex flex-column">
            
            <div class="d-flex flex-row">
                
                <div class="form-group mb-0">
                    <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control w-75"  id="new-chart-value{{$key->id}}" required>
                    <label for="objective-name">New Value</label>
                </div>
              
                <button class="btn btn-default btn-sm mt-2" @if($KEYChart) onclick="addnewquartervalue({{$key->id}},'{{$KEYChart->id}}','{{$report->id}}')" @endif type="button">Add</button>

            </div>
      
         
        </div>
    
    </div>
 
    @else
    <div class="ml-2 text-danger mt-2" role="alert">First Start Quarter</div>

    @endif
</div>

@if($KEYChart)
@php
 $keyqvalue =  DB::table('key_quarter_value')->where('key_chart_id', $KEYChart->id)->orderby('id','DESC')->get();
@endphp

<table id="example" class="table table-sm" style="width: 100%">
    <thead>
        <tr>
          
            <td>Updated On</td>
            <td>Value</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($keyqvalue as $val)
        <tr id="delete-val{{$val->id}}"> 
            <td>{{ \Carbon\Carbon::parse($val->created_at)->format('d M, Y') }}</td>
            <td id="edit-val{{$val->id}}">{{$val->value}}</td>
            <td id="edit-button-val{{$val->id}}">


                <button class="btn-circle btn-tolbar" type="button" onclick="editquartervalue({{$val->id}},'{{$val->value}}')">
                    <img src="{{ url('public/assets/images/icons/edit.svg') }}">
                </button>
                  
                <button class="btn-circle btn-tolbar" type="button" onclick="deletequartervalue({{$val->id}})">
                    <img src="{{ url('public/assets/images/icons/delete.svg') }}">
                </button>
            </td>

        </tr>
        @endforeach
    </tbody>     
</table>
@endif