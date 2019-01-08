<div class="container">
    <h1><?php echo $this->lang->line('module_list') ?></h1>
    <a class="btn btn-success" href="<?=base_url('module/form')?>"><?=$this->lang->line('module_new')?></a>

    <?php get_tree($groups_tree, $modules, $this->lang->line('subject')); ?>

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
    function get_tree($groups = array(), $modules = array(), $subject = ""){
        foreach ($groups as $key => $group) {
            echo '<fieldset class="bob">';
            foreach ($modules as $module) {
                if($module->FK_Group == $group[0]){
                    echo '<div class="row">';
                        if($module->Number==0){
                            $module->Number=$subject;
                        } else if($module->Number<0){
                             $module->Number="";
                        }
                        echo '<div class="col-md-1">'.$module->Number.'</div>';
                        echo '<div class="col-md-10"><a href="'.base_url().'module/form/'.$module->ID.'">'.$module->Title.'</a></div>';
                        echo '<div class="col-md-1"><a href="'.base_url().'module/delete/'.$module->ID.'">[x]</a></div>';
                    echo '</div>';
                }
            }
            if(is_array($group[1])){
                echo '<legend class="bob">'.$key.'</legend>';
                get_tree($group[1], $modules, $subject);
            } else {
                echo '<legend class="bob">'.$group[1].'</legend>';
            }
            echo '</fieldset>';
        }
    }
?>