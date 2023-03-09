<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo $page_title; ?></h1>

    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Select Year</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <select
                                name="selected_year"
                                id="selected_year"
                                onchange="getTotalEarningPerYear(this.value)"
                                class="form-control">
                                <option value="">Select Year</option>
                                <?php foreach ($report_years as $key => $value): ?>
                                    <option
                                        value="<?php echo $value ?>"
                                        <?php echo ($year == $value) ? 'selected' : ''; ?>>
                                        <?php echo $value; ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <button
                            onclick="printContent('data-print')"
                            class="btn btn-primary btn-sm float-right"
                            title="print">
                            <i class="fas fa-fw fa-print"></i>
                        </button>
                        <h6 class="m-0 font-weight-bold text-primary">Results</h6>
                    </div>
                    <div class="card-body" id="data-print">
                        <h3 class="box-title">Total Parking - Report Data Year <?php echo $year; ?></h3>
                        <table id="datatables" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Month</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php foreach ($parking_data as $k => $v): ?>
                                    <tr>
                                        <td>
                                            <?php echo date('F', strtotime($k)); ?>
                                        </td>
                                        <td><?php 
                                        
                                            echo '₱ ' . number_format($v, 2, '.', '');
                                        
                                        ?></td>
                                    </tr>
                                <?php endforeach ?>
                            
                            </tbody>
                            <tbody>
                                <tr>
                                    <th>Total Amount</th>
                                    <th>
                                        <?php echo '₱ ' . number_format(array_sum($parking_data), 2, '.', ''); ?>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>