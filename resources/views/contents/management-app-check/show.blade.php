<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show App</title>
    @include('static.css')
</head>
<body>
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
                        {{-- <embed  src="{{ $application->file }}" style="width:1000px; height:800px;" frameborder="0"> --}}
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Content</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">Applicant Email:</td>
                                        <td class="text-center">{{$application->email}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Applicant Phone:</td>
                                        <td class="text-center">{{$application->phone}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Subject:</td>
                                        <td class="text-center">{{$application->subject}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Description:</td>
                                        <td class="text-center">{{$application->description}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Summary:</td>
                                        <td class="text-center">{{$application->summary}}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">Comment:</td>
                                        <td class="text-center">{{$application->comment}}</td>
                                    </tr>
                                    @if ($application->file)
                                    <tr>
                                        <td class="text-center">Document:</td>
                                        <td class="text-center"><a href="{{ route('doc.open', $application->id) }}">Open</a></td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>

                            @if ($application->status != 1)
                                <div class="w-full d-flex justify-content-center align-content-center">
                                    <a class="btn btn-primary mr-2" href="{{ route('update.status.accept', $application->id) }}">Accept</a>
                                    <a class="btn btn-danger" href="{{ route('update.status.reject', $application->id) }}">{{ $application->status == 0 ? "Rejected" : "Reject" }}</a>
                                </div>
                            @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('static.js')
</body>
</html>

