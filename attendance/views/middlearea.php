<header class="main-header">
  <!-- Logo -->
  <a href="<?php echo URL; ?>" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><img style="width: 50px" src="<?php echo URL; ?>public/logo.png" /></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><img src="<?php echo URL; ?>public/logo.png" style="width: 50px" /></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle hidden" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php if(Session::get("image") != ""): ?><?php echo URL . "public" ?>/uploads/user/<?php echo Session::get('image'); ?><?php else: ?><?php echo URL . "public" ?>/no-image.gif<?php endif; ?>" class="user-image" alt="User Image">
            <span class="hidden-xs"><?php echo Session::get('firstname'); ?> <?php echo Session::get('lastname'); ?></span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="<?php if(Session::get("image") != ""): ?><?php echo URL . "public" ?>/uploads/user/<?php echo Session::get('image'); ?><?php else: ?><?php echo URL . "public" ?>/no-image.gif<?php endif; ?>" class="img-circle" alt="User Image">

              <p>
                <?php echo Session::get('firstname'); ?> <?php echo Session::get('lastname'); ?>
                <small><?php echo ucfirst(Session::get('role')); ?></small>
              </p>
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="<?php echo URL; ?>profile" class="btn btn-default btn-flat">Profile</a>
              </div>
              <div class="pull-right">
                <a href="<?php echo URL; ?>logout" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php if(Session::get("image") != ""): ?><?php echo URL . "public" ?>/uploads/user/<?php echo Session::get('image'); ?><?php else: ?><?php echo URL . "public" ?>/no-image.gif<?php endif; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo Session::get('firstname'); ?> <?php echo Session::get('lastname'); ?></p>
          <a class="text-green"><?php echo ucfirst(Session::get('role')); ?></a>
        </div>
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li<?php echo ($this->menu == "dashboard") ? ' class="active"': ""; ?>><a href="<?php echo URL; ?>"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
        <?php if(Session::get('role') == "officer"): ?>
        <li<?php echo ($this->menu == "attendance") ? ' class="active"': ""; ?>><a href="<?php echo URL; ?>attendance"><i class="fa fa-users"></i> <span>Attendance</span></a></li>
        <?php endif; ?>
        <?php if(Session::get('role') == "admin"): ?>
        <li<?php echo ($this->menu == "officers") ? ' class="active"': ""; ?>><a href="<?php echo URL; ?>officers"><i class="fa fa-users"></i> <span>Officers</span></a></li>
        <?php endif; ?>
        <li<?php echo ($this->menu == "students") ? ' class="active"': ""; ?>><a href="<?php echo URL; ?>students"><i class="fa fa-users"></i> <span>Students</span></a></li>
        <li<?php echo ($this->menu == "events") ? ' class="active"': ""; ?>><a href="<?php echo URL; ?>events"><i class="fa fa-calendar"></i> <span>Events</span></a></li>
        <li<?php echo ($this->menu == "sanction") ? ' class="active"': ""; ?>><a href="<?php echo URL; ?>sanction"><i class="fa fa-list"></i> <span>Sanctions</span></a></li>
        <?php if(Session::get('role') == "admin"): ?>
        <li<?php echo ($this->menu == "reports") ? ' class="active treeview"': ' class="treeview"'; ?>>
          <a href="<?php echo URL; ?>reports">
            <i class="fa fa-print"></i> <span>Reports</span>
            <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
          </a>
          <ul class="treeview-menu">
            <li<?php echo (isset($this->submenu) && $this->submenu == "generate") ? ' class="active"': ""; ?>><a href="<?php echo URL; ?>reports"><i class="fa fa-circle-o"></i> <span>Print Report</span></a></li>
            <li<?php echo (isset($this->submenu) && $this->submenu == "graphs") ? ' class="active"': ""; ?>><a href="<?php echo URL; ?>reports/graphs"><i class="fa fa-circle-o"></i> <span>Graphs</span></a></li>
            <li<?php echo (isset($this->submenu) && $this->submenu == "sanction") ? ' class="active"': ""; ?>><a href="<?php echo URL; ?>reports/sanction"><i class="fa fa-circle-o"></i> <span>Sanction</span></a></li>
          </ul>
        </li>
        <li<?php echo ($this->menu == "logs") ? ' class="active"': ""; ?>><a href="<?php echo URL; ?>logs"><i class="fa fa-compass"></i> <span>Activity Log</span></a></li>
        <li<?php echo ($this->menu == "backup") ? ' class="active"': ""; ?>><a href="<?php echo URL; ?>backup"><i class="fa fa-hdd-o"></i> <span>Backup</span></a></li>
        <?php endif; ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <div class="content-wrapper">
    <?php if(isset($this->title)): ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><?php echo $this->title; ?></h1>
    </section>
    <?php endif; ?>
    <!-- Main content -->
    <section class="content">