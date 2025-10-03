<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>
<?php echo custom_validation_errors(); ?>

<div class="new-item">

    <a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('admin-add-staff'); ?>"><i class="fa fa-plus"></i> Add Staff</a>

    <a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('governance'); ?>" target="_blank"><i class="fa fa-eye"></i> View in Site</a>

</div>

<div class="m-b-30">
    <p><i class="fa fa-eye text-success"></i> Published: <?php echo number_format($total_published); ?></p>
    <p><i class="fa fa-eye-slash text-primary"></i> Unpublished: <?php echo number_format($total_unpublished); ?></p>
    <p><i class="fa fa-th-large"></i> All: <?php echo number_format($total_records); ?></p>

    <p>Note: staff will be shown in homepage if at least 1 future staff is published.</p>

</div>

<?php
//select options bulk actions 
$options_array = array(
    //'value' => 'Caption'
    'publish' => 'Publish',
    'unpublish' => 'Unpublish',
    'delete' => 'Delete'
);
echo modal_bulk_actions('admin_staff/bulk_actions_staff', $options_array); ?>

<div class="table-scroll">
    <table id="all_staff_table" class="table table-bordered table-hover cell-text-middle"
        style="text-align: left">

        <input type="hidden" id="csrf_hash" value="<?php echo $this->security->get_csrf_hash(); ?>" />

        <thead>
            <tr>
                <th class="w-15-p"> <input type="checkbox" class="radio-box select_all" /> </th>
                <th> Actions </th>
                <th class=""> Staff Photo </th>
                <th class="min-w-200"> Name </th>
                <th class=""> Sex </th>
                <th class="min-w-200"> Email Address </th>
                <th class=""> State </th>
                <th class="min-w-150"> Order Number </th>
                <!--<th class="min-w-150"> Phone </th>-->
                <!--<th class="min-w-150"> Designation </th>-->
                <!--<th class="min-w-150"> Socials </th>-->
                <!--<th class="min-w-100"> Date of Birth </th>-->
                <th class="min-w-100"> Status </th>
                <!--<th class="min-w-150"> Date Joined</th>-->
                <th class="min-w-150"> Date Added</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<?php echo form_close(); ?>