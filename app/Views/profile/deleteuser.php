<main class="mt-10">
	<div class="container py-4">


        <div class="row align-items-md-stretch mt-4">
			<div class="col-md-12">
                <div class="col-md-10 mx-auto col-lg-5" id="div-profile-form">

                    <h3 class="my-4">This action is irreversible</h3>

                    <?php echo form_open('profile/confirmdeleteuser'); ?>
                    <button href="<?php echo base_url(); ?>profile/deleteuser" class="btn btn-danger">Delete My Account</button>
                    <?php echo form_close(); ?>

                </div>
            </div>
        </div>

	</div>
</main>

<div style="margin-top: 160px;"></div>
