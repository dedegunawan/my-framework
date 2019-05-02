<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login </title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="<?=base_url('/themes/limitless/Template/global_assets/css/icons/icomoon/styles.css');?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('/themes/limitless/Template/global_assets/css/icons/fontawesome/styles.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('/themes/limitless/Template/layout_1/LTR/default/full/assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('/themes/limitless/Template/layout_1/LTR/default/full/assets/css/core.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('/themes/limitless/Template/layout_1/LTR/default/full/assets/css/components.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?=base_url('/themes/limitless/Template/layout_1/LTR/default/full/assets/css/colors.min.css');?>" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    <style type="text/css">
        .with-background-black {
            background: url(<?=base_url('/assets/black-bg.png');?>);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>

</head>

<body class="login-container bg-slate-800 with-background-black">

<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                <?=@$content;?>

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->
<!-- Core JS files -->
<script src="<?=base_url('/themes/limitless/Template/global_assets/js/plugins/loaders/pace.min.js');?>"></script>
<script src="<?=base_url('/themes/limitless/Template/global_assets/js/core/libraries/jquery.min.js');?>"></script>
<script src="<?=base_url('/themes/limitless/Template/global_assets/js/core/libraries/bootstrap.min.js');?>"></script>
<script src="<?=base_url('/themes/limitless/Template/global_assets/js/plugins/loaders/blockui.min.js');?>"></script>
<!-- /core JS files -->

<!-- Theme JS files -->
<script src="<?=base_url('/themes/limitless/Template/global_assets/js/plugins/forms/styling/uniform.min.js');?>"></script>

<script src="<?=base_url('/themes/limitless/Template/layout_1/LTR/default/full/assets/js/app.js');?>"></script>
<script src="<?=base_url('/themes/limitless/Template/global_assets/js/demo_pages/login.js');?>"></script>
<!-- /theme JS files -->
</body>
</html>
<?php
/*
 <h1><?php echo lang('login_heading');?></h1>
<p><?php echo lang('login_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/login");?>

  <p>
    <?php echo lang('login_identity_label', 'identity');?>
    <?php echo form_input($identity);?>
  </p>

  <p>
    <?php echo lang('login_password_label', 'password');?>
    <?php echo form_input($password);?>
  </p>

  <p>
    <?php echo lang('login_remember_label', 'remember');?>
    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
  </p>


  <p><?php echo form_submit('submit', lang('login_submit_btn'));?></p>

<?php echo form_close();?>

<p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
 */
?>