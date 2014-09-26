<?php
	include_once("_header.php");
?>
    <div class="works-single hidden"></div>
    <br class="clear">

    <div id="post-list" class="row blogpage fitvids">
      <div class="sixteen columns">
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

        <div class="post-<?=$data[ID]?> post type-post status-publish format-standard has-post-thumbnail hentry category-uncategorized blogpost border-color">
          <h3><a href="<?= $data[guid]?>" data-type="blog" data-id="<?= $data[ID]?>" data-token="2f67468a67"><?=$data[post_title]?></a></h3>
          <div class="title border-color">
            <strong>Category :</strong> <a href="http://minivertising.cafe24.com/?cat=1" rel="category">Uncategorized</a> 
            · <a href="<?= $data[guid]?>#comments">No Comments</a>
            · by <a href="http://minivertising.cafe24.com/?author=1" title="Posts by minivertising" rel="author">minivertising</a>
            <span class="datetime"><?=substr($data[post_date],0,10)?></span>
          </div>

          <a href="<?=$data[guid]?>" data-type="blog" data-id="<?=$data[ID]?>" data-token="2f67468a67">
<?php
	if ($thumb_flag == 1)
	{
?>
            <img width="305" height="230" src="<?=$home?>/wp-content/uploads/<?php echo $date_array2[0]?>/<?php echo $date_array2[1]?>/<?=$thumb_img?>.png" class="postThumb wp-post-image" alt="<?=$data[post_title]?>" title="<?=$data[post_title]?>" />
<?php
	}else{
?>
            <img width="305" height="230" src="<?=$home?>/wp-content/themes/Workality-Lite-master/images/no-image.jpg" class="postThumb wp-post-image" alt="<?=$data[post_title]?>" title="<?=$data[post_title]?>" />
<?php
	}
?>
          </a>
          <p><?=$data[post_excerpt]?></p>
          <div class="bottom">
            <a href="<?=$data[guid]?>" class="activemenu-bg readmore" data-type="blog" data-id="<?=$data[ID]?>" data-token="2f67468a67">Read More...</a>
            <span class="loop-tags"></span>
          </div>
        </div>
<?php
		}
?>
        <div class="navigation-bottom">
        </div>
      </div>
    </div>
<?php
	include_once("_footer.php");
?>