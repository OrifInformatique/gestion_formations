<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Login View (Form to login).
 *
 * @author      Orif, section informatique (UlSi, ViDi)
 * @link        https://github.com/OrifInformatique/gestion_formations
 * @copyright   Copyright (c) Orif (http://www.orif.ch)
 */
?>

<div class="container">
    <div class="jumbotron">
        <h1><?php echo $this->lang->line('app_title'); ?></h1>
        <p><?php echo $this->lang->line('indic_login'); ?></p>
    </div>
    <div class="well">
        <?php
        $attributes = array("class" => "form-group",
            "id" => "loginform",
            "name" => "loginform");
        echo form_open('Auth/login', $attributes);
        ?>
        <div class="row">
            <div class="col-lg-4">
                <?php
                    switch ($error){
                        case 1:
                            echo "<p class='alert alert-warning'>" . $this->lang->line('invalid_id') . "</p>";
                            break;
                        case 2:
                            echo "<p class='alert alert-danger'>" . $this->lang->line('no_id') . "</p>";
                            break;
                        default:
                            break;
                    }
                ?>
            </div>
        </div>
        <div class="form-group">
            <?php
            echo form_label($this->lang->line('field_username'), 'username')
            ?>
            <div class="row">
                <div class="col-lg-4">
                    <?php
                    echo form_input('username', '',
                        array(
                            'class' => 'form-control', 'id' => 'username',
                            'aria-describedby' => $this->lang->line('login_enter_username'),
                            'placeholder' => $this->lang->line('placeholder_login_username')
                        ))
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?php
            echo form_label($this->lang->line('field_password'), 'password')
            ?>
            <div class="row">
                <div class="col-lg-4">
                    <?php
                    echo form_password('password', '',
                        array(
                            'class' => 'form-control', 'id' => 'password',
                            'placeholder' => $this->lang->line('placeholder_login_password')
                        ));
                    ?>
                </div>
            </div>
        </div>

        <?php echo form_submit('submit', $this->lang->line('btn_login'), 'class="btn btn-primary"') ?>
        
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#username')[0].focus();
    });
</script>