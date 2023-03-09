<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo $page_title; ?></h1>
    <?php if(in_array('createUser', $user_permission)): ?>
        <a href="<?php echo base_url('users/create'); ?>" class="btn btn-primary mb-2">
            <i class="fas fa-plus"></i> Add User
        </a>
    <?php endif; ?>

    <?php if($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo $this->session->flashdata('success'); ?>
    </div>
    <?php elseif($this->session->flashdata('error')): ?>
    <div class="alert alert-error alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo $this->session->flashdata('error'); ?>
    </div>
    <?php endif; ?>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><?php echo $page_title; ?></h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Group</th>
                            <?php if(in_array('updateUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                                <th>Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($user_data as $k => $v){ ?>
                        <tr>
                            <td><?php echo $v['user_info']['username']; ?></td>
                            <td><?php echo $v['user_info']['email']; ?></td>
                            <td><?php echo $v['user_info']['firstname'] .' '. $v['user_info']['lastname']; ?></td>
                            <td><?php echo $v['user_info']['phone']; ?></td>
                            <td><?php echo $v['user_group']['group_name']; ?></td>
                            <?php if(in_array('updateUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                            <td>
                                <?php if(in_array('updateUser', $user_permission)): ?>
                                <a 
                                    href="<?php echo base_url('users/edit/'.$v['user_info']['id']); ?>"
                                    title="edit"
                                    class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <?php endif; ?>
                                <?php if(in_array('deleteUser', $user_permission)): ?>
                                <a 
                                    href="#" onclick="deleteUsers('<?php echo $v['user_info']['id']; ?>')"
                                    title="delete"
                                    class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <?php endif; ?>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->