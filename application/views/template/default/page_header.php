<!-- Page header -->
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4>
                <?=@$page_title;?>
            </h4>
            <?php
            if (@$back_button) {
                ?>
                <div class="heading-elements">
                    <a href="<?=@$back_button['url'];?>" class="btn <?=@$back_button['class']?$back_button['class']:'btn-primary';?> heading-btn"><?=@$back_button['caption']?$back_button['caption']:"Kembali";?></a>
                </div>
                <?php
            }
            ?>

        </div>
    </div>

    <?php
    /*
     <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="layout_navbar_fixed_both.html">Starters</a></li>
            <li class="active">Fixed both</li>
        </ul>

        <ul class="breadcrumb-elements">
            <li><a href="#"><i class="icon-comment-discussion position-left"></i> Link</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="icon-gear position-left"></i>
                    Dropdown
                    <span class="caret"></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                    <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                    <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                    <li class="divider"></li>
                    <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
                </ul>
            </li>
        </ul>
    </div>
     */
    ?>
</div>
<!-- /page header -->