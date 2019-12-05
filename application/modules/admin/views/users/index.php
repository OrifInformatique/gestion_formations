<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Users List View
 *
 * @author      Orif, section informatique (UlSi, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_questionnaires
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
?>
<div class="container">
    <h1 class="title-section"><?= $this->lang->line('user_list_title'); ?></h1>
    <div class="row">
        <div class="col-4">
            <a href="<?= base_url('admin/user_add'); ?>" class="btn btn-success col-12">
                <?= $this->lang->line('btn_add_user'); ?>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th><?= $this->lang->line('user_name'); ?></th>
                        <th><?= $this->lang->line('user_usertype'); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user) { ?>
                        <tr>
                            <td><a href="<?= base_url('admin/user_add/'.$user->id); ?>"><?= $user->user; ?></td>
                            <td><?= $user_types[$user->fk_user_type]; ?></td>
                            <td><a href="<?= base_url('admin/user_delete/'.$user->id); ?>" class="close">×</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>