<?php include('include/header.php'); ?>
<div class="content">
    <div class="readfiles">
        <?php
        if (!empty($utils->readfiles)) {
            foreach ($utils->readfiles as $file) {
                ?>
                <a href=''><?= $file ?></a>
            <?php }
        } ?>
    </div>

</div>
<?php include('include/footer.php'); ?>