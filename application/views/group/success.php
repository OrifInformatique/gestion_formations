<?php header('Refresh: 5; URL='.base_url().'group'); ?>
<h1><?php echo $this->lang->line('groupe_deleted'); ?></h1>
<?php echo $this->lang->line('redirect_warn_start')." 5 ".$this->lang->line('redirect_warn_end');?>