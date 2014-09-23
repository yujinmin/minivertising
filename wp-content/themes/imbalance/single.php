<?php get_header(); ?> 
<?php get_sidebar(); ?>  
            <div id="main">
              <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
				<div class="entry">
                <div class="postmetadata">
                    <p class="client"><?php the_excerpt(); ?></p>
                    <p class="cate"><?php printf(__('%s'), get_the_category_list(', ')); ?></p>
                    <p class="date"><?php the_time(__('F jS, Y', 'kubrick')) ?></p>
                </div>
                <h1><?php the_title(); ?></h1>
                <div class="article" id="post-<?php the_ID(); ?>">
                    <?php the_content(); ?>
                    <div class="postmetadata"><?php the_tags(__('<span>Tagged in:</span>') . ' ', ', ', '<br />'); ?>
                    
                    </div>
                </div>
                
                <div id="comments">
					<?php comments_template(); ?>
                </div>
            <?php endwhile; ?>
            <?php else : ?>
                <h1 id="error"><?php _e("Sorry, but you are looking for something that isn&#8217;t here."); ?></h1>
            <?php endif; ?>
            </div>         
            </div>

<?php get_footer(); ?>
