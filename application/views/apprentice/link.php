<div class="container">
    <?php
    if(isset($link)) {
        $update = TRUE;
    } else {
        $update = FALSE;
    }
    $attributes = array("id" => "apprenticeLinkForm",
                        "name" => "apprenticeLinkForm");
    ?>
    <h1>
        <?php
        if(!$update)
            echo $this->lang->line('apprentice_formation_link');
        else
            echo $this->lang->line('apprentice_formation_edit');
        ?>
    </h1>
    <?php
    echo form_open('apprentice/link_form_validation', $attributes);
    if(!$update)
        echo form_hidden('apprentice_id', $id);
    else
        echo form_hidden('link_id', $link->id);
    ?>
        <div class="row">
            <div class="form-group">
                <a name="cancel" class="btn btn-danger" href="<?=base_url('/apprentice/apprentice_formations/'.$id)?>"><?=$this->lang->line('cancel')?></a>
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

        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo form_label($this->lang->line('apprentice_formation'), 'formation'); ?>
                </div>
                <div class="col-md-6">
                    <?php
                    if(!$update)
                        echo form_dropdown('formation', $formations, set_value('formation'), 'class="form-control" id="formation"');
                    else
                        echo form_dropdown('formation', $formations, set_value('formation', $link->fk_formation), 'class="form-control" id="formation"');
                    ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <?php echo form_label($this->lang->line('apprentice_formation_date'), 'date'); ?>
                </div>
                <div class="col-md-6">
                    <?php
                    if(!$update)
                        echo form_input('date', set_value('date'), 'class="form-control" id="date"');
                    else
                        echo form_input('date', set_value('date', $link->year), 'class="form-control" id="date"');
                    ?>
                </div>
            </div>
        </div>
    <?php echo form_close(); ?>
</div>