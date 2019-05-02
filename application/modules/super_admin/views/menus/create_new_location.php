<!-- Form horizontal -->
<div class="panel panel-flat">
    <?php $this->load->view('alert');?>
    <div class="panel-body">
        <form class="form-horizontal" action="" method="post">
            <fieldset class="content-group">

                <div class="form-group <?=trim(form_error('lokasi'))!=''?'has-error':'';?>">
                    <label class="control-label col-lg-2">Lokasi</label>
                    <div class="col-lg-10">
                        <input type="text" class="form-control" name="lokasi" value="<?=@$default_lokasi;?>">
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
</script>
<?php buffer_end();?>


