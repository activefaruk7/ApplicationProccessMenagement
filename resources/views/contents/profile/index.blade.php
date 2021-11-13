@extends('layouts.app')
@section('title', 'Profile')

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
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <div class="alert-icon contrast-alert">
                <i class="fa fa-check"></i>
            </div>
            <div class="alert-message">
                <span><strong>Error!</strong> {{session('error')}} </span>
            </div>
        </div>
    @endif


    <div class="container bootstrap snippet">
        <div class="row">
              <div class="col-sm-10"><h1>{{auth()->user()->name}}</h1></div>

        </div>
        <div class="row">
              <div class="col-sm-3"><!--left col-->


                <div class="text-center">
                    <img src="{{ auth()->user()->avater != null? auth()->user()->avater : "http://ssl.gstatic.com/accounts/ui/avatar_2x.png" }}" class="avatar rounded-circle" height="100px" width="100px" alt="avatar">
                    <h6>Upload a different photo...</h6>

                    <input type="file" id="upload-image-form" name="image" class="text-center center-block file-upload">
                    <span class="text-danger" id="image-input-error"></span>
                    <span class="text-success" id="image-input-success"></span>
                </div></hr><br>





            </div><!--/col-3-->
            <div class="col-sm-9">
                <ul class="nav nav-tabs">
                    <li><a href="{{url('/profile?tab=show')}}" class="btn btn-primary"  >Show</a></li>
                    <li><a  class="btn btn-primary mx-2" href="{{url('/profile?tab=edit')}}">Edit</a></li>
                    <li><a class="btn btn-primary" href="{{url('/profile?tab=pass')}}">Change Password</a></li>
                    @cannot('isAdmin', auth()->id())
                    <li><a class="btn btn-danger ml-2" onclick="return confirm('Are you sure?')" href="{{route('profile.delete')}}">Delete User</a></li>
                    @endcannot


                  </ul>


              <div class="tab-content">

                @if ($tab == "pass")
                    @include('contents.profile.change-password')
                @else
                    @if ($tab == "edit")
                       @include('contents.profile.edit')
                    @else
                        @include('contents.profile.show')
                    @endif
                @endif


                  </div><!--/tab-pane-->
              </div><!--/tab-content-->

            </div><!--/col-9-->
        </div><!--/row-->
</div>
@endsection

@push('js')

<script>
$('#upload-image-form').on('change',function(e) {
    var img = e.target.files[0];
   let formData = new FormData();
   formData.append('id', <?php echo auth()->id(); ?>)
   formData.append('image', img);
   $('#image-input-error').text('');

   $.ajax({
      type:'POST',
      url: `/profile-avater-update`,
       data: formData,
       contentType: false,
       processData: false,
       success: (response) => {
         if (response) {

            $('#image-input-success').text('uploaded');

         }
       },
       error: function(response){

            $('#image-input-error').text('sumthing want wrong!');
       }
   });
});
</script>
@endpush
