<div class="aside">
    <div class="d-flex flex-column flex-shrink-0 bg-light" style="width: 100%; height: 89vh;">
        <ul class="nav nav-pills nav-flush flex-column mb-auto text-center sidebar" id="navbarSupportedContent">
            <li class="nav-item">
                <a href="{{url('/dashboard/organizations')}}" @if (url()->current() == url('dashboard/organizations')) class="nav-link active" @else class="nav-link"  @endif  aria-current="page" title="" data-toggle="tooltip" data-placement="right" data-original-title="Dashboard">
                    <img src="{{asset('public/assets/images/icons/home.svg')}}">
                </a>
            </li>
            <!--<li>-->
            <!--    <a href="#pane" class="nav-link" title="" data-toggle="tooltip" data-placement="right" data-original-title="Organizations">-->
            <!--        <img src="{{asset('public/assets/images/icons/departments.svg')}}">-->
            <!--    </a>-->
            <!--</li>-->
            <div class="border-top py-2">
            </div>
            
             <li>
                  <a href="{{url('dashboard/organization/Business-Units')}}"  @if (url()->current() == url('dashboard/organization/Business-Units')) class="nav-link active" @else class="nav-link"  @endif  data-toggle="tooltip" data-placement="right" data-original-title=" Business Units">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.4" d="M2.09961 21.9998V6.02979C2.09961 4.01979 3.09966 3.00977 5.08966 3.00977H11.3196C13.3096 3.00977 14.2996 4.01979 14.2996 6.02979V21.9998" fill="#787878"/>
                    <path d="M10.7508 9H5.80078C5.39078 9 5.05078 8.66 5.05078 8.25C5.05078 7.84 5.39078 7.5 5.80078 7.5H10.7508C11.1608 7.5 11.5008 7.84 11.5008 8.25C11.5008 8.66 11.1608 9 10.7508 9Z" fill="#787878"/>
                    <path d="M10.7508 12.75H5.80078C5.39078 12.75 5.05078 12.41 5.05078 12C5.05078 11.59 5.39078 11.25 5.80078 11.25H10.7508C11.1608 11.25 11.5008 11.59 11.5008 12C11.5008 12.41 11.1608 12.75 10.7508 12.75Z" fill="#787878"/>
                    <path d="M8.25 22.75C7.84 22.75 7.5 22.41 7.5 22V18.25C7.5 17.84 7.84 17.5 8.25 17.5C8.66 17.5 9 17.84 9 18.25V22C9 22.41 8.66 22.75 8.25 22.75Z" fill="#787878"/>
                    <path d="M23 21.2501H20.73V18.2501C21.68 17.9401 22.37 17.0501 22.37 16.0001V14.0001C22.37 12.6901 21.3 11.6201 19.99 11.6201C18.68 11.6201 17.61 12.6901 17.61 14.0001V16.0001C17.61 17.0401 18.29 17.9201 19.22 18.2401V21.2501H1C0.59 21.2501 0.25 21.5901 0.25 22.0001C0.25 22.4101 0.59 22.7501 1 22.7501H19.93C19.95 22.7501 19.96 22.7601 19.98 22.7601C20 22.7601 20.01 22.7501 20.03 22.7501H23C23.41 22.7501 23.75 22.4101 23.75 22.0001C23.75 21.5901 23.41 21.2501 23 21.2501Z" fill="#787878"/>
                    </svg>
                </a>
            </li>
            
            <!--  <li>-->
            <!--      <a href="{{url('dashboard/organization/Value-Streams')}}" @if (url()->current() == url('dashboard/organization/Value-Streams')) class="nav-link active" @else   @endif  class="nav-link" data-toggle="tooltip" data-placement="right" data-original-title="Value Streams">-->
            <!--          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">-->
            <!--            <path d="M19.3697 4.89012L13.5097 2.28012C12.6497 1.90012 11.3497 1.90012 10.4897 2.28012L4.62969 4.89012C3.14969 5.55012 2.92969 6.45012 2.92969 6.93012C2.92969 7.41012 3.14969 8.31012 4.62969 8.97012L10.4897 11.5801C10.9197 11.7701 11.4597 11.8701 11.9997 11.8701C12.5397 11.8701 13.0797 11.7701 13.5097 11.5801L19.3697 8.97012C20.8497 8.31012 21.0697 7.41012 21.0697 6.93012C21.0697 6.45012 20.8597 5.55012 19.3697 4.89012Z" fill="#787878"/>-->
            <!--            <path opacity="0.4" d="M12.0003 17.04C11.6203 17.04 11.2403 16.96 10.8903 16.81L4.15031 13.81C3.12031 13.35 2.32031 12.12 2.32031 10.99C2.32031 10.58 2.65031 10.25 3.06031 10.25C3.47031 10.25 3.80031 10.58 3.80031 10.99C3.80031 11.53 4.25031 12.23 4.75031 12.45L11.4903 15.45C11.8103 15.59 12.1803 15.59 12.5003 15.45L19.2403 12.45C19.7403 12.23 20.1903 11.54 20.1903 10.99C20.1903 10.58 20.5203 10.25 20.9303 10.25C21.3403 10.25 21.6703 10.58 21.6703 10.99C21.6703 12.11 20.8703 13.35 19.8403 13.81L13.1003 16.81C12.7603 16.96 12.3803 17.04 12.0003 17.04Z" fill="#787878"/>-->
            <!--            <path opacity="0.4" d="M12.0003 22C11.6203 22 11.2403 21.92 10.8903 21.77L4.15031 18.77C3.04031 18.28 2.32031 17.17 2.32031 15.95C2.32031 15.54 2.65031 15.21 3.06031 15.21C3.47031 15.21 3.80031 15.54 3.80031 15.95C3.80031 16.58 4.17031 17.15 4.75031 17.41L11.4903 20.41C11.8103 20.55 12.1803 20.55 12.5003 20.41L19.2403 17.41C19.8103 17.16 20.1903 16.58 20.1903 15.95C20.1903 15.54 20.5203 15.21 20.9303 15.21C21.3403 15.21 21.6703 15.54 21.6703 15.95C21.6703 17.17 20.9503 18.27 19.8403 18.77L13.1003 21.77C12.7603 21.92 12.3803 22 12.0003 22Z" fill="#787878"/>-->
            <!--            </svg>-->
            <!--    </a>-->
            <!--</li>-->
            
              <li>
                <a href="{{url('dashboard/organization/contacts')}}" @if (url()->current() == url('dashboard/organization/contacts')) class="nav-link active" @else class="nav-link"  @endif  title="" data-toggle="tooltip" data-placement="right" data-original-title="Contacts">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path opacity="0.4" d="M18 18.86H17.24C16.44 18.86 15.68 19.17 15.12 19.73L13.41 21.42C12.63 22.19 11.36 22.19 10.58 21.42L8.87 19.73C8.31 19.17 7.54 18.86 6.75 18.86H6C4.34 18.86 3 17.53 3 15.89V4.97998C3 3.33998 4.34 2.01001 6 2.01001H18C19.66 2.01001 21 3.33998 21 4.97998V15.89C21 17.52 19.66 18.86 18 18.86Z" fill="#787878"/>
                    <path d="M11.9999 10.41C13.2868 10.41 14.33 9.36684 14.33 8.08002C14.33 6.79319 13.2868 5.75 11.9999 5.75C10.7131 5.75 9.66992 6.79319 9.66992 8.08002C9.66992 9.36684 10.7131 10.41 11.9999 10.41Z" fill="#787878"/>
                    <path d="M14.6792 15.0601C15.4892 15.0601 15.9592 14.1601 15.5092 13.4901C14.8292 12.4801 13.5092 11.8 11.9992 11.8C10.4892 11.8 9.16918 12.4801 8.48918 13.4901C8.03918 14.1601 8.5092 15.0601 9.3192 15.0601H14.6792Z" fill="#787878"/>
                    </svg>
                </a>
            </li>

            <li>
                <a href="{{url('dashboard/organization/users')}}" @if (url()->current() == url('dashboard/organization/users')) class="nav-link active" @else class="nav-link"  @endif title="" data-toggle="tooltip" data-placement="right" data-original-title="Users">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28" fill="none">
                      <path opacity="0.4" d="M10.5007 2.33325C7.44398 2.33325 4.95898 4.81825 4.95898 7.87492C4.95898 10.8733 7.30398 13.2999 10.3607 13.4049C10.454 13.3933 10.5473 13.3933 10.6173 13.4049C10.6407 13.4049 10.6523 13.4049 10.6756 13.4049C10.6873 13.4049 10.6873 13.4049 10.699 13.4049C13.6856 13.2999 16.0306 10.8733 16.0423 7.87492C16.0423 4.81825 13.5573 2.33325 10.5007 2.33325Z" fill="#787878"/>
                      <path d="M16.4271 16.5084C13.1721 14.3384 7.86378 14.3384 4.58544 16.5084C3.10378 17.5 2.28711 18.8417 2.28711 20.2767C2.28711 21.7117 3.10378 23.0417 4.57378 24.0217C6.20711 25.1184 8.35378 25.6667 10.5004 25.6667C12.6471 25.6667 14.7938 25.1184 16.4271 24.0217C17.8971 23.03 18.7138 21.7 18.7138 20.2534C18.7021 18.8184 17.8971 17.4884 16.4271 16.5084Z" fill="#787878"/>
                      <path opacity="0.4" d="M23.3209 8.56337C23.5076 10.8267 21.8976 12.81 19.6693 13.0784C19.6576 13.0784 19.6576 13.0784 19.6459 13.0784H19.6109C19.5409 13.0784 19.4709 13.0784 19.4126 13.1017C18.2809 13.16 17.2426 12.7984 16.4609 12.1334C17.6626 11.06 18.3509 9.45003 18.2109 7.70003C18.1293 6.75503 17.8026 5.8917 17.3126 5.1567C17.7559 4.93504 18.2693 4.79504 18.7943 4.74837C21.0809 4.55004 23.1226 6.25337 23.3209 8.56337Z" fill="#787878"/>
                      <path d="M25.6556 19.3549C25.5623 20.4866 24.8389 21.4666 23.6256 22.1316C22.4589 22.7732 20.9889 23.0766 19.5306 23.0416C20.3706 22.2832 20.8606 21.3382 20.9539 20.3349C21.0706 18.8882 20.3823 17.4999 19.0056 16.3916C18.2239 15.7732 17.3139 15.2832 16.3223 14.9216C18.9006 14.1749 22.1439 14.6766 24.1389 16.2866C25.2123 17.1499 25.7606 18.2349 25.6556 19.3549Z" fill="#787878"/>
                    </svg>
                </a>
            </li>
            
            <li>
                <a href="{{url('dashboard/organization/setting')}}" @if (url()->current() == url('dashboard/organization/setting')) class="nav-link active" @else class="nav-link"  @endif title="" data-toggle="tooltip" data-placement="right" data-original-title="Settings">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg> 
                </a>
            </li>
            
            <li>
                <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                document.getElementById('logout-form').submit();" class="nav-link" title="" data-toggle="tooltip" data-placement="right" data-original-title="Logout">
                    <img src="{{asset('public/assets/images/icons/logout.svg')}}">
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
        <div class="align-items-center mx-auto mb-3">
            <button class="btn-circle btn-xl btn-help">
                <img src="{{asset('public/assets/images/icons/help.svg')}}">
            </button>
        </div>
    </div>
</div>

