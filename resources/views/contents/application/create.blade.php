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
                    <form method="POST" action="{{route('userapplication.store')}}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="name" value="" required autocomplete="name" autofocus>
                                <input type="hidden" name="user_id" value="{{auth()->id()}}"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="" required autocomplete="email">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="phone" value="" required autocomplete="phone" autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Subject') }}</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="subject" value="" required autocomplete="subject" autofocus>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-6">
                            <textarea class="form-control" name="description" id="" cols="36" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="comment" class="col-md-4 col-form-label text-md-right">{{ __('Comment') }}</label>
                            <div class="col-md-6">
                            <textarea name="comment" class="form-control" id="comment" cols="36" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Summary') }}</label>
                            <div class="col-md-6">
                               <textarea class="form-control" name="summary" id="" cols="36" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>
                            <div class="col-md-6">
                               <input type="date" class="form-control"  name="date">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Status') }}</label>
                            <div class="col-md-6">
                               <select name="status" class="form-control"  id="">
                                   <option value="2">Pending</option>
                                   <option value="3">Late Submit</option>
                               </select>
                            </div>
                        </div>


                        <input type="submit" class="form-control btn btn-primary wave-effects" value="SAVE">

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
