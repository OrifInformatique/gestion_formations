<div class="container">
    <?php
    header('Refresh: 5; URL='.base_url('grade/remove_from_module/'.$apprentice_formation->id.'/'.$module->id));
    ?>
    <h1><?php echo $this->lang->line('grade_deleted'); ?></h1>
    <?php echo $this->lang->line('redirect_warn_start')." 5 ".$this->lang->line('redirect_warn_end');?>
</div>