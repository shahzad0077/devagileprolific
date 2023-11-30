<div id="sliderContainerinit{{$keyid->id}}" style="display: none;">
    <div class="row">
    <div class="col-md-8"><input id="rangeSliderinit{{$keyid->id}}" class="range-slider__range_init ml-4" type="range" value="0" min="1" max="100"></div>
     <div class="col-md-4"><input id="sliderValueinit{{$keyid->id}}" class="w-25"  type="text" value="0"></div>
</div>
</div>
         
         @if($key > 0)
         @if($keyid->initiative_weight != null)
         <div class="col-md-8"><input style="margin-top:10px;" id="init_weight{{$keyid->id}}" class="range-slider__range_init  ml-4"  type="range" value="{{$keyid->initiative_weight}}" min="1" max="100">
         </div>
         <div class="col-md-4"><input id="sliderValueEditinit" class="w-25 mt-2 range-slider__range_init"  type="text" min="1" value="{{$keyid->initiative_weight}}">
         </div>
         @else
          <div class="col-md-8"><input style="margin-top:10px;" id="init_w{{$keyid->id}}" class="range-slider__range_init  ml-4"  type="range" value="1" min="1" max="100">
         </div>
         <div class="col-md-4"><input id="sliderValueEditinit" class="w-25 mt-2 "  type="text" min="1" value="1">
         </div>
         @endif
         @else
           <label class="checkbox checkbox-lg mb-3 ml-4">

                <input class="checkeditinit" onclick="getsliderrangeinit({{$keyid->id}})" type="checkbox" />
                <span class="mr-3"></span>

                Add Weight

                </label>
         @endif
         
