<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">

        <div class="col-md-10 mx-auto col-lg-5">

            <?php
                $attributes = ['class' => 'p-4 p-md-5 border rounded-3 bg-light', 'id' => 'form_save_new_password'];
                $hidden = ['code_email' => $code_email];

				echo form_open('login/form-save-new-password', $attributes, $hidden);
            ?>

            <div class="form-floating mb-3">
				<?php
					$data = [
						'type'  => 'password',
						'name'  => 'password_recovery',
						'id'    => 'password_recovery',
						'class' => 'form-control',
						'minlength' => '6',
						'maxlength' => '30',
						'placeholder' => 'Password',
                        'required' => true,
					];

					echo form_input($data);
					echo form_label('Password', 'password_recovery');

					echo '<small></small>';
				?>
			</div>

            <div class="form-floating mb-3">
				<?php
					$data = [
						'type'  => 'password',
						'name'  => 'password_recovery_two',
						'id'    => 'password_recovery_two',
						'class' => 'form-control',
						'minlength' => '6',
						'maxlength' => '30',
						'placeholder' => 'Repeat Password',
                        'required' => true,
					];

					echo form_input($data);
					echo form_label('Repeat Password', 'password_recovery_two');

					echo '<small></small>';
				?>
			</div>

            <?php

                $data = [
                    'name'    => 'button',
                    'class'	  => 'w-100 btn btn-lg btn-success',
                    'value'   => 'Save new password',
                    'content'   => 'Save new password',
                    'type'    => 'submit',
                ];

                echo form_button($data);

                echo form_close();
            ?>

        </div>

        <div class="col-lg-7 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 mb-3">Insert new Password</h1>
            <p class="col-lg-10 fs-4">
				Please enter your new password. Once entered, 
				you will be redirected directly to the login form.
			</p>
        </div>

    </div>
</div>