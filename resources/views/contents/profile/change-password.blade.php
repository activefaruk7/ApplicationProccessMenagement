                 {{-- password change Section --}}
                 <div class="tab-pane active" id="password">

                    <hr>
                       <form class="form" action="{{route('profile.update.password')}}" method="post" id="registrationForm">
                         @csrf
                           <div class="form-group">

                               <div class="col-xs-6">
                                 <label for="last_name"><h4>Old Password</h4></label>
                                   <input type="password" class="form-control @error('old_password') is-invalid @enderror" name="old_password" id="last_name" placeholder="Old Password">
                               </div>
                               @error('old_password')
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $message }}</strong>
                                 </span>
                               @enderror
                           </div>
                           <div class="form-group">
                               <div class="col-xs-6">
                                   <label for="password"><h4>New Password</h4></label>
                                   <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="new password" >
                               </div>
                               @error('password')
                                     <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                           </div>
                           <div class="form-group">
                               <div class="col-xs-6">
                                   <label for="password-confirm"><h4>Again Password</h4></label>
                                   <input id="password-confirm" placeholder="Retype password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                               </div>
                           </div>
                           <div class="form-group">
                                <div class="col-xs-12">
                                     <br>
                                       <button class="btn btn-lg btn-primary" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                 </div>
                           </div>
                       </form>

                  </div><!--/tab-pane-->
