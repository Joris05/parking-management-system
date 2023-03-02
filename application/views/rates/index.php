<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo $page_title; ?></h1>
    <a href="<?php echo base_url('rates/create'); ?>" class="btn btn-primary mb-2">
        <i class="fas fa-plus"></i> Add Rate
    </a>

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
                            <th>Rate Name</th>
                            <th>Type</th>
                            <th>Rate</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rates_data as $k => $v) { ?>
                            <tr>
                                <td><?php echo $v['rate_info']['rate_name']; ?></td>
                                <td><?php echo ($v['rate_info']['type'] == 1) ? 'Fixed': 'Hourly'; ?></td>
                                <td><?php echo '₱ '. $v['rate_info']['rate']; ?></td>
                                <td><?php echo $v['cat_info']['name']; ?></td>
                                <td>
                                    <?php if($v['rate_info']['active'] == 1) { ?>
                                    <span class="badge badge-success">Active</span>
                                    <?php } 
                                    else { ?>
                                    <span class="badge badge-warning">Inactive</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <a
                                      href="<?php echo base_url('rates/edit/'.$v['rate_info']['id']) ?>"
                                      class="btn btn-primary btn-sm"><i
                                      class="fa fa-edit"></i></a>
                                    <a
                                      onclick="deleteRate('<?php echo $v['rate_info']['id']; ?>')"
                                      href="#"
                                      class="btn btn-danger btn-sm"><i
                                      class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->