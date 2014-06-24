<?php /* Template Name: UC-Email */ ?>
<?php // remove all but the wanted area and then move backwards ?>
<?php //get_header(); ?>
<main class="spine-single-template">
  <?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
    <?php //get_template_part('parts/headers'); ?>
      <section class="row single">
        <div class="column one">
          <?php //get_template_part('articles/article'); ?>
        </div><!--/column-->
        <section class="lib-work">
          <h3>Library of work</h3>
          <div class="smallM">
            <div class="metro">
              <nav>
                <?php
                  global $post;
                  $args = array( 'posts_per_page' => 12, 'tag' => 'email' );
                  $myposts = get_posts( $args);
                  foreach( $myposts as $post ) {
                  setup_postdata($post);
                  $thumb_url = wp_get_attachment_thumb_url( $post->ID );
                ?>
                <ul>
                  <li <?php if($thumb_url!=""){ ?>style="background:url('<?=$thumb_url?>');" <?php } ?> ><ul class="label">
                  <h3><?php the_title(); ?></h3>
                  <a href="' . get_permalink( $thumbnail->ID ) . '" title="' . esc_attr( $thumbnail->post_title ) . '"><ul class="label">
                  <li class="descripto"><?php the_excerpt(); ?></li> </ul></li>
                </ul>
                <?php } ?>
              </nav>
            </div>
          </div>
        </section>  
      </section> 
</main>
<?php get_footer(); ?>