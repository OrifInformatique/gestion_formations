<div class="container">
    <h1><?php echo $this->lang->line('module_list') ?></h1>
    <a class="btn btn-success" href="<?=base_url('module/form')?>"><?=$this->lang->line('module_new')?></a>
    <!--<div class="row">
        <div class="col-md-6"><strong><?php echo $this->lang->line('module_title') ?></strong></div>
        <div class="col-md-5"><strong><?php echo $this->lang->line('module_group') ?></strong></div>
        <div class="col-md-1"></div>
    </div>-->
    <?php /*if(isset($modules)) {
        foreach ($modules as $module) { ?>
            <div class="row">
                <!-- Click here to modify -->
                <div class="col-md-2"><?php echo $module->Title; ?></div>
                <div class="col-md-3"><?php echo getParentGroup($module->Group, $groups); ?></div>
                <!-- Click here to delete -->
                <div class="col-md-1"><a href="<?php echo base_url().'group/delete/'.$group->ID; ?>">[x]</a></div>
            </div>
    <?php } */

    get_tree($groups_tree, $modules);

    //} ?>
</div>
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
    function get_tree($groups, $modules = array()){
        foreach ($groups as $key => $group) {
            echo '<fieldset class="bob">';
            foreach ($modules as $module) {
                if($module->FK_Group == $group[0]){
                    echo '<p>'.$module->Title.'</p>';
                }
            }
            if(is_array($group[1])){
                echo '<legend class="bob">'.$key.'</legend>';
                get_tree($group[1], $modules);
            } else {
                echo '<legend class="bob">'.$group[1].'</legend>';
            }
            echo '</fieldset>';
        }
    }
?>