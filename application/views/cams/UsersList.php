<div class="main-panel mt-3">
    <div class="content-wrapper">
    <div class="col-lg-12 grid-margin stretch-card mb-5">
    <div class="card">
        <div class="card-body">    
        <h5 class="card-title text-center">Users List</h5>  
        <hr style="border-top: 1px solid black;">
        <div class="table-responsive">
        <table class="table table-bordered table-hover nowrap data-table">
            <thead>
            <tr>
                <th>Email</th>
                <th>User Type</th>
                <?php if($this->session->userdata('user_type') == "admin")
                {
                ?>
                <th>Action</th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
                <?php foreach($users_list as $user)
                { 
                ?>
                    <tr>
                        <td><?php echo $user->email; ?></td>
                        <td><?php echo $user->user_type; ?></td>

                        <?php if($this->session->userdata('user_type') == "admin")
                        {
                        ?>
                        <td>
                            <a class="badge badge-success" href='<?php echo base_url('EditUser/'.$user->id); ?>' title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
                            </a>
                    
                            <a class="badge badge-danger" onclick="return confirm(' Are You Sure Want To Delete ?');" href='<?php echo base_url('DeleteUser/'.$user->id); ?>' title="Delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                    <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                </svg>
                            </a>
                        </td>
                        <?php 
                        } 
                        ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        </div>
        </div>
    </div>
    </div>
    </div>
</div>