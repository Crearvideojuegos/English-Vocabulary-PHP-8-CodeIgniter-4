<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
        <div class="col-md-10 mx-auto col-lg-5">

            <?php
                $attributes = ['class' => 'p-4 p-md-5 border rounded-3 bg-light', 'id' => 'recovery-form'];
				echo form_open('login/recovery-form', $attributes);
            ?>

            <div class="form-floating mb-3">
				<?php
			
					$data = [
						'type'  => 'email',
						'name'  => 'email_recovery',
						'id'    => 'email_recovery',
						'class' => 'form-control',
						'minlength' => '6',
						'maxlength' => '100',
						'placeholder' => 'name@example.org',
                        'required' => true,
					];

					echo form_input($data);
					echo form_label('Your Email', 'login_email');

					echo '<small></small>';

				?>
			</div>

            <?php

                $data = [
                    'name'    => 'button',
                    'class'	  => 'w-100 btn btn-lg btn-success',
                    'value'   => 'Recovery password',
                    'content'   => 'Recovery password',
                    'type'    => 'submit',
                ];

                echo form_button($data);

                echo form_close();
            ?>

        </div>

        <div class="col-lg-7 text-center text-lg-start">
            <h1 class="display-4 fw-bold lh-1 mb-3">Recovery Password</h1>
            <p class="col-lg-10 fs-4">Please enter your email address to retrieve your password. If your e-mail address is registered on this website, 
                you will receive a message with a link that will redirect you to this website, where you can enter a new password.</p>
        </div>

    </div>
</div>