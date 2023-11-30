            @php
            $Stream = DB::table('business_units')->where('user_id',Auth::id())->get();
            @endphp  
            <div class="flex-shrink-0 p-3 bg-white sub-nav" id="panel-unit" style="width: 280px; margin-top: 5%;">
                <button id="closeBtn" class="close-button">
                    <img src="{{asset('public/assets/images/icons/collaps.svg')}}">
                </button>
                <h6 class="title">Menu</h6>
                <ul class="list-unstyled ps-0">
                    <li class="mb-1">
                        <a href="{{url('dashboard/organization/Business-Units')}}" style="text-decoration: none;" class="" >
                        <button class="btn btn-toggle align-items-center rounded" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                         All Business Units  
                        </button>
                        </a>
                        <div class="collapse show" id="home-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small px-3 py-2 nav-root-item">
                                @if(count($Stream) > 0)
                                @foreach($Stream as $value)
                                <li class="py-2"><a href="{{url('dashboard/organization/'.$value->slug.'/portfolio/'.$value->type)}}" class="link-dark rounded">{{$value->business_name}}</a></li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </li>
                    <!--<li class="mb-1">-->
                    <!--    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">-->
                    <!--        Departments-->
                    <!--    </button>-->
                    <!--    <div class="collapse" id="dashboard-collapse">-->
                    <!--        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small px-3 py-2">-->
                    <!--            <li class="py-2"><a href="#" class="link-dark rounded">Sales & Finance</a></li>-->
                    <!--            <li class="py-2"><a href="#" class="link-dark rounded">Human Resources</a></li>-->
                    <!--            <li class="py-2"><a href="#" class="link-dark rounded">IT Departments</a></li>-->
                    <!--        </ul>-->
                    <!--    </div>-->
                    <!--</li>-->
                </ul>
            </div>