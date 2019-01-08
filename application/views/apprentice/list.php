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
        <div class="col-md-1"></div>
    </div>
    <?php if(isset($apprentices)) {
        foreach ($apprentices as $apprentice) { ?>
            <div class="row">
                <div class="col-md-2"><a href="<?php echo base_url().'apprentice/form/'.$apprentice->ID; ?>"><?php echo $apprentice->Firstname; ?></a></div>
                <div class="col-md-2"><a href="<?php echo base_url().'apprentice/form/'.$apprentice->ID; ?>"><?php echo $apprentice->Last_Name; ?></a></div>
                <div class="col-md-2"><?php echo $apprentice->Date_Birth; ?></div>
                <div class="col-md-2"><?php echo getParentFormation($apprentice->FK_Formation, $formations); ?></div>
                <div class="col-md-2"><?php echo getParentMSP($apprentice->FK_MSP, $msps); ?></div>
                <div class="col-md-1"><?php echo getParentUser($apprentice->FK_User, $users); ?></div>
                <div class="col-md-1"><a href="<?php echo base_url().'apprentice/delete/'.$apprentice->ID; ?>">[x]</a></div>
            </div>
    <?php } } ?>
</div>
<?php
function getParentFormation($id, $formations) {
    return $formations[$id];
}
function getParentMSP($id, $msps) {
    return $msps[$id];
}
function getParentUser($id, $users) {
    return $users[$id];
}
?>