<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo $page_title; ?></h1>

    <div class="col-md-4">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="<?php echo base_url('slots/create'); ?>" method="post">
                    <label>Category</label>
                    <div class="form-group">
                        <select
                            name="vehicle_cat"
                            required="true"
                            id="vehicle_cat"
                            class="form-control">
                            <option value="">Select</option>
                                <?php foreach ($vehicle_cat as $k => $v): ?>
                                <option value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </select>
                    </div>
                    <label>Slot Name</label>
                    <div class="form-group">
                        <input
                            type="text"
                            name="slot_name"
                            autocomplete="off"
                            class="form-control form-control-user"
                            required="true"
                            autofocus="true"
                            placeholder="Slot Name">
                    </div>
                    <label>Status</label>
                    <div class="form-group">
                        <select
                            name="status"
                            required="true"
                            class="form-control">
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                    <a href="<?php echo base_url('slots'); ?>" class="btn btn-warning">
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