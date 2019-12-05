<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
?>
<div id="page-content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div>
                    <span class="form-header"><?= $this->lang->line('user_delete_confirm').'"'.$user->user.'" ?' ?></span>
                </div>
                <div class="btn-group">
                    <?php if (!$user->archive) { ?>
                    <a href="<?= base_url(uri_string().'/1'); ?>" class="btn btn-warning btn-lg">
                        <?= $this->lang->line('btn_deactivate'); ?>
                    </a>
                    <?php } ?>
                    <a href="<?= base_url(uri_string().'/2'); ?>" class="btn btn-danger btn-lg">
                        <?= $this->lang->line('btn_delete'); ?>
                    </a>
                    <a href="<?= base_url('admin/user_index'); ?>" class="btn btn-lg">
                        <?= $this->lang->line('btn_cancel'); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>