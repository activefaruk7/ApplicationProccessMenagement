@extends('layouts.app')
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
<<<<<<< HEAD
        <h1 class="h3 mb-0 text-gray-800">My Applications</h1>
        <a href="{{route('userapplication.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Add Applications</a>
=======
        <h1 class="h3 mb-0 text-gray-800">Applications</h1>
        <a href="{{route('userapplication.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50" ></i> Add Applications</a>
>>>>>>> d23b9843d2f59943b89f89157f18e0e5e41a37c9
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
                            <th>Teacher</th>
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
<<<<<<< HEAD
                        @if (!empty($applications))
                        @foreach ($applications as $key=>$application)
                        <tr>

                            <td>{{ $key + 1}}</td>
                            <td >{{$application->name}}</td>
                            <td >{{$application->teacher ? $application->teacher->name : '' }}</td>
                            <td >{{$application->email}}</td>
                            <td >{{$application->phone}}</td>
                            <td >{{$application->subject}}</td>
                            <td >{{$application->description}}</td>
                            <td >{{$application->comment}}</td>
                            <td >{{$application->summary}}</td>
                            <td >{{$application->date}}</td>
                            <td >
                                @if ($application->status == 2)
                                    <p>Pending</p>
                                @else
                                    @if ($application->status == 1)
                                        <p>Accepted</p>
                                    @else
                                        @if ($application->status == 0)
                                            <p>Rejected</p>
                                        @else
                                            <a href="{{ route('update.status.panding', $application->id) }}">Send</a>
                                            <a href="{{ route('userapplication.edit', $application->id) }}">Edit</a>
                                        @endif
                                    @endif
                                @endif
                            </td>

                            <td>
                                @if ($application->status == 3)
                                <a type="button" style="color:#922B21;" onclick="deleteIncame({{ $application->id }})">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <form id="delete-form-{{ $application->id }}" action="{{route('userapplication.destroy',$application->id)}}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @endif
                            </td>

                        </tr>
=======
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
>>>>>>> d23b9843d2f59943b89f89157f18e0e5e41a37c9

                        @endforeach
                        @endif

                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
<<<<<<< HEAD
                    {{-- {!! $application->links() !!} --}}
=======
                    {!! $applications->links() !!}
>>>>>>> d23b9843d2f59943b89f89157f18e0e5e41a37c9
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


