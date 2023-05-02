<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo $page_title; ?></h1>

    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="" method="post">
                    <label>Rate Name</label>
                    <div class="form-group">
                        <input
                            type="text"
                            name="rate_name"
                            autocomplete="off"
                            class="form-control form-control-user"
                            required="true"
                            autofocus="true"
                            value="<?php echo $rate_data['rate_name']; ?>"
                            placeholder="Rate Name">
                    </div>
                    <label>Category</label>
                    <div class="form-group">
                        <select
                            name="category_name"
                            required="true"
                            class="form-control">
                            <option value="">Select Category</option>
                            <?php foreach ($category_data as $k => $v) { ?>
                            <option
                                value="<?php echo $v['id'] ?>"
                                <?php echo ($rate_data['vehicle_cat_id'] == $v['id']) ? 'selected' : ''; ?>
                                >
                                <?php echo $v['name'] ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <label>Type</label>
                    <div class="form-group">
                        <select
                            name="type"
                            required="true"
                            class="form-control">
                            <option value="">Select Rate</option>
                            <option value="1" selected>Fixed</option>
                        </select>
                    </div>
                    <label>Rate</label>
                    <div class="form-group">
                        <input
                            type="text"
                            name="rate"
                            autocomplete="off"
                            class="form-control form-control-user"
                            required="true"
                            autofocus="true"
                            value="<?php echo $rate_data['rate']; ?>"
                            placeholder="Rate">
                    </div>
                    <label>Active</label>
                    <div class="form-group">
                        <select
                            name="rate_status"
                            required="true"
                            class="form-control">
                            <option value="1" <?php echo ($rate_data['active'] == 1) ? 'selected' : ''; ?>>Active</option>
                            <option value="2" <?php echo ($rate_data['active'] == 2) ? 'selected' : ''; ?>>Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                    <a href="<?php echo base_url('admin/rates'); ?>" class="btn btn-warning">
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