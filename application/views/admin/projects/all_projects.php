<?php echo flash_message_success('status_msg'); ?>
<?php echo flash_message_danger('status_msg_error'); ?>
<?php echo custom_validation_errors(); ?>

<div class="new-item">
	<a class="btn btn-default btn-sm button-adjust" href="<?php echo base_url('admin-add-project'); ?>"><i class="fa fa-plus"></i> Add Project</a>
</div>


<?php
//select options bulk actions 
$options_array = array(
	//'value' => 'Caption'
	'publish' => 'Publish',
	'unpublish' => 'Unpublish',
	'delete' => 'Delete'
);
echo modal_bulk_actions('admin_projects/bulk_actions_projects', $options_array); ?>

<div class="table-scroll">
	<table id="all_projects_table" class="table table-bordered table-hover cell-text-middle" style="text-align: left">

		<input type="hidden" id="csrf_hash" value="<?php echo $this->security->get_csrf_hash(); ?>" />

		<thead>
			<tr>
				<th class="w-15-p"> <input type="checkbox" class="radio-box select_all" /> </th>
				<th> Actions </th>
				<th> Feature Image </th>
				<th class="min-w-150"> Title </th>
				<th class="min-w-500"> Description </th>
				<th class="min-w-150"> State </th>
				<th class="min-w-150"> Location </th>
				<th class="min-w-150"> Address </th>
				<th class="min-w-150"> Amenities </th>
				<th class="min-w-150"> YouTube </th>
				<th class=""> Published </th>
				<th class="min-w-150"> Date </th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>

<?php echo form_close(); ?>