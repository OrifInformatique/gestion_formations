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
                <div class="col-md-2"><a href="<?php echo base_url().'apprentice/form/'.$apprentice->ID; ?>"><?php echo $apprentice->firstname; ?></a></div>
                <div class="col-md-2"><a href="<?php echo base_url().'apprentice/form/'.$apprentice->ID; ?>"><?php echo $apprentice->last_name; ?></a></div>
                <div class="col-md-2"><?php echo $apprentice->date_birth; ?></div>
                <div class="col-md-2"><?php echo getParentFormation($apprentice->fk_formation, $formations); ?></div>
                <div class="col-md-2"><?php echo getParentTeacher($apprentice->fk_teacher, $teachers); ?></div>
                <div class="col-md-1"><?php echo getParentUser($apprentice->fk_user, $users); ?></div>
                <div class="col-md-1"><a href="<?php echo base_url().'apprentice/delete/'.$apprentice->ID; ?>">[x]</a></div>
            </div>
    <?php } } ?>
</div>
<?php
function getParentFormation($id, $formations) {
    return $formations[$id];
}
function getParentTeacher($id, $teachers) {
    return $teachers[$id];
}
function getParentUser($id, $users) {
    return $users[$id];
}
?>