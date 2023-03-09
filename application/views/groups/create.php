<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?php echo $page_title; ?></h1>

    <div class="col-md-10">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="<?php echo base_url('groups/create'); ?>" method="post">
                    <label>Group Name</label>
                    <div class="form-group">
                        <input
                            type="text"
                            name="group_name"
                            autocomplete="off"
                            class="form-control form-control-user"
                            required="true"
                            autofocus="true"
                            placeholder="Enter group name">
                    </div>
                    <label>Permission</label>
                    <table class="table">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Create</th>
                            <th>Update</th>
                            <th>View</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Users</td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="createUser"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="updateUser"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="viewUser"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="deleteUser"></td>
                            </tr>
                            <tr>
                                <td>Groups</td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="createGroup"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="updateGroup"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="viewGroup"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="deleteGroup"></td>
                            </tr>
                            <tr>
                                <td>Category</td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="createCategory"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="updateCategory"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="viewCategory"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="deleteCategory"></td>
                            </tr>
                            <tr>
                                <td>Rates</td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="createRates"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="updateRates"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="viewRates"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="deleteRates"></td>
                            </tr>
                            <tr>
                                <td>Slots</td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="createSlots"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="updateSlots"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="viewSlots"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="deleteSlots"></td>
                            </tr>
                            <tr>
                                <td>Parking</td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="createParking"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="updateParking"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="viewParking"></td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="deleteParking"></td>
                            </tr>
                            <tr>
                                <td>Reports</td>
                                <td> - </td>
                                <td> - </td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="viewReports"></td>
                                <td> - </td>
                            </tr>
                            <tr>
                                <td>Company</td>
                                <td> - </td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="updateCompany"></td>
                                <td> - </td>
                                <td> - </td>
                            </tr>
                            <tr>
                                <td>Settings</td>
                                <td> - </td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="updateSetting"></td>
                                <td> - </td>
                                <td> - </td>
                            </tr>
                            <tr>
                                <td>Profile</td>
                                <td> - </td>
                                <td> - </td>
                                <td><input type="checkbox" name="permission[]" id="permission" value="viewProfile"></td>
                                <td> - </td>
                            </tr>                      
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                    <a href="<?php echo base_url('groups'); ?>" class="btn btn-warning">
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