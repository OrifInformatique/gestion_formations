<div class="container" >
  <div class="row xs-center">
    <div class="col-sm-3">
      <a href="<?= base_url(); ?>" ><img src="<?= base_url("assets/images/logo.png"); ?>" ></a>
    </div>
    <div class="col-sm-6">
      <a href="<?= base_url(); ?>" class="text-info"><h1><?= lang('app_title'); ?></h1></a>
    </div>
    <div class="col-sm-3" >
      <div class="nav nav-pills" >
        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) { ?>
          
          <!-- ADMIN ACCESS ONLY -->
          <?php if ($_SESSION['user_access'] >= $this->config->item('access_lvl_admin')) { ?>
              <a href="<?= base_url("admin/"); ?>" ><?= lang('btn_admin'); ?></a><br />
          <?php } ?>
          <!-- END OF ADMIN ACCESS -->

          <!-- Logged in, display a "logout" button -->
          <a href="<?= base_url("auth/logout"); ?>" ><?= lang('btn_logout'); ?></a>

        <?php } else { ?>
          <!-- Not logged in, display a "login" button -->
          <a href="<?= base_url("auth/login"); ?>" ><?= lang('btn_login'); ?></a>
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
