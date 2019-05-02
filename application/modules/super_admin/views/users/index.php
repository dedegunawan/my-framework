<!-- Simple panel -->
<div class="panel panel-flat">

    <div class="panel-body">
        <table class="table">
            <tr>
                <th>Username</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Group</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php foreach ($users as $user):?>
                <tr>
                    <td><?php echo htmlspecialchars($user['username'],ENT_QUOTES,'UTF-8');?></td>
                    <td><?php echo htmlspecialchars($user['first_name']." ".$user['last_name'],ENT_QUOTES,'UTF-8');?></td>
                    <td><?php echo htmlspecialchars($user['email'],ENT_QUOTES,'UTF-8');?></td>
                    <td>
                        <?php
                        $groups = $this->ion_auth->get_users_groups($user['id'])->result_array();
                        ?>
                        <?php foreach ($groups as $group):?>
                            <?php echo anchor("/super_admin/users/edit_group/".$group['id'], htmlspecialchars($group['name'],ENT_QUOTES,'UTF-8')) ;?><br />
                        <?php endforeach?>
                    </td>
                    <td><?php echo ($user['active']) ? anchor("/super_admin/users/deactivate/".$user['id'], 'Nonaktifkan') : anchor("/super_admin/users/activate/". $user['id'], 'Aktifkan');?></td>
                    <td>
                        <?php echo anchor("/super_admin/users/edit_user/".$user['id'], 'Edit') ;?>
                        <br>
                        <a href="<?=base_url("/super_admin/users/change_user/".$user['id']);?>" class="notification-before-delete" data-message="Apakah anda yakin akan login menggunakan user dengan UserID (<?=$user['id'];?>)">Login&gt;&gt;</a>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>

        <p><?php echo anchor('/super_admin/users/create_user', 'Buat User Baru')?> | <?php echo anchor('/super_admin/users/create_group', 'Buat Group Baru')?></p>
    </div>
</div>
<!-- /simple panel -->