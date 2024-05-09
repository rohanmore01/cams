<div class="container mt-5 col-sm-4">
    <div class="card">
        <div class="card-header text-center" style="background-color:#F0F8FF">
            Edit User
        </div>
        
    <div class="card-body">
        <form action="" method="post" autocomplete="off">
        <div class="form-group">
                <label for="email">Enter Email</label>
                <input type="email" name="email" class="form-control" id="email" value="<?php echo $get_user_data->email; ?>" required="">
        </div>
        <div class="form-group">
                <label for="password">Enter Password</label>
                <input type="password" name="password" class="form-control" id="password">
        </div>
        <div class="form-group">
                <label for="c_password">Enter Confirm Password</label>
                <input type="password" name="c_password" class="form-control" id="c_password">
        </div>
        <div class="form-group">
                <label for="user_type">User Type</label>
                <select class="form-control" id="user_type" name="user_type">
                    <option value="normal_user" <?php echo ($get_user_data->user_type=="normal_user") ? "selected" : ""; ?>>Normal User</option>
                    <option value="admin" <?php echo ($get_user_data->user_type=="admin") ? "selected" : ""; ?>>Admin</option>
                </select>
        </div>
        <div class="form-group">
                <label for="district">District</label>
                <select class="form-control" id="district" name="district">
                    <option value="dnh" <?php echo ($get_user_data->district == "dnh") ? "selected" : ""; ?>>Dadra & Nagar Haveli</option>
                    <option value="daman" <?php echo ($get_user_data->district=="daman") ? "selected" : ""; ?>>Daman</option>
                    <option value="diu" <?php echo ($get_user_data->district=="diu") ? "selected" : ""; ?>>Diu</option>
                </select>
        </div>
        <input type="submit" name="submit-edit-user-form" class="btn btn-success">
        </form>
    </div>
    </div>
</div>