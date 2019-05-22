<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * View of group's details to update
 *
 * @author      Orif, section informatique (BuYa, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_questionnaires
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
?>
<div class="container">
    <div class="row">
        <h1 class="title-section"><?php echo $this->lang->line('group_add_module').$group->name_group; ?></h1>
    </div>

    <?php
    $attributes = array("id" => "addModulesUIForm",
                        "name" => "addModulesUIForm");
    echo form_open('Group/add_module_validation', $attributes);
    echo form_hidden('id', $group->id);
    ?>
        <div class="row">
            <div class="form-group">
                <a name="cancel" class="btn btn-danger" href="<?=base_url('/group')?>"><?=$this->lang->line('cancel')?></a>
                <?php
                    echo form_submit('save', $this->lang->line('save'), 'class="btn btn-success"'); 
                    //echo form_reset('reset', $this->lang->line('btn_reset'), 'class="btn btn-danger"');
                ?>
            </div>
        </div>

        <div class="row">
            <?php echo form_dropdown('m[]', $modules, $m, 'multiple="multiple" id="group_modules-multiselect"'); ?>
        </div>

    <?php echo form_close(); ?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        let filterTC = "<?php echo $this->lang->line('duallistbox_text_clear'); ?>",
        filterPH = "<?php echo $this->lang->line('duallistbox_place_holder'); ?>",
        selectedLL = "<h5><?php echo $this->lang->line('duallistbox_modules_selected'); ?></h5>",
        nonSelectedLL = "<h5><?php echo $this->lang->line('duallistbox_modules_not_selected'); ?></h5>",
        infoT = "<?php echo $this->lang->line('duallistbox_info_text'); ?> {0}",
        infoTE = "<?php echo $this->lang->line('duallistbox_info_text_empty'); ?>",
        infoTF = filterPH + " {0} <?php echo $this->lang->line('to'); ?> {1}";

        $('#group_modules-multiselect').bootstrapDualListbox({
            filterTextClear: filterTC,
            filterPlaceHolder: filterPH,
            selectedListLabel: selectedLL,
            nonSelectedListLabel: nonSelectedLL,
            infoText: infoT,
            infoTextEmpty: infoTE,
            infoTextFiltered: infoTF
        });
    });
</script>