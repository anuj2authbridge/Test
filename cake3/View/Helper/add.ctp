<?php
             echo $this->Form->input('password1', [
                'type'=>'password',
               // 'placeholder'=>'Enter Your New Password',
                'class'=>'form-control',
                'label'=>false,
                'required'=>false,
                'data-validation' => 'required custom',
                'data-validation-regexp' => '^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@#!%^*?&])[A-Za-z\d$@#!%^*?&]{8,14}$',                       
                'data-validation-error-msg'=>'<i>Passwords must contain at least eight characters, including uppercase, lowercase letters, numbers and special characters.</i>',
                'id'=>'password'
            ]);
          ?>
