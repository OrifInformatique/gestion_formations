<div class="container">
    <h1><?php echo $this->lang->line('formation_list') ?></h1>
    <a class="btn btn-success" href="<?=base_url('formation/form')?>"><?=$this->lang->line('formation_new')?></a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('formation_name') ?></th>
                <th><?php echo $this->lang->line('formation_duration') ?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($formations)) {
            foreach($formations as $formation) {
                if($formation->id == 0) continue; ?>
                <tr>
                    <td><a href="<?php echo base_url().'formation/form/'.$formation->id; ?>"><?php echo $formation->name_formation; ?></a></td>
                    <td><?php echo $formation->duration." ".$this->lang->line('years'); ?></td>
                    <td><a href="<?php echo base_url().'formation/delete/'.$formation->id; ?>" class="btn btn-danger">x</a></td>
                </tr>
            <?php } } ?>
        </tbody>
    </table>
</div>