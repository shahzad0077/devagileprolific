<div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="d-flex flex-row align-items-center justify-content-between comment-header">
            <div>
                <h4>Stories</h4>
            </div>
            <div>
                <div class="d-flex flex-row align-items-center">
                    <div class="dropdown">
                      <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="7" viewBox="0 0 11 7" fill="none">
                          <path d="M10.8339 0.644857C10.6453 0.456252 10.3502 0.439106 10.1422 0.593419L10.0826 0.644857L5.49992 5.2273L0.917236 0.644857C0.72863 0.456252 0.433494 0.439106 0.225519 0.593419L0.165935 0.644857C-0.0226701 0.833463 -0.0398163 1.1286 0.114497 1.33657L0.165935 1.39616L5.12427 6.35449C5.31287 6.5431 5.60801 6.56024 5.81599 6.40593L5.87557 6.35449L10.8339 1.39616C11.0414 1.18869 11.0414 0.852323 10.8339 0.644857Z" fill="#787878"/>
                        </svg> Order By
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Status</a>
                        <a class="dropdown-item" href="#">Type</a>
                        <a class="dropdown-item" href="#">Created</a>
                        <a class="dropdown-item" href="#">Assignee</a>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-sm" id="ButtonCollaps" type="button" data-toggle="collapse" data-target="#UpdateStory{{$epic->id}}" aria-expanded="false" aria-controls="AddStory">
                          Add Story
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4 collapse" id="UpdateStory{{$epic->id}}">
    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="card comment-card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <input type="text" class="form-control" id="story_title{{$epic->id}}" required>
                            <label for="objective-name">Title</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <select class="form-control" id="story_assign{{$epic->id}}">
                                <option value="">Select Assignee</option>
                                <?php foreach(DB::table('members')->where('org_user',Auth::id())->get() as $r){ ?>
                                  <option value="{{ $r->id }}">{{ $r->name }}</option>
                                <?php }  ?>
                            </select>
                            <label for="small-description">Assignee</label>
                        </div>
                    </div>
              
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                           <select class="form-control" id="story_status{{$epic->id}}">
                            <option value="">Select Status</option>
                            <option value="To Do">To Do</option>
                            <option value="In progress">In Progress</option>
                             <option value="Done">Done</option>
                           </select>
                            <label for="small-description">Status</label>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="button" onclick="addnewstory({{$epic->id}});" class="btn btn-primary btn-sm">Save</button>
                </div>
              
                <div class="row">
                    <div class="col-md-12">
             
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<table id="example" class="table table-sm ">
    <thead>
        <tr>
            <td>
                <label class="form-checkbox">
                    <input type="checkbox" id="checkAll">
                    <span class="checkbox-label"></span>
                </label>
            </td>
            <td>ID</td>
            <td>Title</td>
            <td>Assignee</td>
            <td>Status</td>
            <td>Action</td>
        </tr>
    </thead>
</table>
@foreach($epicstory as $s)

<table id="example" class="table table-sm">

<tbody>
<tr>
    <td>
        <label class="form-checkbox">
            {{-- <input type="checkbox"> --}}
            <input class="form-check-input"  type="checkbox" @if($s->progress > 0) checked onclick="updateprogress(this.value);" @else onclick="getprogress(this.value);" @endif  value="{{$s->id}}"  id="flexCheckDefault">

            <span class="checkbox-label"></span>
        </label>
    </td>
    <td>{{$s->StoryID}}</td>
    <td>{{$s->epic_story_name}}</td>
    @foreach(DB::table('members')->get() as $r)
    @if($r->id == $s->story_assign)
    <td class="image-cell">
        @if($r->image != NULL)
        <img src="{{asset('public/assets/images/'.$r->image)}}" alt="Example Image">
        @else
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTv1Tt9_33HyVMm_ZakYQy-UgsLjE00biEArg&usqp=CAU" alt="Example Image">
        @endif
        <div>
            <div class="title">{{$r->name}} {{ $r->last_name }}</div>
        </div>
    </td>
    @endif
    @endforeach
    <td>{{$s->story_status}}</td>
    <td>
        <button class="btn-circle btn-tolbar" data-toggle="collapse" data-target="#EditStory{{$s->id}}" type="button" onclick="editstorynew({{$s->id}});">
            <img src="{{ url('public/assets/images/icons/edit.svg') }}">
        </button>
          
        <button class="btn-circle btn-tolbar" type="button" onclick="deletestory({{$s->id}});">
            <img src="{{ url('public/assets/images/icons/delete.svg') }}">
        </button>
    </td>
</tr>

</tbody>
</table>


<div class="row">
    <div class="col-md-12">
        <div class="progress mb-2">
            <div class="progress-bar bg-primary" role="progressbar" style="width:{{$s->progress}}%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
    </div>
</div>


<div class="row mt-4 collapse" id="EditStory{{$s->id}}">
    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="card comment-card">
            <div class="card-body"  >
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <input type="text" class="form-control" value="{{$s->epic_story_name}}" id="edit_story_title{{$s->id}}" required>
                            <label for="objective-name">Title</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                            <select class="form-control" id="edit_story_assign{{$s->id}}">
                                <?php foreach(DB::table('members')->where('org_user',Auth::id())->get() as $r){ ?>
                                  <option @if($r->id == $s->story_assign) selected @endif value="{{ $r->id }}">{{ $r->name }}</option>
                                <?php }  ?>
                            </select>
                            <label for="small-description">Assignee</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-0">
                           <select class="form-control" id="edit_story_status{{$s->id}}">
                            <option @if($s->story_status == 'To Do') selected @endif value="To Do">To Do</option>
                            <option @if($s->story_status == 'In progress') selected @endif value="In progress">In Progress</option>
                             <option @if($s->story_status == 'Done') selected @endif value="Done">Done</option>
                           </select>
                            <label for="small-description">Status</label>
                        </div>
                    </div>
                </div>

                <div>
                    <button type="button" onclick="updatestory({{$s->id}});" class="btn btn-primary btn-sm">Update</button>
                </div>
              
                <div class="row">
                    <div class="col-md-12">
            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach