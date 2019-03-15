<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * View of formation's details to update
 *
 * @author      Orif, section informatique (BuYa, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_questionnaires
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
?>

<?php $GLOBALS['all_modules'] = $all_modules; ?>

<div class="container">
    <h1 class="title-section"><?php if(isset($formation)) {echo $this->lang->line('formation_modify'); $update = true;} else {echo $this->lang->line('formation_new'); $update = false;} ?></h1>
    <?php
    $attributes = array("id" => "addFormationForm",
                        "name" => "addFormationForm");
    echo form_open('Formation/form_validation', $attributes);
    ?>        
        <!-- Display buttons -->
        <div class="row">
            <div class="form-group">
                <a name="cancel" class="btn btn-danger" href="<?=base_url('/formation')?>"><?=$this->lang->line('cancel')?></a>
                <?php
                    echo form_submit('save', $this->lang->line('save'), 'class="btn btn-success"'); 
                    //echo form_reset('reset', $this->lang->line('btn_reset'), 'class="btn btn-danger"');
                ?>
            </div>
        </div>

        <!-- ERROR MESSAGES -->
        <?php
        if (!empty(validation_errors())) {
            echo '<div class="alert alert-danger">'.validation_errors().'</div>';}
        ?>

        <!-- FORMATION FIELDS -->
        <?php

        if($update){
            echo form_hidden('id', $formation->id);
            unset($formation->id);
        }

        ?>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('formation_name'), 'name_formation'); ?>
                    </div>
                    <div class="col-md-8">
                        <?php
                        if($update)
                            echo form_input('name_formation', set_value('name_formation', $formation->name_formation), 'maxlength="65535" class="form-control" id="name_formation"');
                        else
                            echo form_input('name_formation', set_value('name_formation'), 'maxlength="65535" class="form-control" id="name_formation"');
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group col-md-12">
                <div class="form-group row">
                    <div class="col-md-4">
                        <?php echo form_label($this->lang->line('formation_duration'), 'duration_formation'); ?>
                    </div>
                    <div class="col-md-7">
                        <?php
                        if($update)
                            echo form_input('duration_formation', set_value('duration_formation', $formation->duration), 'class="form-control" id="duration_formation"');
                        else
                            echo form_input('duration_formation', set_value('duration_formation'), 'class="form-control" id="duration_formation"');
                        ?>
                    </div>
                    <div class="col-md-1">
                        <?php echo $this->lang->line('years'); ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if($update){ ?>
            <h3><?php echo $this->lang->line('group_list');?></h3>
            <?php 
                /*for ($i = 0; $i < sizeof($groups); $i++){ ?>
                    <div class="row">
                        <div class="form-group col-md-11">
                            <?php
                                echo $groups[$i]->name_group;
                            ?>
                        </div>
                        <div class="col-md-1">
                            <?php echo form_submit('del_module['.$groups[$i]->id.']', '-', 'class="btn btn-danger"');
                            ?>
                        </div>
                    </div>
            <?php*/ 
            get_tree($groups); ?>
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-4">
                    <?php echo form_input('add_group_name', set_value('add_group_name'), 'maxlength="65535" class="form-control" id="add_group_name"'); ?>
                </div>
                <div class="col-md-2">
                    <?php echo form_submit('add_group', $this->lang->line('group_add'), 'class="btn btn-success"');
                        ?>
                </div>
            </div>
        <?php } ?>
            
    <?php echo form_close(); ?>
</div>
<?php

    function get_tree($groups){
        if(!is_null($groups)){
            foreach ($groups as $key => $group) {
                
                if($group[0] == 0){
                    echo '<fieldset class="bob">';
                        echo '<legend class="bob">'.$key.'</legend>';
                        echo '<div class="row">
                            <div class="col-md-8"></div>
                            <div class="col-md-3">
                                '.form_dropdown('added_module['.$group[1].']', $GLOBALS['all_modules'], array(), 'class="form-control"').'
                            </div>
                            <div class="col-md-1">'
                                .form_submit('add_module['.$group[1].']', '+', 'class="btn btn-success"').
                            '</div></div>';
                        get_tree($group[2]);
                    echo '</fieldset>';
                } else {
                    echo '<div class="row">';
                        $number = $group[2]->number > 0 ? $group[2]->number : '';
                        echo '<div class="col-md-6">'.$number.' '.$group[2]->title.'</div>';
                        echo '<div class="col-md-6">'.$group[2]->description.'</div>';
                    echo '</div>';
                }
            }
        }
    }
?>