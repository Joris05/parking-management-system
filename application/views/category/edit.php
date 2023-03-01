<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo $page_title; ?></h1>

    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="" method="post">
                    <label>Category Name</label>
                    <div class="form-group">
                        <input
                            type="text"
                            name="category_name"
                            autocomplete="off"
                            class="form-control form-control-user"
                            required="true"
                            autofocus="true"
                            value="<?php echo $category_data['name']; ?>"
                            placeholder="Category Name">
                    </div>
                    <label>Status</label>
                    <div class="form-group">
                        <select
                            name="category_active"
                            required="true"
                            class="form-control">
                            <option value="1" <?php echo ($category_data['active'] == 1) ? ' selected' :''  ?>>Active</option>
                            <option value="2" <?php echo ($category_data['active'] == 2) ? ' selected' :''  ?>>Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                    <a href="<?php echo base_url('category'); ?>" class="btn btn-warning">
                        Back
                    </a>
                </form>
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