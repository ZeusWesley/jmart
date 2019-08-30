<?php include "styles.php" ?>

<form action="<?php echo site_url() ?>/wp-admin/admin-ajax.php" method="POST" id="filter"> <?php
    if( $terms = get_terms( array( 'taxonomy' => 'category', 'orderby' => 'name' ) ) ) :
        echo '<select name="categoryfilter"><option value="">Select category...</option>';
        foreach ( $terms as $term ) :
            echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option
        endforeach;
        echo '</select>';
    endif;
    ?>
    <input type="text" name="price_min" placeholder="Min price" />
    <input type="text" name="price_max" placeholder="Max price" />
    <label>
        <input type="radio" name="date" value="ASC" /> Date: Ascending
    </label>
    <label>
        <input type="radio" name="date" value="DESC" selected="selected" /> Date: Descending
    </label>
    <label>
        <input type="checkbox" name="featured_image" /> Only posts with featured images
    </label>
    <button>Apply filter</button>
    <input type="hidden" name="action" value="myfilter">
</form>

<script src="<?php echo plugins_url('/jmart/assets/js/main.js'); ?>"></script>