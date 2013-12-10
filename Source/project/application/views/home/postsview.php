<?php
if (empty($errors)) {
    $post = array(
            'name'	=> 'post',
            'id'	=> 'post',
            'value'	=> '',
            'maxlength'	=> 200,
            'rows' => 3,
    );
} else {
     $post = array(
            'name'	=> 'post',
            'id'	=> 'post',
            'value'	=> set_value('post'),
            'maxlength'	=> 200,
            'rows' => 3,
    );   
}
?>

<!-- HEADER -->
<?php include_once(__DIR__."/header.php"); ?>

<!-- Parent Post SECTION -->  
<div id="parent_post"></div>          

<?php 
if (isset($errors)) {
    foreach ($errors as $error_key => $error_value) {
        echo $error_value."<br/>";
    }
} 
?>		

<!-- ADD POST SECTION --> 
<?php if ($type_page != 'followed') { ?>
<div class="form">
      <br/>      
                  
	<?php
        if (!isset($parent_post)) {
                echo form_open('home/addpost/');
        } else {
                echo form_open('home/addpost/'.$id);
        }
        ?>
            <div>
                        <?php
                        if (isset($parent_post)) {
                                echo form_label('Reply', $post['id']);
                        } else {
                                echo form_label('Add a Post', $post['id']);
                        }
                        ?>
            </div>
            <div>
                    <?php echo form_textarea($post); ?>
                    <div id="characterLeft"></div>
            </div>
            <div>
                    <?php echo form_submit('submit', 'Submit'); ?>
            </div>
                <?php echo form_error($post['name']); ?>
        <?php echo form_close(); ?>
</div>
<?php } ?>

<!-- PAGES -->
<div id="pages0"></div>         

<!-- POSTS -->
<div id="posts"></div>

<!-- PAGES -->
<div id="pages1"></div>           
<br /><br />       

<!-- FOOTER -->
<?php include_once(__DIR__."/footer.php"); ?>