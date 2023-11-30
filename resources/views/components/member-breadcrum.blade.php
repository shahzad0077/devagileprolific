                <div class="subheader py-2 py-lg-2 px-lg-8 subheader-solid breadcrums" id="kt_subheader">
                    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                     
                        <div class="d-flex align-items-start flex-column flex-wrap mr-2">
                            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                                Users
                            </h5>
                            <!-- Breadcrum Items -->
                            <div class="d-flex flex-row page-sub-titles">
                                <div class="mr-2">
                                    <a href="{{route('home')}}">Dashboard</a>
                                </div>
                                <div class="mr-2">
                                    <p>Users</p>
                                </div>
                            </div>
                            <!--End Breadcrum Items -->
                        </div>
                       
                        <div class="d-flex align-items-center toolbar">
                            <div>
                                <button class="btn btn-sm btn-dark" style="display:none;" id="delete-button-user" onclick="delete_record_user();" type="button">Delete All</button>
                                <button class="button" data-toggle="modal" data-target="#create-member">Add User</button>
                            </div>
                        </div>
                    
                    </div>
                </div>
