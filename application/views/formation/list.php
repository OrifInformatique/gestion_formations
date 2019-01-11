<div class="container">
    <h1><?php echo $this->lang->line('formation_list') ?></h1>
    <a class="btn btn-success" href="<?=base_url('formation/form')?>"><?=$this->lang->line('formation_new')?></a>
    <div class="row">
        <div class="col-md-3"><strong><?php echo $this->lang->line('formation_name') ?></strong></div>
        <div class="col-md-3"><strong><?php echo $this->lang->line('formation_duration') ?></strong></div>
        <div class="col-md-3"></div>
        <div class="col-md-3"></div>
    </div>
    <?php if(isset($formations)) {
        foreach ($formations as $formation) { ?>
            <div class="row">
                <!-- Click here to modify -->
                <div class="col-md-3"><a href="<?php echo base_url().'formation/form/'.$formation->ID; ?>"><?php echo $formation->Name_Formation; ?></a></div>
                <div class="col-md-3"><?php echo $formation->Duration." ".$this->lang->line('years'); ?></div>
                <div class="col-md-3"><a href="<?php echo base_url().'formation/edit_modules/'.$formation->ID; ?>"><?php echo $this->lang->line('formation_new'); ?></a></div>
                <!-- Click here to delete -->
                <div class="col-md-3"><a href="<?php echo base_url().'formation/delete/'.$formation->ID; ?>">[x]</a></div>
            </div>
        <?php
            }
        }
    ?>
</div>