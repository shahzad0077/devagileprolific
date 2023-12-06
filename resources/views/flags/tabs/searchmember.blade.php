@foreach($member as $r)
<div class="col-md-12 memberprofile" onclick="savemember({{$r->id}} , {{$data->id}})">
    <div class="row">
        <div class="col-md-2">
            <div class="memberprofileimage">
                @if($r->image)
                <img src="{{ url('public/assets/images') }}/{{ $r->image }}">
                @else
                <div class="namecounter">{{ substr($r->name, 0, 1); }}</div>
                @endif
            </div>
        </div>
        <div class="col-md-8">
            <div class="membername">{{ $r->name }} {{ $r->last_name }}</div>
            <div class="memberdetail">{{ DB::table('users')->where('id' , $r->user_id)->first()->role }}</div>
        </div>
        <div class="col-md-2 text-center mt-3">
            @if(DB::table('flag_members')->where('flag_id' , $data->id)->where('member_id' , $r->id)->count() > 0)
            <img class="tickimage" src="{{ url('public/assets/svg/smalltick.svg') }}">
            @endif
        </div>
    </div>
</div>
@endforeach