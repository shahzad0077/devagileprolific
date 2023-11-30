<div class="container-fluid py-5 w-96">
                    <div class="row">
                        <div class="col-md-12 p-0">
                            <div class="card">
                                <div class="card-body p-10">
                                    <table id="example" class="table">
                                        <thead>
                                            <tr>
                                                <td>
                                                    <label class="form-checkbox">
                                                        <input type="checkbox" id="checkAll">
                                                        <span class="checkbox-label"></span>
                                                    </label>
                                                </td>
                                                <td>Member</td>
                                                <td>Email address</td>
                                                <td>Phone Number</td>
                                                <td>Role</td>
                                                <td>Status</td>
                                                <td>Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         

                                           
                                              @if (session('message'))
                                              <div class="alert alert-success mt-1" role="alert">
                                                  {{ session('message') }}
                                              </div>
                                               @endif
                                               
                                           @foreach($Member as $member)
                                            <tr>
                                                <td>
                                                    <label class="form-checkbox">
                                                        <input type="checkbox">
                                                        <span class="checkbox-label"></span>
                                                    </label>
                                                </td>
                                                <td class="image-cell">
                                                    @if($member->image != NULL)
                                                    <img src="{{asset('public/assets/images/'.$member->image)}}" alt="Example Image">
                                                    @else
                                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTv1Tt9_33HyVMm_ZakYQy-UgsLjE00biEArg&usqp=CAU" alt="Example Image">
                                                    @endif
                                                    <div>
                                                        <div class="title">{{$member->name}}</div>
                                                    </div>
                                                </td>
                                                <td>{{$member->email}}</td>
                                                <td>{{$member->phone}}</td>
                                                <td>{{$member->u_role}}</td>
                                                <td>
                                                    @if($member->u_status == 1)
                                                    <span class="badge badge-pill badge-success">Active</span>
                                                    @else
                                                     <span class="badge badge-pill badge-danger">Blocked</span>
                                                    @endif
                                                    <!--<span class="badge badge-pill badge-warning">Pending Invite</span>-->
                                                   
                                                </td>
                                                
                                                <td>
                                                    <button class="btn-circle btn-tolbar" data-toggle="modal" data-target="#edit-member{{$member->ID}}">
                                                        <img src="{{asset('public/assets/images/icons/edit.svg')}}" data-toggle="tooltip" data-placement="top" data-original-title="Edit">
                                                    </button>
                                                    <button class="btn-circle btn-tolbar">
                                                        <img src="{{asset('public/assets/images/icons/delete.svg')}}" data-toggle="tooltip" data-placement="top" data-original-title="Delete">
                                                    </button>
                                                </td>
                                            </tr>
                                            
                      <div class="modal fade" id="edit-member{{$member->ID}}" tabindex="-1" role="dialog" aria-labelledby="edit-member" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content" style="width: 526px !important;">
                                <div class="modal-header">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h5 class="modal-title" id="create-epic">Edit User</h5>
                                        </div>
                                        <div class="col-md-12">
                                            <p>Fill out the form & we'll send them an invite</p>
                                        </div>
                              
                                        
                                    </div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <img src="{{asset('public/assets/images/icons/minus.svg')}}">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="needs-validation" action="{{url('edit-member')}}" method="POST" enctype="multipart/form-data">
                                     @csrf    
                                        <input type="hidden" name="member_id" value="{{$member->ID}}">
                                         <input type="hidden" name="user_id" value="{{$member->u_id}}">
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12 col-xl-12">
                                                <div class="form-group mb-0">
                                                    <input type="text" class="form-control" value="{{$member->name}}" name="name" >
                                                    <label for="objective-name">Full Name</label>
                                                </div>
                                            </div>
                                            <!--<div class="col-md-12 col-lg-12 col-xl-12">-->
                                            <!--    <div class="form-group mb-0">-->
                                            <!--        <input type="email" class="form-control" value="{{$member->email}}" id="email_edit" readonly>-->
                                            <!--        <label for="email">Email</label>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            <div class="col-md-12 col-lg-12 col-xl-12">
                                                <div class="form-group mb-0">
                                                    <input type="text" value="{{$member->phone}}" class="form-control" onkeypress="return onlyNumberKey(event)" name="phone" >
                                                    <label for="phone-number">Phone number</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-12 col-lg-12 col-xl-12">
                                            <div class="form-group mb-0">
                                               <select class="form-control"  name="status">
                                                   <option @if($member->status == 1) selected @endif value="1">Active</option>
                                                    <option @if($member->status == 0) selected @endif value="0">Blocked</option>

                
                                               </select>
                                                <label for="small-description">Status</label>
                                            </div>
                                        </div>
                                            
                                            <div class="col-md-12 col-lg-12 col-xl-12">
                                                <div class="form-group mb-0">
                                                    <input type="text" class="form-control" value="{{$member->u_role}}" readonly name="role" >
                                                    <label for="role">Role</label>
                                                </div>
                                            </div>
                                            
                                            
                                            <input type="hidden" id="old_image" name="old_image" value="{{ $member->image }}">
                                            <div class="col-md-12 col-lg-12 col-xl-12">
                                            <img src="{{asset('public/assets/images/'.$member->image)}}" style="width:100px; height:100px; object-fit:cover" alt="Example Image">
                                                <div class="form-group mb-0">
                                                    <input type="file" class="form-control" name="image" >
                                                    <label for="profile">Profile Picture</label>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button class="btn btn-primary btn-lg btn-theme btn-block ripple" type="submit">Submit</button>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>