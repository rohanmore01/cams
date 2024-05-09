<div class="container mt-5 col-sm-3">
    <div class="card">
        <div class="card-header text-center" style="background-color:#F0F8FF">
            Print General Information CAMS
        </div>
        
    <div class="card-body">
        <form action="GeneralInformationDepartmentWisePrint" method="post" autocomplete="off" target="_blank">
        <div class="form-group">
                <label for="department">Select Department to View Report</label>
                <select class="form-control" id="department" name="department">
                    <?php foreach($departments as $department)
                      { ?>
                        <option value="<?php echo $department->dept_no; ?>"><?php echo $department->dept_name; ?></option>
                    <?php } ?>
                </select>
        </div>
        <input type="submit" name="submit-general-information-form" class="btn btn-success">
        </form>
    </div>
    </div>
</div>