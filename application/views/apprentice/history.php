<div class="container">
    <h1><?php echo $this->lang->line('apprentice_formation_history') ?></h1>
    <a class="btn btn-primary" href="<?php echo base_url('apprentice')?>"><?php echo $this->lang->line('return'); ?></a>
    <?php if (!$formation_in_progress) { ?>
        <a class="btn btn-success" href="<?php echo base_url('apprentice/link_form/'.$id); ?>">
            <?php echo $this->lang->line('apprentice_link'); ?>
        </a>
    <?php } else { ?>
        <a class="btn btn-outline-secondary" style="cursor: not-allowed;"><?php echo $this->lang->line('apprentice_link'); ?></a>
    <?php } ?>
    <a class="btn btn-success" href="<?=base_url('formation/form')?>"><?=$this->lang->line('formation_new')?></a>

    <table class="table table-hover">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('formation_name'); ?></th>
                <th><?php echo $this->lang->line('formation_end'); ?></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($linked_formations as $linked_formation) {
                $formation = $formations[$linked_formation->fk_formation]; ?>
                <tr>
                    <td>
                        <a href="<?php echo base_url().'apprentice/edit_form/'.$linked_formation->id; ?>">
                            <?php echo $formation->name_formation; ?>
                        </a>
                    </td>
                    <td><?php echo $formation->duration + $linked_formation->year; ?></td>
                    <td>
                        <a href="<?php echo base_url().'grade/list/'.$linked_formation->id; ?>" class="btn btn-primary">
                            <?php echo $this->lang->line('apprentice_formation_grades'); ?>
                        </a>
                    </td>
                    <td>
                        <a href="<?php echo base_url().'apprentice/unlink_form/'.$linked_formation->id; ?>" class="btn btn-danger">x</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>