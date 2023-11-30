@if(count($data) > 0)
@foreach($data as $chart)
<div class="col-md-5 col-lg-5 col-xl-5">
    <div class="form-group mb-0">
        <input type="text" class="form-control month-input"  value="{{$chart->target_month}}" id="month">
        <label for="objective-name">Month</label>
    </div>
</div>
<div class="col-md-5 col-lg-5 col-xl-5">
    <div class="form-group mb-0">
        <input type="text" class="form-control value-input"  value="{{$chart->target_value}}" id="value">
        <label for="objective-name">Value</label>
    </div>
</div>

<div class="col-md-2 col-lg-2 col-xl-2">
    
<button  type="button" style="float:right;" onclick="DeleteGraphVal({{$chart->id}});" class="btn btn-danger"><i class="fa fa-trash"></i></button>

</div>
<input type="hidden" id="" class="chart-id" value="{{$chart->id}}">
@endforeach
@endif

<div class="col-md-12 w-100 mt-0" id="field_wrapper_chart{{$id}}"></div>

<div class="">
    <a class="btn text-primary  mr-2 add_button_chart" onclick="addButton({{$id}})" type="button">Add  item</a>
</div>


<div class="col-md-12">
    <button  type="button" style="float:right;" onclick="UpdateChartData();" class="btn btn-primary btn-lg btn-theme">Update</button>
</div>
