 <!-- Begin Page Content -->
 <div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <div class="row">
        <!-- Content Column -->
        <div class="col-lg-4 mb-4">
            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Available Parking Slots</h6>
                </div>
                <div class="card-body" style="min-height:308px">
                    <div class="list-group list-group-flush">
                        <?php 
                             foreach ($vehicle_datas as $k => $v) {
                        ?>
                        <div class="list-group-item d-flex align-items-center justify-content-between small px-0 py-2">
                            <div class="me-3">
                                <i class="fas fa-circle fa-sm me-1 text-green"></i>
                                <?php echo $v['vehicle']['name']; ?>
                            </div>
                            <div class="fw-500 text-dark">
                            <?php echo $v['slots']['total_available']; ?>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 mb-4">
            <div class="row">

                <!-- Total Parking Slots Card -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Parking Slots</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $total_slots; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-parking fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Users Card -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Total Users</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $total_users; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pending Requests Card Example -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Total Parking</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $total_parking; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-signal fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Total Monthly Parking Earnings</h6>
                    <select name="selected_year" onchange="getParkingData(this.value)">
                    <?php foreach ($report_years as $key => $value): ?>
                        <option value="<?php echo $value ?>" <?php if($value == $selected_year) { echo "selected"; } ?>><?php echo $value; ?></option>
                    <?php endforeach ?>
                    </select>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pie Chart -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Most Parked Vehicle</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-5 text-center small">
                        <!-- <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Vehicle
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Motorcycle
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-info"></i> Tricab
                        </span> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->