<input type="hidden" id="epic_id" value="{{ $data->epic_id }}" name="epic_id">
<div class="form-group mb-0 positionrelative">
    <label for="objective-name">Epic (Optional)</label>
    <input onkeyup="searchepic(this.value)" type="text" placeholder="Search Epic" class="form-control">
    <div class="searchiconforinput">
        <img src="{{ url('public/assets/images/searchiconsvg.svg') }}">
    </div>
    @if($data->epic_id)
    <div class="selectepic">
        <p>{{ DB::Table('epics')->where('id' , $data->epic_id)->first()->epic_name }}</p>
        <a onclick="removeepic({{ $data->id }})" href="javascript:void(0)"><img class="closeimage" src="{{url('public/assets/svg/cross.svg')}}"></a>
    </div>
    @endif
</div>
<div class="searchepic-box">
    <div class="epic">
        <div class="epic-tittle">Epic Name</div>
        <div class="epic-detail">Objective / Key Result / Initiative</div>
    </div>
    <div class="epic">
        <div class="epic-tittle">Epic Name</div>
        <div class="epic-detail">Objective / Key Result / Initiative</div>
    </div>
    <div class="epic">
        <div class="epic-tittle">Epic Name</div>
        <div class="epic-detail">Objective / Key Result / Initiative</div>
    </div>
</div>