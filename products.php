<?php foreach($products as $item): ?>
    <tr>
        <td><?php echo $item->hotmart_id?></td>
        <td><?php echo $item->name?></td>
        <td><?php echo $item->category?></td>
        <td>
            <a href="<?php echo get_site_url(null, '/wp-json/jmart/product/change-status/'. $item->id, 'http')?>"
               class="btn btn-warning">
                <?php echo ($item->status == 0) ?  'Ativar visualização' : 'Desativar Visualização';?>
            </a>
            <a href="<?php echo get_site_url(null, '/wp-json/jmart/product/view/'. $item->id, 'http')?>"
               class="btn btn-info">
                Visualizar
            </a>
        </td>
    </tr>
<?php endforeach;?>