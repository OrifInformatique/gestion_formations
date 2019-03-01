<div class="container">
    <h1><?php echo $this->lang->line('formation_list') ?></h1>
    <a class="btn btn-success" href="<?=base_url('formation/form')?>"><?=$this->lang->line('formation_new')?></a>
    <div class="row">
        <div class="col-md-6"><strong><?php echo $this->lang->line('formation_name') ?></strong></div>
        <div class="col-md-4"><strong><?php echo $this->lang->line('formation_duration') ?></strong></div>
        <div class="col-md-2"></div>
    </div>
    <?php if(isset($formations)) {
        foreach ($formations as $formation) { 
            if($formation->id == 0) continue; ?>
            <div class="row">
                <!-- Click here to modify -->
                <div class="col-md-6"><a href="<?php echo base_url().'formation/form/'.$formation->id; ?>"><?php echo $formation->name_formation; ?></a></div>
                <div class="col-md-4"><?php echo $formation->duration." ".$this->lang->line('years'); ?></div>
                <!-- Click here to delete -->
                <div class="col-md-2"><a href="<?php echo base_url().'formation/delete/'.$formation->id; ?>">[x]</a></div>
            </div>
        <?php } } ?>
</div>