<div class="container">
  <div class="forgot_password_section">
      <?php echo $this->Form->create($user); ?>
     <div class="step_box">        
        <p style="font-weight:500; font-size:15px;">Please change your password</p>
      </div>
        <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <label>Old Password</label>
             <?php
             echo $this->Form->input('old_password', [
                'type'=>'password',
                'placeholder'=>'Enter Your Old Password',
                'class'=>'form-control',
                'label'=>false,                
                'id'=>'old_password'
            ]);
          ?>

          </div>
        </div>
        </div>
      
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <label>New Password</label>
             <?php
             echo $this->Form->input('password1', [
                'type'=>'password',
                'placeholder'=>'Enter Your New Password',
                'class'=>'form-control',
                'label'=>false,
                'required'=>false,
                'id'=>'password'
            ]);
          ?>

          </div>
        </div>
      </div>
      
      
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="form-group">
            <label>Confirm Password</label>
            <?php
             echo $this->Form->input('password2', [
                'type'=>'password',
                'placeholder'=>'Enter Your Confirm Password',
                'class'=>'form-control',
                'label'=>false,
                'required'=>false,
                'id'=>'cpassword'
            ]);
          ?>                    
          </div>
        </div>
      </div>
      

      <div class="row">
         <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                  <div class="form-group">
                     <button type="submit" class="black_btn" id="submitFormId">Change Passworde</button>

                  </div>
          </div>
      </div>

                   <div class="mar-t25 text-center">
                                <a href="#">Need Help?</a>
                        </div>

   <?php echo $this->Form->end(); ?>         
  </div>
</div>      
<script type="text/javascript" language="javascript">
$(document).ready(function(){
  // $.validate({focusout: false, keyup: false});
  $('#submitFormId').on('click', function(e){
    var password = $('#password').val().trim();
    var cpassword = $('#cpassword').val().trim();
    if((password != "" && cpassword != "") && (password != cpassword)){
      alert("Password do not match.");
      return false;        
    }      
   });
});
</script>
