<div class="container my-4 col-lg-10 col-sm-10">
    <div class="card">
        <div class="card-header text-center" style="background-color:#F0F8FF">
           Add Application Type
        </div>
    <div class="card-body">
        <form action="" method="post" autocomplete="off">

        <div class="row">
            <label for="app_code" class="col-sm-2 control-label">Application Code</label>
            <div class="col-sm-4">
                 <div class="form-group">
                 <input type="text" class="form-control" id="app_code" name="app_code" value="<?php echo $last_app_code->app_code+1; ?>" required="">
                </div>
            </div>
            
            <label for="app_type" class="col-sm-2 control-label">Application Type</label>
            <div class="col-sm-4">
                <div class="form-group">
                 <input type="text" class="form-control" id="app_type" name="app_type" required="">
                </div>
            </div>
        </div> 

        <div class="row">
            <label for="dept_no" class="col-sm-2 control-label">Department</label>
            <div class="col-sm-4">
                 <div class="form-group">
                 <select class="form-control" id="dept_no" name="dept_no">
                    <?php foreach($departments as $department)
                      { ?>
                        <option value="<?php echo $department->dept_no; ?>"><?php echo $department->dept_no."-".$department->dept_name; ?></option>
                    <?php } ?>
                </select>
                </div>
            </div>
            
            <label for="no_days" class="col-sm-2 control-label">No Of Days</label>
            <div class="col-sm-4">
                <div class="form-group">
                    <input type="number" class="form-control" id="no_days" name="no_days" required="">
                </div>
            </div>
        </div> 
        <input type="submit" name="submit-add-application-type-form" class="btn btn-success float-right">
        </form>
    </div>
    </div>
</div>