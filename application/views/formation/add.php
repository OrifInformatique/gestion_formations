<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * View of formation's details to update
 *
 * @author      Orif, section informatique (BuYa, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_questionnaires
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
?>

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
                            echo form_input('name_formation', set_value('name_formation', $formation->name_formation, FALSE), 'maxlength="65535" class="form-control" id="name_formation"');
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

        <div class="row">
            <?php echo form_dropdown('a[]', $apprentices, $a, 'multiple="multiple" id="formation_apprentices-multiselect"'); ?>
        </div>
            
    <?php echo form_close(); ?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        let filterTC = "<?php echo $this->lang->line('duallistbox_text_clear'); ?>",
        filterPH = "<?php echo $this->lang->line('duallistbox_place_holder'); ?>",
        selectedLL = "<h5><?php echo $this->lang->line('duallistbox_apprentices_selected'); ?></h5>",
        nonSelectedLL = "<h5><?php echo $this->lang->line('duallistbox_apprentices_not_selected'); ?></h5>",
        infoT = "{0} <?php echo $this->lang->line('duallistbox_info_text'); ?>",
        infoTE = "<?php echo $this->lang->line('duallistbox_info_text_empty'); ?>",
        infoTF = filterPH + " {0} <?php echo $this->lang->line('out_of'); ?> {1}",
        moveAL = "<?php echo $this->lang->line('duallistbox_move_all'); ?>",
        removeAL = "<?php echo $this->lang->line('duallistbox_remove_all'); ?>";

        $('#formation_apprentices-multiselect').bootstrapDualListbox({
            filterTextClear: filterTC,
            filterPlaceHolder: filterPH,
            selectedListLabel: selectedLL,
            nonSelectedListLabel: nonSelectedLL,
            infoText: infoT,
            infoTextEmpty: infoTE,
            infoTextFiltered: infoTF,
            moveAllLabel: moveAL,
            removeAllLabel: removeAL
        });
    });
</script>
<style type="text/css">
    select {
        max-height: 200px;
    }
</style>