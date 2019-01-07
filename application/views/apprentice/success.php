<div class="container">
    <?php header('Refresh: 5; URL='.base_url().'apprentice'); ?>
    <h1><?php echo $this->lang->line('apprentice_deleted'); ?></h1>
    <?php echo $this->lang->line('redirect_warn_start')." 5 ".$this->lang->line('redirect_warn_end');?>
</div>