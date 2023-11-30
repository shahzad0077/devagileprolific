
 <div class="subheader py-2 py-lg-2 px-lg-8 subheader-solid breadcrums" id="kt_subheader">
                    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                        <!--begin::Info-->
                        <div class="d-flex align-items-start flex-column flex-wrap mr-2">
                            <!--begin::Page Title-->
                            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                                Teams
                            </h5>
                            <div class="d-flex flex-row page-sub-titles">
                                <div class="mr-2">
                                    <p>Dashboard</p>
                                </div>
                                
                         
                                <div class="mr-2">
                                    <a  href="{{url('dashboard/organization/'.$organization->slug.'/portfolio/'.$organization->type)}}" style="text-decoration: none;" >{{$organization->value_name}}</a>
                                </div>
                                <div class="mr-2">
                                    <p>Teams</p>
                                </div>
                            </div>
                        </div>
                        <!--end::Info-->
                        <!--begin::Toolbar-->
                        <div class="d-flex align-items-center toolbar">
                            <div class="mr-3">
                                <!--<a href="#" class="btn btn-default">-->
                                <!--    OKRs</a>-->
                            </div>
                            <div>
                                <button class="button" type="button" data-toggle="modal" data-target="#add-team-stream">
                                    Add New
                                </button>
                            </div>
                        </div>
                        <!--end::Toolbar-->
                    </div>
                </div>
