<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>
<?php echo custom_validation_errors(); ?>

<?php
//select options bulk actions
$options_array = array(
    //'value' => 'Caption'
    'delete' => 'Delete'
);
echo modal_bulk_actions('admin_leads/bulk_actions_leads', $options_array); ?>

<div class="table-scroll">
    <table id="all_leads_table" class="table table-bordered table-hover cell-text-middle"
        style="text-align: left">

        <input type="hidden" id="csrf_hash" value="<?php echo $this->security->get_csrf_hash(); ?>" />

        <thead>
            <tr>
                <th class="w-15-p"> <input type="checkbox" class="radio-box select_all" /> </th>
                <th> Actions </th>
                <th class="min-w-200"> FullName </th>
                <th class="min-w-200"> Email Address </th>
                <th class=""> Phone </th>
                <th class="min-w-100"> Ebook Requested </th>
                <th class="min-w-150"> Date Added</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<?php echo form_close(); ?>
