<div class="tab-pane active" id="edit">
    <hr>
       <form class="form" action="{{route('profile.update')}}" method="post">
         {{-- @method('put') --}}
         @csrf
           <div class="form-group">

               <div class="col-xs-6">
                 <label for="last_name"><h4>name</h4></label>
                   <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="last_name" placeholder="last name" value="{{old('name',auth()->user()->name)}}" autofocus title="enter your last name if any.">
               </div>
               @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
               @enderror
           </div>
           <div class="form-group">
               <div class="col-xs-6">
                   <label for="email"><h4>Email</h4></label>
                   <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="you@email.com" value="{{old('email',auth()->user()->email)}}" autofocus title="enter your email.">
               </div>
               @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
           </div>
           <div class="form-group">
               <div class="col-xs-6">
                   <label for="phone"><h4>Phone</h4></label>
                   <input type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" id="email" placeholder="01300-000000" value="{{old('phone',auth()->user()->phone)}}"  autofocus title="enter your phone.">
               </div>
               @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
           </div>
           <div class="form-group">
               <div class="col-xs-6">
                   <label for="address"><h4>Address</h4></label>
                   <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" >{!! auth()->user()->address !!}</textarea>
               </div>
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
           </div>
           <div class="form-group">
                <div class="col-xs-12">
                     <br>
                       <button class="btn btn-lg btn-primary" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                 </div>
           </div>
       </form>

  </div><!--/tab-pane-->
