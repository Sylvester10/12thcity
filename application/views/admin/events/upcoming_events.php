<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>
<?php echo custom_validation_errors(); ?>

<div class="new-item">

    <a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('admin-add-event'); ?>"><i class="fa fa-plus"></i> Add Event</a>

    <?php if ($total_records > 0) { ?>
        <button class="btn btn-default btn-sm button-adjust" data-toggle="modal" data-target="#clear_events"><i class="fa fa-trash"></i> Clear All</button>
    <?php } ?>

    <a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('events'); ?>" target="_blank"><i class="fa fa-eye"></i> View in Site</a>

</div>

<div class="m-b-30">
    <p><i class="fa fa-eye text-success"></i> Published: <?php echo number_format($total_published); ?></p>
    <p><i class="fa fa-eye-slash text-primary"></i> Unpublished (Drafts): <?php echo number_format($total_unpublished); ?></p>
    <p><i class="fa fa-th-large"></i> All: <?php echo number_format($total_records); ?></p>

    <p>Note: Events will be shown in homepage if at least 1 future events is published.</p>

</div>

<?php
//select options bulk actions 
$options_array = array(
    //'value' => 'Caption'
    'publish' => 'Publish',
    'unpublish' => 'Unpublish',
    'delete' => 'Delete'
);
echo modal_bulk_actions('admin_events/bulk_actions_events', $options_array); ?>

<div class="table-scroll">
    <table id="upcoming_events_table" class="table table-bordered table-hover cell-text-middle"
        style="text-align: left">

        <input type="hidden" id="csrf_hash" value="<?php echo $this->security->get_csrf_hash(); ?>" />

        <thead>
            <tr>
                <th class="w-15-p"> <input type="checkbox" class="radio-box select_all" /> </th>
                <th> Actions </th>
                <th class=""> Feature Image </th>
                <th> Type </th>
                <th class="min-w-150"> Caption </th>
                <th class="min-w-150"> Date </th>
                <th class="min-w-150"> Venue </th>
                <th class="min-w-100"> Views </th>
                <th class="min-w-100"> Status </th>
                <th class="min-w-150"> Date Added</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<?php echo form_close(); ?>