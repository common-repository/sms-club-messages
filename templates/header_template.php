<div class="header-block">
    <div class="inform-user">
        <?php if (!$balance) { ?>
        <p class="alert alert-danger"><?= implode('<br>', $errors) ?></p>
        <?php } else { ?>
        <p>Текущий баланс: <span><?php echo esc_html($balanceText); ?></span></p>
	    <?php } ?>
    </div>
</div>