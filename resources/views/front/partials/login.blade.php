<div class="modal signUpContent fade" id="ModalLogin" tabindex="-1" role="dialog">
   <div class="modal-dialog ">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
            <h3 class="modal-title-site text-center"> Login </h3>
         </div>
         <div class="modal-body">
            <form id="frm-login" action="">
                <div class="form-group login-username">
                   <div>
                      <input name="email" id="login-user" class="form-control input" size="20" placeholder="Enter Username" type="email">
                   </div>
                </div>
                <div class="form-group login-password">
                   <div>
                      <input name="password" id="login-password" class="form-control input" size="20" placeholder="Password" type="password">
                   </div>
                </div>
                
                <div>
                   <div>
                      <input name="submit" class="btn  btn-block btn-lg btn-primary" value="LOGIN" type="submit">
                   </div>
                </div>
            </form>
         </div>
         <div class="modal-footer">
            <p class="text-center"> Not here before? 
               <a data-toggle="modal" data-dismiss="modal" href="#ModalSignup"> Sign Up. </a>
               <br>
               <a href="{{ route('user.forgot') }}"> Lost your password? </a>
            </p>
         </div>
      </div>
   </div>
</div>
