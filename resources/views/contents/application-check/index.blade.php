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
    @if(session('error'))
        <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <div class="alert-icon contrast-alert">
                <i class="fa fa-check"></i>
            </div>
            <div class="alert-message">
                <span><strong>Error!</strong> {{session('error')}} </span>
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
                            <th>Status</th>
                            <th>Message</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (!empty($applications))
                        @foreach ($applications as $key=>$application)
                        <tr>

                            <td >{{$application->name}}</td>
                            <td >{{$application->email}}</td>

                            <td >

                                @if ($application->status == 2)
                                    <a  href="{{ route('update.status.accept', $application->id) }}">Accept</a>
                                    <a class="mx-2" href="{{ route('update.status.reject', $application->id) }}">Reject</a>
                                    <a href="{{ url('/check-application-index?id='.$application->id) }}">Show</a>
                                @else
                                    @if ($application->status == 0)
                                        <p class="bg-denger">Rejected</p>
                                        <a href="{{ url('/check-application-index?id='.$application->id) }}">Again Review</a>
                                    @endif
                                    @if ($application->status == 1)
                                        <p >Accepted</p>
                                        <span class="text-success" id="image-input-success{{$application->id}}"></span>
                                        <div class="d-flex justify-content-between">
                                        <select id="getManagementId{{$application->id}}" class="form-control" name="management_id">
                                            @foreach ($managements as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        <button class="btn btn-sm btn-primary text-center ml-2" onclick="sendToManagement({{$application->id}})">Send</button>
                                        </div>
                                        @endif
                                @endif
                            </td>
                            <td>
                                <a href="#" id="setMessageId{{ $application->id }}"  onclick="getMessage({{ $application->id}})" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#incomeAdd{{$application->id}}">Send A Message</a>
                            </td>

                            <div class="modal fade modelTitle" id="incomeAdd{{$application->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Chatt To The Other Persion</h5>
                                            <button class="close" onclick="removeDivChiledelement({{$application->id}})" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row ">
                                                <div class="col-6 border border-dark" id="setMessage{{$application->id}}">
                                                    <h5>Teacher</h5>
                                                </div>
                                                <div class="col-6 border border-dark" id="setMessageForTeacher{{$application->id}}">
                                                    <h5>Student</h5>
                                                    <p></p>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label for="modalTitle{{$application->id}}">Message:</label>
                                                <input required type="text" id="textMessage{{$application->id}}" class="form-control " name="text" placeholder='Enter Text...'>

                                            </div>
                                            <button
                                                    onclick="sendMessage({{$application->id}})"
                                                    id="getTeacherId{{$application->id}}"
                                                    data-user_id="{{$application->user_id}}"
                                                    data-teacher_id="{{$application->teacher_id}}"
                                                    class="btn btn-sm btn-primary">Send</button>

                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" onclick="removeDivChiledelement({{$application->id}})" type="button" data-dismiss="modal">Cancel</button>
                                            {{-- <button type="submit" class="btn btn-primary" >Save</button> --}}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </tr>

                        @endforeach
                        @endif

                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{-- {!! $application->links() !!} --}}
                </div>
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


