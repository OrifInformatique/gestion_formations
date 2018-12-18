<?php
    function getParentGroup($id = 0, $groups){
        if($id == 0){
            return "";
        } else {
            foreach ($groups as $group) {
                if($group->ID == $id){
                    return $group->Name_Group;
                }
            }
        }
    }
?>
<div class="container">
    <h1><?php echo $this->lang->line('group_list') ?></h1>
    <a class="btn btn-success" href="<?=base_url('group/add')?>"><?=$this->lang->line('group_new')?></a>
    <div class="row">
        <div class="col-md-3"><strong><?php echo $this->lang->line('group_name') ?></strong></div>
        <div class="col-md-2"><strong><?php echo $this->lang->line('group_weight') ?></strong></div>
        <div class="col-md-2"><strong><?php echo $this->lang->line('group_eliminatory') ?></strong></div>
        <div class="col-md-3"><strong><?php echo $this->lang->line('group_parent_group') ?></strong></div>
        <div class="col-md-2"></div>
    </div>
    <?php if(isset($groups)) {
        foreach ($groups as $group) { ?>
            <div class="row">
                <!-- Click here to modify -->
                <div class="col-md-3"><a href="<?php echo base_url().'view/'.$group->ID; ?>"><?php echo $group->Name_Group; ?></a></div>
                <div class="col-md-2"><?php echo $group->Weight . ' %'; ?></div>
                <div class="col-md-2"><?php echo $group->Eliminatory?$this->lang->line('yes'):$this->lang->line('no'); ?></div>
                <div class="col-md-3"><?php echo getParentGroup($group->ID, $groups); ?></div>
                <!-- Click here to delete -->
                <div class="col-md-2"><a href="<?php echo base_url().'delete/'.$group->ID; ?>">[x]</a></div>
            </div>
    <?php } } ?>
</div>