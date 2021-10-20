@extends('layouts.app')

@section('content')

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Apply') }}</div>

                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="{{!empty($application) ? route('userapplication.update', $application->id) : route('userapplication.store')}}">
                        @csrf
                        @if (!empty($application))
                            @method('put')
                        @endif
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="name" value="{{ !empty($application) ? $application->name: '' }}" required autocomplete="name" autofocus>
                                <input type="hidden" name="user_id" value="{{auth()->id()}}"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ !empty($application) ? $application->email: '' }}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="phone" value="{{ !empty($application) ? $application->phone: '' }}" required autocomplete="phone" autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Subject') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="subject" value="{{ !empty($application) ? $application->subject: '' }}" required autocomplete="subject" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-6">
                            <textarea class="form-control" name="description" id="" cols="36" rows="3">{{ !empty($application) ? $application->description : '' }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="comment" class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>
                            <div class="col-md-6">
                            <textarea name="comment" class="form-control" id="comment" cols="36" rows="3">{{ !empty($application) ? $application->comment: '' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Summary') }}</label>
                            <div class="col-md-6">
                               <textarea class="form-control" name="summary" id="" cols="36" rows="3">{{ !empty($application) ? $application->summary: '' }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>
                            <div class="col-md-6">
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

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Select A Teacher') }}</label>
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
                               <select name="status" class="form-control"  id="select">
                                   <option value="3">Send After</option>
                                   <option value="2">Send Now</option>
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
