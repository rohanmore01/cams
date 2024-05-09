<style>
	.Rejected {
		color: red;
	}

	.Pending {
		color: blue;
	}

	.Granted {
		color: green;
	}
</style>
<div class="main-panel mt-3">
	<div class="content-wrapper">
		<div class="col-lg-12 grid-margin stretch-card mb-5">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title text-center">CAMS DATA ENTRY LIST<button type="button" class="btn btn-outline-secondary" style="float:right;line-height:1;" data-toggle="modal" data-target="#ackNoSearchModal">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
								<path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
							</svg>
							<span class="visually-hidden">ACK No.</span>
						</button></h5>
					<hr style="border-top: 1px solid black;">
					<div class="table-responsive">
						<table class="table table-bordered table-hover display nowrap data-table">
							<thead>
								<tr>
									<th>Ack No</th>
									<th>Name</th>
									<th>Department</th>
									<th>App Type</th>
									<th>Date</th>
									<th>Due Date</th>
									<th>Status</th>
									<th>Query Date</th>
									<th>Grant Date</th>
									<th>Rejected Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php

								$db = $this->load->database();

								if (isset($applicantData)) {
									$getDepartmentQuery = $this->db->query('SELECT dept_no, dept_name FROM `department` WHERE `dept_no` = ' . $applicantData->dept_no . '');
									$department = $getDepartmentQuery->row();

									$getAppTypeQuery = $this->db->query('SELECT app_code , app_type FROM `app_type` WHERE app_code = ' . $applicantData->app_code . '');
									$appType = $getAppTypeQuery->row();
								?>
									<tr>
										<td><?php echo $applicantData->ack_no; ?></td>
										<td><a href="<?php echo base_url('camDataEntryDetail/' . $applicantData->ack_no); ?>" style="color:black;"><?php echo $applicantData->name; ?></a></td>
										<td><?php echo $department->dept_no . "-" . $department->dept_name; ?></td>
										<td><?php echo $appType->app_code . "-" . $appType->app_type; ?></td>
										<td><?php echo date("d-m-Y", strtotime($applicantData->date)); ?></td>
										<td><?php echo date("d-m-Y", strtotime($applicantData->due_date)); ?></td>
										<td class="<?php echo $applicantData->status ?>"><?php echo $applicantData->status; ?></td>
										<td><?php if ($applicantData->query_date == '') {
												echo 'NA';
											} else {
												echo date("d-m-Y", strtotime($applicantData->query_date));
											} ?></td>
										<td><?php if ($applicantData->grant_date == '') {
												echo 'NA';
											} else {
												echo date("d-m-Y", strtotime($applicantData->grant_date));
											} ?></td>
										<td><?php if ($applicantData->rejected_date == '') {
												echo 'NA';
											} else {
												echo date("d-m-Y", strtotime($applicantData->rejected_date));
											} ?></td>

										<td>
											<a class="badge badge-success" href='<?php echo base_url('camDataEntryEdit/' . $applicantData->ack_no); ?>' title="Edit">
												<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
													<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
												</svg>
											</a>

											<?php if ($this->session->userdata('user_type') == "admin") {
											?>
												<a class="badge badge-danger" onclick="return confirm(' Are You Sure Want To Delete ?');" href='<?php echo base_url('camDataEntryDelete/' . $applicantData->ack_no); ?>' title="Delete">
													<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
														<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
														<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
													</svg>
												</a>
											<?php
											}
											?>

											<a class="badge badge-info" href='<?php echo base_url('camDataEntryPrint/' . $applicantData->ack_no); ?>' target="_blank" title="Print">
												<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
													<path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
													<path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
												</svg>
											</a>

											<a class="badge badge-warning" href='<?php echo base_url('camDataEntryDepartmentCopyPrint/' . $applicantData->ack_no); ?>' target="_blank" title="Department Copy">
												<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
													<path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"></path>
													<path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"></path>
												</svg>
											</a>

										</td>
									</tr>
									<?php
								} else {
									if (isset($applications)) {
										foreach ($applications as $application) {
											$getDepartmentQuery = $this->db->query('SELECT dept_no, dept_name FROM `department` WHERE `dept_no` = ' . $application->dept_no . '');
											$department = $getDepartmentQuery->row();

											$getAppTypeQuery = $this->db->query('SELECT app_code , app_type FROM `app_type` WHERE app_code = ' . $application->app_code . '');
											$appType = $getAppTypeQuery->row();
									?>
											<tr>
												<td><?php echo $application->ack_no; ?></td>
												<td><a href="<?php echo base_url('camDataEntryDetail/' . $application->ack_no); ?>" style="color:black;"><?php echo $application->name; ?></a></td>
												<td><?php echo $department->dept_no . "-" . $department->dept_name; ?></td>
												<td><?php echo $appType->app_code . "-" . $appType->app_type; ?></td>
												<td><?php echo date("d-m-Y", strtotime($application->date)); ?></td>
												<td><?php echo date("d-m-Y", strtotime($application->due_date)); ?></td>
												<td class="<?php echo $application->status ?>"><?php echo $application->status; ?></td>
												<td><?php if ($application->query_date == '') {
														echo 'NA';
													} else {
														echo date("d-m-Y", strtotime($application->query_date));
													} ?></td>
												<td><?php if ($application->grant_date == '') {
														echo 'NA';
													} else {
														echo date("d-m-Y", strtotime($application->grant_date));
													} ?></td>
												<td><?php if ($application->rejected_date == '') {
														echo 'NA';
													} else {
														echo date("d-m-Y", strtotime($application->rejected_date));
													} ?></td>

												<td>
													<?php
													if ($application->status == "Pending") { ?>
														<a class="badge badge-success" href='<?php echo base_url('camDataEntryEdit/' . $application->ack_no); ?>' title="Edit">
															<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
																<path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
															</svg>
														</a>
													<?php
													} ?>

													<?php if ($this->session->userdata('user_type') == "admin") {
														if ($application->status == "Pending") {
													?>
															<a class="badge badge-danger" onclick="return confirm(' Are You Sure Want To Delete ?');" href='<?php echo base_url('camDataEntryDelete/' . $application->ack_no); ?>' title="Delete">
																<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
																	<path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
																	<path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
																</svg>
															</a>
													<?php
														}
													}
													?>

													<a class="badge badge-info" href='<?php echo base_url('camDataEntryPrint/' . $application->ack_no); ?>' target="_blank" title="Print">
														<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
															<path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
															<path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
														</svg>
													</a>

													<a class="badge badge-warning" href='<?php echo base_url('camDataEntryDepartmentCopyPrint/' . $application->ack_no); ?>' target="_blank" title="Department Copy">
														<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-printer-fill" viewBox="0 0 16 16">
															<path d="M5 1a2 2 0 0 0-2 2v1h10V3a2 2 0 0 0-2-2H5zm6 8H5a1 1 0 0 0-1 1v3a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-3a1 1 0 0 0-1-1z"></path>
															<path d="M0 7a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2h-1v-2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2H2a2 2 0 0 1-2-2V7zm2.5 1a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"></path>
														</svg>
													</a>

												</td>
											</tr>
								<?php }
									}
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="ackNoSearchModal" tabindex="-1" role="dialog" aria-labelledby="ackNoSearchModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width:25%;">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="ackNoSearchModalLabel">Enter Acknowledge No.</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type="text" class="form-control" name="ack_no" id="ack_no">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="searchByAckNo">Search</button>
			</div>
		</div>
	</div>
</div>
