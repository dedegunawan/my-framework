<div class="panel panel-body">
    <?php $this->load->view('alert');?>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">Pilih Lokasi Menu</label>
                <div class="">
                    <select name="select" class="form-control" onchange="changeSelected(event, this)">
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
                </div>
            </div>
        </div>
    </div>
    <a href="<?=base_url('/super_admin/menus/create');?>" class="btn btn-primary">Tambah Menu Baru</a>
    <a href="<?=base_url('/super_admin/menus/create_new_location');?>" class="btn btn-primary">Tambah Menu dengan Lokasi Baru</a>
    <table class="table datatable-basic">
        <thead>
        <tr>
            <th>No.</th>
            <th>Nama Menu </th>
            <th>Urutan </th>
            <th>URL</th>
            <th>Icon</th>
            <th>Hak Akses</th>
            <th class="text-center">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (@$menus && is_array($menus)) {
            foreach ($menus as $key => $menu) {
                $submenus = $this->menu_model->get_all_menu($menu['id']);
                ?>
                <tr>
                    <td><?=($key+1);?></td>
                    <td><?=$menu['nama_menu'];?></td>
                    <td><?=$menu['urutan'];?></td>
                    <td><a href="<?=$menu['url'];?>"><?=$menu['url'];?></a></td>
                    <td><i class="<?=$menu['icon'];?>"></i> (<?=$menu['icon'];?>)</td>
                    <td>
                        <?php
                        $groups = $this->menu_model->get_group_by_menu_ids_string($menu['groups']);
                        $groups = array_column($groups, 'description');
                        echo implode(", ", $groups);
                        ?>
                    </td>
                    <td class="text-center">
                        <?php
                        if (empty($submenus)) {
                            ?>
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="<?=base_url('/super_admin/menus/edit/'.$menu['id']);?>"><i class="fa fa-edit"></i> Edit</a></li>
                                        <li><a href="<?=base_url('/super_admin/menus/delete/'.$menu['id']);?>" class="notification-before-delete"><i class="fa fa-trash"></i> Hapus</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <?php
                        } else {
                            ?>
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="<?=base_url('/super_admin/menus/edit/'.$menu['id']);?>"><i class="fa fa-edit"></i> Edit</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
                <?php
                if (@$submenus && is_array($submenus)) {
                    foreach ($submenus as $key2 => $submenu) {
                        ?>
                        <tr>
                            <td>--(<?=($key2+1);?>)</td>
                            <td><?=$submenu['nama_menu'];?></td>
                            <td><?=$submenu['urutan'];?></td>
                            <td><a href="<?=$submenu['url'];?>"><?=$submenu['url'];?></a></td>
                            <td><i class="<?=$submenu['icon'];?>"></i> (<?=$submenu['icon'];?>)</td>
                            <td>
                                <?php
                                $groups = $this->menu_model->get_group_by_menu_ids_string($submenu['groups']);
                                $groups = array_column($groups, 'description');
                                echo implode(", ", $groups);
                                ?>
                            </td>
                            <td class="text-center">
                                <ul class="icons-list">
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>

                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li><a href="<?=base_url('/super_admin/menus/edit/'.$submenu['id']);?>"><i class="fa fa-edit"></i> Edit</a></li>
                                            <li><a href="<?=base_url('/super_admin/menus/delete/'.$submenu['id']);?>" class="notification-before-delete"><i class="fa fa-trash"></i> Hapus</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <?php
                    }
                }
            }
        }
        ?>
        </tbody>
    </table>
</div>

<?php buffer_start('scripts');?>
<?php $this->load->view('datatable');?>
<script type="application/javascript">
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

