<div class="container">
    <h1><?php echo $this->lang->line('apprentice_list') ?></h1>
    <a class="btn btn-success" href="<?=base_url('apprentice/form')?>"><?=$this->lang->line('apprentice_new')?></a>
    <div class="row">
        <div class="col-md-2"><?php echo $this->lang->line('apprentice_firstname'); ?></div>
        <div class="col-md-2"><?php echo $this->lang->line('apprentice_lastname'); ?></div>
        <div class="col-md-2"><?php echo $this->lang->line('apprentice_datebirth'); ?></div>
        <div class="col-md-4"><?php echo $this->lang->line('apprentice_teacher'); ?></div>
        <div class="col-md-1"><?php echo $this->lang->line('apprentice_user'); ?></div>
        <div class="col-md-1"></div>
    </div>
    <?php if(isset($apprentices)) {
        foreach ($apprentices as $apprentice) { ?>
            <div class="row">
                <div class="col-md-2"><a href="<?php echo base_url().'apprentice/form/'.$apprentice->id; ?>"><?php echo $apprentice->firstname; ?></a></div>
                <div class="col-md-2"><a href="<?php echo base_url().'apprentice/form/'.$apprentice->id; ?>"><?php echo $apprentice->last_name; ?></a></div>
                <div class="col-md-2"><?php echo $apprentice->date_birth; ?></div>
                <div class="col-md-4"><?php echo $teachers[$apprentice->fk_teacher]; ?></div>
                <div class="col-md-1"><?php echo $users[$apprentice->fk_user]; ?></div>
                <div class="col-md-1"><a href="<?php echo base_url().'apprentice/delete/'.$apprentice->id; ?>">[x]</a></div>
            </div>
    <?php } } ?>
</div>