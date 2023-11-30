                                       <table class="table data-table" id="olddata">
                                                <thead>
                                                    <tr>
                                                        <td>
                                                            <label class="form-checkbox">
                                                                <input type="checkbox" id="checkAll">
                                                                <span class="checkbox-label"></span>
                                                            </label>
                                                        </td>
                                                        <td>Title</td>
                                                        <td>Quarter</td>
                                                        <td>Start/End Date</td>
                                                        <td>Status</td>
                                                        <td>Progress</td>
                                                        <td>Action</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                       
                                                    @foreach($Backlog as $backlog)       
                                                    <tr>
                                                        <td>
                                                    <label class="form-checkbox">
                                                    <input type="checkbox" class="checkbox" value="{{$backlog->id}}">
                                                    <span class="checkbox-label"></span>
                                                  </label>
                                                        </td>
                                                        <td class="">
                                                            <img src="{{asset('public/assets/images/flash-svgrepo-com.svg')}}" width="25" height="25">
                                                          {{$backlog->epic_title}}
                                                        </td>
                                                          <td> 
                                                      
                                                        @if($backlog->assign_status == NULL)
                                                    
                                                 
                                                        Assign
                                                        
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none" data-toggle="modal"  data-target="#assign-unitbacklog-epic{{$backlog->id}}">
                                                              <path d="M4.72421 14.1377C4.29212 14.1377 3.88837 13.989 3.59796 13.7127C3.22962 13.3656 3.05254 12.8415 3.11629 12.2748L3.37837 9.9798C3.42796 9.54772 3.69004 8.97397 3.99462 8.6623L9.81004 2.50688C11.2621 0.969799 12.778 0.9273 14.315 2.37938C15.8521 3.83147 15.8946 5.3473 14.4425 6.88438L8.62712 13.0398C8.32962 13.3585 7.77712 13.656 7.34504 13.7269L5.06421 14.1165C4.94379 14.1235 4.83754 14.1377 4.72421 14.1377ZM12.0838 2.3723C11.5384 2.3723 11.0638 2.7123 10.5821 3.2223L4.76671 9.3848C4.62504 9.53355 4.46212 9.88772 4.43379 10.0931L4.17171 12.3881C4.14337 12.6219 4.20004 12.8131 4.32754 12.9335C4.45504 13.054 4.64629 13.0965 4.88004 13.061L7.16087 12.6715C7.36629 12.6361 7.70629 12.4519 7.84796 12.3031L13.6634 6.14772C14.5417 5.21272 14.8605 4.34855 13.5784 3.14438C13.0117 2.59897 12.523 2.3723 12.0838 2.3723Z" fill="#292D32"/>
                                                              <path d="M13.0824 8.06722C13.0683 8.06722 13.047 8.06722 13.0329 8.06722C10.8229 7.84764 9.04495 6.16889 8.70495 3.97305C8.66245 3.68264 8.86078 3.41347 9.1512 3.36389C9.44162 3.32139 9.71078 3.51972 9.76037 3.81014C10.0295 5.5243 11.4179 6.8418 13.1462 7.0118C13.4366 7.04014 13.6491 7.30222 13.6208 7.59264C13.5854 7.8618 13.3516 8.06722 13.0824 8.06722Z" fill="#292D32"/>
                                                              <path d="M15.6748 16.4255H2.9248C2.63439 16.4255 2.39355 16.1847 2.39355 15.8943C2.39355 15.6039 2.63439 15.363 2.9248 15.363H15.6748C15.9652 15.363 16.2061 15.6039 16.2061 15.8943C16.2061 16.1847 15.9652 16.4255 15.6748 16.4255Z" fill="#292D32"/>
                                                              </svg>
                                                        @endif      
                                                              
                                                   </td>
                                                   
                                                <div class="modal fade" id="assign-unitbacklog-epic{{$backlog->id}}" tabindex="-1" role="dialog" aria-labelledby="create-epic" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content" style="width: 526px !important;">
                                                            <div class="modal-header">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <h5 class="modal-title" id="create-epic">Assign Backlog Epic</h5>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <p>Fill out the form, submit and hit the save button.</p>
                                                                    </div>
                                                                      <div id=""  role="alert"></div>
                                                                    <span id="" class="ml-3 text-danger"></span>
                                                                </div>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <form class="needs-validation" action="{{url('assign-unitbacklog-epic')}}" method="POST">
                                                            @csrf   
                                                               
                                                                <input type="hidden" name="backlog_id" value="{{$backlog->id}}">
                                                
                                                                    <div class="row">
                                                                        <!--<div class="col-md-12 col-lg-12 col-xl-12">-->
                                                                        <!--    <div class="form-group mb-0">-->
                                                                        <!--        <input type="text" class="form-control" name="epic_name" id="" required>-->
                                                                        <!--        <label for="objective-name">Epic Title</label>-->
                                                                        <!--    </div>-->
                                                                        <!--</div>-->
                                                                    
                                                                          <div class="col-md-12 col-lg-12 col-xl-12">
                                                                            <div class="form-group mb-0">
                                                                               <select class="form-control category" id="" name="stream_obj" required>
                                                                                <option value="" >Select Business Unit</option>
                                                                                <?php foreach(DB::table('business_units')->where('user_id',Auth::id())->get() as $r){ ?>
                                                                                  <option value="{{ $r->id }}">{{ $r->business_name }}</option>-->
                                                                                   <?php }  ?>
                                                
                                                                               </select>
                                                                                <label for="small-description">Choose Business Unit</label>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                         <div class="col-md-12 col-lg-12 col-xl-12">
                                                                            <div class="form-group mb-0">
                                                                             <select name="locstate" id="" onchange="getvaluekey(this.value)"  class="form-control obj" value="" required>
                                                                                                    
                                                                            </select>
                                                                                <label for="small-description">Choose Objective</label>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                              <div class="col-md-12 col-lg-12 col-xl-12">
                                                                            <div class="form-group mb-0">
                                                                             <select name="lockey" id="" onchange="getvalueintit(this.value)"  class="form-control key" value="" required>
                                                                                                    
                                                                            </select>
                                                                                <label for="small-description">Choose Key Result</label>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                          <div class="col-md-12 col-lg-12 col-xl-12">
                                                                            <div class="form-group mb-0">
                                                                             <select name="locinit" id="" class="form-control init"  value="" required>
                                                                                                    
                                                                            </select>
                                                                                <label for="small-description">Choose initiative</label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                                                        <div class="form-group mb-0">
                                                                            <input type="date" class="form-control" name="start_date[]" value="{{ date('Y-m-d') }}" required>
                                                                            <label for="start-date">Start Date</label>
                                                                        </div>
                                                                    </div>
                                                
                                                                      <div class="col-md-6 col-lg-6 col-xl-6">
                                                                        <div class="form-group mb-0">
                                                                            <input type="date" class="form-control" name="end_date[]" required>
                                                                            <label for="start-date">End Date</label>
                                                                        </div>
                                                                    </div>
                                                                     
                                                                        
                                                                        <div class="col-md-12">
                                                                            <button class="btn btn-primary btn-lg btn-theme btn-block ripple mt-3"  type="submit">Assign Epics</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                         @php
                                                        $startdate = json_decode($backlog->epic_start_date);
                                                        $enddate = json_decode($backlog->epic_end_date);
                                                        @endphp
                                                        <td> 
                                                        @if($backlog->epic_end_date != '')
                                                      {{ \Carbon\Carbon::parse($backlog->epic_start_date)->format('M d')}}
                                                     
                                                        - {{ \Carbon\Carbon::parse($backlog->epic_end_date)->format('M d')}}
                                                    
                                                        @else
                                                         Epic Date Not Selected
                                                         @endif
                                                          </td>
                                                        <td>
                                                          <div class="text-center">
                                                                                          
                                                        @if($backlog->epic_status == 'In Progress')
                                                        <span class="badge-cs warning w-100">{{$backlog->epic_status}}</span>
                                                        @endif
                                                        @if($backlog->epic_status == 'Done')
                                                        <span class="badge-cs success">Done</span>
                                                        @endif
                                                        @if($backlog->epic_status == 'To Do')
                                                        <span class="badge-cs bg-primary">To Do</span>
                                                        @endif
                                                        </div>
                                                        </td>
                                                     
                                                        <td> 
                                                        <div class="d-flex flex-column">
                                                            <div class="ml-auto">
                                                                {{round($backlog->progress,2)}}%
                                                            </div>
                                                            <div>
                                                                <div class="progress">
                                                                  <div class="progress-bar" role="progressbar" style="width: {{$backlog->progress}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </td>
                                                        <td>
                                                            <button class="btn-circle btn-tolbar" data-toggle="modal" data-target="#create{{$backlog->id}}" >
                                                                <img src="{{asset('public/assets/images/icons/edit.svg')}}" data-toggle="tooltip" data-placement="top" data-original-title="Edit">
                                                            </button>
                                                            <button class="btn-circle btn-tolbar" data-toggle="modal" data-target="#delete{{$backlog->id}}">
                                                                <img src="{{asset('public/assets/images/icons/delete.svg')}}" data-toggle="tooltip" data-placement="top" data-original-title="Delete">
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    <div class="modal fade" id="delete{{$backlog->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">Delete Backlog</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                          </button>
                                                        </div>
                                                      
                                                
                                                        <form method="POST" action="{{url('delete-unit-backlog')}}">
                                                         @csrf   
                                                         <input type="hidden" name="delete_id" value="{{$backlog->id}}">
                                                       
                                                
                                                        <div class="modal-body">
                                                          
                                                        Are you sure you want to delete this Backlog?
                                                
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                          <button type="submit" class="btn btn-danger">Confirm</button>
                                                        </div>
                                                        </form>
                                                      </div>
                                                    </div>
                                                  </div>
                                                    
                            <div class="modal fade" id="create{{$backlog->id}}" tabindex="-1" role="dialog" aria-labelledby="create-epic" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content" style="width: 526px !important;">
                                    <div class="modal-header">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5 class="modal-title" id="create-epic">Update Backlog Epic</h5>
                                            </div>
                                            <div class="col-md-12">
                                                <p>Fill out the form, submit and hit the save button.</p>
                                            </div>
                                              <div id=""  role="alert"></div>
                                            <span id="" class="ml-3 text-danger"></span>
                                        </div>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="needs-validation" action="{{url('update-unitbacklog-epic')}}" method="POST" >
                                        @csrf
                                            <input type="hidden" name="backlog_id" value="{{$backlog->id}}">
                                            <div class="row">
                                                <div class="col-md-12 col-lg-12 col-xl-12">
                                                    <div class="form-group mb-0">
                                                        <input type="text" class="form-control" value="{{$backlog->epic_title}}" name="epic_name" id="" required>
                                                        <label for="objective-name">Epic Title</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group mb-0">
                                                        <input type="date" class="form-control"  name="epic_start_date" value="{{$backlog->epic_start_date}}">
                                                        <label for="start-date">Start Date</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xl-6">
                                                    <div class="form-group mb-0">
                                                        <input type="date" class="form-control"  name="epic_end_date" value="{{$backlog->epic_end_date}}">
                                                        <label for="end-date">End Date</label>
                                                    </div>
                                                </div>
                                                  <div class="col-md-12 col-lg-12 col-xl-12">
                                                    <div class="form-group mb-0">
                                                       <select class="form-control" name="epic_status">
                                                            <option value="To Do">To Do</option>
                                                          <option value="In progress">In Progress</option>
                                                           <option value="Done">Done</option>
                        
                                                       </select>
                                                        <label for="small-description">Status</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-lg-12 col-xl-12">
                                                    <div class="form-group mb-0">
                                                        <input type="text" class="form-control" value="{{$backlog->epic_detail}}"  name="epic_description">
                                                        <label for="small-description">Small Description</label>
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                        
                                                
                                                <div class="col-md-12">
                                                    <button class="btn btn-primary btn-lg btn-theme btn-block ripple mt-3"  type="submit">Update</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                     @endforeach


                                                 
                                                    <!-- Add more rows as needed -->
                                                </tbody>
                                            </table>
