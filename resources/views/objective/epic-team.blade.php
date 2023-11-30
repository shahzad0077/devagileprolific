
                        
                            @if($type == 'unit')
                            <div class="form-group mb-0">
                            <select class="form-control search-team" id="edit-team">
                                
                             @foreach(DB::table('unit_team')->where('org_id',$id)->get() as $r)
                             <option @if($data->team_id == $r->id) checked @endif value="{{$r->id}}">{{$r->team_title}}</option>
                             @endforeach
                             </select>
                             
                            <label for="small-description" >Assign Team</label>
                            </div>
                             
                             @endif
                            
                            
                            @if($type == 'stream')
                           <div class="form-group mb-0">
                            <select class="form-control search-team" id="edit-team">
                            @foreach(DB::table('value_team')->where('org_id',$id)->get() as $r)
                            <option @if($data->team_id == $r->id) checked @endif value="{{$r->id}}">{{$r->team_title}}</option>
                            @endforeach
                           </select>
                           <label for="small-description" >Assign Team</label>
                            </div>
                            
                            @endif

                            @if($type == 'BU')
                            @php
                            $team = DB::table('unit_team')->where('id',$id)->first();
                            @endphp
                            <div class="form-group mb-0">
                            <select class="form-control search-team" id="edit-team">
                                
                             @foreach(DB::table('unit_team')->where('org_id',$team->org_id)->get() as $r)
                             <option @if($data->team_id == $r->id) checked @endif value="{{$r->id}}">{{$r->team_title}}</option>
                             @endforeach
                             </select>
                             
                            <label for="small-description" >Assign Team</label>
                            </div>
                             
                             @endif
                            
                            
                            @if($type == 'VS')
                            @php
                            $team = DB::table('value_team')->where('id',$id)->first();
                            @endphp
                           <div class="form-group mb-0">
                            <select class="form-control search-team" id="edit-team">
                            @foreach(DB::table('value_team')->where('org_id',$id)->get() as $r)
                            <option @if($data->team_id == $r->id) checked @endif value="{{$r->id}}">{{$r->team_title}}</option>
                            @endforeach
                           </select>
                           <label for="small-description" >Assign Team</label>
                            </div>
                            
                            @endif
                            
                            


<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>-->
<!--    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />-->

<!--<script>-->

<!--    $(document).ready(function() {-->
<!--    $('.search-team').select2({-->
<!--      width: '100%',-->
<!--    });-->
<!--  });-->
<!--</script>-->