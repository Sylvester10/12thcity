<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>
<?php echo custom_validation_errors(); ?>


<div class="new-item">
    <a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('admin-awards'); ?>"><i class="fa fa-award"></i> All Awards </a>
</div>

<?php
echo form_open_multipart('admin_awards/add_award_ajax', 'id="submit_button"'); ?>

All fields marked * are required.

<div class="row">

    <div class="col-md-6 col-sm-12 col-xs-12">

        <div class="form-group">
            <label class="form-control-label">Title* </label>
            <br />
            <input type="text" name="title" value="<?php echo set_value('title'); ?>" class="form-control" required />
            <div class="form-error"><?php echo form_error('title'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label">Description</label>
            <textarea id="email_messages" name="description" class="form-control t200" required><?php echo set_value('description'); ?></textarea>
            <div class="form-error"><?php echo form_error('description'); ?></div>
        </div>

    </div>


    <div class="col-md-6 col-sm-12 col-xs-12">

        <div class="form-group">
            <label class="form-control-label">Upload Awards Photo </label>
            <br />
            <small>Only JPG and PNG files allowed (max 4MB).</small>
            <input type="file" name="awards_photo" id="the_image" class="form-control" accept=".jpeg,.jpg,.png" required />
            <div class="form-error"><?php echo form_error('awards_photo'); ?></div>
        </div>

        <!-- Image preview-->
        <?php echo generate_image_preview(); ?>

        <div class="m-t-20">
            <button type="submit" id="send_mail_btn" class="btn btn-lg btn-primary">
                <span id="btn_text">Submit</span>
                <span id="loading_icon" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>
            </button>
        </div>

    </div><!--/.col-->

</div><!--/.row-->


<?php echo form_close(); ?>