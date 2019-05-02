<!-- Advanced login -->
<form action="" method="post">
    <div class="panel panel-body login-form">
        <div class="text-center">
            <div class="icon-object border-sucess-400 text-success-400" style="padding: 10px;border-width: 2px;">
                <i class="fa fa-key"></i>
            </div>
            <h5 class="content-group-lg">
                <?php echo $this->lang->line('forgot_password_heading');?>
                <small class="display-block"><?=sprintf($this->lang->line('forgot_password_subheading'), $identity_label);?></small>
            </h5>
        </div>

        <?php
        \DedeGunawan\MyFramework\Helper\Alert::show_messages();
        ?>

        <div class="form-group has-feedback has-feedback-left">
            <input type="text" class="form-control" placeholder="<?=(($type=='email') ? sprintf($this->lang->line('forgot_password_email_label'), $identity_label) : sprintf($this->lang->line('forgot_password_identity_label'), $identity_label));?>" name="identity" id="identity" value="<?=set_value('identity');?>">
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn bg-blue btn-block"><?=$this->lang->line('forgot_password_submit_btn');?> <i class="icon-circle-right2 position-right"></i></button>
            <a href="<?=base_url('/auth/login');?>" class="btn btn-default btn-block"><i class="icon-circle-left2 position-left"></i> Kembali</a>
        </div>
    </div>
</form>
<!-- /advanced login -->