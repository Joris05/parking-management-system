<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-parking"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Panel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Menu
    </div>
    <?php if(in_array('createUser', $user_permission) || in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUsers"
            aria-expanded="true" aria-controls="collapseUsers">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span>
        </a>
        <div id="collapseUsers" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <?php if(in_array('createUser', $user_permission)): ?>
                    <a class="collapse-item" href="<?php echo base_url('users/create'); ?>">Add User</a>
                <?php endif; ?>
                <?php if(in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                    <a class="collapse-item" href="<?php echo base_url('users'); ?>">Manage Users</a>
                <?php endif; ?>
            </div>
        </div>
    </li>
    <?php endif; ?>
    <?php if(in_array('createGroup', $user_permission) || in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseGroups"
            aria-expanded="true" aria-controls="collapseGroups">
            <i class="fas fa-fw fa-circle"></i>
            <span>Groups</span>
        </a>
        <div id="collapseGroups" class="collapse" aria-labelledby="headingGroups"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <?php if(in_array('createGroup', $user_permission)): ?>
                    <a class="collapse-item" href="<?php echo base_url('groups/create'); ?>">Add Group</a>
                <?php endif; ?>
                <?php if(in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                    <a class="collapse-item" href="<?php echo base_url('groups'); ?>">Manage Groups</a>
                <?php endif; ?>
            </div>
        </div>
    </li>
    <?php endif; ?>

    <?php if(in_array('createCategory', $user_permission) || in_array('updateCategory', $user_permission) || in_array('viewCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategory"
            aria-expanded="true" aria-controls="collapseCategory">
            <i class="fas fa-fw fa-table"></i>
            <span>Category</span>
        </a>
        <div id="collapseCategory" class="collapse" aria-labelledby="headingCategory"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <?php if(in_array('createCategory', $user_permission)): ?>
                    <a class="collapse-item" href="<?php echo base_url('category/create'); ?>">Add Category</a>
                <?php endif; ?>
                <?php if(in_array('updateCategory', $user_permission) || in_array('viewCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
                    <a class="collapse-item" href="<?php echo base_url('category'); ?>">Manage Category</a>
                <?php endif; ?>
            </div>
        </div>
    </li>
    <?php endif; ?>

    <?php if(in_array('createRates', $user_permission) || in_array('updateRates', $user_permission) || in_array('viewRates', $user_permission) || in_array('deleteRates', $user_permission)): ?>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRates"
            aria-expanded="true" aria-controls="collapseRates">
            <i class="fas fa-fw fa-money-bill-wave-alt"></i>
            <span>Rates</span>
        </a>
        <div id="collapseRates" class="collapse" aria-labelledby="headingRates"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <?php if(in_array('createRates', $user_permission)): ?>
                    <a class="collapse-item" href="<?php echo base_url('rates/create'); ?>">Add Rate</a>
                <?php endif; ?>
                <?php if(in_array('updateRates', $user_permission) || in_array('viewRates', $user_permission) || in_array('deleteRates', $user_permission)): ?>
                    <a class="collapse-item" href="<?php echo base_url('rates'); ?>">Manage Rates</a>
                <?php endif; ?>
            </div>
        </div>
    </li>
    <?php endif; ?>

    <?php if(in_array('createSlots', $user_permission) || in_array('updateSlots', $user_permission) || in_array('viewSlots', $user_permission) || in_array('deleteSlots', $user_permission)): ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseParkingSlot"
            aria-expanded="true" aria-controls="collapseParkingSlot">
            <i class="fas fa-fw fa-car"></i>
            <span>Parking Slot</span>
        </a>
        <div id="collapseParkingSlot" class="collapse" aria-labelledby="headingParkingSlot"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <?php if(in_array('createSlots', $user_permission)): ?>
                    <a class="collapse-item" href="<?php echo base_url('slots/create'); ?>">Add Slot</a>
                <?php endif; ?>
                <?php if(in_array('updateSlots', $user_permission) || in_array('viewSlots', $user_permission) || in_array('deleteSlots', $user_permission)): ?>
                    <a class="collapse-item" href="<?php echo base_url('slots'); ?>">Manage Slot</a>
                <?php endif; ?>
            </div>
        </div>
    </li>
    <?php endif; ?>

    <?php if(in_array('createParking', $user_permission) || in_array('updateParking', $user_permission) || in_array('viewParking', $user_permission) || in_array('deleteParking', $user_permission)): ?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseParking"
            aria-expanded="true" aria-controls="collapseParking">
            <i class="fas fa-fw fa-car"></i>
            <span>Parking</span>
        </a>
        <div id="collapseParking" class="collapse" aria-labelledby="headingParking"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <?php if(in_array('createParking', $user_permission)): ?>
                    <a class="collapse-item" href="<?php echo base_url('parking/create'); ?>">Add Parking</a>
                <?php endif; ?>
                <?php if(in_array('updateParking', $user_permission) || in_array('viewParking', $user_permission) || in_array('deleteParking', $user_permission)): ?>
                    <a class="collapse-item" href="<?php echo base_url('parking'); ?>">Manage Parking</a>
                <?php endif; ?>
            </div>
        </div>
    </li>
    <?php endif; ?>

    <?php if(in_array('viewReports', $user_permission)): ?>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('reports'); ?>">
            <i class="fas fa-fw fa-print"></i>
            <span>Reports</span>
        </a>
    </li>
    <?php endif; ?>

    <?php if(in_array('updateCompany', $user_permission)): ?>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('company'); ?>">
            <i class="fas fa-fw fa-cog"></i>
            <span>Company</span>
        </a>
    </li>
    <?php endif; ?>

</ul>
<!-- End of Sidebar -->