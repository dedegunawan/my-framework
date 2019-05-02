<!-- Form horizontal -->
<div class="panel panel-flat">
    <?php $this->load->view('alert');?>
    <div class="panel-body">
        <form class="form-horizontal" action="" method="post">
            <fieldset class="content-group">

                <div class="form-group <?=trim(form_error('lokasi'))!=''?'has-error':'';?>">
                    <label class="control-label col-lg-2">Lokasi</label>
                    <div class="col-lg-10">
                        <select name="lokasi" class="form-control" onchange="changeSelected(event, this)">
                            <option value="" selected="selected">--Pilih Salah satu--</option>
                            <?php
                            $selected_lokasi_menu = $this->session->userdata('lokasi_menu');
                            if (@$lokasi_menus && is_array($lokasi_menus)) {
                                foreach ($lokasi_menus as $lokasi_menu) {
                                    $selected = $selected_lokasi_menu==$lokasi_menu['lokasi']?' selected="selected" ':'';
                                    ?>
                                    <option value="<?=$lokasi_menu['lokasi'];?>" <?=$selected;?>><?=$lokasi_menu['lokasi'];?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <?php echo form_error('lokasi', '<span class="help-block">', '</span>'); ?>
                    </div>
                </div>
                <div class="form-group <?=trim(form_error('nama_menu'))!=''?'has-error':'';?>">
                    <label class="control-label col-lg-2">Nama Menu</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="nama_menu" value="<?=@$default_nama_menu;?>">
                        <?php echo form_error('nama_menu', '<span class="help-block">', '</span>'); ?>
                    </div>
                </div>
                <div class="form-group <?=trim(form_error('url'))!=''?'has-error':'';?>">
                    <label class="control-label col-lg-2">URL</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="url" value="<?=@$default_url;?>">
                        <?php echo form_error('url', '<span class="help-block">', '</span>'); ?>
                    </div>
                </div>

                <div class="form-group <?=trim(form_error('icon'))!=''?'has-error':'';?>">
                    <label class="control-label col-lg-2">Icon</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="icon" value="<?=@$default_icon;?>">
                        <?php echo form_error('icon', '<span class="help-block">', '</span>'); ?>
                    </div>
                </div>

                <div class="form-group <?=trim(form_error('parent'))!=''?'has-error':'';?>">
                    <label class="control-label col-lg-2">Parent</label>
                    <div class="col-lg-10">
                        <select name="parent" class="form-control">
                            <option value="" selected="selected">--Sebagai Menu Utama--</option>
                            <?php
                            if (@$parents && is_array($parents)) {
                                foreach ($parents as $parent) {
                                    $selected = $default_parent==$parent['lokasi']?' selected="selected" ':'';
                                    ?>
                                    <option value="<?=$parent['id'];?>" <?=$selected;?>><?=$parent['nama_menu'];?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <?php echo form_error('parent', '<span class="help-block">', '</span>'); ?>
                    </div>
                </div>

                <div class="form-group <?=trim(form_error('urutan'))!=''?'has-error':'';?>">
                    <label class="control-label col-lg-2">Urutan</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="urutan" value="<?=@$default_urutan;?>">
                        <?php echo form_error('urutan', '<span class="help-block">', '</span>'); ?>
                    </div>
                </div>

                <div class="form-group <?=trim(form_error('groups'))!=''?'has-error':'';?>">
                    <label class="control-label col-lg-2">Group</label>
                    <div class="col-lg-10">
                        <select multiple="multiple" class="select2group" name="groups[]">
                            <?php
                            if (@$groups && is_array($groups)) {
                                foreach ($groups as $group) {
                                    $selected = ($default_groups && is_array($default_groups) && in_array($group['id'], $groups))
                                        ? 'selected="selected"' : '';
                                    ?>
                                    <option value="<?=$group['id'];?>" <?=$selected;?>><?=$group['description'];?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <?php echo form_error('groups', '<span class="help-block">', '</span>'); ?>
                    </div>
                </div>

            </fieldset>
            <div class="text-right">
                <button type="submit" class="btn btn-primary">Tambah <i class="icon-arrow-right14 position-right"></i></button>
            </div>
        </form>
    </div>
</div>
<!-- /form horizontal -->

<?php buffer_start('scripts');?>
<?php $this->load->view('select2');?>
<script>
    $('.select2group').select2();
    function changeSelected(event, el) {
        event.preventDefault();
        var current = $(el).find('option:selected').val();
        $.ajax({
            type: 'post',
            url: '<?=base_url("/super_admin/menus/ganti_lokasi_menu");?>',
            data: {
                lokasi_menu: current
            },
            success: function (a, b) {
                window.location.href=window.location;
            }
        })

    }
</script>
<?php buffer_end();?>


