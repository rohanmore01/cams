<?php

$db = $this->load->database();
$getDepartmentQuery = $this->db->query('SELECT dept_name FROM `department` WHERE `dept_no` = ' . $camDataEntry->dept_no . '');
$department = $getDepartmentQuery->row();

$getAppTypeQuery = $this->db->query('SELECT app_type FROM `app_type` WHERE app_code = ' . $camDataEntry->app_code . '');
$appType = $getAppTypeQuery->row();

?>
<div class="container my-4 col-lg-10 col-sm-10">
	<div class="card">
		<div class="card-header text-center">
			CAMS Data Entry Details
			<span class="float-right">
				<a type="button" class="btn" href="<?php echo base_url('camDataEntryEdit/' . $camDataEntry->ack_no); ?>" title="Edit">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
						<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
					</svg>
				</a>

				<a type="button" class="btn" href="<?php echo base_url(); ?>" title="Cancel">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-x-circle" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
						<path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
					</svg>
				</a>
			</span>
		</div>
		<div class="card-body">
			<div class="row">
				<label for="ack_number" class="col-sm-2 control-label">Ack Number :</label>
				<div class="col-sm-4">
					<?php echo $camDataEntry->ack_no; ?>
				</div>

				<label for="name" class="col-sm-2 control-label">Name :</label>
				<div class="col-sm-4">
					<?php echo $camDataEntry->name; ?>
				</div>
			</div>
			<hr>
			<div class="row">
				<label for="ack_number" class="col-sm-2 control-label">Department :</label>
				<div class="col-sm-4">
					<?php echo $department->dept_name; ?>
				</div>

				<label for="name" class="col-sm-2 control-label">Application Type :</label>
				<div class="col-sm-4">
					<?php echo $appType->app_type; ?>
				</div>
			</div>
			<hr>
			<div class="row">
				<label for="ack_number" class="col-sm-2 control-label">Date :</label>
				<div class="col-sm-4">
					<?php echo date("d-m-Y", strtotime($camDataEntry->date)); ?>
				</div>

				<label for="name" class="col-sm-2 control-label">Due Date :</label>
				<div class="col-sm-4">
					<?php echo date("d-m-Y", strtotime($camDataEntry->due_date)); ?>
				</div>
			</div>
			<hr>
			<div class="row">
				<label for="ack_number" class="col-sm-2 control-label">Query Date :</label>
				<div class="col-sm-4">
					<?php echo ($camDataEntry->query_date == "") ? "NA" : date("d-m-Y", strtotime($camDataEntry->query_date)); ?>
				</div>

				<label for="name" class="col-sm-2 control-label">Grant Date :</label>
				<div class="col-sm-4">
					<?php echo ($camDataEntry->grant_date == "") ? "NA" : date("d-m-Y", strtotime($camDataEntry->grant_date)); ?>
				</div>
			</div>
			<hr>
			<div class="row">
				<label for="ack_number" class="col-sm-2 control-label">Rejected Date :</label>
				<div class="col-sm-4">
					<?php echo ($camDataEntry->rejected_date == "") ? "NA" : date("d-m-Y", strtotime($camDataEntry->rejected_date)); ?>
				</div>

				<label for="name" class="col-sm-2 control-label">Status :</label>
				<div class="col-sm-4">
					<?php echo $camDataEntry->status; ?>
				</div>
			</div>
			<hr>
			<div class="row">
				<label for="ack_number" class="col-sm-2 control-label">Remark :</label>
				<div class="col-sm-4">
					<?php echo $camDataEntry->remark; ?>
				</div>

				<label for="name" class="col-sm-2 control-label">Address :</label>
				<div class="col-sm-4">
					<?php echo $camDataEntry->address; ?>
				</div>
			</div>

		</div>
	</div>
</div>