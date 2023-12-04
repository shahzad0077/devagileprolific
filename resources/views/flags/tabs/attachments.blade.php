<div class="row">
    <div class="col-md-12 col-lg-12 col-xl-12">
        <div class="d-flex flex-row align-items-center justify-content-between block-header">
            <div>
                <h4><img src="{{ url('public/assets/svg/attachmentmainsvg.svg') }}"> Attachments</h4>
            </div>
            <div class="displayflex">
                <div class="dropdown firstdropdownofcomments">
                  <span class="dropdown-toggle orderbybutton" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Order By
                    <svg xmlns="http://www.w3.org/2000/svg" width="11" height="7" viewBox="0 0 11 7" fill="none">
                      <path d="M10.8339 0.644857C10.6453 0.456252 10.3502 0.439106 10.1422 0.593419L10.0826 0.644857L5.49992 5.2273L0.917236 0.644857C0.72863 0.456252 0.433494 0.439106 0.225519 0.593419L0.165935 0.644857C-0.0226701 0.833463 -0.0398163 1.1286 0.114497 1.33657L0.165935 1.39616L5.12427 6.35449C5.31287 6.5431 5.60801 6.56024 5.81599 6.40593L5.87557 6.35449L10.8339 1.39616C11.0414 1.18869 11.0414 0.852323 10.8339 0.644857Z" fill="#787878"/>
                    </svg> 
                  </span>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="javascript:void(0)">Latest</a>
                    <a class="dropdown-item" href="javascript:void(0)">Older</a>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        @if($attachments->count() > 0)
            <div class="attachment-card">
              <div class="attachment-header">
                <div class="attachment-title">
                  <i class="far fa-file-word file-icon"></i> Attachment 1
                </div>
                <div class="attachment-icons">
                  <span class="action-icon">&#128465;</span><!-- Delete Icon -->
                  <span class="action-icon">&#8681;</span><!-- Download Icon -->
                </div>
                <div class="attachment-date">December 5, 2023</div>
              </div>
              
            </div>

            <div class="attachment-card">
              <div class="attachment-header">
                <div class="attachment-title">
                  <i class="far fa-file-pdf file-icon"></i> Attachment 2
                </div>
                <div class="attachment-icons">
                  <span class="action-icon">&#128465;</span><!-- Delete Icon -->
                  <span class="action-icon">&#8681;</span><!-- Download Icon -->
                </div>
                <div class="attachment-date">December 5, 2023</div>
              </div>
            </div>
        @else
        <div class="nodatafound">
            <h4>No Attachments</h4>    
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