<?php get_header(); ?>

<section class="mb-0">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <p class="current-search">Результаты поиска по: <span><?php echo get_search_query(); ?></span></p>
      </div>
    </div>
  </div>
</section>

<?php if (have_posts()) : ?>
<section class="category-posts mt-0">
  <div class="container">
    <div class="posts-grid clearfix" data-columns>
      <?php while (have_posts()) : the_post(); ?>
        <div class="preview-post content-block content-block--shadow content-block--radius">
          <?php $image = get_the_post_thumbnail_url($post->ID, 'large'); ?>
          <?php if ($image) : ?>
              <img class="img-responsive" src="<?php echo $image; ?>" alt="">
          <?php endif;?>
          <div class="preview-post__body">
            <div class="preview-post__meta">
              <time class="preview-post__date" datetime="<?php echo get_the_date('Y-m-d g:i:s'); ?>"><?php echo get_the_date('j M Y'); ?></time> /
              <span class="preview-post__categories"><?php the_category(' · '); ?></span>
            </div>
            <h4 class="preview-post__title mb-0"><?php the_title(); ?></h4>
            <p class="preview-post__excerpt mb-0"><?php echo get_the_excerpt(); ?></p>
          </div>
          <div class="preview-post__footer">
              <a class="preview-post__link" href="<?php echo get_the_permalink(); ?>" title="Подробнее">Читать далее...</a>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
    <?php the_posts_pagination(); ?>
  </div>
</section>
<?php endif; ?>

<?php get_footer(); ?>