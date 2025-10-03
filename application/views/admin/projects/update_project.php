<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>

<div class="new-item">
    <a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('admin_projects'); ?>"><i class="fa fa-home"></i> All Projects</a>
    <a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('admin-add-project'); ?>"><i class="fa fa-plus"></i> Add project</a>
</div>



<?php

echo form_open_multipart('admin_projects/update_project_ajax/' . $y->id, 'id="submit"'); ?>

<div class="row">

    <div class="col-md-6 col-sm-12 col-xs-12">

        <div class="form-group">
            <label class="form-control-label">Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo set_value('title', $y->title); ?>" required />
            <div class="form-error"><?php echo form_error('title'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label">Description</label>
            <textarea id="email_message" name="description" class="form-control t200" required><?php echo set_value('description', $y->description); ?></textarea>
        </div>

        <div class="form-group">
            <label class="form-control-label">State*</label>
            <br />
            <select class="form-control" name="state" required>
                <option value="">Select</option>
                <?php
                $current_state = set_value('state', $y->state);
                $states = [
                    "abuja" => "Abuja",
                    "ph" => "Portharcourt"
                ];
                foreach ($states as $key => $value) {
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
                $current_location = set_value('location', $y->location);

                // Grouped locations
                $locations = [
                    "Abuja" => ["Apo", "Bwari", "Guzape", "Idu", "Lugbe", "Mbora", "Kuje"],
                    "Port Harcourt" => [
                        "New GRA",
                        "Old GRA",
                        "Diobu (Mile 1, 2, 3)",
                        "D-Line",
                        "Trans-Amadi",
                        "Choba",
                        "Rumuola",
                        "Elelenwo",
                        "Woji",
                        "Ada George",
                        "Agip",
                        "Peter Odili Road",
                        "Ogbunabali",
                        "Mgbuoba",
                        "Rumukrueshi"
                    ]
                ];

                foreach ($locations as $city => $areas) {
                    echo "<optgroup label=\"$city\">";
                    foreach ($areas as $location) {
                        $selected = ($location === $current_location) ? 'selected' : '';
                        echo "<option value=\"$location\" $selected>$location</option>";
                    }
                    echo "</optgroup>";
                }
                ?>
            </select>
            <div class="form-error"><?php echo form_error('location'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label">Address*</label>
            <br />
            <input type="text" name="address" class="form-control" value="<?php echo set_value('address', $y->address); ?>" required />
            <div class="form-error"><?php echo form_error('address'); ?></div>
        </div>

    </div>

    <div class="col-md-6 col-sm-12 col-xs-12">

        <div class="form-group">
            <label class="form-control-label">Living Rooms*</label>
            <br />
            <select class="form-control" name="livingrooms" required>
                <option value="">Select</option>
                <?php
                // Get the current value, falling back to the saved project detail
                $selected_rooms = set_value('livingrooms', $y->livingrooms);
                for ($i = 1; $i <= 5; $i++) {
                    $selected = ($i == $selected_rooms) ? 'selected' : '';
                    echo "<option value=\"$i\" $selected>$i</option>";
                }
                ?>
            </select>
            <div class="form-error"><?php echo form_error('livingrooms'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label">Bedrooms*</label>
            <br />
            <select class="form-control" name="bedrooms" required>
                <option value="">Select</option>
                <?php
                $selected_rooms = set_value('bedrooms', $y->bedrooms);
                for ($i = 1; $i <= 10; $i++) {
                    $selected = ($i == $selected_rooms) ? 'selected' : '';
                    echo "<option value=\"$i\" $selected>$i</option>";
                }
                ?>
            </select>
            <div class="form-error"><?php echo form_error('bedrooms'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label">Bathroom*</label>
            <br />
            <select class="form-control" name="bathrooms" required>
                <option value="">Select</option>
                <?php
                $selected_rooms = set_value('bathrooms', $y->bathrooms);
                for ($i = 1; $i <= 10; $i++) {
                    $selected = ($i == $selected_rooms) ? 'selected' : '';
                    echo "<option value=\"$i\" $selected>$i</option>";
                }
                ?>
            </select>
            <div class="form-error"><?php echo form_error('bathrooms'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label">Square ft</label>
            <input type="text" name="size" class="form-control" value="<?php echo set_value('size', $y->size); ?>" required />
            <div class="form-error"><?php echo form_error('size'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label m-r-20 ">Parking*</label>
            <br />
            <select class="form-control" name="parking" required>
                <option value="">Select</option>
                <?php
                $selected_rooms = set_value('parking', $y->parking);
                for ($i = 1; $i <= 5; $i++) {
                    $selected = ($i == $selected_rooms) ? 'selected' : '';
                    echo "<option value=\"$i\" $selected>$i</option>";
                }
                ?>
            </select>
            <div class="form-error"><?php echo form_error('parking'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label m-r-20 ">Elevator*</label>
            <label class="m-r-10"><input type="radio" name="elevator" value="1" <?php echo set_radio('elevator', '1', ($y->elevator == '1')); ?>> Yes</label>
            <label><input type="radio" name="elevator" value="0" <?php echo set_radio('elevator', '0', ($y->elevator == '0')); ?>> No</label>
            <div class="form-error"><?php echo form_error('elevator'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label m-r-20 ">Wifi*</label>
            <label class="m-r-10"><input type="radio" name="wifi" value="1" <?php echo set_radio('wifi', '1', ($y->wifi == '1')); ?>> Yes</label>
            <label><input type="radio" name="wifi" value="0" <?php echo set_radio('wifi', '0', ($y->wifi == '0')); ?>> No</label>
            <div class="form-error"><?php echo form_error('wifi'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label">Amenities</label>
            <br />
            <select class="form-control selectpicker" name="amenities[]" multiple required>
                <?php
                $amenities_list = [
                    "car_parking" => ["title" => "Car Parking", "icon" => "aminities-icon1-1.svg", "img" => "aminities1-1.png"],
                    "fitness_center" => ["title" => "Fitness Center", "icon" => "aminities-icon1-2.svg", "img" => "aminities1-2.png"],
                    "rooftop_garden" => ["title" => "Rooftop Garden", "icon" => "aminities-icon1-3.svg", "img" => "aminities1-3.png"],
                    "indoor_pool" => ["title" => "Indoor Pool", "icon" => "aminities-icon1-4.svg", "img" => "aminities1-4.png"],
                    "pet_friendly" => ["title" => "Pet Friendly", "icon" => "aminities-icon1-5.svg", "img" => "aminities1-5.png"],
                    "playground" => ["title" => "Playground", "icon" => "aminities-icon1-6.svg", "img" => "aminities1-6.png"],
                    "basketball_court" => ["title" => "Basketball Court", "icon" => "aminities-icon1-5.svg", "img" => "aminities1-5.png"],
                    "barbecue" => ["title" => "Barbecue", "icon" => "aminities-icon1-6.svg", "img" => "aminities1-6.png"],
                    "recreation" => ["title" => "Recreation", "icon" => "aminities-icon1-1.svg", "img" => "aminities1-1.png"],
                    "security" => ["title" => "Security", "icon" => "aminities-icon1-2.svg", "img" => "aminities1-2.png"],
                    "ante_room" => ["title" => "Ante Room", "icon" => "aminities-icon1-4.svg", "img" => "aminities1-4.png"],
                    "visitors_toilet" => ["title" => "Visitors Toilet", "icon" => "aminities-icon1-6.svg", "img" => "aminities1-6.png"],
                    "ensuite_bedrooms" => ["title" => "En-suite Bedrooms", "icon" => "aminities-icon1-1.svg", "img" => "aminities1-1.png"],
                    "masters_bedroom" => ["title" => "Master's Bedroom", "icon" => "aminities-icon1-2.svg", "img" => "aminities1-2.png"],
                    "family_lounge" => ["title" => "Family Lounge", "icon" => "aminities-icon1-3.svg", "img" => "aminities1-3.png"],
                    "lounge_balcony" => ["title" => "Lounge Balcony", "icon" => "aminities-icon1-4.svg", "img" => "aminities1-4.png"],
                ];

                $selected_amenities = [];
                if (!empty($y->amenities)) {
                    $selected_amenities = explode(',', $y->amenities);
                }

                foreach ($amenities_list as $key => $details) {
                    $isSelected = in_array($key, $selected_amenities) ? 'selected' : '';
                    echo '<option value="' . htmlspecialchars($key) . '" ' . $isSelected . '>' . htmlspecialchars($details['title']) . '</option>';
                }
                ?>
            </select>
            <div class="form-error"><?php echo form_error('amenities'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label">Video</label><br />
            <small>Please make sure the link has "<b>embed</b>" in it.</small>
            <br />
            <input type="text" name="video" class="form-control" value="<?php echo set_value('video', $y->video); ?>" placeholder="https://www.youtube.com/embed/eWUxqVFBq74" />
            <div class="form-error"><?php echo form_error('video'); ?></div>
        </div>

    </div>

    <div class="col-md-6 col-sm-12 col-xs-12">

        <div class="form-group">
            <label class="form-control-label">Upload New Feature Image (Optional)</label>
            <p class="m-t-10"><strong>Current Image:</strong></p>
            <?php if (!empty($y->featured_image)): ?>
                <img src="<?php echo base_url('assets/uploads/projects/' . $y->featured_image); ?>" alt="Current Image" style="width: 200px; height: auto; margin-bottom: 15px;">
            <?php else: ?>
                <p>No feature image.</p>
            <?php endif; ?>

            <br />
            <small>If you upload a new image, it will replace the current one.</small>
            <input type="file" name="featured_image" class="form-control" accept=".jpeg,.jpg,.png" />
        </div>

        <hr>

        <div class="form-group">
            <label class="form-control-label">Upload Other Project Images (Optional)</label><br />
            <p class="m-t-10"><strong>Current Other Images:</strong></p>
            <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 15px;">
                <?php if (!empty($y->other_images)):
                    $other_images = explode(',', $y->other_images);
                    foreach ($other_images as $img): ?>
                        <img src="<?php echo base_url('assets/uploads/projects/' . trim($img)); ?>" alt="Other Image" style="width: 100px; height: auto;">
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

</div>

<?php echo form_close(); ?>