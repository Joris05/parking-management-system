<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Company Info</h1>

    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="" method="post">
                    <label>Company Name</label>
                    <div class="form-group">
                        <input
                            type="text"
                            name="company_name"
                            autocomplete="off"
                            class="form-control form-control-user"
                            required="true"
                            autofocus="true"
                            value="<?php echo $company_data['name']; ?>"
                            placeholder="Company Name">
                    </div>
                    <label>Address</label>
                    <div class="form-group">
                        <input
                            type="text"
                            name="address"
                            autocomplete="off"
                            class="form-control form-control-user"
                            required="true"
                            autofocus="true"
                            value="<?php echo $company_data['address']; ?>"
                            placeholder="Address">
                    </div>
                    <label>Message</label>
                    <div class="form-group">
                        <textarea class="form-control" name="message" rows="3"><?php echo nl2br($company_data['message']); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </form>
                <?php if(validation_errors()): ?>
                    <div class="alert alert-danger alert-dismissible mt-2" role="alert">
                    <?php echo validation_errors('<li>', '</li>'); ?>
                    </div>
                <?php endif; ?>
                <?php if($this->session->flashdata('success')): ?>
                <div class="alert alert-success alert-dismissible mt-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php elseif($this->session->flashdata('error')): ?>
                <div class="alert alert-error alert-dismissible mt-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?php echo $this->session->flashdata('error'); ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>