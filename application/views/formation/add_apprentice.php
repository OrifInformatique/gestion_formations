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
    <div class="row">
        <h1><?php echo $this->lang->line('formation_add_apprentice').$formation->name_formation; ?></h1>
    </div>

    <?php
    $attributes = array("id" => "addFormationApprenticeForm",
                        "name" => "addFormationApprenticeForm");

    echo form_open('Formation/apprentice_add_validation',$attributes);
    echo form_hidden('id', $formation->id);
    ?>
        <div class="row">
            <div class="form-group">
                <a name="cancel" class="btn btn-danger" href="<?=base_url('/formation')?>"><?=$this->lang->line('cancel')?></a>
                <?php
                    echo form_submit('save', $this->lang->line('save'), 'class="btn btn-success"'); 
                    //echo form_reset('reset', $this->lang->line('btn_reset'), 'class="btn btn-danger"');
                ?>
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