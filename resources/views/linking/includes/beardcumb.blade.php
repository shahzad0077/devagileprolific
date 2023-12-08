<div class="subheader py-2 py-lg-2 px-lg-8 subheader-solid breadcrums" id="kt_subheader">
    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-start flex-column flex-wrap mr-2">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
                Linking
            </h5>
            <!-- Breadcrum Items -->
            <div class="d-flex flex-row page-sub-titles">
                <div class="mr-2">
                    <p>Dashboard</p>
                </div>
                <div class="mr-2">
                    <a href="{{url('dashboard/organization/contacts')}}" style="text-decoration: none;"></a>
                </div>
                <div class="mr-2">
                    @if($organization->type == 'unit')
                    <a  href="{{url('dashboard/organization/'.$organization->slug.'/portfolio/'.$organization->type)}}" style="text-decoration: none;" >{{$organization->business_name}}</a>
                    @endif
                    @if($organization->type == 'stream')
                    <a  href="{{url('dashboard/organization/'.$organization->slug.'/portfolio/'.$organization->type)}}" style="text-decoration: none;" >{{$organization->value_name}}</a>
                    @endif
                </div>
                <div class="mr-2">
                    <p>Linking</p>
                </div>
            </div>
            <!--End Breadcrum Items -->
        </div>
        <!--end::Info-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center toolbar">
                
            
        </div>
        
        
        <!--end::Toolbar-->
    </div>
</div>