                             
                            @foreach($member as $r)
                            <div class="d-flex flex-row align-items-center justify-content-between single-member">
                                <div class="d-flex flex-row align-items-center ">
                                    <div>
                                         @if($r->image != NULL)
                                        <img width="45px" height="45px" src="{{asset('public/assets/images/'.$r->image)}}" alt="Example Image">
                                        @else
                                        <img width="45px" height="45px" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTv1Tt9_33HyVMm_ZakYQy-UgsLjE00biEArg&usqp=CAU" alt="Example Image">
                                        @endif
                                        
                                    </div>
                                    <div class="d-flex flex-column ml-3">
                                        <p>{{$r->name}} {{ $r->last_name }}</p>
                                        <small>{{$r->email}}</small>
                                    </div>
                                </div>
                                <div>
                                    <input type="checkbox" value="{{$r->id}}" name="member[]">
                                </div>
                            </div>
                            @endforeach