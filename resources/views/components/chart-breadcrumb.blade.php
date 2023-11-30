<!-- begin breadcrums -->

                <div class="subheader py-2 py-lg-2 px-lg-8 subheader-solid breadcrums" id="kt_subheader">
                    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                        <!--begin::Info-->
                        <div class="d-flex align-items-start flex-column flex-wrap mr-2">
                            <!--begin::Page Title-->
                            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                                Performance Dashboard
                            </h5>
                          <div class="d-flex flex-row page-sub-titles">
                             <div class="mr-2">
                                    <p>Dashboard</p>
                                </div>
                               
                                <div class="mr-2">
                                    <a href="{{url('dashboard/organization/contacts')}}" style="text-decoration: none;"></a>
                                </div>
                                <div class="mr-2">
                                    @if($organization->type == 'stream')
                                    <a  href="{{url('dashboard/organization/'.$organization->slug.'/portfolio/'.$organization->type)}}" style="text-decoration: none;" >{{$organization->value_name}}</a>
                                    @endif
                                    
                                     @if($organization->type == 'unit')
                                    <a  href="{{url('dashboard/organization/'.$organization->slug.'/portfolio/'.$organization->type)}}" style="text-decoration: none;" >{{$organization->business_name}}</a>
                                    @endif
                                </div>
                                <div class="mr-2">
                                    <p>Performance Dashboard</p>
                                </div>
                               </div>
                        </div>
                        <!--end::Info-->
                        <!--begin::Toolbar-->
                        <div class="d-flex align-items-center toolbar">
                            
                            <div class="dropdown dropleft mr-2">
                                    <button class="button dropdown-toggle bg-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       Status
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="get_chart_status('all');">All</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="get_chart_status('Green');">Green</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="get_chart_status('Amber');">Amber</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="get_chart_status('Red');">Red</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="get_chart_status('N');">No Status</a>

                                    </div>
                                </div>
                            <div>
                                
                                <button class="button" data-toggle="modal" data-target="#create-chart">Add New</button>
                            </div>
                            
                        </div>
                        <!--end::Toolbar-->
                    </div>
                </div>
                <!-- end breadcrums -->