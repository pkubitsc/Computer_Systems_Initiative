<?php foreach ($posts as $user_post) { ?>
        <div class="form">
            <br/>                  
                <div class="post">
                        <?php if ($function == 'get_parent_post') { ?>
                                <h2 class="title">Original Post</h2>
                        <?php } ?>
			<h2 class="title">
                                <img src="<?php echo $base_url;?>images/user_images/<?php echo $user_post['profile_image']; ?>"></img>
                                <a href="<?php echo $base_url;?>index.php/home/view_other_profile/<?php echo $user_post['user_id'];?>"><?php echo $user_post['username'] ?></a>
                        </h2> &nbsp;&nbsp;&nbsp;
			<p class="meta">Posted On: <?php echo $user_post['created'] ?></p>
			<div class="entry">
                                <p><?php echo $user_post['post_content']?></p>
                            
                                <a href="<?php echo $base_url; ?>index.php/home/see_replies/<?php echo $user_post['post_id'];?> "> Comments (<?php echo $user_post['post_replies']; ?>)</a> &nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;
                                <?php if ($user_post['is_liked'] != 0) { ?>
                    			 <a href="<?php echo $base_url;?>index.php/home/likepost/<?php echo $user_post['post_id']; ?>">Dislike</a>
                                <?php } else { ?>
                                        <a href="<?php echo $base_url;?>index.php/home/likepost/<?php echo $user_post['post_id']; ?>">Like</a>
                                <?php } ?>
                        
                                &nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;
                                <?php echo $user_post['post_likes']; ?> &nbsp;Likes
                                <?php if ($user_post['parent_id'] != 0) { ?>
                                        &nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp; In reply to <a href="<?php echo $base_url;?>index.php/home/see_replies/<?php echo $user_post['parent_id'];?>/"> Hoot #<?php echo $user_post['parent_id'];?></a>
                                <?php }?>
			</div>
                </div>
        </div>      
<?php } ?>
