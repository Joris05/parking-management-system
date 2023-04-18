<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800"><?php echo $page_title; ?></h1>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="" method="post">
                                <label>Slot</label>
                                <div class="form-group">
                                    <select
                                        name="parking_slot"
                                        required="true"
                                        class="form-control">
                                        <option value="">Select Slot</option>
                                        <?php foreach ($slot_data as $k => $v): ?>
                                            <option
                                                <?php if($save_parking_data['slot_id'] == $v['id']) {
                                                    echo "selected";
                                                } ?>
                                                value="<?php echo $v['id'] ?>"><?php echo $v['slot_name']; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                                <label>Category</label>
                                <div class="form-group">
                                    <select
                                        name="vehicle_cat"
                                        required="true"
                                        id="vehicle_cat"
                                        class="form-control">
                                        <option value="">Select</option>
                                            <?php foreach ($vehicle_cat as $k => $v): ?>
                                            <option
                                                <?php if($save_parking_data['vehicle_cat_id'] == $v['id']) {
                                                    echo "selected";
                                                } ?>
                                                value="<?php echo $v['id'] ?>"><?php echo $v['name'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </select>
                                </div>
                                <label>Rate</label>
                                <div class="form-group">
                                    <select
                                        name="vehicle_rate"
                                        required="true"
                                        id="vehicle_rate"
                                        class="form-control">
                                        <?php if($save_parking_data['rate_id']) { ?>
                                            <?php foreach ($get_used_rate_data as $rate_v): ?>
                                                <option value="<?php echo $rate_v['id']; ?>" <?php if($rate_v['id'] == $save_parking_data['rate_id']) { echo "selected"; } ?>><?php echo $rate_v['rate_name'] ?></option>
                                            <?php endforeach ?>
                                        <?php } else { ?>
                                            <option value="">Select Rate</option>
                                        <?php } ?>
                                       
                                    </select>
                                </div>
                                <label>Customer Name</label>
                                <div class="form-group">
                                    <input
                                      type="text"
                                      name="customer_name"
                                      class="form-control"
                                      value="<?= $save_parking_data['customer']; ?>"
                                      autocomplete="off">
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                                <a href="<?php echo base_url('parking'); ?>" class="btn btn-warning">
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

                <div class="col-md-4">
                    <h1 class="h3 mb-2 text-gray-800">Update Payment</h1>
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="<?php echo base_url('parking/updatepayment'); ?>" method="post">
                                <?php $date = strtotime('now'); ?>
                                <div class="form-group">
                                    <label for="">Check-out date : <?php echo date('Y-m-d', $date); ?></label> <br />
                                    <label for="">Check-out time : <?php echo date('h:i a', $date); ?></label>
                                </div>
                                <label>Payment status</label>
                                <div class="form-group">
                                    <select class="form-control" name="payment_status" id="payment_status">
                                    <option value="">Select</option>
                                    <option value="1">Paid</option>
                                    <option value="0">Unpaid</option>
                                    </select>
                                </div>             
                                <input type="hidden" name="parking_id" id="parking_id" value="<?php echo $save_parking_data['id'];  ?>">       
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                                <a href="<?php echo base_url('parking'); ?>" class="btn btn-warning">
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
        </div>
    </div>
</div>