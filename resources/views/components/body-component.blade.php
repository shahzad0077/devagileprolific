<div class="container-fluid py-5 w-96">
                    
     <div class="row">
        <div class="col-md-12 p-0">
            <div class="card">
                <div class="card-body">
                    <div id="parentCollapsible">
                        <!-- Parent Collapsible -->
                        <div class="card bg-transparent shadow-none">
                            <div class="card-header objective-header active-header bg-white border-bottom" id="parentHeading">
                                <div class="d-flex flex-row justify-content-between header-objective align-items-center" data-toggle="collapse" data-target="#nestedCollapsible">
                                    <div class="title">
                                        <h5>Objective name</h5>
                                    </div>
                                    <div class="d-flex flex-row justify-content-between content align-items-center">
                                        <div>
                                            <p>6 Key Results</p>
                                        </div>
                                        <div>
                                            <p>Jun 24 - Jun 30</p>
                                        </div>
                                        <div>
                                            <span class="badge-cs success">Running</span>
                                        </div>
                                        <div>
                                            <div class="d-flex flex-row progress-section">
                                                <div class="progress">
                                                    <div class="progress-bar" role="progressbar" style="width: 13%;" aria-valuenow="13" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                                <div class="d-flex justify-content-between">
                                                    <span class="tasks">3/10</span>
                                                    <span class="completion">13% Completed</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="action ml-0">
                                        <button class="btn btn-icon btn-circle btn-tolbar ml-auto">
                                            <img src="{{asset('public/assets/images/icons/edit.svg')}}" alt="Edit" style="border-radius: 50%; width: 18px; height: 18px;" data-toggle="tooltip" data-placement="top" data-original-title="Edit">
                                        </button>
                                        <button class="btn btn-icon btn-circle btn-tolbar">
                                            <img src="{{asset('public/assets/images/icons/delete.svg')}}" alt="Delete" style="border-radius: 50%; width: 18px; height: 18px;" data-toggle="tooltip" data-placement="top" data-original-title="Delete">
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="nestedCollapsible" class="collapse">
                                <div class="card-body p-0">
                                    <!-- begin Key Results -->
                                    <div>
                                        <!-- begin Item -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card bg-transparent shadow-none">
                                                    <div class="card-header keyresult-header bg-light-gray">
                                                        <div class="d-flex flex-row justify-content-between header-objective align-items-center" data-toggle="collapse" data-target="#key-result">
                                                            <div class="title">
                                                                <h5>Key Result 1</h5>
                                                            </div>
                                                            <div class="d-flex flex-row justify-content-between content align-items-center">
                                                                <div class="text-center">
                                                                    <p>6 Initiatives</p>
                                                                </div>
                                                                <div class="text-center">
                                                                    <p>Jun 24 - Jun 30</p>
                                                                </div>
                                                                <div class="text-center">
                                                                    <span class="badge-cs warning">Paused</span>
                                                                </div>
                                                                <div>
                                                                    <div class="d-flex flex-row progress-section">
                                                                        <div class="progress">
                                                                            <div class="progress-bar" role="progressbar" style="width: 13%;" aria-valuenow="13" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                        <div class="d-flex justify-content-between">
                                                                            <span class="tasks">3/10</span>
                                                                            <span class="completion">13% Completed</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="action ml-0">
                                                                <button class="btn btn-icon btn-circle bg-white btn-tolbar ml-auto">
                                                                    <img src="{{asset('public/assets/images/icons/edit.svg')}}" alt="Edit" style="border-radius: 50%; width: 18px; height: 18px;">
                                                                </button>
                                                                <button class="btn btn-icon btn-circle bg-white btn-tolbar">
                                                                    <img src="{{asset('public/assets/images/icons/delete.svg')}}" alt="Delete" style="border-radius: 50%; width: 18px; height: 18px;">
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="key-result" class="collapse">
                                                        <div class="card-body p-0">
                                                            <!-- begin Initiative -->
                                                            <div>
                                                                <!-- begin Item -->
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="card bg-transparent shadow-none">
                                                                            <div class="card-header initiative-header" style="background: #f9   f9f9 !important;">
                                                                                <div class="d-flex flex-row justify-content-between header-objective align-items-center" data-toggle="collapse" data-target="#initiative">
                                                                                    <div class="title">
                                                                                        <h5>Initiative</h5>
                                                                                    </div>
                                                                                    <div class="d-flex flex-row justify-content-between content align-items-center">
                                                                                        <div class="text-center">
                                                                                            <p>6 Epics</p>
                                                                                        </div>
                                                                                        <div class="text-center">
                                                                                            <p>Jun 24 - Jun 30</p>
                                                                                        </div>
                                                                                        <div class="text-center">
                                                                                            <span class="badge-cs warning">Paused</span>
                                                                                        </div>
                                                                                        <div>
                                                                                            <div class="d-flex flex-row progress-section">
                                                                                                <div class="progress">
                                                                                                    <div class="progress-bar" role="progressbar" style="width: 13%;" aria-valuenow="13" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                                </div>
                                                                                                <div class="d-flex justify-content-between">
                                                                                                    <span class="tasks">3/10</span>
                                                                                                    <span class="completion">13% Completed</span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="action ml-0">
                                                                                        <button class="btn btn-icon btn-circle bg-white btn-tolbar ml-auto">
                                                                                            <img src="{{asset('public/assets/images/icons/edit.svg')}}" alt="Edit" style="border-radius: 50%; width: 18px; height: 18px;">
                                                                                        </button>
                                                                                        <button class="btn btn-icon btn-circle bg-white btn-tolbar">
                                                                                            <img src="{{asset('public/assets/images/icons/delete.svg')}}" alt="Delete" style="border-radius: 50%; width: 18px; height: 18px;">
                                                                                        </button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div id="initiative" class="collapse">
                                                                                <div class="card-body p-0">
                                                                                    hello
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- end Item -->
                                                                <!-- begin Add New -->
                                                                <div class="row py-2">
                                                                    <div class="col-md-12">
                                                                        <a href="" data-toggle="modal" data-target="#create-initiative" class="col-action"><img src="images/icons/add-circle.svg" class="mr-1"> Add Initiative</a>
                                                                    </div>
                                                                </div>
                                                                <!-- end Add New -->
                                                            </div>
                                                            <!-- end Initiative -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end Item -->
                                        <!-- begin Add New -->
                                        <div class="row py-2">
                                            <div class="col-md-12">
                                                <a href="" data-toggle="modal" data-target="#create-key-result" class="col-action"><img src="images/icons/add-circle.svg" class="mr-1"> Add Key Result</a>
                                            </div>
                                        </div>
                                        <!-- end Add New -->
                                    </div>
                                    <!-- end Key Results -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>