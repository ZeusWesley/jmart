<?php
ob_start();
?>
<?php foreach($data as $item):?>
<div class="product">
    <img src="<?php echo $item->urlCoverPhoto ?>" alt="">
</div>
<?php endforeach;?>

<?php
return ob_get_clean();
?>