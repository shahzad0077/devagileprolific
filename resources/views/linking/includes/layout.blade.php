<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/assets/css/kanban.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dragula@3.7.3/dist/dragula.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs4.min.css" rel="stylesheet">
    @yield('metta_tittle')
</head>
<body class="bg-light-gray">
    <div class="d-flex flex-column flex-root">
        <!-- begin topbar -->
          @include('components.topbar-component')
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid body-cont">
            <!-- begin Sidebar -->             
            @if ($var_objective == 'linking')
                @include('Business-units.unit-sidebar')
                @include('Business-units.unit-subnav')
            @endif
            <!-- end Sidebar -->
            <div class="content d-flex flex-column flex-column-fluid">
                @if ($var_objective == 'linking')
                    @include('linking.includes.beardcumb')
                @endif
                <div class="container-fluid py-5 w-96">
                @yield('content')
            </div>
            </div>
        </div>
    </div>
       @include('linking.includes.scripts')
</body>
</html>