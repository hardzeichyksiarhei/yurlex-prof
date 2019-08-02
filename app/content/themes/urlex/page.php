<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<section class="single-post">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
          <h1 class="title"><?php the_title(); ?></h1>
          <?php $image = get_the_post_thumbnail_url($post->ID, 'large'); ?>
          <?php if ($image) : ?>
              <img class="img-responsive w-50 mr-4 rounded-7 img-thumbnail" align="left" src="<?php echo $image; ?>" alt="">
          <?php endif;?>
          <?php the_content(); ?>
      </div>
    </div>
  </div>
</section>
<?php endwhile; endif; ?>

<?php get_footer(); ?>