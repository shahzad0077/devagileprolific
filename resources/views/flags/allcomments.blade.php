<div class="col-md-12 col-lg-12 col-xl-12">
    @foreach($comments as $r)
    @php
        $user = DB::table('users')->where('id',$r->user_id)->first();
    @endphp
    <div class="card comment-card">
        <div class="deletecomment" id="commentdelete{{ $r->id }}">
            <div class="buttons">
                <button onclick="deletecommenthide({{$r->id}})" class="btn btn-default btn-sm">Cancel</button>
                <button onclick="deletecomment({{ $r->id }})" class="btn btn-primary btn-sm">Delete</button>
            </div>
        </div>
        <div class="commentedit" id="commentedit{{ $r->id }}">
            <form method="POST" id="updatecomment{{ $r->id }}" action="{{ url('dashboard/flags/updatecomment') }}">
                @csrf
                <input type="hidden" value="{{ $r->id }}" name="comment_id">
                <div class="row mt-3">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="d-flex flex-column">
                            <div>
                                <div class="form-group mb-0">
                                    <input value="{{ $r->comment }}" type="text" class="form-control" name="comment" id="objective-name" required>
                                    <label for="objective-name">Write Comment</label>
                                </div>
                            </div>
                            <div>
                                <span onclick="editcommenthide({{$r->id}})" class="btn btn-default btn-sm">Cancel</span>
                                <button type="submit" id="updatecommentbutton{{ $r->id }}" class="btn btn-primary btn-sm">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="d-flex flex-column">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex flex-row align-items-center">
                        <!-- <div>
                            <img class="user-image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTv1Tt9_33HyVMm_ZakYQy-UgsLjE00biEArg&usqp=CAU" style="width:34px; height:34px; background-size:cover">                        
                        </div> -->
                        <div class="d-flex flex-column">
                            <div>
                                <h5>{{ $user->name }} {{ $user->last_name }}</h5>
                                <small>{{ Cmf::date_format($r->created_at) }}</small>
                                @if($r->created_at != $r->updated_at)
                                <small>Updated</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <div class="pr-2">
                            <button onclick="editcommentshow({{$r->id}})" class="btn-circle btn-tolbar">
                                <img src="{{ url('public/assets/images/icons/edit.svg') }}">
                            </button>
                        </div>
                        <div>
                            <button onclick="deletecommentshow({{$r->id}})" class="btn-circle btn-tolbar">
                                <img src="{{ url('public/assets/images/icons/delete.svg') }}">
                            </button>
                        </div>
                    </div>
                </div>
                <div>
                    <p>{{ $r->comment }}</p>
                </div>
                <div>
                    <button onclick="replycomment({{$r->id}})" class="btn btn-default btn-sm">Reply</button>
                </div>
                
                <div class="replycard{{ $r->id }}" style="display: none;" >
                    <form id="savereply{{ $r->id }}" method="POST" action="{{ url('dashboard/flags/savereply') }}">
                        @csrf
                        <input type="hidden" value="{{ $r->flag_id }}" name="flag_id">
                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                        <input type="hidden" value="{{ $r->id }}" name="comment_id">
                        <div class="d-flex flex-column mt-3 d-none" >
                            <div>
                                <div class="form-group mb-0">
                                    <input type="text" class="form-control" name="comment" id="objective-name" required>
                                    <label for="objective-name">Write Reply</label>
                                </div>
                            </div>
                            <div>
                                <span onclick="replycomment({{$r->id}})" class="btn btn-default btn-sm">Cancel</span>
                                <button type="submit" id="savereplybutton{{ $r->id }}" class="btn btn-primary btn-sm">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
                <script type="text/javascript">
                    $('#savereply{{ $r->id }}').on('submit',(function(e) {
                        $('#savereplybutton{{ $r->id }}').html('<i class="fa fa-spin fa-spinner"></i>');
                        e.preventDefault();
                        var formData = new FormData(this);
                        $.ajax({
                            type:'POST',
                            url: $(this).attr('action'),
                            data:formData,
                            cache:false,
                            contentType: false,
                            processData: false,
                            success: function(data){
                                $('#savereplybutton{{ $r->id }}').html('Save');
                                $('.comment-area').html(data);
                            }
                        });
                    }));
                </script>
            </div>
        </div>
    </div>
    @foreach(DB::table('flag_comments')->where('type' , 'reply')->where('comment_id' , $r->id)->get() as $p)
    @php
        $puser = DB::table('users')->where('id',$p->user_id)->first();
    @endphp
    <div class="card comment-card reply-card">
        <div class="deletecomment" id="commentdelete{{ $p->id }}">
            <div class="buttons">
                <button onclick="deletecommenthide({{$p->id}})" class="btn btn-default btn-sm">Cancel</button>
                <button onclick="deletecomment({{ $p->id }})" class="btn btn-primary btn-sm">Delete</button>
            </div>
        </div>
        <div class="commentedit" id="commentedit{{ $p->id }}">
            <form method="POST" id="updatecomment{{ $p->id }}" action="{{ url('dashboard/flags/updatecomment') }}">
                @csrf
                <input type="hidden" value="{{ $p->id }}" name="comment_id">
                <div class="row mt-3">
                    <div class="col-md-12 col-lg-12 col-xl-12">
                        <div class="d-flex flex-column">
                            <div>
                                <div class="form-group mb-0">
                                    <input value="{{ $p->comment }}" type="text" class="form-control" name="comment" id="objective-name" required>
                                    <label for="objective-name">Write Comment</label>
                                </div>
                            </div>
                            <div>
                                <span onclick="editcommenthide({{$p->id}})" class="btn btn-default btn-sm">Cancel</span>
                                <button type="submit" id="updatecommentbutton{{ $p->id }}" class="btn btn-primary btn-sm">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="d-flex flex-column">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <div class="d-flex flex-row align-items-center">
                        <div class="d-flex flex-column">
                            <div>
                                <h5>{{ $puser->name }} {{ $puser->last_name }}</h5>
                                <small>{{ Cmf::date_format($p->created_at) }}</small>
                                @if($p->created_at != $p->updated_at)
                                <small>Updated</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <div class="pr-2">
                            <button onclick="editcommentshow({{$p->id}})" class="btn-circle btn-tolbar">
                                <img src="{{ url('public/assets/images/icons/edit.svg') }}">
                            </button>
                        </div>
                        <div>
                            <button onclick="deletecommentshow({{$p->id}})" class="btn-circle btn-tolbar">
                                <img src="{{ url('public/assets/images/icons/delete.svg') }}">
                            </button>
                        </div>
                    </div>
                </div>
                <div>
                    <p>{{ $p->comment }}</p>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $('#updatecomment{{ $p->id }}').on('submit',(function(e) {
            $('#updatecommentbutton{{ $p->id }}').html('<i class="fa fa-spin fa-spinner"></i>');
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type:'POST',
                url: $(this).attr('action'),
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success: function(data){
                    $('#updatecommentbutton{{ $p->id }}').html('Save');
                    $('.comment-area').html(data);
                }
            });
        }));
    </script>
    @endforeach
    <script type="text/javascript">
        $('#updatecomment{{ $r->id }}').on('submit',(function(e) {
            $('#updatecommentbutton{{ $r->id }}').html('<i class="fa fa-spin fa-spinner"></i>');
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type:'POST',
                url: $(this).attr('action'),
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success: function(data){
                    $('#updatecommentbutton{{ $r->id }}').html('Save');
                    $('.comment-area').html(data);
                }
            });
        }));
    </script>
    @endforeach
</div>
<script type="text/javascript">
    function replycomment(id) {
        $('.replycard'+id).slideToggle();
    }
    function editcommentshow(id) {
        $('#commentedit'+id).show();
    }
    function editcommenthide(id) {
        $('#commentedit'+id).hide();
    }
    function deletecommentshow(id) {
        $('#commentdelete'+id).show();
    }
    function deletecommenthide(id) {
        $('#commentdelete'+id).hide();
    }
    function deletecomment(id) {
        $.ajax({
            type: "POST",
            url: "{{ url('dashboard/flags/deletecomment') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                id:id,
            },
            success: function(res) {
                $('.comment-area').html(res);
            },
            error: function(error) {
                console.log('Error updating card position:', error);
            }
        });
    }
</script>