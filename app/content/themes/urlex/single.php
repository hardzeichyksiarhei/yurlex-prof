<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<section class="single-post">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="breadcrumbs fz-14" typeof="BreadcrumbList" vocab="https://schema.org/">
          <?php if(function_exists('bcn_display'))
          {
            bcn_display();
          }?>
        </div>
          <p class="fz-14">Дата публикации: <span class="accent-text"><?php the_date(); ?></span> | Категории: <?php the_category(', '); ?></p>
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
