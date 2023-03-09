<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo $page_title; ?></h1>

    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-body">
                <table class="table table-bordered table-condensed table-hovered">
                    <tr>
                        <th>Username</th>
                        <td><?php echo $user_data['username']; ?></td>
                    </tr>
                    <tr>
                    <th>Email</th>
                        <td><?php echo $user_data['email']; ?></td>
                    </tr>
                    <tr>
                        <th>First Name</th>
                        <td><?php echo $user_data['firstname']; ?></td>
                    </tr>
                    <tr>
                        <th>Last Name</th>
                        <td><?php echo $user_data['lastname']; ?></td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td><?php echo ($user_data['gender'] == 1) ? 'Male' : 'Gender'; ?></td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td><?php echo $user_data['phone']; ?></td>
                    </tr>
                    <tr>
                        <th>Group</th>
                        <td><span class="alert alert-success"><?php echo $user_group['group_name']; ?></span></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>