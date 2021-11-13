@extends('layouts.app')
@section('title', 'Application Check')
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
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Applications</h1>

    </div>

    {{-- table sectio here.... --}}

    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>

                            <th>Applicant Name</th>
                            <th>Applicant Email</th>
                            <th>Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        @if (!empty($apps))
                        @foreach ($apps as $key=>$application)
                        <tr>

                            <td >{{$application->application->name}}</td>
                            <td >{{$application->application->email}}</td>

                            <td >
                                    <a href="{{ url('/show-management-index?id='.$application->application->id) }}">Show</a>
                            </td>

                        </tr>

                        @endforeach
                        @endif

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@if (isset($singleApp))

<div class="container">
    <div class="row">
        <div class="col-10 col-md-8 col-lg-8 col-xl-10 mx-auto">

            <div class="card shadow mb-4">
                <div class="card-header">
                    <h1 class="text-gray-600">Applicant Name: <span class=" font-italic font-weight-normal text-gray-700">{{ $singleApp->name }}</span></h1>
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
                                    <td class="text-center">{{$singleApp->email}}</td>
                                </tr>
                                <tr>
                                    <td class="text-center">Applicant Phone:</td>
                                    <td class="text-center">{{$singleApp->phone}}</td>
                                </tr>
                                <tr>
                                    <td class="text-center">Subject:</td>
                                    <td class="text-center">{{$singleApp->subject}}</td>
                                </tr>
                                <tr>
                                    <td class="text-center">Description:</td>
                                    <td class="text-center">{{$singleApp->description}}</td>
                                </tr>
                                <tr>
                                    <td class="text-center">Summary:</td>
                                    <td class="text-center">{{$singleApp->summary}}</td>
                                </tr>
                                <tr>
                                    <td class="text-center">Comment:</td>
                                    <td class="text-center">{{$singleApp->comment}}</td>
                                </tr>
                                @if ($singleApp->file)
                                <tr>
                                    <td class="text-center">Document:</td>
                                    <td class="text-center"><a href="{{ route('doc.open', $singleApp->id) }}">Open</a></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>

                        @if ($singleApp->status != 1)
                            <div class="w-full d-flex justify-content-center align-content-center">
                                <a class="btn btn-primary mr-2" href="{{ route('update.status.accept', $singleApp->id) }}">Accept</a>
                                <a class="btn btn-danger" href="{{ route('update.status.reject', $singleApp->id) }}">{{ $singleApp->status == 0 ? "Rejected" : "Reject" }}</a>
                            </div>
                        @endif

                </div>
            </div>
        </div>
    </div>
</div>

@endif
@endsection
@push('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">

    function sendToManagement (id) {
        var managementId = $('#getManagementId'+id).find(":selected").val()
        var formData = new FormData();
        formData.append('id', managementId);
        formData.append('app_id', id);

        $.ajax({
            type: "POST",
            url: '/send-to-mangement',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data){
                $('#image-input-success'+id).text('File Sended to Management');
        }
        })
    }

    function removeDivChiledelement (id) {
        $("#setMessageForTeacher"+id).children('p').remove();
        $("#setMessage"+id).children('p').remove();

    }
    function getMessage (id) {
        var teacher_id =$("#getTeacherId"+id).data("teacher_id");
        var user_id =$("#getTeacherId"+id).data("user_id");

        $.ajax({
            type: "GET",
            url: "/get-message-studentId/"+user_id,
            success: function(data){

                var teachersMessages = data.filter(item => item.user_id == teacher_id)
                var studentMessages = data.filter(item => item.user_id == user_id)

                teachersMessages.map((item) => $("#setMessage"+id).append("<p>"+ item.text +"</p>"))
                studentMessages.map((item) => $("#setMessageForTeacher"+id).append("<p>"+ item.text +"</p>"))
        }
        })
    }
    function sendMessage(id) {
        var text = $("#textMessage"+id).val();
        var teacher_id =$("#getTeacherId"+id).data("user_id");
        var formData = new FormData();
        formData.append("text", text);
        formData.append("student_id", teacher_id);
        $.ajax({
            type: "POST",
            url: '/set-message',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data){
                $("#setMessage"+id).append("<p>"+ text +"</p>")
        }
        })

    }
   function deleteIncame(id){

        const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You want to delete this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
        }).then((result) => {
        if (result.isConfirmed) {
        event.preventDefault();
        document.getElementById('delete-form-'+id).submit();
        } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
        ) {
        swalWithBootstrapButtons.fire(
        'Cancelled',
        'Your imaginary file is safe :)',
        'error'
        )
        }
        })

}
</script>

@endpush


