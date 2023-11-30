            @php
            $organization = DB::table('organization')->where('user_id',Auth::id())->where('trash',NULL)->limit(2)->get();    
            @endphp  
            <div class="flex-shrink-0 p-3 bg-white sub-nav" id="panel" style="width: 280px; margin-top: 5%;">
                <button id="closeBtn" class="close-button">
                    <img src="{{asset('public/assets/images/icons/collaps.svg')}}">
                </button>
                <h6 class="title">Menu</h6>
                <ul class="list-unstyled ps-0">
                    <li class="mb-1">
                        <a href="{{url('/dashboard/organizations')}}" style="text-decoration: none;" class="" >
                        <button class="btn btn-toggle align-items-center rounded" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                         All Organizations   
                        </button>
                        </a>
                        <div class="collapse show" id="home-collapse" style="">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small px-3 py-2 nav-root-item">
                                @if(count($organization) > 0)
                                @foreach($organization as $org_nav)
                                <li class="py-2"><a href="#" class="link-dark rounded">{{$org_nav->organization_name}}</a></li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </li>
                    <!-- <li class="mb-1">
                        <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                            Departments
                        </button>
                        <div class="collapse" id="dashboard-collapse">
                            <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small px-3 py-2">
                                <li class="py-2"><a href="#" class="link-dark rounded">Sales & Finance</a></li>
                                <li class="py-2"><a href="#" class="link-dark rounded">Human Resources</a></li>
                                <li class="py-2"><a href="#" class="link-dark rounded">IT Departments</a></li>
                            </ul>
                        </div>
                    </li> -->
                </ul>
            </div>