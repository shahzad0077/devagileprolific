@foreach($flag as $r)
@php
    $user = DB::table('members')->where('id' , $r->flag_assign)->first();
@endphp
<div id="{{$r->id}}" class="card impediment-card">
    @include('flags.simplecard')
</div>
@endforeach