<div class="container">
    <h1><?php echo $this->lang->line('module_list') ?></h1>
    <a class="btn btn-success" href="<?=base_url('module/form')?>"><?=$this->lang->line('module_new')?></a>

    <?php get_tree($groups_tree, $modules, $this->lang->line('subject')); ?>

</div>
<?php
    /**
     * Returns the parent group
     * @param integer $id
     *      The id of the parent group
     * @param array $groups
     *      The entirety of groups
     * @return string
     *      The name of the parent group
     */
    function getParentGroup($id = 0, $groups){
        if($id == 0){
            return "";
        } else {
            foreach ($groups as $group) {
                if($group->ID == $id){
                    return $group->name_group;
                }
            }
        }
    }
    /**
     * Displays the entire tree of groups with the modules inside
     * @param array $groups
     *      All the groups
     * @param array $modules
     *      All the modules
     * @param string $subject
     *      Text displayed if the module number is 0
     */
    function get_tree($groups = array(), $modules = array(), $subject = ""){
        foreach ($groups as $key => $group) {
            echo '<fieldset class="bob">';
            foreach ($modules as $module) {
                if($module->fk_group == $group[0]){
                    echo '<div class="row">';
                        if($module->number==0){
                            $module->number=$subject;
                        } else if($module->number<0){
                             $module->number="";
                        }
                        echo '<div class="col-md-1">'.$module->number.'</div>';
                        echo '<div class="col-md-10"><a href="'.base_url().'module/form/'.$module->id.'">'.$module->title.'</a></div>';
                        echo '<div class="col-md-1"><a href="'.base_url().'module/delete/'.$module->id.'">[x]</a></div>';
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