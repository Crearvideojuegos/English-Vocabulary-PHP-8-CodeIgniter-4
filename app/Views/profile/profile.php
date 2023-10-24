<main class="mt-10">
	<div class="container py-4">

        <div class="row align-items-md-stretch">
			<div class="col-md-12">
                <div class="col-md-10 mx-auto col-lg-5">
                    <h3 class="mb-1">Your personal Info. You can't change this info.</h3>

                    <div>
                        <strong>Nickname: </strong><?php echo $info_user_by_id[0]['user_nickname'];  ?>
                    </div>
                    
                    <div>
                        <strong>Email: </strong><?php echo $info_user_by_id[0]['user_email'];  ?>
                    </div>

                </div>
			</div>
		</div>


		<div class="row align-items-md-stretch mt-4">
			<div class="col-md-12">
                <div class="col-md-10 mx-auto col-lg-5" id="div-profile-form">
                
                    <h3 class="my-4">You can change your password</h3>
                <?php

                    // Success Message
                    if($show_message_password_success) {
                        ?>
                            <div class="alert alert-success d-flex align-items-center alert-dismissible" role="alert">
                                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                                <div>
                                    Your password has been updated.
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                            </div>
                        <?php
                    }

                    // Profile Form
                    $attributes = ['class' => 'p-4 p-md-5 border rounded-3 bg-light', 'id' => 'password-form'];
                    echo form_open('profile/change-info', $attributes);

                    if(isset($profile_user_error)) {
                        echo $profile_user_error;
                    }
                            
                    if(isset($profile_validation)) {
                        echo $profile_validation->getError('actual_password_profile');
                        echo $profile_validation->getError('profile_password');
                        echo $profile_validation->getError('profile_password_two');
                    }
                ?>

                    <div class="form-floating mb-3">
                        <?php
                    
                        $data = [
                            'type'  => 'password',
                            'name'  => 'actual_password_profile',
                            'id'    => 'actual_password_profile',
                            'class' => 'form-control',
                            'minlength' => '6',
                            'maxlength' => '30',
                            'placeholder' => 'password'
                        ];
                    
                        echo form_input($data);
                        echo form_label('Actual password', 'actual_password_profile');

                        echo '<small></small>';
                        ?>
                    </div>

                    <div class="form-floating mb-3">
                        <?php
                    
                        $data = [
                            'type'  => 'password',
                            'name'  => 'password_profile',
                            'id'    => 'password_profile',
                            'class' => 'form-control',
                            'minlength' => '6',
                            'maxlength' => '30',
                            'placeholder' => 'password'
                        ];
                    
                        echo form_input($data);
                        echo form_label('New password', 'password_profile');

                        echo '<small></small>';
                        ?>
                    </div>

                    <div class="form-floating mb-3">
                        <?php

                        $data = [
                            'type'  => 'password',
                            'name'  => 'password_profile_two',
                            'id'    => 'password_profile_two',
                            'class' => 'form-control',
                            'minlength' => '6',
                            'maxlength' => '30',
                            'placeholder' => 'Repeat password'
                        ];
                    
                        echo form_input($data);
                        echo form_label('Repeat password', 'password_profile_two');

                        echo '<small></small>';

                        ?>
                    </div>

                    <?php

                        $data = [
                            'name'    => 'button',
                            'class'	  => 'w-100 btn btn-lg btn-success',
                            'value'   => 'Update',
                            'content'   => 'Update',
                            'type'    => 'submit',
                        ];

                        echo form_button($data);

                        echo form_close();

                    ?>

                </div>


			</div>
		</div>


        <div class="row align-items-md-stretch mt-4">
			<div class="col-md-12">
                <div class="col-md-10 mx-auto col-lg-5" id="div-profile-form">

                    <h3 class="my-4">Delete your account</h3>
                    <a href="<?php echo base_url(); ?>profile/deleteuser" class="btn btn-danger">Delete My Account</a>

                </div>
            </div>
        </div>

	</div>
</main>

<div style="margin-top: 160px;"></div>
