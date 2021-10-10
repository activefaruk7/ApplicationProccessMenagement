@extends('layouts.app')
@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Applications</h1>
        <a href="{{route('userapplication.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50" ></i> Add Applications</a>
    </div>

    {{-- table sectio here.... --}}

    <div class="card shadow mb-4">

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Description</th>
                            <th>Comment</th>
                            <th>Summary</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($applications as $key=>$application)
                            <tr>

                                <td>{{ $key + 1}}</td>
                                <td >{{$application->name}}</td>
                                <td >{{$application->email}}</td>
                                <td >{{$application->phone}}</td>
                                <td >{{$application->subject}}</td>
                                <td >{{$application->description}}</td>
                                <td >{{$application->comment}}</td>
                                <td >{{$application->summary}}</td>
                                <td >{{$application->date}}</td>
                                <td >{{$application->status}}</td>

                                <td>
                                    <a type="button"
                                        href="{{ route('userapplication.edit', $application->id) }}"
                                        style="color: #1D8348;"
                                        >
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" style="color:#922B21;" onclick="deleteApplication({{ $application->id }})">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <form id="delete-form-{{ $application->id }}" action="{{route('userapplication.destroy',$application->id)}}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>

                            </tr>


                            @endforeach


                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $applications->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
   function deleteApplication(id){

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


