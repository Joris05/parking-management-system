<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo $page_title; ?></h1>
    <a href="<?php echo base_url('parking/create'); ?>" class="btn btn-primary mb-2">
        <i class="fas fa-plus"></i> Add Parking
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
                            <th>Parking Code</th>
                            <th>Check-In</th>
                            <th>Check-Out</th>
                            <th>Vehicle Type</th>
                            <th>Rate Name</th>
                            <th>Rate</th>
                            <th>Rate Type</th>
                            <th>Slot</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($parking_data as $k => $v) {
                        ?>
                        <tr>
                            <td><?php echo $v['parking']['parking_code']; ?></td>
                            <td><?php
                            // date_default_timezone_set("Asia/Kathmandu");
                            $date=date('Y-m-d', $v['parking']['in_time']);
                            $time=date('h:i a', $v['parking']['in_time']);

                            echo $date . '<br />' . $time;
                            // echo date_format($date,"Y-m-d"); echo "<br />"; echo date_format($date,"H:i:s"); ?>
                                
                            </td>
                            <td><?php 

                            if($v['parking']['out_time'] == '') {
                                echo "-";
                            }
                            else {
                                $date= date('Y-m-d', $v['parking']['out_time']);
                                $time= date('h:i a', $v['parking']['out_time']);
        
                                echo $date . '<br />' . $time;
                                // echo date_format($date,"Y-m-d"); echo "<br />"; echo date_format($date,"H:i:s");
                            }

                            ?></td>
                            <td><?php echo $v['category']['name']; ?></td>
                            <td><?php echo $v['rate']['rate_name']; ?></td>
                            <td><?php 
                            echo '₱ ' . $v['rate']['rate']; ?></td>
                            <td><?php echo $v['slot']['slot_name']; ?></td>
                            <td><?php echo $v['parking']['total_time'] . ' hour'; echo ($v['parking']['total_time'] > 1)?'s':'';?></td>
                            <td><?php echo '₱ ' . ($v['parking']['earned_amount'])?:'-'; ?></td>
                            <td><?php echo ($v['parking']['paid_status'] == 1) ? '<label class="label label-success">Paid</label>' : '<label class="label label-warning">Not Paid</label>'; ?></td>
                            
                            <td>
                            <a href="<?php echo base_url('parking/edit/'.$v['parking']['id']) ?>" class="btn btn-default"><i class="fa fa-pencil"></i></a>
                
                            <a href="<?php echo base_url('parking/delete/'.$v['parking']['id']) ?>" class="btn btn-default"><i class="fa fa-trash"></i></a>
                            <a onclick="printParking(<?php echo "'". base_url('parking/printInvoice/'.$v['parking']['id']) . "'"; ?>)" class="btn btn-default"><i class="fa fa-print"></i></a>
                            </td>
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