
<!-- Advanced login -->
<form action="" method="post">
    <div class="panel panel-body login-form">
        <div class="text-center">
            <div class="icon-object border-sucess-400 text-success-400" style="padding: 10px;border-width: 2px;">
                <i class="fa fa-key"></i>
            </div>
            <h5 class="content-group-lg">
                <?php echo $this->lang->line('reset_password_heading');?>
                <small class="display-block"><?=sprintf($this->lang->line('reset_password_subheading'));?></small>
            </h5>
        </div>

        <?php
        \DedeGunawan\MyFramework\Helper\Alert::show_messages();
        ?>

        <div class="form-group has-feedback has-feedback-left">
            <?=form_input($new_password);?>
            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
            </div>
        </div>
        <div class="form-group has-feedback has-feedback-left">
            <?=form_input($new_password_confirm);?>
            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
            </div>
        </div>
        <?=form_input($user_id);?>
        <div class="form-group">
            <button type="submit" class="btn bg-blue btn-block"><?=$this->lang->line('reset_password_submit_btn');?> <i class="icon-circle-right2 position-right"></i></button>
        </div>
    </div>
</form>
<!-- /advanced login -->
