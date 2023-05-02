<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo $page_title; ?></h1>
    <?php if(in_array('createParking', $user_permission)): ?>
        <a href="<?php echo base_url('admin/parking/create'); ?>" class="btn btn-primary mb-2">
            <i class="fas fa-plus"></i> Add Parking
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
                <table class="table table-bordered table-sm" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>P-Code</th>
                            <th>Check-In</th>
                            <th>Check-Out</th>
                            <th>Customer Name</th>
                            <th>Vehicle Type</th>
                            <th>Rate</th>
                            <th>Slot</th>
                            <th style="width:90px">Rate Type</th>
                            <th>Status</th>
                            <?php if(in_array('updateParking', $user_permission) || in_array('deleteParking', $user_permission) || in_array('viewParking', $user_permission)): ?>
                                <th>Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($parking_data as $k => $v) {
                        ?>
                        <tr>
                            <td><?php echo $v['parking']['parking_code']; ?></td>
                            <td>
                                <?php
                                
                                $date=date('Y-m-d', $v['parking']['in_time']);
                                $time=date('h:i a', $v['parking']['in_time']);

                                echo $date . '<br />' . $time;
                            ?>
                            </td>
                            <td>
                                <?php
                                if($v['parking']['out_time'] == '') {
                                    echo "-";
                                }
                                else {
                                    $date= date('Y-m-d', $v['parking']['out_time']);
                                    $time= date('h:i a', $v['parking']['out_time']);
            
                                    echo $date . '<br />' . $time;
                                }
                                ?>
                            </td>
                            <td><?php echo $v['parking']['customer']; ?></td>
                            <td><?php echo $v['category']['name']; ?></td>
                            <td><?php 
                            echo '₱ ' . number_format((float)$v['rate']['rate'], 2, '.', ''); ?></td>
                            <td><?php echo $v['slot']['slot_name']; ?></td>
                            <td>Fixed</td>
                            <td>
                                <?php if($v['parking']['vehicle_status'] == 0){ 
                                    echo '<label class="badge badge-success">Unparked</label>';
                                }
                                else {
                                    echo '<label class="badge badge-warning">Parked</label>'; 
                                }
                                ?> 
                            </td>
                            <?php if(in_array('updateParking', $user_permission) || in_array('deleteParking', $user_permission) || in_array('viewParking', $user_permission)): ?>
                            <td>
                                <?php if(in_array('updateParking', $user_permission) && $v['parking']['vehicle_status'] == 1): ?>
                                    <a
                                    onclick="unparked(<?php echo $v['parking']['id'] ?>)"
                                    class="btn btn-primary btn-sm">
                                    <i class="fa fa-arrow-right"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if(in_array('deleteParking', $user_permission)): ?>
                                    <a
                                    href="#"
                                    onclick="deleteParking('<?php echo $v['parking']['id'] ?>','<?php echo $v['slot']['id'] ?>')"
                                    class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                <?php endif; ?>
                                <?php if(in_array('viewParking', $user_permission)): ?>
                                    <a
                                    onclick="printParking('<?php echo base_url('admin/parking/print_invoice/'.$v['parking']['id']); ?>')"
                                    class="btn btn-success btn-sm">
                                    <i class="fa fa-print"></i>
                                    </a>
                                <?php endif; ?>
                            </td>
                            <?php endif; ?>
                        </tr>
                        <?php
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->