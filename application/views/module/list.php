<div class="container">
    <h1><?php echo $this->lang->line('module_list') ?></h1>
    <a class="btn btn-success" href="<?=base_url('module/form')?>"><?=$this->lang->line('module_new')?></a>
    <table class="table table-hover">
        <thead>
            <tr>
                <th><?php echo $this->lang->line('module_title') ?></th>
                <th><?php echo $this->lang->line('module_number') ?></th>
                <th><?php echo $this->lang->line('module_description') ?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php if(isset($modules)) {
            foreach($modules as $module) { ?>
                <tr>
                    <td><a href="<?php echo base_url().'module/form/'.$module->id; ?>"><?php echo $module->title; ?></a></td>
                    <td>
                        <?php
                        if($module->number == 0)
                            echo $this->lang->line('subject');
                        else
                            echo $module->number;
                        ?>
                    </td>
                    <td><?php echo $module->description; ?></td>
                    <td><a href="<?php echo base_url().'module/delete/'.$module->id; ?>" class="btn btn-danger">x</a></td>
                </tr>
            <?php } } ?>
        </tbody>
    </table>
</div>