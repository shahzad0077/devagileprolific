<!-- This Class is Created By Usama -->
<div class="row mb-3">
    <div class="col-md-12">
        <div id="success-flag"></div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-12">
        <div id="success-flag-error"></div>
    </div>
</div>

<form class="needs-validation" action="#" method="POST" novalidate>
    @csrf
    <input type="hidden" value="{{ $epic->id }}" id="flag_epic_id">
    <input type="hidden" value="{{ $epic->initiative_id }}" id="flag_ini_epic_id">
    <input type="hidden" value="{{ $epic->obj_id }}" id="flag_epic_obj">
    <input type="hidden" value="{{ $epic->key_id }}" id="flag_epic_key">
    <input type="hidden" value="{{ $epic->buisness_unit_id }}" id="buisness_unit_id">
    <input type="hidden" value="{{ $epic->epic_type }}" id="board_type">
    <div class="row">        
          <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="form-group mb-0">
               <select class="form-control" id="flag_type" >
                   <option value="">Select Flag Type</option>
                   <option value="Risk">Risk</option>
                   <option value="Impediment">Impediment</option>
                   <option value="Blocker">Blocker</option>
                   <option value="Action">Action</option>
               </select>
                <label for="small-description">Flag Type <small class="text-danger">*</small></label>
            </div>
        </div>
         <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="form-group mb-0">
                <select class="form-control" id="flag_assign">
                    @foreach(DB::table('members')->where('org_user',Auth::id())->get() as $r)
                      <option value="{{ $r->id }}">{{ $r->name }}</option>
                    @endforeach
                </select>
                <label for="lead-manager">Flag Assignee <small class="text-danger">*</small></label>
            </div>
        </div>
         <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="form-group mb-0">
                <input type="text" class="form-control"  id="flag_title" >
                <label for="small-description">Title <small class="text-danger">*</small></label>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="form-group mb-0">
                <textarea id="flag_description" class="form-control"></textarea>
                <label for="small-description">Description <small class="text-danger">*</small></label>
            </div>
        </div>
        <div class="col-md-12">
            <button id="updateflagmodalbuton" class="btn btn-primary btn-lg btn-theme btn-block ripple mt-3" onclick="updateepicflag();"  type="button">Add Flag</button>
        </div>
    </div>
</form>