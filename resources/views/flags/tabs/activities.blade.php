<div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12 paddingrightzero">
        <div class="d-flex flex-row align-items-center justify-content-between block-header">
            <div>
                <h4><img src="{{ url('public/assets/svg/activitiessvgmain.svg') }}"> Activities</h4>
            </div>
            <div class="displayflex">
                <div class="dropdown firstdropdownofcomments">
                  <span class="dropdown-toggle orderbybutton" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(isset($orderby))
                        @if($orderby == 'asc')
                            Order by Older
                        @endif
                        @if($orderby == 'desc')
                            Order by Latest
                        @endif
                    @else
                        Order By
                    @endif
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="7" viewBox="0 0 11 7" fill="none">
                      <path d="M10.8339 0.644857C10.6453 0.456252 10.3502 0.439106 10.1422 0.593419L10.0826 0.644857L5.49992 5.2273L0.917236 0.644857C0.72863 0.456252 0.433494 0.439106 0.225519 0.593419L0.165935 0.644857C-0.0226701 0.833463 -0.0398163 1.1286 0.114497 1.33657L0.165935 1.39616L5.12427 6.35449C5.31287 6.5431 5.60801 6.56024 5.81599 6.40593L5.87557 6.35449L10.8339 1.39616C11.0414 1.18869 11.0414 0.852323 10.8339 0.644857Z" fill="#787878"/>
                    </svg> 
                  </span>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" onclick="showorderby('desc',{{ $data->id }},'activities')" href="javascript:void(0)">Latest</a>
                    <a class="dropdown-item" onclick="showorderby('asc',{{ $data->id }},'activities')" href="javascript:void(0)">Older</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        @if($activity->count() > 0)
        <div class="activity-feed">
            @foreach($activity as $r)
            <div class="activity">
              <div class="profile-image-container">
                <img src="{{ url('public/assets/svg/trend-up.svg') }}" alt="User Profile">
              </div>
              <div class="dotted-line"></div>
              <div class="activity-content">
                <div class="activity-header">{{ DB::table('users')->where('id' , $r->user_id)->first()->name }} {{ DB::table('users')->where('id' , $r->user_id)->first()->last_name }}<span> {{ $r->activity }}</span></div>
                <div class="activity-time">{{ Cmf::create_time_ago($r->created_at) }}</div>
              </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="nodatafound">
            <h4>No Activities</h4>    
        </div>
        @endif
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function()
    {
      $(".profile-image-container:odd").css({"background-color":"#dbf7e8"});
    });
</script>