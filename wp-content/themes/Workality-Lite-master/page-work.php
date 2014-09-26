<?php
	include_once("_header.php");
?>
    <div id="post-list" class="row">
<?php
	$query = "SELECT * FROM wp_posts WHERE post_type='post' AND post_status <> 'auto-draft' ORDER BY ID DESC";
	$res = mysqli_query($my_db, $query);
		while($data = mysqli_fetch_array($res))
		{
			$query_options = "SELECT option_value FROM wp_options WHERE option_name='home'";
			list($home) = mysqli_fetch_array(mysqli_query($my_db, $query_options));
			$date_array1 = explode(" ",$data[post_date]);
			$date_array2 = explode("-",$date_array1[0]);

			$query_meta = "SELECT meta_key, meta_value FROM wp_postmeta WHERE post_id='".$data[ID]."'";
			$res_meta = mysqli_query($my_db, $query_meta);
			
			while($meta_data = mysqli_fetch_array($res_meta))
			{
				if ($meta_data[meta_key] == "_thumbnail_id")
				{
					$query_meta_re = "SELECT post_title FROM wp_posts WHERE ID='".$meta_data[meta_value]."'";
					list($thumb_img) = mysqli_fetch_array(mysqli_query($my_db, $query_meta_re));
					$thumb_flag = 1;
				}else{
					$thumb_flag = 2;
				}
			}
?>
      <div class="one-third column featured project-item" >
        <div class="imgdiv">
          <a href="<?=$data[guid]?>" class="getworks" data-type="works" data-id="22" data-token="5b4ac08af1">
            <span></span>
<?php
	if ($thumb_flag == 1)
	{
?>
            <img src="<?=$home?>wp-content/uploads/<?php echo $date_array2[0]?>/<?php echo $date_array2[1]?>/<?=$thumb_img?>.png" data-small="<?=$home?>wp-content/uploads/<?php echo $date_array2[0]?>/<?php echo $date_array2[1]?>/<?=$thumb_img?>-150x113.png" data-large="<?=$home?>wp-content/uploads/<?php echo $date_array2[0]?>/<?php echo $date_array2[1]?>/<?=$thumb_img?>-300x226.png" noimage="" title="<?=$data[post_title]?>" alt="<?=$data[post_title]?>" />
<?php
	}else{
?>
            <img src="<?=$home?>wp-content/themes/Workality-Lite-master/images/no-image.jpg" data-small="<?=$home?>wp-content/themes/Workality-Lite-master/images/no-image.png-150x113.jpg" data-large="<?=$home?>wp-content/themes/Workality-Lite-master/images/no-image.png-300x226.jpg" title="<?=$data[post_title]?>" alt="<?=$data[post_title]?>" />
<?php
	}
?>
          </a>
        </div>
        <div class="thumb_large">
          <h5><a href="<?=$data[guid]?>" class="getworks" data-type="works" data-id="22" data-token="5b4ac08af1"><?=$data[post_title]?></a></h5>
          <p><?=$data[post_excerpt]?></p>
        </div>  
      </div>
<?php
		}
?>
      <br class="clear rowseperator">
    </div>  
<?php
	include_once("_footer.php");
?>