<div class="container mt-5 col-sm-4">
    <div class="card">
        <div class="card-header text-center" style="background-color:#F0F8FF">
            Edit Department
        </div>
        
    <div class="card-body">
        <form action="" method="post" autocomplete="off">
        <div class="form-group">
                <label for="dept_name">Dept Name</label>
                <input type="text" name="dept_name" class="form-control" id="dept_name" value="<?php echo $get_department_data->dept_name; ?>" required="">
        </div>
        <div class="form-group">
                <label for="ho_desig">Ho Desig</label>
                <input type="text" name="ho_desig" class="form-control" id="ho_desig" value="<?php echo $get_department_data->ho_desig; ?>" required="">
        </div>
        <input type="submit" name="submit-department-edit-form" class="btn btn-success">
        </form>
    </div>
    </div>
</div>