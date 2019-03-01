<div class="container">
    <h1><?php echo $this->lang->line('module_list') ?></h1>
    <a class="btn btn-success" href="<?=base_url('module/form')?>"><?=$this->lang->line('module_new')?></a>
    <div class="row">
        <div class="col-md-2"><strong><?php echo $this->lang->line('module_title') ?></strong></div>
        <div class="col-md-2"><strong><?php echo $this->lang->line('module_number') ?></strong></div>
        <div class="col-md-7"><strong><?php echo $this->lang->line('module_description') ?></strong></div>
        <div class="col-md-1"></div>
    </div>

    <?php if(isset($modules)) {
        foreach ($modules as $module) { 
            if($module->id == 0) continue; ?>
            <div class="row">
                <!-- Click here to modify -->
                <div class="col-md-2"><a href="<?php echo base_url().'module/form/'.$module->id; ?>"><?php echo $module->title; ?></a></div>
                <div class="col-md-2"><?php echo $module->number . ' %'; ?></div>
                <div class="col-md-7"><?php echo $module->description; ?></div>
                <!-- Click here to delete -->
                <div class="col-md-1"><a href="<?php echo base_url().'module/delete/'.$module->id; ?>">[x]</a></div>
            </div>
    <?php } } ?>

</div>