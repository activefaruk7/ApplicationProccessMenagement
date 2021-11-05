@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">


                    {{ __('Before proceeding, please check your email for a verification code.') }}

                    <form class="d-inline" method="POST" action="{{ route('code.to.login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="">Enter Code:</label>
                            <input type="text" name="code" class="form-control" value="{{old('code')}}" placeholder="Enter Code">
                            <input type="hidden" name='user_id' value="{{$user_id}}">
                        </div>
                        <button type="submit" class="btn btn-secondary">{{ __('Send') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
