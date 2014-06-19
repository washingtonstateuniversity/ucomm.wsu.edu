<?php /* Template Name: UC-Email */ ?>

<?php get_header(); ?>

<main class="spine-single-template">

  <?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>
  <?php get_template_part('parts/headers'); ?>

<section class="row single">
  <div class="column one">
    <?php get_template_part('articles/article'); ?>
  </div><!--/column-->
  <section class="lib-work">
    <h3>Library of work</h3>
    <?php 
      $thumbnails = get_posts(array('posts_per_page' => 9,'tag' => 'email'));
      foreach ($thumbnails as $thumbnail) {
        if ( has_post_thumbnail($thumbnail->ID)) {
          echo '<a href="' . get_permalink( $thumbnail->ID ) . '" title="' . esc_attr( $thumbnail->post_title ) . '">';
          echo get_the_post_thumbnail($thumbnail->ID, 'thumbnail');
          echo '</a>';
        }
      }
    ?>
  </section>  
</section>

<?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>    