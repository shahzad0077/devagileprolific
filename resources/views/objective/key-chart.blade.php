<p style="font-size: 14px"><b >Current Value:  @if($KEYChart){{$KEYChart->quarter_value}}@endif</b>  {{$key->key_result_type}} {{$key->target_number}}</p>
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
            <div>
                <div class="form-group mb-0">
                    <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" @if($KEYChart) onfocusout="addnewquartervalue({{$key->id}},'{{$KEYChart->id}}','{{$report->id}}')" @endif id="new-chart-value{{$key->id}}" required>
                    <label for="objective-name">New Value</label>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="ml-2 text-danger mt-2" role="alert">First Start Quarter</div>

    @endif
</div>

@if($KEYChart)
@php
 $keyqvalue =  DB::table('key_quarter_value')->where('key_chart_id', $KEYChart->id)->get();    
@endphp

<table id="example" class="table table-sm" style="width: 110%">
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