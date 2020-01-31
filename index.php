<?php wp_head(); ?>

<h1>Floor Plans</h1>




<form method="GET">

  <select name="orderby" id="orderby">
    <option
      value="date"
      <?php echo selected($_GET['orderby'], 'date'); ?>
    >
    Newest to Oldest
    </option>
    <option
    value="title"
    <?php echo selected($_GET['orderby'], 'title'); ?>
    >
    Alphabetical
    </option>
  </select>

  <input
    id="order"
    type="hidden"
    name="order"
    value="<?php echo (isset($_GET['order']) && $_GET['order'] == 'ASC') ? 'ASC' : 'DESC'; ?>" 
  />


  <?php

  $terms = get_terms([
    'taxonomy' => 'home_type',
    'hide_empty' => false
  ]);

  foreach ($terms as $term) :

  ?>

  <label>

      <input
        type="checkbox"
        name="home_type[]"
        value="<?php echo $term->slug; ?>"
        <?php checked(
          (isset($_GET['home_type']) && in_array($term->slug, $_GET['home_type']))
        ) ?>
      />

      <?php echo $term->name; ?>

    </label>

  <?php endforeach; ?>
  
  
  <button type="submit">Apply</button>

</form>




<div class="wrapper">

  <?php
    if(have_posts()){
      while(have_posts()){ the_post();
      ?>
      
      <div class="home-card">

      <?php
      if(has_post_thumbnail()){
        the_post_thumbnail('full');
      }
      ?>

      <h3><?php the_title(); ?></h3>

      <?php
        $term_obj_list = get_the_terms($post->ID, 'home_type');
        echo '<strong>Type:</strong> ' . join(', ', wp_list_pluck($term_obj_list, 'name'));
      ?>

      </div>
    
      <?php
      }   
    }
  ?>

</div>

<?php wp_footer(); ?>
