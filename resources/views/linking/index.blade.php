@extends('linking.includes.layout')
@section('metta_tittle')
<title>Linking </title>
@endsection
@section('content')
<style>
.flowchart-example-container {
    width: 100%;
    height: 100vh;
    background: white;
    border: 1px solid #BBB;
    margin-bottom: 10px;
}
</style>
<div class="d-flex flex-column flex-root">
    <div class="page d-flex flex-row flex-column-fluid">
        <div class="content d-flex flex-column flex-column-fluid">
            <!-- begin page Content -->
            <div class="container-fluid py-7">
                <div id="chart_container">
                    <div class="flowchart-example-container" id="flowchartworkspace"></div>
                </div>
            </div>
            <!-- end page content -->
        </div>
    </div>
</div>
@endsection