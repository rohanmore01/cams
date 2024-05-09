<div class="container my-6 mt-3 col-lg-10 col-sm-10">
    <div class="card">
        <div class="card-header text-center" style="background-color:#F0F8FF">
            Edit CAMS Data Entry Screen<span class="float-right"><?php echo date('d-m-Y'); ?></span>
        </div>
    <div class="card-body">
        <form action="" method="post" autocomplete="off">

        <div class="row">
            <label for="ack_number" class="col-sm-2 control-label">Ack Number</label>
            <div class="col-sm-4">
                 <div class="form-group">
                 <input type="text" class="form-control" id="ack_number" name="ack_number" value="<?php echo $camDataEntry->ack_no; ?>" required="" readonly>
                </div>
            </div>
            
            <label for="name" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-4">
                <div class="form-group">
                 <input type="text" class="form-control" id="name" name="name" value="<?php echo $camDataEntry->name; ?>" required="">
                </div>
            </div>
        </div> 

        <div class="row">
            <label for="department" class="col-sm-2 control-label">Department</label>
            <div class="col-sm-4">
                 <div class="form-group">
                 <select class="form-control" id="department" name="department">
                    <?php foreach($departments as $department)
                      { ?>
                        <option value="<?php echo $department->dept_no; ?>" <?php echo ($department->dept_no==$camDataEntry->dept_no) ? "selected" : ""; ?>><?php echo $department->dept_no."-".$department->dept_name; ?></option>
                    <?php } ?>
                </select>
                </div>
            </div>
            
            <label for="type_of_application" class="col-sm-2 control-label">Type Of Application</label>
            <div class="col-sm-4">
                <div class="form-group">
                 <select class="form-control" id="type_of_application" name="type_of_application">
                    <?php foreach($app_types as $app_type)
                      { ?>
                        <option value="<?php echo $app_type->app_code; ?>" <?php echo ($app_type->app_code==$camDataEntry->app_code) ? "selected" : ""; ?>><?php echo $app_type->app_code."-".$app_type->app_type; ?></option>
                    <?php } ?>
                </select>
                </div>
            </div>
        </div> 
        
        <div class="row">
            <label for="date" class="col-sm-2 control-label">Date</label>
            <div class="col-sm-4">
                 <div class="form-group">
                 <input type="date" class="form-control" id="date" name="date" value="<?php echo $camDataEntry->date; ?>" required="">
                </div>
            </div>

            <label for="due_date" class="col-sm-2 control-label">Due Date</label>
            <div class="col-sm-4">
                 <div class="form-group">
                 <input type="date" class="form-control" id="due_date" name="due_date" value="<?php echo $camDataEntry->due_date; ?>" required="">
                </div>
            </div>
        </div>

        <div class="row">
            <label for="query_date" class="col-sm-2 control-label">Query Date</label>
            <div class="col-sm-4">
                 <div class="form-group">
                 <input type="date" class="form-control" id="query_date" name="query_date" value="<?php echo $camDataEntry->query_date; ?>" >
                </div>
            </div>

            <label for="grant_date" class="col-sm-2 control-label">Grant Date</label>
            <div class="col-sm-4">
                 <div class="form-group">
                 <input type="date" class="form-control" id="grant_date" name="grant_date" value="<?php echo $camDataEntry->grant_date; ?>" >
                </div>
            </div>
        </div>

        <div class="row">
        <label for="rejected_date" class="col-sm-2 control-label">Rejected Date</label>
            <div class="col-sm-4">
                 <div class="form-group">
                 <input type="date" class="form-control" id="rejected_date" name="rejected_date" value="<?php echo $camDataEntry->rejected_date; ?>" >
                </div>
            </div>

            <label for="remark" class="col-sm-2 control-label">Remark</label>
            <div class="col-sm-4">
                 <div class="form-group">
                 <input type="text" class="form-control" id="remark" name="remark" value="<?php echo $camDataEntry->remark; ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <label for="address" class="col-sm-2 control-label">Address</label>
            <div class="col-sm-10">
                 <div class="form-group">
                  <textarea class="form-control" id="address" name="address" rows="3"><?php echo $camDataEntry->address; ?></textarea>
                </div>
            </div>
        </div>
        
        <input type="submit" name="submit-cam-data-edit-form" class="btn btn-success float-right">
        </form>
    </div>
    </div>
</div>