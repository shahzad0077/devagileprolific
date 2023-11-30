<table id="" class="table table-sm ">
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
@foreach($story as $s)
<input type="hidden" class="story_id" value="{{$s->id}}">
<input type="hidden" id="story_edit_id">
<table id="example" class="table table-sm">

<tbody>
<tr>
    <td>
        <label class="form-checkbox">
            <input type="checkbox">
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
          
        <button class="btn-circle btn-tolbar" type="button" onclick="deletestorynew({{$s->id}});">
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
                    <button type="button" onclick="UpdateNewStory({{$s->id}});" class="btn btn-primary btn-sm">Update</button>
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

