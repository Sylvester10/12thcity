<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>
<?php echo custom_validation_errors(); ?>


<?php
echo form_open_multipart('admin_hero/add_hero_ajax', 'id="submit_button"'); ?>

All fields marked * are required.

<div class="row">


	<div class="col-md-6 col-sm-12 col-xs-12">

		<div class="form-group">
			<label class="form-control-label">First Hero Image </label>
			<br />
			<small>Only JPG and PNG files allowed (max 4MB).</small>
			<input type="file" name="first_image" id="the_image" class="form-control" accept=".jpeg,.jpg,.png" required />
			<div class="form-error"><?php echo form_error('first_image'); ?></div>
		</div>

	</div><!--/.col-->

	<div class="col-md-6 col-sm-12 col-xs-12">

		<div class="form-group">
			<label class="form-control-label">Second Hero Image </label>
			<br />
			<small>Only JPG and PNG files allowed (max 4MB).</small>
			<input type="file" name="second_image" id="the_second_image" class="form-control" accept=".jpeg,.jpg,.png" required />
			<div class="form-error"><?php echo form_error('second_image'); ?></div>
		</div>

	</div>

	<div class="col-md-6 col-sm-12 col-xs-12">

		<div class="m-t-20">
			<button type="submit" id="send_mail_btn" class="btn btn-lg btn-primary">
				<span id="btn_text">Submit</span>
				<span id="loading_icon" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>
			</button>
		</div>

	</div><!--/.col-->

</div><!--/.row-->


<?php echo form_close(); ?>