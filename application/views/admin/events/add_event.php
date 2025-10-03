<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>
<?php echo custom_validation_errors(); ?>


<div class="new-item">
	<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('admin-events'); ?>"><i class="fa fa-calendar"></i> All Events </a>
</div>

<?php
echo form_open_multipart('admin_events/add_event_ajax', 'id="submit_button"'); ?>

All fields marked * are required.

<div class="row">

	<div class="col-md-6 col-sm-12 col-xs-12">

		<div class="form-group" id="postType">
			<label class="form-control-label">Post Type*</label>
			<br />
			<select class="form-control" name="type" required>
				<option value="event"> Event </option>
				<option value="blog"> Blog </option>
			</select>
			<div class="form-error"><?php echo form_error('type'); ?></div>
		</div>

		<div class="form-group" id="event_date">
			<label class="form-control-label"> Date*</label>
			<div class="input-group date calendar_date_datepicker" data-date-format="yyyy-mm-dd">
				<input type="text" class="form-control" name="date" value="<?php echo set_value('date'); ?>" readonly />
				<div class="input-group-addon">
					<i class="fa fa-calendar"></i>
				</div>
				<div class="form-error"><?php echo form_error('date'); ?></div>
			</div>
		</div>

		<div class="form-group" id="event_venue">
			<label class="form-control-label"> Location</label>
			<br>
			<input type="text" name="venue" class="form-control" value="<?php echo set_value('venue'); ?>" />
			<div class="form-error"><?php echo form_error('venue'); ?></div>
		</div>

		<div class="form-group">
			<label class="form-control-label">Caption*</label>
			<br />
			<input type="text" name="caption" class="form-control" value="<?php echo set_value('caption'); ?>" required />
			<div class="form-error"><?php echo form_error('caption'); ?></div>
		</div>

		<div class="form-group">
			<label class="form-control-label">Description</label>
			<br />
			<p>Note: To add more images to post body, click on the <i class="fa fa-image"></i> icon and insert the image link into the <b>Source</b> field and click <b>Ok</b>.</p>
			<textarea id="email_message" name="description" class="form-control t200" required><?php echo set_value('description'); ?></textarea>
			<div class="form-error"><?php echo form_error('description'); ?></div>
		</div>

	</div><!--/.col-->


	<div class="col-md-6 col-sm-12 col-xs-12">

		<div class="form-group">
			<label class="form-control-label">Upload Feature Image </label>
			<br />
			<small>Only JPG and PNG files allowed (max 4MB).</small>
			<input type="file" name="event_image" id="the_image" class="form-control" accept=".jpeg,.jpg,.png" required />
			<div class="form-error"><?php echo form_error('event_image'); ?></div>
		</div>

		<!-- Image preview-->
		<?php echo generate_image_preview(); ?>

		<div class="form-group" id="other_images">
			<label class="form-control-label">Upload Other Event Images </label><br />
			<small>Only JPG and PNG files allowed (max 5MB).</small>
			<input type="file" name="other_images[]" multiple class="form-control" accept=".jpeg,.jpg,.png" />
			<div class="form-error"><?php echo $error; ?></div>
		</div>

		<div class="m-t-20">
			<button type="submit" id="send_mail_btn" class="btn btn-lg btn-primary">
				<span id="btn_text">Submit</span>
				<span id="loading_icon" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>
			</button>
		</div>

	</div><!--/.col-->

</div><!--/.row-->


<?php echo form_close(); ?>