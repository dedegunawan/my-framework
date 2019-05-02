<div class="row">
    <?php
    if (@$link_datas && is_array($link_datas)) {
        foreach ($link_datas as $link_data) {
            ?>
            <div class="col-lg-3 col-md-6 link-hover" data-href="<?=$link_data['href'];?>">
                <div class="panel panel-body">
                    <div class="media">
                        <div class="media-left">
                            <i class="<?=$link_data['icon'];?>"></i>
                        </div>

                        <div class="media-body">
                            <h6 class="media-heading"><?=$link_data['title'];?></h6>
                            <p class="text-muted"><?=$link_data['subtitle'];?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>