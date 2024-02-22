<footer class="py-3">
    <div class="container">
        <ul class="nav justify-content-center pb-3 mb-1">
            <li class="nav-item"><a href="<?php echo base_url(); ?>" class="nav-link px-2 footer-link">Home</a></li>
            <li class="nav-item"><a href="<?php echo base_url(); ?>about" class="nav-link px-2 footer-link">About</a></li>
            <li class="nav-item"><a href="<?php echo base_url(); ?>privacy" class="nav-link px-2 footer-link">Privacy</a></li>
        </ul>

        <ul class="nav justify-content-center pb-3 mb-3">

            <li class="nav-item">
                <a class="nav-link text-dark h5" href="https://x.com/crearvideojuego" target="blank">
                    <i class="bi-twitter icons-footer-fullscren"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark h5" href="https://www.instagram.com/crearvideojuego" target="blank">
                    <i class="bi-instagram icons-footer-fullscren"></i>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-dark h5" href="https://www.linkedin.com/in/alejandro-lujan-garcia/" target="blank">
                    <i class="bi-linkedin icons-footer-fullscren"></i>
                </a>
            </li>
        </ul>

        <p class="text-center lightColoured">© <?php echo date('Y') ?> Improve English Vocabulary - Created by <a href="https://x.com/crearvideojuego" target="_blank">CrearVideojuegos</a></p>
    </div>
</footer>

<?php 
    if(!isLoggedBool()) 
    {
?>

<!--Register Popup-->
<div class="modal" tabindex="-1" id="registerModal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Register</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

            <?php
                // Register Form
                $attributes = ['class' => 'p-4 p-md-5 border rounded-3 bg-light', 'id' => 'register-form'];
                echo form_open('register/register', $attributes);

                if(isset($register_user_error)) {
                    echo $register_user_error;
                }
                
                        
                if(isset($register_validation)) {
                    echo $register_validation->getError('register_nickname');
                    echo $register_validation->getError('register_email');
                    echo $register_validation->getError('register_password');
                    echo $register_validation->getError('register_password_two');
                }
            ?>

			<div class="form-floating mb-3">
				<?php
				$data = [
					'type'  => 'text',
					'name'  => 'register_nickname',
					'id'    => 'register_nickname',
					'class' => 'form-control',
					'minlength' => '3',
					'maxlength' => '40',
					'Placeholder' => 'Nickname'
				];
			
				echo form_input($data);
				echo form_label('Your nickname', 'register_nickname');
			
				echo '<small></small>';

				?>
			</div>

			<div class="form-floating mb-3">
				<?php
					$data = [
						'class'	=> 'form-select'
					];

					$options = array();

					$native_language = get_native_language_db();
					foreach($native_language as $language) {
						$options += [$language['id'] => $language['native_language']];
					}

					echo form_dropdown('native_language', $options, '', $data);
					echo form_label('Native Language', 'native_language');
				?>
			</div>

			<div class="form-floating mb-3">
				<?php

				$data = [
					'type'  => 'email',
					'name'  => 'register_email',
					'id'    => 'register_email',
					'class' => 'form-control',
					'minlength' => '6',
					'maxlength' => '100',
					'placeholder' => 'name@example.org'
				];
			
				echo form_input($data);
				echo form_label('Your email', 'register_email');

				echo '<small></small>';
				?>
			</div>

			<div class="form-floating mb-3">
				<?php
			
				$data = [
					'type'  => 'password',
					'name'  => 'register_password',
					'id'    => 'register_password',
					'class' => 'form-control',
					'minlength' => '6',
					'maxlength' => '30',
					'placeholder' => 'password'
				];
			
				echo form_input($data);
				echo form_label('Your password', 'register_password');

				echo '<small></small>';
				?>
			</div>

			<div class="form-floating mb-3">
				<?php

				$data = [
					'type'  => 'password',
					'name'  => 'register_password_two',
					'id'    => 'register_password_two',
					'class' => 'form-control',
					'minlength' => '6',
					'maxlength' => '30',
					'placeholder' => 'Repeat password'
				];
			
				echo form_input($data);
				echo form_label('Repeat password', 'register_password_two');

				echo '<small></small>';

				?>
			</div>

			<?php

				$data = [
					'name'    => 'button',
					'class'	  => 'w-100 btn btn-lg btn-success',
					'value'   => 'Sign up',
					'content'   => 'Sign up',
					'type'    => 'submit',
				];

				echo form_button($data);
			?>


			<p class="mt-2">
				Have you already registered? <a href="#" id="register-modal-login" class="link"> Click here for login. </a>
			</p>

			<?php
				echo form_close();
			?>

			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
			</div>
        </div>
    </div>
</div>
<!--End Register Popup-->

<!--Login Popup-->
<div class="modal" tabindex="-1" id="loginModal">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <?php
			// Login Form
				$attributes = ['class' => 'p-4 p-md-5 border rounded-3 bg-light', 'id' => 'login-form'];
				echo form_open('login/login', $attributes);

				if(isset($login_user_error)) {
					echo $login_user_error;
				}
						
				if(isset($login_validation)) {
					echo $login_validation->getError('register_email');
					echo $login_validation->getError('register_password');
				}
			?>

			<div class="form-floating mb-3">
				<?php
			
					$data = [
						'type'  => 'email',
						'name'  => 'login_email',
						'id'    => 'login_email',
						'class' => 'form-control',
						'minlength' => '6',
						'maxlength' => '100',
						'placeholder' => 'name@example.org'
					];

					echo form_input($data);
					echo form_label('Your Email', 'login_email');

					echo '<small></small>';

				?>
			</div>

			<div class="form-floating mb-3">
				<?php
					$data = [
						'type'  => 'password',
						'name'  => 'login_password',
						'id'    => 'login_password',
						'class' => 'form-control',
						'minlength' => '6',
						'maxlength' => '30',
						'placeholder' => 'password'
					];
				
					echo form_input($data);
					echo form_label('Your Password', 'login_password');

					echo '<small></small>';

				?>
			</div>


			<div class="checkbox mb-3">
				<label>
					<input type="checkbox" name="remember_me" id="remember_me"> Remember me
				</label>
			</div>
			<p>Forget your password? <a class="link" href="<?php echo base_url(); ?>login/recovery-password">Click here!</a></p>
			<?php

				$data = [
					'name'    => 'button',
					'class'	  => 'w-100 btn btn-lg btn-success',
					'value'   => 'Sign in',
					'content'   => 'Sign in',
					'type'    => 'submit',
				];

				echo form_button($data);

				echo form_close();
			?>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        
        </div>
    </div>
</div>
<!--End Login Popup-->
<?php 
    }
?>

<!--Cookies Popup-->
<div id="cookiePopup">
    <h4>Cookie Consent</h4>
    <p>
    This website uses cookies to collect information for Google Analytics. 
    You can find more information in the <a href="<?php echo base_url(); ?>privacy" target="_blank">privacy policy</a> section.
    </p>
    <button id="acceptCookie">Accept</button> 
</div>
<!--End Cookies Popup-->

<script src="<?php echo base_url(); ?>assets/node_modules/@popperjs/core/dist/umd/popper.min.js?ver=2.11.6"></script>
<script src="<?php echo base_url(); ?>assets/node_modules/bootstrap/dist/js/bootstrap.min.js?ver=5.2.3"></script>
<script src="<?php echo base_url(); ?>assets/<?php echo localJS('index'); ?>.js?ver=1.0.0"></script>
<script src="<?php echo base_url(); ?>assets/<?php echo localJS('cookies'); ?>.js?ver=1.0.0"></script>
<?php 
    if(!isLoggedBool()) 
    {
?>
<script src="<?php echo base_url(); ?>assets/<?php echo localJS('loginValidation'); ?>.js?ver=1.0.0"></script>
<script src="<?php echo base_url(); ?>assets/<?php echo localJS('registerValidation'); ?>.js?ver=1.0.0"></script>

<?php 
    }
?>

<?php
    if(isset($optional_scripts)) {
        echo $optional_scripts;
    }
?>

</body>
</html>