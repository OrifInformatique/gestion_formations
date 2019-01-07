<div class="container">
    <h1><?php echo $this->lang->line('apprentice_list') ?></h1>
    <a class="btn btn-success" href="<?=base_url('apprentice/form')?>"><?=$this->lang->line('apprentice_new')?></a>
    <div class="row">
        <div class="col-md-2"><?php echo $this->lang->line('apprentice_firstname'); ?></div>
        <div class="col-md-2"><?php echo $this->lang->line('apprentice_lastname'); ?></div>
        <div class="col-md-2"><?php echo $this->lang->line('apprentice_datebirth'); ?></div>
        <div class="col-md-2"><?php echo $this->lang->line('apprentice_formation'); ?></div>
        <div class="col-md-2"><?php echo $this->lang->line('apprentice_MSP'); ?></div>
        <div class="col-md-1"><?php echo $this->lang->line('apprentice_user'); ?></div>
    </div>
    <?php if(isset($apprentices)) {
        foreach ($apprentices as $apprentice) { ?>
            <div class="row">
                <div class="col-md-2"><?php echo $apprentice->Firstname; ?></div>
                <div class="col-md-2"><?php echo $apprentice->Last_Name; ?></div>
                <div class="col-md-2"><?php echo $apprentice->Date_Birth; ?></div>
                <div class="col-md-2"><?php echo $apprentice->FK_Formation; ?></div>
                <div class="col-md-2"><?php echo $apprentice->FK_MSP; ?></div>
                <div class="col-md-1"><?php echo $apprentice->FK_User; ?></div>
            </div>
    <?php } } ?>
</div>