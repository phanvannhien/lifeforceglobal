<div class="modal signUpContent fade" id="ModalSignup" tabindex="-1" role="dialog">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>
            <h3 class="modal-title-site text-center">  Become a member   </h3>
         </div>
         <div class="modal-body">
            <form action="" id="frm-register" method="post">
               <label for="" class="text-xs-center" id="msg"></label>
               <div class="form-group reg-username">
                  <div>
                     <input name="email" class="form-control input" placeholder="Enter Email" type="email">
                  </div>
               </div>
               <div class="form-group reg-email">
                  <div>
                     <input id="password" name="password" class="form-control input" size="100" placeholder="Enter Password" type="password">
                  </div>
               </div>
               <div class="form-group reg-password">
                  <div>
                     <input name="confirm_password" class="form-control input" size="100" placeholder="Confirm Password" type="password">
                  </div>
               </div>

               <div class="form-group reg-password">
                  <div>
                     <input name="user_refferal" class="form-control input" placeholder="User refferal" type="text">
                  </div>
               </div>
               
               <div>
                  <div>
                     <input name="submit" class="btn  btn-block btn-lg btn-primary" value="SUBMIT" type="submit">
                  </div>
               </div>
            </form>
         </div>

         <div class="modal-footer">
            <p class="text-center"> Already member? <a data-toggle="modal" data-dismiss="modal" href="#ModalLogin">
               Member login </a>
            </p>
         </div>

      </div>
   </div>
</div>
