<div class="container mt-5 col-sm-3">
	<div class="card">
		<div class="card-header text-center" style="background-color:#F0F8FF">
			Daily Report For Printing
		</div>

		<div class="card-body">
			<form action="DailyReportPrint" method="post" autocomplete="off" target="_blank">
				<div class="form-group">
					<label for="date">Select Date</label>
					<input type="date" name="date" class="form-control" id="date" required="" value="<?php echo date('Y-m-d'); ?>">
				</div>
				<input type="submit" name="submit-daily-report-form" class="btn btn-success">
			</form>
		</div>
	</div>
</div>
