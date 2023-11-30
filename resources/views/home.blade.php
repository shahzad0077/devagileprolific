{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

{{-- @extends('components.main-layout')
@section('content')
<style>
    .dataTables_wrapper .dataTables_paginate .paginate_button.previous,
.dataTables_wrapper .dataTables_paginate .paginate_button.next {
    background: none;
    color: #333;
    border: none;
    font-size: 18px;
    padding: 0;
    cursor: pointer;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.previous span,
.dataTables_wrapper .dataTables_paginate .paginate_button.next span {
    display: inline-block;
    width: 16px;
    height: 16px;
    background: url('custom-arrow.png') no-repeat center center;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.previous span {
    transform: rotate(180deg);
}

.dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
    pointer-events: none;
}

.dataTables_wrapper .dataTables_filter input {
    height: 40px;
   
}

.dataTables_wrapper .dataTables_length select {
    height: 30px;
    
}

.table {
    border: none;
  
}

.table tbody tr {
    border-bottom: 1px solid #EFEFEF;

}

.table thead td {
    border-bottom: none;
    color: var(--black, #000);
    font-size: 13px !important;
    font-style: normal;
    font-weight: 400;
    border-top: 0px;
    text-transform: uppercase;
    border-bottom: 1px solid #EFEFEF;
    padding-top: 20px !important;
    ;
}

.table tbody td {
    color: #717171;
    / Small /
    font-size: 13px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    vertical-align: middle;
    border-top: 0px;
    border-bottom: 1px solid #EFEFEF;
}

.table .form-check {
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 25px !important;

    height: 25px !important;
  
    background-color: #F3F3F3;
  
}

.table .form-check input[type="checkbox"] {
    width: 25px;

    height: 25px;
 
}

.table td.image-cell {
    display: flex;
    align-items: center;

}

.table td.image-cell img {
    width: 40px;
  
    height: 40px;
   
    margin-right: 10px;
  
    background-size: cover;
}

.table td.image-cell .title {
    color: var(--black-color, #000);
    font-size: 15px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
    margin-bottom: 2px;
}

.table td.image-cell .small-tag {
    color: #717171;

    / X - Small /
    font-family: BR Candor;
    font-size: 12px;
    font-style: normal;
    font-weight: 300;
    line-height: normal;
}


.form-checkbox input[type="checkbox"] {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

.form-checkbox .checkbox-label {
    position: relative;
    display: inline-block;
    width: 20px;
  
    height: 20px;
 
    border: 1px solid #999;
 
    margin-bottom: 0px;
}

.form-checkbox .checkbox-label::before {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 12px;
    height: 12px;
    border-radius: 2px;
    transition:background-color 0.3s ease;
}

.form-checkbox input[type="checkbox"]:checked+.checkbox-label::before {
    background-color: #555;
    
}

.btn-circle.btn-small {
    width: 32px;
    height: 32px;
    padding: 4px 6px;
    border-radius: 35px;
    font-size: 15px;
    line-height: 1.33;
}

.text-decoration-none {
    text-decoration: none;
    color: black;
}

.dataTables_wrapper .pagination .page-item .page-link {
    width: 38px;
    height: 38px;
    padding: 10px 6px;
    border-radius: 315px;
    font-size: 15px;
    margin-right: 7px;
    text-align: center;
}

.dataTables_wrapper .pagination .page-item:first-child .page-link {
    width: 80px;
    height: 38px;
    text-align: center;
    padding: 9px;
}

.dataTables_wrapper .pagination .page-item:last-child .page-link {
    width: 80px;
    height: 38px;
    text-align: center;
    padding: 9px;
}

.dataTables_info {
    color: #717171;
    font-size: 14px;
    font-style: normal;
    font-weight: 400;
    line-height: normal;
}

.table thead .sorting::before,
.table thead .sorting_desc::before,
.table thead .sorting_asc::before {
  
    top: 20px;
  
}

.table thead .sorting::after,
.table thead .sorting_desc::after,
.table thead .sorting_asc::after {
 
    top: 20px;
   
}

.dataTables_wrapper .dataTables_filter label {
    font-size: 14px;
 
}

.dataTables_wrapper .dataTables_length label {
    font-size: 14px;
    
}

.dataTables_wrapper .dataTables_paginate {
    margin-top: 30px;
   
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body p-10">
                <table class="table data-table">
                    <thead>
                      <tr>
                        <td>
                          <label class="form-checkbox">
                            <input type="checkbox" id="checkAll">
                            <span class="checkbox-label"></span>
                          </label>
                        </td>
                        <td>Organization</td>
                        <td>Email</td>
                        <td>Phone Number</td>
                        <td>Running Objectives</td>
                        <td>Action</td>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>
                          <label class="form-checkbox">
                            <input type="checkbox">
                            <span class="checkbox-label"></span>
                          </label>
                        </td>
                        <td class="image-cell">
                          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTv1Tt9_33HyVMm_ZakYQy-UgsLjE00biEArg&usqp=CAU" alt="Example Image">
                          <div>
                            <div class="title">Hunddlers Pvt.</div>
                            <div class="small-tag">#OR1234</div>
                          </div>
                        </td>
                        <td>example@example.com</td>
                        <td>1234567890</td>
                        <td>
                          <a class="text-decoration-none" href="#running-objectives">5 
                                <button class="btn-circle btn-small"><img src="images/icons/angle-right.svg"></button>
                            </a>
                        </td>
                        <td>
                            <button class="btn-circle btn-tolbar">
                                 <img src="images/icons/edit.svg">
                             </button>
                             <button class="btn-circle btn-tolbar">
                                 <img src="images/icons/delete.svg">
                             </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <label class="form-checkbox">
                            <input type="checkbox">
                            <span class="checkbox-label"></span>
                          </label>
                        </td>
                        <td class="image-cell">
                          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTv1Tt9_33HyVMm_ZakYQy-UgsLjE00biEArg&usqp=CAU" alt="Example Image">
                          <div>
                            <div class="title">Hunddlers Pvt.</div>
                            <div class="small-tag">#OR1234</div>
                          </div>
                        </td>
                        <td>example@example.com</td>
                        <td>1234567890</td>
                        <td>
                          <a class="text-decoration-none" href="#running-objectives">5 
                                <button class="btn-circle btn-small"><img src="images/icons/angle-right.svg"></button>
                            </a>
                        </td>
                        <td>
                            <button class="btn-circle btn-tolbar">
                                 <img src="images/icons/edit.svg">
                             </button>
                             <button class="btn-circle btn-tolbar">
                                 <img src="images/icons/delete.svg">
                             </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <label class="form-checkbox">
                            <input type="checkbox">
                            <span class="checkbox-label"></span>
                          </label>
                        </td>
                        <td class="image-cell">
                          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTv1Tt9_33HyVMm_ZakYQy-UgsLjE00biEArg&usqp=CAU" alt="Example Image">
                          <div>
                            <div class="title">Hunddlers Pvt.</div>
                            <div class="small-tag">#OR1234</div>
                          </div>
                        </td>
                        <td>example@example.com</td>
                        <td>1234567890</td>
                        <td>
                          <a class="text-decoration-none" href="#running-objectives">5 
                                <button class="btn-circle btn-small"><img src="images/icons/angle-right.svg"></button>
                            </a>
                        </td>
                        <td>
                            <button class="btn-circle btn-tolbar">
                                 <img src="images/icons/edit.svg">
                             </button>
                             <button class="btn-circle btn-tolbar">
                                 <img src="images/icons/delete.svg">
                             </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <label class="form-checkbox">
                            <input type="checkbox">
                            <span class="checkbox-label"></span>
                          </label>
                        </td>
                        <td class="image-cell">
                          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTv1Tt9_33HyVMm_ZakYQy-UgsLjE00biEArg&usqp=CAU" alt="Example Image">
                          <div>
                            <div class="title">Hunddlers Pvt.</div>
                            <div class="small-tag">#OR1234</div>
                          </div>
                        </td>
                        <td>example@example.com</td>
                        <td>1234567890</td>
                        <td>
                          <a class="text-decoration-none" href="#running-objectives">5 
                                <button class="btn-circle btn-small"><img src="images/icons/angle-right.svg"></button>
                            </a>
                        </td>
                        <td>
                            <button class="btn-circle btn-tolbar">
                                 <img src="images/icons/edit.svg">
                             </button>
                             <button class="btn-circle btn-tolbar">
                                 <img src="images/icons/delete.svg">
                             </button>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <label class="form-checkbox">
                            <input type="checkbox">
                            <span class="checkbox-label"></span>
                          </label>
                        </td>
                        <td class="image-cell">
                          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTv1Tt9_33HyVMm_ZakYQy-UgsLjE00biEArg&usqp=CAU" alt="Example Image">
                          <div>
                            <div class="title">Hunddlers Pvt.</div>
                            <div class="small-tag">#OR1234</div>
                          </div>
                        </td>
                        <td>example@example.com</td>
                        <td>1234567890</td>
                        <td>
                          <a class="text-decoration-none" href="#running-objectives">5 
                                <button class="btn-circle btn-small"><img src="images/icons/angle-right.svg"></button>
                            </a>
                        </td>
                        <td>
                            <button class="btn-circle btn-tolbar">
                                 <img src="images/icons/edit.svg">
                             </button>
                             <button class="btn-circle btn-tolbar">
                                 <img src="images/icons/delete.svg">
                             </button>
                        </td>
                      </tr>
                      <!-- Add more rows as needed -->
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
</div>
@endsection --}}
