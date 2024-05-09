<div class="container mt-5 col-sm-4">
    <div class="card">
        <div class="card-header text-center" style="background-color:#F0F8FF">
            Edit Application Type
        </div>
        
    <div class="card-body">
        <form action="" method="post" autocomplete="off">

        <div class="form-group">
                <label for="app_type">Application Type</label>
                <input type="text" class="form-control" id="app_type" name="app_type" value="<?php echo $get_app_type_data->app_type; ?>" required="">
        </div>

        <div class="form-group">
                <label for="dept_no">Department</label>
                <select class="form-control" id="dept_no" name="dept_no">
                    <?php foreach($departments as $department)
                      { ?>
                        <option value="<?php echo $department->dept_no; ?>" <?php echo ($department->dept_no==$get_app_type_data->dept_no) ? "selected" : ""; ?>><?php echo $department->dept_no."-".$department->dept_name; ?></option>
                    <?php } ?>
                </select>
        </div>

        <div class="form-group">
                <label for="no_days">No Of Days</label>
                <input type="number" class="form-control" id="no_days" name="no_days" value="<?php echo $get_app_type_data->no_days; ?>" required="">
        </div>

        <input type="submit" name="submit-edit-application-type-form" class="btn btn-success float-right">
        </form>
    </div>
    </div>
</div>