@extends('layouts.app')
@section('title', 'Document')
@section('content')
<div class="container-fluid">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <div class="alert-icon contrast-alert">
                <i class="fa fa-check"></i>
            </div>
            <div class="alert-message">
                <span><strong>Success!</strong> {{session('success')}} </span>
            </div>
        </div>
    @endif

    <div class="container">
        <div class="row">
            <div class="col-10 col-md-8 col-lg-8 col-xl-10 mx-auto">

                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h1 class="text-gray-600">Applicant Name: <span class=" font-italic font-weight-normal text-gray-700">{{ $application->name }}</span></h1>
                    </div>
                    <div class="card-body">
                        <embed  src="{{ $application->file }}" style="width:800px; height:800px;" frameborder="0">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



