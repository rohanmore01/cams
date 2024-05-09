<div class="container mt-4 col-sm-4">
    <div class="card">
        <div class="card-header text-center" style="background-color:#F0F8FF">
            Create User
        </div>
        
    <div class="card-body">
        <form action="" method="post" autocomplete="off" name="myForm">
        <div class="form-group">
                <label for="email">Enter Email</label>
                <input type="email" name="email" class="form-control" id="email" required="">
        </div>
        <div class="form-group">
                <label for="password">Enter Password</label>
                <input type="password" name="password" class="form-control" id="password" required="">
        </div>
        <div class="form-group">
                <label for="c_password">Enter Confirm Password</label>
                <input type="password" name="c_password" class="form-control" id="c_password" required="">
        </div>
        <div class="form-group">
                <label for="user_type">User Type</label>
                <select class="form-control" id="user_type" name="user_type">
                    <option value="normal_user">Normal User</option>
                    <option value="admin">Admin</option>
                </select>
        </div>
        <div class="form-group">
                <label for="district">District</label>
                <select class="form-control" id="district" name="district">
                    <option value="dnh">Dadra & Nagar Haveli</option>
                    <option value="daman">Daman</option>
                    <option value="diu">Diu</option>
                </select>
        </div>
        <input type="submit" name="submit-create-user-form" class="btn btn-success">
        </form>
    </div>
    </div>
</div>