<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * View of question's details to update
 *
 * @author      Orif, section informatique (BuYa, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_questionnaires
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
?>

<div class="container">
    <h1 class="title-section"><?php echo $this->lang->line('formation_edit_module'); ?></h1>
    <?php
    if(isset($formation)) {
    $attributes = array("id" => "addFormationForm",
                        "name" => "addFormationForm");
    echo form_open('Formation/edit_modules_post', $attributes);

    echo form_hidden('id', $formation->id);
    unset($formation->id);

    for ($i = 0; $i < sizeof($modules); $i++){ ?>
        <div class="row">
            <div class="form-group col-md-11">
                <?php
                    echo form_dropdown('modules['.$modules[$i]->id.']', $all_modules, $modules[$i]->fk_module, 'class="form-control" id="modules['.$modules[$i]->id.']"');
                ?>
            </div>
            <div class="col-md-1">
                <?php echo form_submit('del_module['.$modules[$i]->id.']', '-', 'class="btn btn-danger"');
                ?>
            </div>
        </div>
    <?php }
        if(isset($add_module)){
            echo form_dropdown('modules[0]', $all_modules, 0, 'class="form-control" id="modules[0]"');
        }
    ?>
    <div class="row">
        <div class="col-md-3">
            <?php echo form_submit('add_module', '+', 'class="btn btn-success"');
                ?>
        </div>
        <div class="col-md-3"></div>
        <div class="col-md-3">
            <?php echo form_submit('save', $this->lang->line('save'), 'class="btn btn-primary"');
                ?>
        </div>
        <div class="col-md-3">
            <?php echo form_submit('quit', $this->lang->line('save_quit'), 'class="btn btn-primary"');
                ?>
        </div>
    </div>
            
    <?php echo form_close(); } else { 
    echo $this->lang->line('formation_missing');?>
    <br><a href="<?php echo base_url().'formation'; ?>" class="btn"><?php echo $this->lang->line('return'); ?></a>
    <?php } ?>
</div>