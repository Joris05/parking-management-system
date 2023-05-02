<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo $page_title; ?></h1>

    <div class="col-md-5">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="<?php echo base_url('admin/users/create'); ?>" method="post">
                    <label>Groups</label>
                    <div class="form-group">
                        <select class="form-control" id="groups" name="groups" required="true">
                            <option value="">Select Groups</option>
                            <?php foreach ($group_data as $k => $v): ?>
                            <option value="<?php echo $v['id'] ?>"><?php echo $v['group_name'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <label>Username</label>
                    <div class="form-group">
                        <input
                            type="text"
                            name="username"
                            autocomplete="off"
                            class="form-control form-control-user"
                            required="true"
                            autofocus="true"
                            placeholder="Username">
                    </div>
                    <label>Email</label>
                    <div class="form-group">
                        <input
                            type="email"
                            name="email"
                            autocomplete="off"
                            class="form-control form-control-user"
                            required="true"
                            autofocus="true"
                            placeholder="Email">
                    </div>
                    <label>Password</label>
                    <div class="form-group">
                        <input
                            type="password"
                            name="password"
                            autocomplete="off"
                            class="form-control form-control-user"
                            required="true"
                            autofocus="true"
                            placeholder="Password">
                    </div>
                    <label>Confirm Password</label>
                    <div class="form-group">
                        <input
                            type="password"
                            name="cpassword"
                            autocomplete="off"
                            class="form-control form-control-user"
                            required="true"
                            autofocus="true"
                            placeholder="Confirm Password">
                    </div>
                    <label>First name</label>
                    <div class="form-group">
                        <input
                            type="text"
                            name="fname"
                            autocomplete="off"
                            class="form-control form-control-user"
                            required="true"
                            autofocus="true"
                            placeholder="First name">
                    </div>
                    <label>Last name</label>
                    <div class="form-group">
                        <input
                            type="text"
                            name="lname"
                            autocomplete="off"
                            class="form-control form-control-user"
                            required="true"
                            placeholder="Last name">
                    </div>
                    <label>Phone</label>
                    <div class="form-group">
                        <input
                            type="text"
                            name="phone"
                            autocomplete="off"
                            class="form-control form-control-user"
                            placeholder="Phone">
                    </div>
                    <label>Gender</label>
                    <div class="form-group">
                        <select
                            name="gender"
                            required="true"
                            class="form-control">
                            <option value="1">Male</option>
                            <option value="2">Female</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                    <a href="<?php echo base_url('admin/users'); ?>" class="btn btn-warning">
                        Back
                    </a>
                </form>
                <?php if(validation_errors()): ?>
                    <div class="alert alert-danger alert-dismissible mt-2" role="alert">
                    <?php echo validation_errors('<li>', '</li>'); ?>
                    </div>
                <?php endif; ?>
                <?php if($this->session->flashdata('error')): ?>
                <div class="alert alert-danger alert-dismissible mt-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>