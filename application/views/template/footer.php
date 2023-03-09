                </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Parking Management System <?php echo date('Y'); ?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="<?php echo base_url('dashboard/logout'); ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        var report_data = <?php 
            if(@$parking_data){
                echo '[' . implode(',', $parking_data) . ']'; 
            }else{
                echo '[]';
            }
            ?>;
        var vehicle_list = <?php
            if(@$vehicle_cat){
                echo '[' . implode(',', $vehicle_cat) . ']'; 
            }else{
                echo '[]';
            }
        ?>;
        var total_per_vehicle = <?php 
            if(@$total_per_vehicle){
                echo '[' . implode(',', $total_per_vehicle) . ']';
            }else{
                echo '[]';
            }
        ?>;
    </script>
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('assets/js/sb-admin-2.min.js'); ?>"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url('assets/vendor/chart.js/Chart.min.js'); ?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url('assets/js/demo/chart-area-demo.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/demo/chart-pie-demo.js'); ?>"></script>

    <!-- Page level plugins -->
    <script src="<?php echo base_url('assets/vendor/datatables/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.js'); ?>"></script>

    <!-- Page level custom scripts -->
    <script src="<?php echo base_url('assets/js/demo/datatables-demo.js'); ?>"></script>
    
    <script>
        function deleteCategory(id){
            if(!confirm('Are you sure you want to remove this record?')) return false;
            window.location = '<?php echo base_url('category/delete/'); ?>' + id;
        }
        function deleteRate(id){
            if(!confirm('Are you sure you want to remove this record?')) return false;
            window.location = '<?php echo base_url('rates/delete/'); ?>' + id;
        }
        function deleteSlots(id){
            if(!confirm('Are you sure you want to remove this record?')) return false;
            window.location = '<?php echo base_url('slots/delete/'); ?>' + id;
        }
        function deleteParking(id,slotid){
            if(!confirm('Are you sure you want to remove this record?')) return false;
            window.location = '<?php echo base_url('parking/delete/'); ?>' + id + '/' + slotid;
        }
        function deleteGroups(id){
            if(!confirm('Are you sure you want to remove this record?')) return false;
            window.location = '<?php echo base_url('groups/delete/'); ?>' + id;
        }
        function deleteUsers(id){
            if(!confirm('Are you sure you want to remove this record?')) return false;
            window.location = '<?php echo base_url('users/delete/'); ?>' + id;
        }
        function printParking(parking_url){
            $.ajax({
                url: parking_url,
                type: 'post',
                success:function(response) {

                var mywindow = window.open('', 'PRINT', 'height=400,width=600');

                mywindow.document.write(response);


                mywindow.document.close(); // necessary for IE >= 10
                mywindow.focus(); // necessary for IE >= 10*/

                mywindow.print();
                mywindow.close(); 

                }
            });
        }

        function getParkingData(yr){
            window.location = '<?php echo base_url('dashboard/index/');?>' + yr;
        }

        $("#vehicle_cat").on('change', function() {
            var value = $(this).val();

            $.ajax({
                url: <?php echo "'". base_url('parking/get_category_rate/') . "'"; ?>  + value,
                type: 'post',
                dataType: 'json',
                success:function(response) {
                    $("#vehicle_rate").html(response);
                }
            });
        });

        function getTotalEarningPerYear(yr){
            if(yr){
                window.location = '<?php echo base_url('reports/index/');?>' + yr;
            }
        }

        function printContent(el) {
            let restorePage = document.body.innerHTML;
            let printContent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            // document.body.innerHTML = restorePage;
            location.reload();
        } 
        window.onafterprint = location.reload; 
    </script>

</body>

</html>