<?php
ob_start();
?>

<?php if (count($posts) > 0) { ?>
        <?php foreach ($posts as $post) { ?>
            <div class="rounded box-shadow p-4 mb-4">
                <h3 class="font-weight-bold"><?= $post['title'] ?></h3>
                <h6 class="my-4 text-secondary">
                    <?= $post['category'] ?> /
                    <span dir="ltr"><?= $post['created_at'] ?></span> /
                    <?= \App\Models\Post::getLikesCount($post['id']) ?> لایک /
                    <a href="/like?id=<?= $post['id'] ?>" class="text-primary">پسندیدم</a>
                </h6>
                <h5 class="description"><?= $post['description'] ?></h5>
            </div>
        <?php } ?>
<?php } else { ?>
    <div class="center-box font-weight-bold h3 text-secondary">تا کنون هیچ مقاله ای ثبت نشده است.</div>
<?php } ?>

<?php
$content = ob_get_clean();

include 'layout/layout.php';
