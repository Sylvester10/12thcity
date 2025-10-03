<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>

<div class="new-item">
    <a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('admin_projects'); ?>"><i class="fa fa-cubes"></i> All Projects</a>
</div>



<?php

echo form_open_multipart('admin_projects/add_project_ajax', 'id="submit"'); ?>

<div class="row">

    <div class="col-md-6 col-sm-12 col-xs-12">

        <div class="form-group">
            <label class="form-control-label">Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo set_value('title'); ?>" required />
            <div class="form-error"><?php echo form_error('title'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label">Description</label>
            <textarea id="email_message" name="description" class="form-control t200" required><?php echo set_value('description'); ?></textarea>
            <div class="form-error"><?php echo form_error('description'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label">State*</label>
            <br />
            <select class="form-control" name="state" required>
                <option value="">Select</option>
                <?php
                $selected_state = set_value('state', ''); // Assuming this gets the previously selected state
                $states = [
                    "abuja" => "Abuja",
                    "ph" => "Portharcourt"
                    // Add other states here as needed
                ];

                foreach ($states as $key => $value) {
                    $selected = ($key === $selected_state) ? 'selected' : '';
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
                <option value="<?php echo set_value('location'); ?>">
                    <?php echo set_value('location'); ?>
                </option>

                <!-- Abuja Areas -->
                <optgroup label="Abuja">
                    <option value="Apo">Apo</option>
                    <option value="Bwari">Bwari</option>
                    <option value="Guzape">Guzape</option>
                    <option value="Idu">Idu</option>
                    <option value="Lugbe">Lugbe</option>
                    <option value="Mbora">Mbora</option>
                    <option value="Kuje">Kuje</option>
                </optgroup>

                <!-- Port Harcourt Areas -->
                <optgroup label="Port Harcourt">
                    <option value="New GRA">New GRA</option>
                    <option value="Old GRA">Old GRA</option>
                    <option value="Diobu">Diobu (Mile 1, 2, 3)</option>
                    <option value="D-Line">D-Line</option>
                    <option value="Trans-Amadi">Trans-Amadi</option>
                    <option value="Choba">Choba</option>
                    <option value="Rumuola">Rumuola</option>
                    <option value="Elelenwo">Elelenwo</option>
                    <option value="Woji">Woji</option>
                    <option value="Ada George">Ada George</option>
                    <option value="Agip">Agip</option>
                    <option value="Peter Odili Road">Peter Odili Road</option>
                    <option value="Ogbunabali">Ogbunabali</option>
                    <option value="Mgbuoba">Mgbuoba</option>
                    <option value="Rumukrueshi">Rumukrueshi</option>
                </optgroup>
            </select>
            <div class="form-error"><?php echo form_error('location'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label">Address*</label>
            <br />
            <input type="text" name="address" class="form-control" value="<?php echo set_value('address'); ?>" required />
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
                $selected_rooms = set_value('livingrooms', '');
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
                $selected_rooms = set_value('bedrooms', '');
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
                $selected_rooms = set_value('bathrooms', '');
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
            <input type="text" name="size" class="form-control" value="<?php echo set_value('size'); ?>" required />
            <div class="form-error"><?php echo form_error('size'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label m-r-20 ">Parking*</label>
            <br />
            <select class="form-control" name="parking" required>
                <option value="">Select</option>
                <?php
                $selected_rooms = set_value('parking', '');
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
            <label class="m-r-10"><input type="radio" name="elevator" value="1" <?php echo set_radio('elevator', 1); ?>> Yes</label>
            <label><input type="radio" name="elevator" value="0" <?php echo set_radio('elevator', 0); ?>> No</label>
            <div class="form-error"><?php echo form_error('elevator'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label m-r-20 ">Wifi*</label>
            <label class="m-r-10"><input type="radio" name="wifi" value="1" <?php echo set_radio('wifi', 1); ?>> Yes</label>
            <label><input type="radio" name="wifi" value="0" <?php echo set_radio('wifi', 0); ?>> No</label>
            <div class="form-error"><?php echo form_error('wifi'); ?></div>
        </div>

        <div class="form-group">
            <label class="form-control-label">Amenities</label>
            <br />
            <select class="form-control selectpicker" name="amenities[]" multiple required>
                <?php
                // The master list of all available amenities
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

                // Get the saved amenities (which are stored as a comma-separated string of keys)
                $selected_amenities = [];
                if (!empty($project_details->amenities)) {
                    $selected_amenities = explode(',', $project_details->amenities);
                }

                // Loop through the master list to create the options
                foreach ($amenities_list as $key => $details) {
                    // Check if the current amenity's key is in the array of selected amenities
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
            <input type="text" name="video" class="form-control" value="<?php echo set_value('video'); ?>" placeholder="https://www.youtube.com/embed/eWUxqVFBq74" />
            <div class="form-error"><?php echo form_error('video'); ?></div>
        </div>

    </div>

    <div class="col-md-6 col-sm-12 col-xs-12">

        <div class="form-group">
            <label class="form-control-label">Upload Feature Image </label>
            <br />
            <small>Only JPG and PNG files allowed (max 4MB).</small>
            <input type="file" name="featured_image" id="the_image" class="form-control" accept=".jpeg,.jpg,.png" required />
            <div class="form-error"><?php echo form_error('featured_image'); ?></div>
        </div>

        <!-- Image preview-->
        <?php echo generate_image_preview(); ?>

        <div class="form-group" id="other_images">
            <label class="form-control-label">Upload Other Project Images </label><br />
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

    </div>

</div><!--/.row-->

<?php echo form_close(); ?>