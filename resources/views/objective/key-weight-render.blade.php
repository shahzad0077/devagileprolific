
<div id="sliderContainer{{$keyid->id}}" style="display: none;">
    <div class="row">
    <div class="col-md-8"><input id="rangeSlider{{$keyid->id}}" class="range-slider__range ml-4" type="range" value="0" min="1" max="100"></div>
     <div class="col-md-4"><input id="sliderValue{{$keyid->id}}" class="w-25 range-slider__range"  type="text" value="0"></div>
</div>
</div>
         @if($key > 0)
         @if($keyid->weight != null)
         <div class="col-md-8"><input style="margin-top:10px;" id="rangevalue{{$keyid->id}}" class="range-slider__range-one  ml-4"  type="range" value="{{$keyid->weight}}" min="1" max="100">
         </div>
         <div class="col-md-4"><input id="sliderValueEdit" class="w-25 mt-2 range-slider__range-one"  type="text" min="1" value="{{$keyid->weight}}">
         </div>
         @else
         <div class="col-md-8"><input style="margin-top:10px;" id="k_w{{$keyid->id}}" class="range-slider__range-one  ml-4"  type="range" value="1" min="1" max="100">
         </div>
         <div class="col-md-4"><input id="sliderValueEdit" class="w-25 mt-2 range-slider__range-one"  type="text" min="1" value="1">
         </div>
         
         @endif
         @else
           <label class="checkbox checkbox-lg mb-3 ml-4">

                <input class="checkedit" onclick="getsliderrange({{$keyid->id}})" type="checkbox" />
                <span class="mr-3"></span>

                Add Weight

                </label>
         @endif
         

