<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>
<?php echo custom_validation_errors(); ?>


<div class="new-item">
    <a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('admin-staff'); ?>"><i class="fa fa-calendar"></i> All staff </a>
</div>

<?php
// Form now points to the edit function with the staff ID
echo form_open_multipart('admin_staff/update_staff_ajax/' . $staff_details->id, 'id="submit_button"'); ?>

All fields marked * are required.

<div class="row">

    <div class="col-md-6 col-sm-12 col-xs-12">

        <div class="form-group">
            <label class="form-control-label">Order* <small>(For Our Staff page)</label>
            <select class="form-control" name="order_number" required>
                <option value="<?php echo set_value('order_number', $staff_details->order_number); ?>"><?php echo $staff_details->order_number; ?></option>

                <?php
                for ($i = 1; $i <= 10; $i++) {
                    echo "<option value='$i'>{$i}</option>";
                }
                ?>

            </select>
            <div class="form-error"><?php echo form_error('order_number'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label">Name* <small>(Surname first)</small></label>
            <br />
            <input type="text" name="name" value="<?php echo set_value('name', $staff_details->name); ?>" class=" form-control" required />
            <div class="form-error"><?php echo form_error('name'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label">Email*</label>
            <br />
            <input type="email" name="email" value="<?php echo set_value('email', $staff_details->email); ?>" class="form-control" required />
            <div class="form-error"><?php echo form_error('email'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label">State*</label>
            <br />
            <select class="form-control" name="state" required>
                <option value="">Select</option>
                <?php
                $current_state = set_value('state', $staff_details->state);
                $states = [
                    "abuja" => "Abuja",
                    "portharcourt" => "Portharcourt"
                ];
                foreach ($states as $key => $value) {
                    $selected = ($key === $current_state) ? 'selected' : '';
                    echo "<option value=\"$key\" $selected>$value</option>";
                }
                ?>
            </select>
            <div class="form-error"><?php echo form_error('state'); ?></div>
        </div>

        <!--<div class="form-group">-->
        <!--    <label class="form-control-label">Mobile No*</label>-->
        <!--    <br />-->
        <!--    <input type="text" name="phone" value="<?php echo set_value('phone', $staff_details->phone); ?>" class="form-control numbers-only" required />-->
        <!--    <div class="form-error"><?php echo form_error('phone'); ?></div>-->
        <!--</div>-->

        <!--<div class="form-group">-->
        <!--    <label class="form-control-label"> Date of Birth*</label>-->
        <!--    <div class="input-group date date_datepicker_no_future" data-date-format="yyyy-mm-dd">-->
        <!--        <input type="text" class="form-control" name="dob" value="<?php echo set_value('dob', $staff_details->dob); ?>" readonly />-->
        <!--        <div class="input-group-addon">-->
        <!--            <i class="fa fa-calendar"></i>-->
        <!--        </div>-->
        <!--        <div class="form-error"><?php echo form_error('dob'); ?></div>-->
        <!--    </div>-->
        <!--</div>-->

        <!--<div class="form-group">-->
        <!--    <label class="form-control-label"> Date Joined*</label>-->
        <!--    <div class="input-group date date_datepicker_no_future" data-date-format="yyyy-mm-dd">-->
        <!--        <input type="text" class="form-control" name="date_joined" value="<?php echo set_value('date_joined', $staff_details->date_joined); ?>" readonly />-->
        <!--        <div class="input-group-addon">-->
        <!--            <i class="fa fa-calendar"></i>-->
        <!--        </div>-->
        <!--        <div class="form-error"><?php echo form_error('date_joined'); ?></div>-->
        <!--    </div>-->
        <!--</div>-->

        <div class="form-group">
            <label class="form-control-label m-r-20 ">Sex*</label>
            <label class="m-r-10"><input type="radio" name="sex" value="Male" <?php echo set_radio('sex', 'Male', radio_value($staff_details->sex, 'Male')); ?>> Male</label>
            <label><input type="radio" name="sex" value="Female" <?php echo set_radio('sex', 'Female', radio_value($staff_details->sex, 'Female')); ?>> Female</label>
            <div class="form-error"><?php echo form_error('sex'); ?></div>
        </div>

        <!--<div class="form-group">-->
        <!--    <label class="form-control-label">Residential Address</label>-->
        <!--    <textarea class="form-control t100" name="address"><?php echo set_value('address', $staff_details->address); ?></textarea>-->
        <!--    <div class="form-error"><?php echo form_error('address'); ?></div>-->
        <!--</div>-->

        <div class="form-group">
            <label class="form-control-label">Designation*</label>
            <select class="form-control" name="designation" required>
                <option value="<?php echo set_value('designation', $staff_details->designation); ?>"><?php echo $staff_details->designation; ?></option>

                <?php
                $staff_designations = staff_designations();
                foreach ($staff_designations as $designation) { ?>
                    <option value="<?php echo $designation; ?>" <?php echo set_select('designation', $designation); ?>><?php echo $designation; ?></option>
                <?php } ?>

            </select>
            <div class="form-error"><?php echo form_error('designation'); ?></div>
        </div>

    </div>

    <div class="col-md-6 col-sm-12 col-xs-12">

        <!--<div class="form-group">-->
        <!--    <label class="form-control-label">Facebook Handle</label>-->
        <!--    <div class="input-group">-->
        <!--        <div class="input-group-addon bg-facebook">-->
        <!--            <i class="fa-brands fa-facebook"></i>-->
        <!--        </div>-->
        <!--        <input type="text" class="form-control" name="facebook" value="<?php echo set_select('facebook', $staff_details->facebook); ?>" />-->
        <!--        <div class="form-error"><?php echo form_error('facebook'); ?></div>-->
        <!--    </div>-->
        <!--</div>-->

        <!--<div class="form-group">-->
        <!--    <label class="form-control-label">Twitter Handle</label>-->
        <!--    <div class="input-group">-->
        <!--        <div class="input-group-addon bg-twitter">-->
        <!--            <i class="fa-brands fa-twitter"></i>-->
        <!--        </div>-->
        <!--        <input type="text" class="form-control" name="twitter" value="<?php echo set_select('twitter', $staff_details->twitter); ?>" />-->
        <!--        <div class="form-error"><?php echo form_error('twitter'); ?></div>-->
        <!--    </div>-->
        <!--</div>-->

        <!--<div class="form-group">-->
        <!--    <label class="form-control-label">Instagram Handle</label>-->
        <!--    <div class="input-group">-->
        <!--        <div class="input-group-addon bg-instagram">-->
        <!--            <i class="fa-brands fa-instagram"></i>-->
        <!--        </div>-->
        <!--        <input type="text" class="form-control" name="instagram" value="<?php echo set_select('instagram', $staff_details->instagram); ?>" />-->
        <!--        <div class="form-error"><?php echo form_error('instagram'); ?></div>-->
        <!--    </div>-->
        <!--</div>-->

        <!--<div class="form-group">-->
        <!--    <label class="form-control-label">LinkedIn Handle</label>-->
        <!--    <div class="input-group">-->
        <!--        <div class="input-group-addon bg-linkedin">-->
        <!--            <i class="fa-brands fa-linkedin"></i>-->
        <!--        </div>-->
        <!--        <input type="text" class="form-control" name="linkedin" value="<?php echo set_select('linkedin', $staff_details->linkedin); ?>" />-->
        <!--        <div class="form-error"><?php echo form_error('linkedin'); ?></div>-->
        <!--    </div>-->
        <!--</div>-->

        <div class="form-group">
            <label class="form-control-label">Upload Staff Photo (Optional)</label>
            <p class="m-t-10"><strong>Current Image:</strong></p>
            <?php if (!empty($staff_details->staff_photo)): ?>
                <img src="<?php echo base_url('assets/uploads/staff/' . $staff_details->staff_photo); ?>" alt="Current Image" style="width: 200px; height: auto; margin-bottom: 15px;">
            <?php else: ?>
                <p>No feature image.</p>
            <?php endif; ?>

            <br />
            <small>If you upload a new image, it will replace the current one.</small>
            <input type="file" name="staff_photo" id="the_image" class="form-control" accept=".jpeg,.jpg,.png" />
            <div class="form-error"><?php echo form_error('staff_photo'); ?></div>
        </div>

        <div class="m-t-20">
            <button type="submit" id="send_mail_btn" class="btn btn-lg btn-primary">
                <span id="btn_text">Update staff</span>
                <span id="loading_icon" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>
            </button>
        </div>

    </div>
</div>

<?php echo form_close(); ?>