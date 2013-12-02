<?php
$biography = array(
	'name'	=> 'biography',
	'id'	=> 'biography',
	'value' => set_value('biography'),
	'maxlength'	=> 255,
        'rows' => 5,
        'columns' => 10,
	'size'	=> 30,
);
?>

<?php echo form_open_multipart($this->uri->uri_string()); ?>
<table>
        <tr>
                <td>
                        <table>
                            <tr>
                                <td><img src="http://localhost/project/images/user_images/original/<?php echo $user->profile_image;?>"></img></td>
                            </tr>
                            <tr>
                                <td><a href="http://localhost/project/index.php/auth/change_profile_image/">Change Profile Image</a></td>
                            </tr>
                        </table>
                </td>
                <td>
                    <!-- show and change everything else -->
                    <table>
                        <tr>
                            <td>Username - </td>
                            <td><?php echo $user->username?></td>
                        </tr>
                        <tr>
                            <td>Name - </td>
                            <td><?php echo $user->first_name?> <?php echo $user->last_name?></td>
                        </tr>
                        <tr>
                            <td><a href="http://localhost/project/index.php/auth/change_email/">Change Email</a></td>
                        </tr>
                        <tr>
                            <td><a href="http://localhost/project/index.php/auth/change_password/">Change Password</a></td>
                        </tr>
                        <tr>
                            <td><?php echo form_label('Biography', $biography['id']); ?></td>
                            <td><?php echo $user->biography; ?></td>
                            <td><?php echo form_textarea($biography); ?></td>
                            <td style="color: red;"><?php echo form_error($biography['name']); ?></td>
                        </tr>
                    </table>
                </td>
        </tr>
</table>

<?php echo form_submit('change', 'Change'); ?>
<?php echo form_close(); ?>