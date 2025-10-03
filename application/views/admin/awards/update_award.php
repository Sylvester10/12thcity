<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>
<?php echo custom_validation_errors(); ?>


<div class="new-item">
    <a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('admin-awards'); ?>"><i class="fa fa-award"></i> All Awards </a>
</div>

<?php
// Form now points to the edit function with the awards ID
echo form_open_multipart('admin_awards/update_award_ajax/' . $awards_details->id, 'id="submit_button"'); ?>

All fields marked * are required.

<div class="row">

    <div class="col-md-6 col-sm-12 col-xs-12">

        <div class="form-group">
            <label class="form-control-label">Title*</label>
            <br />
            <input type="text" name="title" value="<?php echo set_value('title', $awards_details->title); ?>" class=" form-control" required />
            <div class="form-error"><?php echo form_error('title'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label">Description</label>
            <textarea id="email_message" name="description" class="form-control t200" required><?php echo set_value('description', $awards_details->description); ?></textarea>
        </div>


    </div>

    <div class="col-md-6 col-sm-12 col-xs-12">

        <div class="form-group">
            <label class="form-control-label">Upload awards Photo (Optional)</label>
            <p class="m-t-10"><strong>Current Image:</strong></p>
            <?php if (!empty($awards_details->award_photo)): ?>
                <img src="<?php echo base_url('assets/uploads/awards/' . $awards_details->award_photo); ?>" alt="Current Image" style="width: 200px; height: auto; margin-bottom: 15px;">
            <?php else: ?>
                <p>No feature image.</p>
            <?php endif; ?>

            <br />
            <small>If you upload a new image, it will replace the current one.</small>
            <input type="file" name="awards_photo" id="the_image" class="form-control" accept=".jpeg,.jpg,.png" />
            <div class="form-error"><?php echo form_error('awards_photo'); ?></div>
        </div>

        <div class="m-t-20">
            <button type="submit" id="send_mail_btn" class="btn btn-lg btn-primary">
                <span id="btn_text">Update Award</span>
                <span id="loading_icon" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>
            </button>
        </div>

    </div>
</div>

<?php echo form_close(); ?>