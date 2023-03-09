<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo $page_title; ?></h1>

    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="<?php echo base_url('category/create'); ?>" method="post">
                    <label>Category Name</label>
                    <div class="form-group">
                        <input
                            type="text"
                            name="category_name"
                            autocomplete="off"
                            class="form-control form-control-user"
                            required="true"
                            autofocus="true"
                            placeholder="Category Name">
                    </div>
                    <label>Status</label>
                    <div class="form-group">
                        <select
                            name="category_active"
                            required="true"
                            class="form-control">
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                    <a href="<?php echo base_url('category'); ?>" class="btn btn-warning">
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