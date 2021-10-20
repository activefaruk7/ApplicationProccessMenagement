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
                            <th>Status</th>
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
                                    <a href="{{ route('userapplication.show', $application->id) }}">Show</a>
                                @else
                                    @if ($application->status == 0)
                                        <p class="bg-denger">Rejected</p>
                                        <a href="{{ route('userapplication.show', $application->id) }}">Again Review</a>
                                    @endif
                                    @if ($application->status == 1)
                                        <p >Accepted</p>
                                    @endif
                                @endif
                            </td>


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
@endsection
@push('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
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


