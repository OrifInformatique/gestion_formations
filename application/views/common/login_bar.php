<div class="container" >
  <div class="row xs-center">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
      <a href="<?php echo base_url(); ?>" ><img src="<?php echo base_url("assets/images/logo.jpg"); ?>" ></a>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
      <a href="<?php echo base_url(); ?>" ><h1><?php echo $this->lang->line('app_title'); ?></h1></a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" >
      <div class="nav nav-pills" style="margin-top:20px;">
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) { ?>
          
          <!-- ADMIN ACCESS ONLY -->
          <?php if ($_SESSION['user_access'] >= ACCESS_LVL_ADMIN) { ?>
              <a href="<?php echo base_url("admin/"); ?>" ><?php echo $this->lang->line('btn_admin'); ?></a><br />
          <?php } ?>
          <!-- END OF ADMIN ACCESS -->

          <!-- Logged in, display a "logout" button -->
          <a href="<?php echo base_url("auth/logout"); ?>" ><?php echo $this->lang->line('btn_logout'); ?></a>

        <?php } else { ?>
          <!-- Not logged in, display a "login" button -->
          <a href="<?php echo base_url("auth"); ?>" ><?php echo $this->lang->line('btn_login'); ?></a>
        <?php } ?>
      </div>
    </div>
  </div>
  <div class="row xs">
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <b class="nav-link"><?php echo $this->lang->line('nav_categories');?></b>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url('Group');?>"><?php echo $this->lang->line('nav_group');?></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url('Module');?>"><?php echo $this->lang->line('nav_module');?></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url('Apprentice');?>"><?php echo $this->lang->line('nav_apprentice');?></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="<?php echo base_url('Formation');?>"><?php echo $this->lang->line('nav_formation');?></a>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</div>
<hr />
