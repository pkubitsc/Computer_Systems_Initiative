<?php
$profile_image = array(
	'name'	=> 'profile_image',
	'id'	=> 'profile_image',
	'value' => set_value('profile_image'),
);

?>
<?php echo form_open_multipart($this->uri->uri_string()); ?>

<table>
        <tr>
                <td><img src="http://localhost/project/images/user_images/original/<?php echo $user->profile_image;?>"></img></td>
        </tr>
</table>
<table>
        <tr>
		<td><?php echo form_label('Profile Image', $profile_image['id']); ?></td>
                <td><input type="file" name="userfile" size="20" /></td>
		<td style="color: red;"><?php echo form_error($profile_image['name']); ?></td>
	</tr>
</table>
<?php echo form_submit('upload', 'Upload'); ?>
<?php echo form_close(); ?>