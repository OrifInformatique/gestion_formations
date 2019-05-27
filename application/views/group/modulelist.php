<div class="container">
    <h1><?php echo $this->lang->line('group_module_list'); ?></h1>
    <a class="btn btn-primary" href="<?=base_url('/group')?>"><?=$this->lang->line('return')?></a>
    <a class="btn btn-success" href="<?php echo base_url('module/form');?>"><?php echo $this->lang->line('module_new'); ?></a>
    <table class="table table-hover" style="margin-top: 10px;">
        <?php foreach($modules as $module) { ?>
            <tr>
                <td><?php echo $module->title; ?></td>
                <td><a href="<?php echo base_url('group/remove_module/'.$group->id.'/'.$module->id); ?>">[x]</a></td>
            </tr>
        <?php } ?>
    </table>
    <?php if($creation_allowed) { ?>
    <a href="<?php echo base_url('group/add_module/'.$group->id); ?>" class="btn btn-success"><?php echo $this->lang->line('add'); ?></a>
    <?php } else { ?>
    <a style="cursor: not-allowed;" href="#" class="btn btn-secondary"><?php echo $this->lang->line('add'); ?></a>
    <?php } ?>
</div>