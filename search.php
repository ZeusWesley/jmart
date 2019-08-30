<?php include "styles.php" ?>

<form action="<?php echo site_url() ?>/wp-json/jmart/post-search" method="GET" id="filter"> <?php
//    if( $terms = get_terms( array( 'taxonomy' => 'category', 'orderby' => 'name' ) ) ) :
//        echo '<select name="categoryfilter"><option value="">Select category...</option>';
//        foreach ( $terms as $term ) :
//            echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option
//        endforeach;
//        echo '</select>';
//    endif;
//    ?>
    <div>
        <h4>Categorias</h4>
        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                sopas
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                café da manhã e lanches
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                saladas
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                prato principal
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                prato único
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                sobremesa
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                bebidas
            </label>
        </div>
    </div>

    <div>
        <h4>Dieta</h4>
        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                low carb
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                vegetariano
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                vagano
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                sem glutem
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                sem leite
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                sem açucar
            </label>
        </div>
    </div>

    <div>
        <h4>Ingredientes</h4>
        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                chocolate
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                coco
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                vegetais folhosos
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                banana
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                sementes oleaginosas
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                feijões e leguminosas
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                peixe e frutos do mar
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                frango
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                carne bovina
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                leite e derivados
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                ervas
            </label>
        </div>
    </div>

    <div>
        <h4>Tempo de preparo</h4>
        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                até 10min
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                entre 10 - 30min
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                entre 30min - 1h
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type='checkbox' value='5min'/>
                mais de 1h
            </label>
        </div>
    </div>

    <button>Filtrar</button>
    <input type="hidden" name="action" value="myfilter">
</form>