
             <div class="subheader py-2 py-lg-2 px-lg-8 subheader-solid breadcrums" id="kt_subheader">
                    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                        <!--begin::Info-->
                        <div class="d-flex align-items-start flex-column flex-wrap mr-2">
                            <!--begin::Page Title-->
                            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                                Backlog
                            </h5>
                               <div class="d-flex flex-row page-sub-titles">
                                <div class="mr-2">
                                    <p>Dashboard</p>
                                </div>
                                <div class="mr-2">
                                    <a href="{{url('dashboard/organization/contacts')}}" style="text-decoration: none;"></a>
                                </div>
                                <div class="mr-2">
                                    <a  href="{{url('dashboard/organization/'.$organization->slug.'/portfolio/'.$organization->type)}}" style="text-decoration: none;" >{{$organization->value_name}}</a>
                                </div>
                                <div class="mr-2">
                                    <p>Backlog</p>
                                </div>
                            </div>
                        </div>
                        <!--end::Info-->
                        <!--begin::Toolbar-->
                        <div class="d-flex align-items-center toolbar">
                                <div class="dropdown dropleft mr-2">
                                    <button class="button dropdown-toggle bg-secondary" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                       Filter
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="assign_epic(1);">Assign Epics</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="assign_epic(0);">Un Assign Epics</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="assign_epic('all');">All</a>
                                    </div>
                                </div>
                            <div>
                                <button class="button" data-toggle="modal" onclick="get_epic();" data-target="#assign">Assign</button>
                                <button class="button" data-toggle="modal" data-target="#create-backlog-epic">Add New</button>
                                <button class="button" data-toggle="modal"  data-target="#create-jira-epic">Connect Jira</button>
                            </div>
                        </div>
                        
                        
                        <!--end::Toolbar-->
                    </div>
                </div>