@extends('layouts.app')

@section('content')
    <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Aplication Form</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-10 col-xl-6 col-lg-6 col-md-8 col-sm-10 mx-auto">

            </div>
        </div>
    </div> -->
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Apply') }}</div>

                <div class="card-body">
<<<<<<< HEAD
                    <form method="post" enctype="multipart/form-data" action="{{!empty($application) ? route('userapplication.update', $application->id) : route('userapplication.store')}}">
                        @csrf
                        @if (!empty($application))
                            @method('put')
                        @endif
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="name" value="{{ !empty($application) ? $application->name: '' }}" required autocomplete="name" autofocus>
=======
                    <form method="POST" action="{{!empty($application) ? route('userapplication.update',$application->id) : route('userapplication.store')}}">
                    @if(!empty($application))   
                    @method("PUT")
                    @endif 
                    @csrf
                        
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="name" value="{{!empty($application) ? $application->name : ''}}" >
>>>>>>> d23b9843d2f59943b89f89157f18e0e5e41a37c9
                                <input type="hidden" name="user_id" value="{{auth()->id()}}"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
<<<<<<< HEAD
                                <input type="email" class="form-control" name="email" value="{{ !empty($application) ? $application->email: '' }}" required autocomplete="email">
=======
                                <input type="email" class="form-control" name="email" value="{{!empty($application) ? $application->email : ''}}" required autocomplete="email">
>>>>>>> d23b9843d2f59943b89f89157f18e0e5e41a37c9
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                            <div class="col-md-6">
<<<<<<< HEAD
                                <input id="name" type="text" class="form-control" name="phone" value="{{ !empty($application) ? $application->phone: '' }}" required autocomplete="phone" autofocus>
=======
                                <input id="name" type="text" class="form-control" name="phone" value="{{!empty($application) ? $application->phone : ''}}" required autocomplete="phone" autofocus>
>>>>>>> d23b9843d2f59943b89f89157f18e0e5e41a37c9

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Subject') }}</label>
                            <div class="col-md-6">
<<<<<<< HEAD
                                <input type="text" class="form-control" name="subject" value="{{ !empty($application) ? $application->subject: '' }}" required autocomplete="subject" autofocus>
=======
                                <input type="text" class="form-control" name="subject" value="{{!empty($application) ? $application->subject : ''}}" required autocomplete="subject" autofocus>

>>>>>>> d23b9843d2f59943b89f89157f18e0e5e41a37c9
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-6">
<<<<<<< HEAD
                            <textarea class="form-control" name="description" id="" cols="36" rows="3">{{ !empty($application) ? $application->description : '' }}</textarea>
=======
                            <textarea class="form-control" name="description" id="" cols="36" rows="3">{{!empty($application) ? $application->description : ''}}</textarea>
>>>>>>> d23b9843d2f59943b89f89157f18e0e5e41a37c9
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="comment" class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>
                            <div class="col-md-6">
<<<<<<< HEAD
                            <textarea name="comment" class="form-control" id="comment" cols="36" rows="3">{{ !empty($application) ? $application->comment: '' }}</textarea>
=======
                            <textarea name="comment" class="form-control" id="comment" cols="36" rows="3">{{!empty($application) ? $application->comment : ''}}</textarea>
>>>>>>> d23b9843d2f59943b89f89157f18e0e5e41a37c9
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Summary') }}</label>
                            <div class="col-md-6">
<<<<<<< HEAD
                               <textarea class="form-control" name="summary" id="" cols="36" rows="3">{{ !empty($application) ? $application->summary: '' }}</textarea>
=======
                               <textarea class="form-control" name="summary" id="" cols="36" rows="3">{{!empty($application) ? $application->summary : ''}}</textarea>
>>>>>>> d23b9843d2f59943b89f89157f18e0e5e41a37c9
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>
                            <div class="col-md-6">
<<<<<<< HEAD
                               <input type="date" value="{{ !empty($application) ? $application->date: '' }}" class="form-control"  name="date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="file" class="col-md-4 col-form-label text-md-right">{{ __('File') }}</label>
                            <div class="col-md-6 d-flex justify-content-between">
                               <input type="file" class="form-control" file="true"  name="file">
                               @if (!empty($application) && $application->file)
                               <a href="{{ route('doc.open', $application->id) }}">Open</a>
                               @endif

                               @error('file')
                               <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                               </span>
                           @enderror

=======
                               <input type="date" class="form-control"  name="date" value="{{!empty($application) ? $application->date : ''}}"> 
>>>>>>> d23b9843d2f59943b89f89157f18e0e5e41a37c9
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Select A ') }}</label>
                            <div class="col-md-6">
                               <select name="teacher_id" class="form-control"  id="select">
                                    @foreach ($teachers as $item)
                                        @if (!empty($application) && $application->teacher_id == $item->id)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endif

                                    @endforeach
                               </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                            <div class="col-md-6">
<<<<<<< HEAD
                               <select name="status" class="form-control"  id="select">
                                   <option value="3">Send After</option>
                                   <option value="2">Send Now</option>
=======
                               <select name="status" class="form-control" id="">
                                   @if(!empty($application))
                                   <option selected value="{{$application->id}}">{{$application->status}}</option>
                                   @else
                                   <option value="2">Pending</option>
                                   <option value="3">Late Submit</option>
                                   @endif
                                   
>>>>>>> d23b9843d2f59943b89f89157f18e0e5e41a37c9
                               </select>
                            </div>
                        </div>


                        <input type="submit" id="submit" class="form-control btn btn-primary wave-effects" value="{{ !empty($application) ? "Update": 'save' }}">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
   <script>
        $('select').on('change', function() {
            var selectedValue = parseInt($(this).val());

            if (selectedValue === 3) {
                $('#submit').val("Save")
            }else{
                $('#submit').val("Send")

            }
        });
   </script>
@endpush
