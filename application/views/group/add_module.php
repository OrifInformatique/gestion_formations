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
    <h1 class="title-section"><?php echo $this->lang->line('group_add_module'); ?></h1>

    <?php
    $attributes = array("id" => "addModulesForm",
                        "name" => "addModulesForm");
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
            <div class="col-md-6">
                <?php echo form_label($this->lang->line('module_title'), 'group_modules-multiselect'); ?>
            </div>
            <div class="col-md-6">
                <?php echo form_dropdown('m[]', $modules, $m, 'multiple="multiple" id="group_modules-multiselect"'); ?>
            </div>
        </div>

    <?php echo form_close(); ?>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#group_modules-multiselect').multiselect({
            buttonWidth: '100%',
        });
    });
</script>