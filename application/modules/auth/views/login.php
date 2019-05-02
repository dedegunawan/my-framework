<!-- Advanced login -->
<form action="" method="post">
    <div class="panel panel-body login-form">
        <div class="text-center">
            <div class="icon-object border-sucess-400 text-success-400" style="padding: 10px;border-width: 2px;">
                <i class="fa fa-cube"></i>
            </div>
            <h5 class="content-group-lg">
                <?=$this->lang->line('login_heading');?>
                <small class="display-block"><?=$this->lang->line('login_subheading');?></small>
            </h5>
        </div>

        <?php
        \DedeGunawan\MyFramework\Helper\Alert::show_messages();
        ?>

        <div class="form-group has-feedback has-feedback-left">
            <input type="text" class="form-control" placeholder="<?=$this->lang->line('login_identity_label');?>" name="identity" id="identity">
            <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
            </div>
        </div>

        <div class="form-group has-feedback has-feedback-left">
            <input type="password" class="form-control" placeholder="<?=$this->lang->line('login_password_label');?>" name="password" id="password">
            <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
            </div>
        </div>

        <div class="form-group login-options">
            <div class="row">
                <div class="col-sm-6">
                    <label class="checkbox-inline">
                        <input type="checkbox" class="styled" name="remember" id="remember">
                        <?=$this->lang->line('login_remember_label');?>
                    </label>
                </div>

                <div class="col-sm-6 text-right">
                    <a href="<?=base_url('/auth/forgot_password');?>">
                        <?=$this->lang->line('login_forgot_password');?>
                    </a>
                </div>
            </div>
        </div>

        <div class="form-group">
            <button type="submit" class="btn bg-blue btn-block"><?=$this->lang->line('login_submit_btn');?> <i class="icon-circle-right2 position-right"></i></button>
        </div>
    </div>
</form>
<!-- /advanced login -->