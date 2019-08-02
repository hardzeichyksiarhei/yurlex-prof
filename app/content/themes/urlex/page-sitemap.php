<?php /* Template Name: Карта сайта */ ?>

<?php get_header(); ?>

<section class="single-post">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
          <h1 class="title"><?php the_title(); ?></h1>
          <?php $image = get_the_post_thumbnail_url($post->ID, 'large'); ?>
          <?php if ($image) : ?>
              <img class="img-responsive w-50 mr-4 rounded-7 img-thumbnail" align="left" src="<?php echo $image; ?>" alt="">
          <?php endif;?>
          <h2>Категории:</h2>
          <ul>
            <?php
            $cats = get_categories('exclude=');
            foreach ($cats as $cat) {
              echo '<li><h3 style="display: inline-block;">' . $cat->cat_name . '</h3>';
              echo "<ul>";
              query_posts('posts_per_page=-1&cat='.$cat->cat_ID);
              while(have_posts()) {
                the_post();
                $category = get_the_category();
                if ($category[0]->cat_ID == $cat->cat_ID) {
                  echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a></li>';
                }
              }
              echo "</ul>";
              echo "</li>";
            }
            ?>
          </ul>
          <h2>Страницы:</h2>
          <ul>
            <?php
            wp_list_pages(
              array(
                'exclude' => '',
                'title_li' => '',
                )
              );
            ?>
          </ul>
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>
