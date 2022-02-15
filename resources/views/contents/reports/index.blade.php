@extends('layouts.app')
@section('title', 'Report')
@section('css')
{{-- <link rel="stylesheet" type="text/css" href="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.css')}}"> --}}
<link rel="stylesheet" href="{{ asset('assets') }}/vendor/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/vendor/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="{{ asset('assets') }}/vendor/datatables-buttons/css/buttons.bootstrap4.min.css">
@endsection
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
        <h1 class="h3 mb-0 text-gray-800">Report</h1>

    </div>

    {{-- table sectio here.... --}}

    <div class="card shadow mb-4">
        <div class="card-header ">
            <form class="row" method="get" action="{{route('report')}}">
                @csrf
                <div class="col-md-6 d-flex justify-content-between align-items-center">
                    <label for="">From</label>
                    <input class="form-control" value="{{ $from }}" name="from" type="date">
                    <label for="">To</label>
                    <input class="form-control" value="{{ $to }}" name="to" type="date">
                </div>
            <div class="d-flex justify-content-center align-items-center">
                <button type="submit"  class="btn btn-sm btn-success">Search</button>
            </div>
        </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="example1" >
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Total Application</th>
                            <th>Total Accept</th>
                            <th>Total Reject</th>
                            <th>Total Pandding</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (!empty($users))
                        @foreach ($users as $key=>$user)
                        <tr>

                            <td >{{$user->name}}</td>
                            <td >{{$user->student_applications()->count()}}</td>
                            <td >{{$user->student_applications()->where('status',1)->count()}}</td>
                            <td >{{$user->student_applications()->where('status',0)->count()}}</td>
                            <td >{{$user->student_applications()->where('status',2)->count()}}</td>
                        </tr>

                        @endforeach
                        @endif

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

@endsection
@push('js')
{{-- <script type="text/javascript" charset="utf8" src="{{asset('assets/vendor/datatables/jquery.dataTables.js')}}"></script> --}}
{{-- <script type="text/javascript" charset="utf8" src="{{asset('assets/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script> --}}
<script type="text/javascript" src="{{ asset('assets') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('assets') }}/vendor/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('assets') }}/vendor/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('assets') }}/vendor/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('assets') }}/vendor/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('assets') }}/vendor/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('assets') }}/vendor/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('assets') }}/vendor/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('assets') }}/vendor/datatables-buttons/js/buttons.colVis.min.js"></script>
<script type="text/javascript">
$(function () {
    var table = $('#example1');
    table.append('<tfoot class="tFooter"><tr><th id="th0"></th> <th id="th1"></th><th id="th2"></th><th id="th3"></th><th id="th4"></th></tr></tfoot>')
    $("#example1").DataTable({
        'initComplete': function (settings, json){
                this.api().columns([1,2,3,4], {page:'current'}).every(function(){
                    var column = this;
                    var sum = column
                    .data()
                    .reduce(function (a, b) {
                        a = parseFloat(a, 2);
                        if(isNaN(a)){ a = 0; }

                        b = parseFloat(b, 2);
                        if(isNaN(b)){ b = 0; }

                        return (a + b);
                    });

                    $(column.footer()).html(parseFloat(sum).toFixed(0));
                });
            },
      "paging": false,
      "responsive": false, "lengthChange": false, "autoWidth": false,
      "buttons": [
        //   {extend:"copy"},
        //     {extend:"csv",
        //         exportOptions: {
        //                         columns: [ 0, 1, 2,3]
        //                     }},
            {extend:"excel",
                exportOptions: {
                            columns: [ 0, 1, 2,3,4]
                        }, footer: true},
            // {extend:"pdf",
            //     exportOptions: {
            //         columns: [ 0, 1, 2,3]
            //     }},
            {extend:"print",
                exportOptions: {
                                columns: [ 0, 1, 2, 3,4]
                            },
                            footer: true
                    },

         ],
        "footerCallback": function ( row, data, start, end, display ) {
        this.api().columns([1,2,3,4], {page:'current'}).every(function(){
                    var column = this;
                    var sum = column
                    .data()
                    .reduce(function (a, b) {
                        a = parseFloat(a, 2);
                        if(isNaN(a)){ a = 0; }

                        b = parseFloat(b, 2);
                        if(isNaN(b)){ b = 0; }

                        return (a + b);
                    });

                    $(column.footer()).html(parseFloat(sum).toFixed(0));
                });

        }

    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  });
</script>
@endpush


