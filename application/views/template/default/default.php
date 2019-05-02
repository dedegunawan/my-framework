<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php
        $this->load->view('template/default/title');
        ?>
    </title>

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
        .link-hover {
            cursor: pointer;
        }
        .pop-image {
            cursor: pointer;
        }
    </style>

</head>

<body class="navbar-top-md-xs">

<!-- Multiple navbars wrapper -->
<div class="navbar-fixed-top">

    <!-- Main navbar -->
    <div class="navbar navbar-inverse">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.html">SNMPTN UNSIL 2019</a>

            <ul class="nav navbar-nav pull-right visible-xs-block">
                <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            </ul>
        </div>

        <div class="navbar-collapse collapse" id="navbar-mobile">

            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown dropdown-user">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <span><?=DedeGunawan\MyFramework\Helper\Profile::get_auth_profile('first_name+last_name');?></span>
                        <i class="caret"></i>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="<?=base_url('auth/change_password');?>"><i class="icon-cog5"></i> Ganti Password</a></li>
                        <li><a href="<?=base_url('auth/logout');?>"><i class="icon-switch2"></i> Keluar</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- /main navbar -->


    <!-- Second navbar -->
    <div class="navbar navbar-default navbar-xs">
        <ul class="nav navbar-nav no-border visible-xs-block">
            <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-circle-down2"></i></a></li>
        </ul>

        <div class="navbar-collapse collapse" id="navbar-second-toggle">
            <ul class="nav navbar-nav">
            <?php
            if ($this->ion_auth->is_admin()) {
                ?>
                <li class=""><a href="<?=base_url('/super_admin');?>"><i class="fa fa-home"></i> Dashboard</a></li>
                <li class=""><a href="<?=base_url('/super_admin/menus');?>"><i class="fa fa-th"></i> Manajemen Menu</a></li>
                <?php
            }

            $menus = $this->menu_model->get_sub_menu('main_menu', 0);
            foreach ($menus as $menu) {
                $url = is_http($menu['url']) ? $menu['url'] : base_url($menu['url']);
                $sub_menus = $this->menu_model->get_sub_menu('main_menu', $menu['id']);
                ?>
                <li class="">
                <a href="<?=$url;?>" <?=!empty($sub_menus)?'class="dropdown-toggle" data-toggle="dropdown"':'';?>>
                    <i class="<?=$menu['icon'];?>"></i> <?=$menu['nama_menu'];?>
                    <?=(!empty($sub_menus)?'<span class="caret"></span>':'');?>
                </a>
                <?php


                if (count($sub_menus)) {
                    echo "<ul class='dropdown-menu'>";
                    foreach ($sub_menus as $sub_menu) {
                        $url = is_http($sub_menu['url']) ? $sub_menu['url'] : base_url($sub_menu['url']);
                        ?>
                        <li class=""><a href="<?=$url;?>"><i class="<?=$sub_menu['icon'];?>"></i> <?=$sub_menu['nama_menu'];?></a></li>
                        <?php

                    }
                    echo "</ul>";
                }
                ?>
                </li>
                <?php
            }
            if ($this->ion_auth->is_admin() || $this->session->userdata('enable_change_user')=='super_admin') {
                ?>
                <li class=""><a href="<?=base_url('/super_admin/users');?>"><i class="fa fa-users"></i> User</a></li>
                <?php
            }
            ?>

            </ul>

        </div>
    </div>
    <!-- /second navbar -->

</div>
<!-- /multiple navbars wrapper -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <?php
            $this->load->view('template/default/page_header');
            ?>


            <!-- Content area -->
            <div class="content">

                <?php
                echo @$content;
                ?>


                <!-- Footer -->
                <div class="footer text-muted">
                    &copy; 2018. <a href="#">Pendaftaran Ulang SNMPTN 2019</a> by <a href="https://upttik.unsil.ac.id/" target="_blank">UPT TIK Universitas Siliwangi.</a>
                </div>
                <!-- /footer -->

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

<!-- Theme JS files -->
<script src="<?=base_url('/themes/limitless/Template/layout_1/LTR/default/full/assets/js/app.js');?>"></script>
<!-- /theme JS files -->

<script>
    $(".link-hover").click(function (event) {
        event.preventDefault();
        var href = $(this).data('href');
        if (href) {
            window.location.href=href;
            return 0;
        }
    })

    $(".notification-before-delete").click(function (event) {
        event.preventDefault();
        var href = $(this).data('href');
        if (href == undefined) href = $(this).attr('href');
        var message = $(this).data('message');
        if (message == undefined) message = "Apakah anda yakin akan menghapus ini ?";

        var cf = confirm(message);
        if (cf) {
            window.location.href = href;
        }
    })

</script>

<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" data-dismiss="modal">
        <div class="modal-content"  >
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <img src="" id="imagepreview" style="width: 100%;" >
            </div>
            <div class="modal-footer">
            </div>


        </div>
    </div>
</div>

<script>
    $('.pop-image').on('click', function() {
        $('#imagepreview').attr('src', $(this).attr('src'));
        $('#imagemodal').modal('show');
    });
</script>

<?=get_buffer('scripts');?>
</body>
</html>
