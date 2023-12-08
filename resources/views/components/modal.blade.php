<!-- Updated by Usama Start-->
<div class="modal fade" id="edit-epic-flag" tabindex="-1" role="dialog" aria-labelledby="edit-epic" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 526px !important;">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="create-epic">Flag a Risk</h5>
                    </div>
                    <div class="col-md-12">
                        <p>Fill out the form, submit and hit the save button.</p>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                </button>
            </div>
            <div class="modal-body flagmodalbody">
                
            </div>
        </div>
    </div>
</div>
<!-- Updated By Usama End -->
<div class="modal fade" id="create-key-result" tabindex="-1" role="dialog" aria-labelledby="create-key-result" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 526px !important;">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="create-key-result">Create Key Result</h5>
                    </div>
                    <div class="col-md-12">
                        <p>Fill out the form, submit and hit the save button.</p>
                    </div>
                    
                    <div id="success-obj-key"  role="alert"></div>
                    <span id="key-feild-error" class="ml-3 text-danger"></span>

                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                </button>
            </div>
            <div id="wieght-error"></div>
            <div class="row" id="weight">
              
             </div>
        
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label class="checkbox checkbox-lg mb-3">
                            <input class="check" type="checkbox" />
                            <span class="mr-3">Add Weight</span>
                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form class="needs-validation" method="POST" action="#" novalidate>
                        @csrf
                        <input type="hidden" id="key_obj_id">
                        <div class="row">
                            <small id="obj-key-name-error" class="mb-5 ml-5"></small>

                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group mb-0">
                                    <input type="text" class="form-control" id="key_name" required>
                                    <label for="objective-name">Key Result Title</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group mb-0">
                                    <input type="date" class="form-control" value="{{ date('Y-m-d') }}"   onchange="get_date(this.value,'key_end_date')" id="key_start_date" >
                                    <label for="start-date">Start Date</label>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group mb-0">
                                    <input type="date" class="form-control"  id="key_end_date" required>
                                    <label for="end-date">End Date</label>
                                </div>
                            </div>
                               <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group mb-0">
                                   <select class="form-control" id="key_status" >
                                    <option value="To Do">To Do</option>
                                      <option value="In progress">In Progress</option>
                                       <option value="Done">Done</option>

                                   </select>
                                    <label for="small-description">Status</label>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="form-group mb-0">
                                    <input type="text" class="form-control" id="key_detail" required>
                                    <label for="small-description">Small Description</label>
                                </div>
                            </div>
                            @if($type == 'unit' || $type == 'stream')
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="d-flex flex-row align-items-center justify-content-between mt-4">
                                      <div>
                                        Teams
                                      </div>

                               <a href="javascript:void(0);" onclick="appendteam();" class="add_team text-black" title="Add field"><i class="fa fa-plus" aria-hidden="true"></i></a> 

                                    
                                </div>
                                <hr>
                                </div>

                                
                           
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group mb-0">
                                 <select name="key-team"  id="key-team" onchange="getteamobj(this.value,1)"  class="form-control key-team" value="" required>
                                                        
                                </select>
                                    <label for="small-description" style="bottom:72px">Choose Team</label>
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <div class="form-group mb-0">
                                 <select name="obj-team"  id="obj-team1"  class="form-control obj-team"  required>
                                                        
                                </select>
                                    <label for="small-description" style="bottom:72px">Choose Objective</label>
                                </div>
                            </div>

                            <div class="col-md-12 field_wrapper_bu_team"></div>
                            @endif

                        <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="d-flex flex-row align-items-center justify-content-between mt-4">
                              <div>
                                Target Values
                              </div>
                            
                        </div>
                        <hr>
                        </div>

                            <div class="col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group mb-0">
                                   <select class="form-control" id="key_result_type">
                                    <option value="">Select Key Result type</option>
                                    <option  value="Should Increase to">Should Increase To</option>
                                      <option value="Should decrease to">Should decrease To</option>
                                       <option value="Should stay above">Should stay above</option>
                                       <option value="Should stay below">Should stay below</option>
                                       <option value="Achieved">Achieved or not(100% / 0%)</option>

                                   </select>
                                    <label for="small-description">Key Result Type</label>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group mb-0">
                                   <select class="form-control" id="key_result_unit" >
                                    <option value="">Select Key Result Unit</option>
                                    <option  value="number">Number</option>
                                      <option value="pound £">pound £</option>
                                       <option value="Euro €">Euro €</option>
                                       <option value="Dollar $">Dollar $</option>

                                   </select>
                                    <label for="small-description">Unit</label>
                                </div>
                            </div>
                            
                            <div id="target-error" class="w-100 mb-3 ml-2 text-danger"></div>
                            <div class="col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group mb-0">
                                    <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="init_value" required>
                                    <label for="objective-name">Initial Number</label>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-12 col-xl-6">
                                <div class="form-group mb-0">
                                    <input type="text"  onkeypress="return onlyNumberKey(event)"  class="form-control" id="target_number" required>
                                    <label for="objective-name">Target Number</label>
                                </div>
                            </div>
                            
                                        <div class="col-md-8 mt-1 mb-4">
                                        <div class="form-group mb-0">
                                         <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control target_value" placeholder="" id=""  onkeypress="return onlyNumberKey(event)">
                                         <label for="small-description">Quarter 1 Target Value</label>
                                        </div> 
                                        </div>
                                            <div class="col-md-4 mt-5">
                                            <a href="javascript:void(0);" class="add_value text-black" title="Add field"><i class="fa fa-plus" aria-hidden="true"></i></a>

                                    </div>
                                    <div class="col-md-12 field_wrapper_key"></div>
                                    
                            <div class="col-md-12">
                                <button type="button" onclick="saveKeyObjective();" class="btn btn-primary btn-lg btn-theme btn-block ripple">Submit</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="edit-key-result" tabindex="-1" role="dialog" aria-labelledby="edit-key-result" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 550px !important;">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="create-key-result">Update Key Result</h5>
                    </div>
                    <div class="col-md-12">
                        <p>Fill out the form, submit and hit the save button.</p>
                    </div>
                    <div id="success-obj-key-edit"  role="alert"></div>
                    <span id="key-feild-error-edit" class="ml-3 text-danger"></span>

                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                </button>
            </div>
            
                 <div id="wieght-error-edit"></div>
                 <div class="row mt-3 mb-2" id="weight-edit">
    

                 </div>
                 
              
            <div class="modal-body">
                <form class="needs-validation" method="POST" action="#" novalidate>
                    @csrf
                    <input type="hidden" id="edit_key_obj_id">
                    <input type="hidden" id="edit_key_obj">

                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" id="edit_key_name" required>
                                <label for="objective-name">Key Result Title</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <input type="date" class="form-control" id="edit_key_start_date"  required>
                                <label for="start-date">Start Date</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <input type="date" class="form-control" id="edit_key_end_date"  required>
                                <label for="end-date">End Date</label>
                            </div>
                        </div>
                        
                              <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                               <select class="form-control" id="edit_key_status" >
                                <option value="To Do">To Do</option>
                                  <option value="In progress">In Progress</option>
                                   <option value="Done">Done</option>

                               </select>
                                <label for="small-description">Status</label>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" id="edit_key_detail" required>
                                <label for="small-description">Small Description</label>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="d-flex flex-row align-items-center justify-content-between mt-4">
                                  <div>
                                    Target Values
                                  </div>
                                
                            </div>
                            <hr>
                            </div>
    
                                <div class="col-md-12 col-lg-12 col-xl-6">
                                    <div class="form-group mb-0">
                                       <select class="form-control" id="edit_key_result_type">
                                        <option value="Should Increase to">Should Increase To</option>
                                          <option value="Should decrease to">Should decrease To</option>
                                           <option value="Should stay above">Should stay above</option>
                                           <option value="Should stay below">Should stay below</option>
                                           <option value="Achieved">Achieved or not(100% / 0%)</option>
    
                                       </select>
                                        <label for="small-description">Key Result Type</label>
                                    </div>
                                </div>
    
                                <div class="col-md-12 col-lg-12 col-xl-6">
                                    <div class="form-group mb-0">
                                       <select class="form-control" id="edit_key_result_unit" >
                                        <option value="number">Number</option>
                                          <option value="pound £">pound £</option>
                                           <option value="Euro €">Euro €</option>
                                           <option value="Dollar $">Dollar $</option>
    
                                       </select>
                                        <label for="small-description">Unit</label>
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-12 col-xl-6">
                                    <div class="form-group mb-0">
                                        <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="edit_init_value" required>
                                        <label for="objective-name">Initial Number</label>
                                    </div>
                                </div>
    
                                <div class="col-md-12 col-lg-12 col-xl-6">
                                    <div class="form-group mb-0">
                                        <input type="text" onkeypress="return onlyNumberKey(event)" class="form-control" id="edit_target_number" required>
                                        <label for="objective-name">Target Number</label>
                                    </div>
                                </div>

                        <div class="row ml-1">
                            <div class="col-md-12 key-chart-data">
                         
                                       
                                  
                            </div>
                        </div>


                        <div class="col-md-12">
                            <button type="button" onclick="updateKeyObjective();" class="btn btn-primary btn-lg btn-theme btn-block ripple">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-objective-key" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Objective Key Result</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="success-key-delete"  role="alert"></div>

        <form method="POST" action="">
         @csrf   
         <input type="hidden" name="" id="key_delete_id">
         <input type="hidden" name="" id="key_delete_obj_id">

        <div class="modal-body">
          
        Are you sure you want to delete this Key Result?

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" onclick="DeleteObjectivekey();" class="btn btn-danger">Confirm</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<!-- Create Epic -->

<div class="modal fade" id="create-objective" tabindex="-1" role="dialog" aria-labelledby="create-objective" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 526px !important;">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="create-objective">Create objective</h5>
                    </div>
                    <div class="col-md-12">
                        <p>Fill out the form, submit and hit the save button.</p>
                    </div>
                    <div id="success-obj"  role="alert"></div>
                    <span id="obj-feild-error" class="ml-3 text-danger"></span>
    
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="POST" >
                    @csrf
                    <div class="row">
                        <small id="obj-name-error" class="mb-5 ml-5"></small>
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" id="objective_name" required>
                                <label for="objective-name">Objective Name</label>

                            </div>
                        </div>




                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <input type="date" class="form-control" value="{{date('Y-m-d')}}" onchange="get_date(this.value,'end_date')" id="start_date"  required>
                                <label for="start-date">Start Date</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <input type="date" class="form-control" id="end_date"  required>
                                <label for="end-date">End Date</label>
                            </div>
                        </div>
                        
                            <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                               <select class="form-control" id="obj_status" >
                                <option value="To Do">To Do</option>
                                  <option value="In progress">In Progress</option>
                                   <option value="Done">Done</option>

                               </select>
                                <label for="small-description">Status</label>
                            </div>
                        </div>
                        
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" id="obj_small_description" >
                                <label for="small-description">Small Description</label>
                            </div>
                        </div>
                        
                  
                        @if($type == 'BU')
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="d-flex flex-row align-items-center justify-content-between mt-4">
                                  <div>
                                    Team's Linking
                                  </div>

                           <a href="javascript:void(0);" onclick="appendBu();" class="text-black" title="Add field"><i class="fa fa-plus" aria-hidden="true"></i></a> 

                                
                            </div>
                            <hr>
                            </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                          <div class="form-group mb-0">
                             <select class="form-control unitobj" onchange="getUnitObj(this.value,1)">
                              <option value="" >Select Business Unit</option>
                              <?php foreach(DB::table('business_units')->where('id',$organization->org_id)->get() as $r){ ?>
                                <option value="{{ $r->id }}">{{ $r->business_name }}</option>
                                 <?php }  ?>

                             </select>
                              <label for="small-description">Choose Business Unit</label>
                          </div>
                      </div>

                      <div class="col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group mb-0">
                         <select name="" id="bu-obj1" onchange="getBUKey(this.value,1)"  class="form-control bu-obj" value="" required>
                                                
                        </select>
                            <label for="small-description" >Choose Objective</label>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group mb-0">
                         <select name="" id="key-BU1"   class="form-control key-BU" value="" required>
                                                
                        </select>
                            <label for="small-description" >Choose Key Result</label>
                        </div>
                    </div>

                    <div class="col-md-12 field_wrapper_bu"></div>

                      @endif

                      @if($type == 'VS')
                      <div class="col-md-12 col-lg-12 col-xl-12">
                          <div class="d-flex flex-row align-items-center justify-content-between mt-4">
                                <div>
                                  Team's Linking
                                </div>

                         <a href="javascript:void(0);" onclick="appendBu();" class="text-black" title="Add field"><i class="fa fa-plus" aria-hidden="true"></i></a> 

                              
                          </div>
                          <hr>
                          </div>
                      <div class="col-md-6 col-lg-6 col-xl-6">
                        <div class="form-group mb-0">
                           <select class="form-control unitobj" onchange="getUnitObj(this.value,1)">
                            <option value="" >Select Value Stream</option>
                            <?php foreach(DB::table('value_stream')->where('id',$organization->org_id)->get() as $r){ ?>
                              <option value="{{ $r->id }}">{{ $r->value_name }}</option>
                               <?php }  ?>

                           </select>
                            <label for="small-description">Choose Value Stream</label>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-xl-6">
                      <div class="form-group mb-0">
                       <select name="" id="bu-obj1" onchange="getBUKey(this.value,1)"  class="form-control bu-obj" value="" required>
                                              
                      </select>
                          <label for="small-description" >Choose Objective</label>
                      </div>
                  </div>

                  <div class="col-md-6 col-lg-6 col-xl-6">
                      <div class="form-group mb-0">
                       <select name="" id="key-BU1"   class="form-control key-BU" value="" required>
                                              
                      </select>
                          <label for="small-description" >Choose Key Result</label>
                      </div>
                  </div>

                  <div class="col-md-12 field_wrapper_bu"></div>

                    @endif
                   

                        
                        <div class="col-md-12">
                            <button onclick="saveObjective();" type="button" class="btn btn-primary btn-lg btn-theme btn-block ripple">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="edit-objective" tabindex="-1" role="dialog" aria-labelledby="edit-objective" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 526px !important;">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="create-objective">Update objective</h5>
                    </div>
                    <div class="col-md-12">
                        <p>Fill out the form, submit and hit the save button.</p>
                    </div>
                    <div id="success-obj-edit"  role="alert"></div>
                    <span id="obj-feild-error-edit" class="ml-3 text-danger"></span>
    
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="POST" >
                    @csrf
                    <input type="hidden" name="obj_id" id="edit_obj_id">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" id="edit_objective_name" required>
                                <label for="objective-name">Objective Name</label>
                            </div>
                            <small id="" class="mb-2 ml-5"></small>

                        </div>


                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <input type="date" class="form-control" id="edit_start_date"  required>
                                <label for="start-date">Start Date</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <input type="date" class="form-control" id="edit_end_date"  required>
                                <label for="end-date">End Date</label>
                            </div>
                        </div>
                        
                               <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                               <select class="form-control" id="edit_obj_status" >
                                <option value="To Do">To Do</option>
                                  <option value="In progress">In Progress</option>
                                   <option value="Done">Done</option>

                               </select>
                                <label for="small-description">Status</label>
                            </div>
                        </div>
                        
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" id="edit_obj_small_description" >
                                <label for="small-description">Small Description</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button onclick="UpdateObjective();" type="button" class="btn btn-primary btn-lg btn-theme btn-block ripple">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-objective" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Objective</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="success-obj-delete"  role="alert"></div>

        <form method="POST" action="">
         @csrf   
         <input type="hidden" name="obj_delete_id" id="obj_delete_id">
        <div class="modal-body">
          
        Are you sure you want to delete this Objective?

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" onclick="DeleteObjective();" class="btn btn-danger">Confirm</button>
        </div>
        </form>
      </div>
    </div>
  </div>
<!-- Create Initiative -->
<div class="modal fade" id="create-initiative" tabindex="-1" role="dialog" aria-labelledby="create-initiative" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 526px !important;">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="create-initiative">Create Initiative</h5>
                    </div>
                    <div class="col-md-12">
                        <p>Fill out the form, submit and hit the save button.</p>
                    </div>
                    <div id="success-initiative"  role="alert"></div>
                    <span id="initiative-feild-error" class="ml-3 text-danger"></span>

                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                </button>
            </div>
            
              <div id="wieght-error-initiative"></div>
            <div class="row" id="weight-initiative">
              
             </div>
                
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label class="checkbox checkbox-lg mb-3 ml-4">

                        <input class="checkweight" type="checkbox" />

                        <span class="mr-3"></span>

                        Add Weight

                        </label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <form class="needs-validation" method="POST" action="#" novalidate>
                    @csrf
                    <input type="hidden" id="key_id_initiative">
                    <input type="hidden" id="obj_id_initiative">

                    <div class="row">
                        <small id="initiative-name-error" class="mb-5 ml-5"></small>
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" id="initiative_name" required>
                                <label for="objective-name">Initiative Name</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <input type="date" class="form-control" value="{{date('Y-m-d')}}"  id="initiative_start_date" onchange="get_date(this.value,'initiative_end_date')"  >
                                <label for="start-date">Start Date</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <input type="date" class="form-control"  id="initiative_end_date" >
                                <label for="end-date">End Date</label>
                            </div>
                        </div>
                         <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                               <select class="form-control" id="init_status" >
                                <option value="To Do">To Do</option>
                                  <option value="In progress">In Progress</option>
                                   <option value="Done">Done</option>

                               </select>
                                <label for="small-description">Status</label>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" id="initiative_detail" required>
                                <label for="small-description">Small Description</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="button" onclick="saveKeyinitiative();" class="btn btn-primary btn-lg btn-theme btn-block ripple">Submit</button>
                        </div>
                    </div>
                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-initiative" tabindex="-1" role="dialog" aria-labelledby="edit-initiative" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 526px !important;">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="create-initiative">Update Initiative</h5>
                    </div>
                    <div class="col-md-12">
                        <p>Fill out the form, submit and hit the save button.</p>
                    </div>
                    <div id="success-initiative-edit"  role="alert"></div>
                    <span id="initiative-feild-error-edit" class="ml-3 text-danger"></span>
                   <span  id="initiative-date-error" class="ml-3 text-danger"></span>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                </button>
            </div>
            
            <div id="wieght-error-edit-init"></div>
                 <div class="row mt-3 mb-2" id="initiative-edit-weight">
                 </div>
                 
            <div class="modal-body">
                <form class="needs-validation" method="POST" action="#" novalidate>
                    @csrf
                    <input type="hidden" id="edit_id_initiative">
                    <input type="hidden" id="edit_id_initiative_key">
                    <input type="hidden" id="edit_id_initiative_obj">
                    <div class="row">
                        <small id="initiative-name-error-edit" class="mb-5 ml-5"></small>
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" id="edit_initiative_name" required>
                                <label for="objective-name">Initiative Name</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <input type="date" class="form-control edit_initiative_start_date" id="edit_initiative_start_date" required>
                                <label for="start-date">Start Date</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <input type="date" class="form-control" id="edit_initiative_end_date"  required>
                                <label for="end-date">End Date</label>
                            </div>
                        </div>
                        
                           <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                               <select class="form-control" id="edit_initiative_status" >
                                <option value="To Do">To Do</option>
                                  <option value="In progress">In Progress</option>
                                   <option value="Done">Done</option>

                               </select>
                                <label for="small-description">Status</label>
                            </div>
                        </div>
                        
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" id="edit_initiative_detail" required>
                                <label for="small-description">Small Description</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="button" onclick="UpdateKeyinitiative();" class="btn btn-primary btn-lg btn-theme btn-block ripple">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="delete-initiative-key" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Initiative</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="success-initiative-delete"  role="alert"></div>

        <form method="POST" action="">
         @csrf   
         <input type="hidden" name="" id="initiative_delete_id">
         <input type="hidden" name="" id="initiative_delete_obj_id">
         <input type="hidden" name="" id="initiative_delete_key_id">

        <div class="modal-body">
          
        Are you sure you want to delete this Initiative?

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" onclick="Deletekeyinitiative();" class="btn btn-danger">Confirm</button>
        </div>
        </form>
      </div>
    </div>
  </div>


{{-- Create Organization --}}


  <!-- Create Epic -->
  <div class="modal fade" id="create-org" tabindex="-1" role="dialog" aria-labelledby="create-org" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 526px !important;">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="">Create new Organization</h5>
                    </div>
                    <div class="col-md-12">
                        <p>Fill out the form, submit and hit the save button.</p>
                    </div>
                    <div id="success"  role="alert"></div>
                    <span id="org-feild-error" class="ml-3 text-danger"></span>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="POST" action="#"  enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" name="organization_name" required id="organization_name">
                                <label for="objective-name">organization Name</label>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" required name="email" id="email" required>
                                <label for="start-date">Email</label>
                            </div>
                        </div>

                        <small id="email-error" class="mb-2 ml-5"></small>

                          
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="number" class="form-control" required name="phone_no" id="phone">
                                <label for="end-date">Phone number</label>
                            </div>
                        </div>
                        <small id="phone-error" class="mb-2 ml-5"></small>

                        <div class="col-md-12 col-lg-12 col-xl-12">
                             <div class="form-group mb-0">
                                <input type="file" class="form-control" required name="logo"  id="add_logo" >
                                <label for="logo">Logo</label>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" name="detail" id="small_description" required>
                                <label for="small-description">Small Description</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button  type="button" onclick="saveOrganization();" class="btn btn-primary btn-lg btn-theme btn-block ripple">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="delete-org" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Organization</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{url('delete-org')}}">
         @csrf   
         <input type="hidden" name="org_id" id="org-id">
        <div class="modal-body">
          
        Are you sure you want to delete this Organization?

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Confirm</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="create-epic" tabindex="-1" role="dialog" aria-labelledby="create-epic" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 526px !important;">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="create-epic">Create Epic</h5>
                    </div>
                    <div class="col-md-12">
                        <p>Fill out the form, submit and hit the save button.</p>
                    </div>
                      <div id="success-epic"  role="alert"></div>
                    <span id="epic-feild-error" class="ml-3 text-danger"></span>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" action="#" method="POST" novalidate>
                @csrf
                <input type="hidden" id="ini_epic_id">
                <input type="hidden" id="epic_obj">
                <input type="hidden" id="epic_key">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" id="epic_name" required>
                                <label for="objective-name">Epic Title</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <input type="date" class="form-control" min="{{ date('Y-m-d') }}" id="epic_start_date"  required>
                                <label for="start-date">Start Date</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <input type="date" class="form-control" min="{{ date('Y-m-d') }}" id="epic_end_date" required>
                                <label for="end-date">End Date</label>
                            </div>
                        </div>
                          <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                               <select class="form-control" id="epic_status">
                                    <option value="To Do">To Do</option>
                                  <option value="In progress">In Progress</option>
                                   <option value="Done">Done</option>

                               </select>
                                <label for="small-description">Status</label>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" name="story[]" id="epic_description" required>
                                <label for="small-description">Small Description</label>
                            </div>
                        </div>
                        
                        <!--<h5 class="ml-3">Stories</h5>-->
                        
                        <!--  <div class="col-md-12 col-lg-12 col-xl-12">-->
                        <!--    <div class="form-group mb-0">-->
                        <!--        <input type="text" class="form-control epic-input" id="epic_story" required>-->
                        <!--        <label for="small-description">Add Story</label>-->
                        <!--    </div>-->
                        <!--</div>-->
                        
                        <div class="col-md-12 field_wrapper w-100"></div>
                        
                        
                        <!-- <div class="col-md-12">-->
                        <!--    <button class="btn btn-primary  w-50 mt-2 add_button" type="button">Add on item</button>-->
                        <!--</div>-->
                        
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-lg btn-theme btn-block ripple mt-3" onclick="saveEpic();"  type="button">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


  <div class="modal fade" id="edit-epic" tabindex="-1" role="dialog" aria-labelledby="edit-epic" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 626px !important;">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="create-epic">Edit Epic</h5>
                    </div>
                    <div class="col-md-12">
                        <p>Fill out the form, submit and hit the save button.</p>
                    </div>
                      <div id="success-epic-edit"  role="alert"></div>
                    <span id="epic-feild-error-edit" class="ml-3 text-danger"></span>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" action="#" method="POST" novalidate>
                @csrf
                 <input type="hidden" id="edit_epic_id">
                <input type="hidden" id="edit_ini_epic_id">
                <input type="hidden" id="edit_epic_obj">
                <input type="hidden" id="edit_epic_key">
                <input type="hidden" id="edit_buisness_unit_id">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" id="edit_epic_name" required>
                                <label for="objective-name">Epic Title</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <input type="date" class="form-control" id="edit_epic_start_date"  required>
                                <label for="start-date">Start Date</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <input type="date" class="form-control" id="edit_epic_end_date" required>
                                <label for="end-date">End Date</label>
                            </div>
                        </div>
                          <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                               <select class="form-control" id="edit_epic_status" >
                                   <option value="To Do">To Do</option>
                                  <option value="In progress">In Progress</option>
                                   <option value="Done">Done</option>

                               </select>
                                <label for="small-description">Status</label>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control"  id="edit_epic_description" >
                                <label for="small-description">Small Description</label>
                            </div>
                        </div>
                        
                        <!--  <div class="col-md-12 col-lg-12 col-xl-12">-->
                        <!--    <div class="d-flex flex-row align-items-center justify-content-between mt-4">-->
                        <!--        <div>-->
                        <!--            Assign Team-->
                        <!--        </div>-->
                            
                        <!--    </div>-->
                        <!--    <hr>-->
                        <!--</div>-->                  
                       
                            <div class="col-md-12 col-lg-12 col-xl-12" id="all-team">
                          
                            </div>
                           
                        
                        
            
                        
                      <div class="col-md-12 col-lg-12 col-xl-12" id="epic_story_edit"></div>        
                        <div class="row ml-2">
                            <div class="col-md-12" id="epic_story_edit">
                         
                                       
                                  
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="d-flex flex-row align-items-center justify-content-between comment-header">
                                    <div>
                                        <h4>Comments</h4>
                                    </div>
                                    <div class="dropdown">
                                      <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="7" viewBox="0 0 11 7" fill="none">
                                          <path d="M10.8339 0.644857C10.6453 0.456252 10.3502 0.439106 10.1422 0.593419L10.0826 0.644857L5.49992 5.2273L0.917236 0.644857C0.72863 0.456252 0.433494 0.439106 0.225519 0.593419L0.165935 0.644857C-0.0226701 0.833463 -0.0398163 1.1286 0.114497 1.33657L0.165935 1.39616L5.12427 6.35449C5.31287 6.5431 5.60801 6.56024 5.81599 6.40593L5.87557 6.35449L10.8339 1.39616C11.0414 1.18869 11.0414 0.852323 10.8339 0.644857Z" fill="#787878"/>
                                        </svg> Order By
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="#">Latest</a>
                                        <a class="dropdown-item" href="#">Older</a>
                                      </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-12 col-xl-12">
                                <div class="d-flex flex-column">
                                    <div>
                                        <div class="form-group mb-0">
                                            <input type="text" class="form-control" id="edit-epic-comment" required>
                                            <label for="objective-name">Write Comment</label>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-default btn-sm">Cancel</button>
                                        <button type="button" onclick="SaveEditComment();" class="btn btn-primary btn-sm">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                         <div class="row mt-4 comment-area ml-2" style="width:100%" id="edit-comment_area">
                    
                         </div>
    
                                          
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-lg btn-theme btn-block ripple mt-3" onclick="UpdateEpic();"  type="button">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Create Chart-->

<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="create-chart" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 526px !important;">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="">New KPI</h5>
                    </div>
                    <div class="col-md-12">
                        <p>Add a Kpi CVC file</p>
                    </div>
                    <div id="success-chart"  role="alert"></div>
                    <span id="chart-feild-error" class="ml-3 text-danger"></span>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="POST" action="#"  enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" name="title" required id="title">
                                <label for="objective-name">Chart Title</label>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" required name="subtitle" id="subtitle" >
                                <label for="start-date">SubTitle</label>
                            </div>
                        </div>


                          
                        <div class="col-md-12 col-lg-12 col-xl-12">
                             <div class="form-group mb-0">
                                <input type="file" class="form-control" required name="file" accept=".xlsx,.xls,.csv"  id="addfile" >
                                <label for="logo">Upload CSV file</label>
                            </div>
                        </div>

                      
                        <div class="col-md-12">
                            <button  type="button" onclick="saveChartData();" class="btn btn-primary btn-lg btn-theme btn-block ripple">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-chart" tabindex="-1" role="dialog" aria-labelledby="edit-chart" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 526px !important;">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="">Edit/Update Values</h5>
                    </div>
                    <div class="col-md-12">
                        <p>Add a Performance Statistics</p>
                    </div>
                    <div id="success-chart-edit"  role="alert"></div>
                    <span id="" class="ml-3 text-danger"></span>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="POST" action="#"  enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="kpi">
                    <div class="row" id="chart-data">
                       
                    
                       
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="delete-chart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Chart</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div id="success-delete-chart"  role="alert"></div>

        <form method="POST" action="">
         @csrf   
         <input type="hidden" name="" id="chart_id">
       

        <div class="modal-body">
          
        Are you sure you want to delete this Graph?

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" onclick="DeleteChart();" class="btn btn-danger">Confirm</button>
        </div>
        </form>
      </div>
    </div>
  </div>

 <div class="modal fade" id="edit-basic-chart" tabindex="-1" role="dialog" aria-labelledby="edit-chart" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 526px !important;">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="">Edit Basic Detail</h5>
                    </div>
                    <div class="col-md-12">
                        <p>Edit KPI basic details such as target value, statuses options and more.</p>
                    </div>
                    <div id="success-basic-edit"  role="alert"></div>
                    <span id="chart-feild-error-edit" class="ml-3 text-danger"></span>
                    <span id="green-feild-error-edit" class="ml-3 text-danger"></span>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" method="POST" action="#"  enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="chart_edit_id">
                    <input type="hidden" id="stream_id">
                    <div class="row" id="">


                              <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" 
                                    required name="" id="edit_chart_title">

                                <label for="objective-name">Chart Title</label>
                            </div>
                        </div>
                        
                         <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" 
                                    required name="" id="edit_chart_subtitle">

                                <label for="objective-name">Chart SubTitle</label>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" onkeypress="return onlyNumberKey(event)"
                                    required name="" id="edit_t_value">

                                <label for="objective-name" style="bottom:72px">Target Value</label>
                            </div>
                        </div>
                        
                           <!--<div class="col-md-6 col-lg-6 col-xl-6">-->
                           <!--     <div class="form-group mb-0">-->
                           <!--         <select class="form-control" id="t_display_edit">-->
                                        
                           <!--             <option value="No">No</option>-->
                           <!--             <option value="Yes">Yes</option>-->
                           <!--         </select>-->
                           <!--         <label for="objective-name">Display Guide Line</label>-->
                           <!--     </div>-->
                           <!-- </div>-->
                            
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <input type="date" class="form-control" min="{{ date('Y-m-d') }}" required
                                    name="" id="edit_t_date">
                                <label for="start-date">Target Date</label>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <select class="form-control" id="edit_t_line">
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>

                                </select>
                                <label for="objective-name">Trend Line</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <select class="form-control" id="edit_t_bar">
                                    <option value="Bar">Vertical Bar</option>
                                    <option value="Line">Line</option>

                                </select>
                                <label for="objective-name">Chart Type</label>
                            </div>
                        </div>
                        <div class="col-md-12 mb-5">
                            <span><input name="collapseGroupedit"  id="edit_target_option_1" type="radio" value="yes"
                                    class="yes_edit collapseGroup mr-2 editcollapseGroup"  data-toggle="collapse"
                                    data-target="#collapseOne" />Option 1: Red and Green Statuses</span>
                        </div>

                             <div class="col-md-12 col-lg-12 col-xl-12 edit_option_1">
                            <div class="form-group mb-0">
                                
                                <select class="form-control" id="target_status">
                                <option value="Greater">Greater than</option>
                                <option value="Less">Less than</option>
                                </select>
                                <label for="">Select Value </label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 edit_option_1">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" onkeyup="get_val_edit(this.value)"
                                    value="" id="edit_g_value_opt_1">
                                <label for="">Green (Value)</label>
                            </div>
                        </div>
                        
                         <!--<div class="col-md-6 col-lg-6 col-xl-6 edit_option_1" >-->
                         <!--       <div class="form-group mb-0">-->
                         <!--           <select class="form-control" id="g_display_edit">-->
                                        
                         <!--               <option value="No">No</option>-->
                         <!--               <option value="Yes">Yes</option>-->
                         <!--           </select>-->
                         <!--           <label for="objective-name">Display Green Guide Line</label>-->
                         <!--       </div>-->
                         <!--   </div>-->
                        <!--<div class="col-md-6 col-lg-6 col-xl-6 edit_option_1">-->
                        <!--    <div class="form-group mb-0">-->
                        <!--        <input type="text"   class="form-control" id="edit_r_value_opt_1">-->
                        <!--        <label for="objective-name">Red (Value)</label>-->
                        <!--    </div>-->
                        <!--</div>-->

                        <div class="col-md-12 mb-5">
                            <span><input id="edit_target_option" name="collapseGroupedit"  value="no" type="radio"
                                    class="no_edit collapseGroup mr-2 editcollapseGroup" data-toggle="collapse"
                                    data-target="#collapseOne" />Option 2: RAG - Red, Amber and Green Statuses</span>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6 edit_option_2">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" onkeypress="return onlyNumberKey(event)"
                                    value="" id="edit_g_value_opt_2">
                                <label for="objective-name">Green (Value)</label>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-6 col-xl-6 edit_option_2">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" onkeypress="return onlyNumberKey(event)"
                                    value="" id="edit_r_value_opt_2">
                                <label for="objective-name">Red (Value)</label>
                            </div>
                        </div>
                        
                        <!--<div class="col-md-12 col-lg-12 col-xl-12 edit_option_2" >-->
                        <!--        <div class="form-group mb-0">-->
                        <!--            <select class="form-control" id="g_display_edit_2">-->
                                        
                        <!--                <option value="No">No</option>-->
                        <!--                <option value="Yes">Yes</option>-->
                        <!--            </select>-->
                        <!--            <label for="objective-name">Display Green Guide Line</label>-->
                        <!--        </div>-->
                        <!--    </div>-->

                        <div class="col-md-12 col-lg-12 col-xl-12 edit_option_2">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control"  value="" id="edit_a_value_opt_2">
                                <label for="objective-name">Amber (Value)</label>
                            </div>
                        </div>
                        
                        <div class="col-md-12 mb-5">
                            <span><input id="edit_target_option_3" name="collapseGroupedit"  value="null" type="radio"
                                    class="collapseGroup mr-2 editcollapseGroup" data-toggle="collapse"
                                    data-target="#collapseOne" />Option 3: No Status</span>
                        </div>

                        <button type="button" id="" onclick="UpdateChartDataBasic();"
                                class="btn btn-primary  btn-lg ">Update</button>
                       
                    
                       
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

  <div class="modal fade" id="create-report" tabindex="-1" role="dialog" aria-labelledby="create-report" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 526px !important;">
            <div class="modal-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="create-epic">Create Quarter/Sprint </h5>
                    </div>
                    <div class="col-md-12">
                        <p>Fill out the form, submit and hit the save button.</p>
                    </div>
                      <div id="success-sprint"  role="alert"></div>
                    <span id="sprint-error" class="ml-3 text-danger"></span>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                </button>
            </div>
            <div class="modal-body">
                <form class="needs-validation" action="#" method="POST" novalidate>
                @csrf
            
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" id="q_title" required>
                                <label for="objective-name">Quarter Title</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}" id="q_start_date"  required>
                                <label for="start-date">Start Date</label>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div class="form-group mb-0">
                                <input type="date" class="form-control" value="{{ date('Y-m-d') }}" id="q_end_date" required>
                                <label for="end-date">End Date</label>
                            </div>
                        </div>
                        
                        <div class="col-md-12 col-lg-12 col-xl-12">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control"  id="q_description" >
                                <label for="small-description">Description</label>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn-primary btn-lg btn-theme btn-block ripple mt-3" onclick="saveQuarter();"  type="button">Start</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




