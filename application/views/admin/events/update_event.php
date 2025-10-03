<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>
<?php echo custom_validation_errors(); ?>


<div class="new-item">
    <a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('admin-events'); ?>"><i class="fa fa-calendar"></i> All Events </a>
</div>

<?php
// Form now points to the edit function with the event ID
echo form_open_multipart('admin_events/update_project_ajax/' . $event_details->id, 'id="submit_button"'); ?>

All fields marked * are required.

<div class="row">

    <div class="col-md-6 col-sm-12 col-xs-12">

        <div class="form-group">
            <label class="form-control-label">Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo set_value('title', $project_details->title); ?>" required />
            <div class="form-error"><?php echo form_error('title'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label">Description</label>
            <textarea id="email_message" name="description" class="form-control t200" required><?php echo set_value('description', $project_details->description); ?></textarea>
        </div>

        <div class="form-group">
            <label class="form-control-label">State*</label>
            <br />
            <select class="form-control" name="state" required>
                <option value="">Select</option>
                <?php
                // Get the current state value, falling back to the saved project detail
                $current_state = set_value('state', $project_details->state);
                $states = [
                    "Abuja" => "Abuja",
                    "Portharcourt" => "Portharcourt"
                    // Add other states here as needed
                ];

                foreach ($states as $key => $value) {
                    // If the current state matches this option, mark it as 'selected'
                    $selected = ($key === $current_state) ? 'selected' : '';
                    echo "<option value=\"$key\" $selected>$value</option>";
                }
                ?>
            </select>
            <div class="form-error"><?php echo form_error('state'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label">Location*</label>
            <br />
            <select class="form-control" name="location" required>
                <option value="">Select</option>
                <?php
                // Get the current location value
                $current_location = set_value('location', $project_details->location);
                $locations = ["Guzape", "Idu", "Lugbe", "Mbora", "Kuje"];

                foreach ($locations as $location) {
                    // If the current location matches this option, mark it as 'selected'
                    $selected = ($location === $current_location) ? 'selected' : '';
                    echo "<option value=\"$location\" $selected>$location</option>";
                }
                ?>
            </select>
            <div class="form-error"><?php echo form_error('location'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label">Address*</label>
            <br />
            <input type="text" name="address" class="form-control" value="<?php echo set_value('address', $project_details->address); ?>" required />
            <div class="form-error"><?php echo form_error('address'); ?></div>
        </div>

    </div>

    <div class="col-md-6 col-sm-12 col-xs-12">

        <div class="form-group">
            <label class="form-control-label">Upload New Feature Image (Optional)</label>
            <p class="m-t-10"><strong>Current Image:</strong></p>
            <?php if (!empty($event_details->event_image)): ?>
                <img src="<?php echo base_url('assets/uploads/events/' . $event_details->event_image); ?>" alt="Current Image" style="width: 200px; height: auto; margin-bottom: 15px;">
            <?php else: ?>
                <p>No feature image.</p>
            <?php endif; ?>

            <br />
            <small>If you upload a new image, it will replace the current one.</small>
            <input type="file" name="event_image" id="the_image" class="form-control" accept=".jpeg,.jpg,.png" />
            <div class="form-error"><?php echo form_error('event_image'); ?></div>
        </div>

        <hr>

        <div class="form-group" id="other_images">
            <label class="form-control-label">Upload Other Event Images (Optional)</label><br />
            <p class="m-t-10"><strong>Current Other Images:</strong></p>
            <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 15px;">
                <?php if (!empty($event_details->other_images)):
                    $other_images = explode(',', $event_details->other_images);
                    foreach ($other_images as $img): ?>
                        <img src="<?php echo base_url('assets/uploads/events/' . trim($img)); ?>" alt="Other Image" style="width: 100px; height: auto;">
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No other images.</p>
                <?php endif; ?>
            </div>

            <small>Uploading new images will **replace all** current "other" images.</small>
            <input type="file" name="other_images[]" multiple class="form-control" accept=".jpeg,.jpg,.png" />
        </div>

        <div class="m-t-20">
            <button type="submit" id="send_mail_btn" class="btn btn-lg btn-primary">
                <span id="btn_text">Update Event</span>
                <span id="loading_icon" style="display: none;"><i class="fa fa-spinner fa-spin"></i></span>
            </button>
        </div>

    </div>
</div><?php echo form_close(); ?>