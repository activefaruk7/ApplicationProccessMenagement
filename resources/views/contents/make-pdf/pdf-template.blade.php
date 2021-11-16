<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('static.css')
    @include('static.js')
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Applicaton</h4>
                    </div>
                    <div class="card-body" id="bodySection">
                        <div class="d-flex justify-content-between">
                            <div> </div>
                            <div>{{$application->date}}</div>
                        </div>
                        <div>
                           <h2>{{$application->teacher ? $application->teacher->name : ''}}</h2>
                        </div>
                        <div>
                           <h3>{{$application->subject}}</h3>
                        </div>
                        <br>
                        <br>
                        <div>
                           <p>{{$application->description}}</p>
                        </div>
                        <br>
                        <div>
                           <p>{{$application->comment}}</p>
                        </div>
                        <br>
                        <div>
                           <p>{{$application->summary}}</p>
                        </div>
                        <br>
                        <br>
                        <div>
                           <p>{{$application->name}}</p>
                           <p>{{$application->email}}</p>
                           <p>{{$application->phone}}</p>
                        </div>


                    </div>
                    {{-- <div><button class="btn btn-sm btn-secondary" id="printThis" >Print</button></div> --}}
                </div>
            </div>
        </div>
    </div>
</body>
</html>

@push('js')
 <script>
function printData()
{
   var divToPrint=document.getElementById("bodySection");
   newWin= window.open();
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}
         $("#printThis").on("click", function (e) {
            printData();

         })

 </script>
@endpush
