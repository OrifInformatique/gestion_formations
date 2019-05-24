<div class="container">
    <h1><?php echo $this->lang->line('group_module_add'); ?></h1>
    <?php
    $attributes = array("id" => "addModuleGroupForm",
                        "name" => "addModuleGroupForm");
    echo form_open('Group/add_module_validation', $attributes);
    ?>
        <!-- Display buttons -->
        <div class="row">
            <div class="form-group">
                <a name="cancel" class="btn btn-danger" href="<?=base_url('/group/module_list/'.$group->id)?>"><?=$this->lang->line('cancel')?></a>
                <?php
                    echo form_submit('save', $this->lang->line('save'), 'class="btn btn-success"'); 
                    //echo form_reset('reset', $this->lang->line('btn_reset'), 'class="btn btn-danger"');
                ?>
            </div>
        </div>

        <!-- ERROR MESSAGES -->
        <?php
        if (!empty(validation_errors())) {
            echo '<div class="alert alert-danger">'.validation_errors().'</div>';
        }
        echo form_hidden('id', $group->id);
        ?>

        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo form_label($this->lang->line('module_title'), 'fk_module'); ?>
                </div>
                <div class="col-md-6">
                    <?php echo form_dropdown('fk_module', $modules, set_value('fk_module'), 'class="form-control" id="fk_module"'); ?>
                </div>
            </div>
        </div>
    <?php echo form_close(); ?>
</div>