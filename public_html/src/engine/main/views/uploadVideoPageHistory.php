<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/default/include/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/default/include/header.php';
?>


<section>
    <div class="container">
        <div class="videos-list">

            <?php foreach ($this->data as $video): ?>
        <div class="video">
            <div>Видео</div>
            <video width="250" height="150" controls>
                <source src="/files/uploads/<?=$video['video']?>" type="video/mp4">
            </video>
            <div>Превью</div>
            <img style="max-width: 400px; max-height: 150px;" src="/templates/default/assets/img/<?=$video['thumbnail']?>">
            <div>
                Название: <?=$video['name']?>
            </div>
            <div>
                Описание: <?=$video['description']?>
            </div>
            <div style="display: flex; justify-content: space-between; margin-top: 10px;">
                <div>
                    <?=$video['date_create']?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>


        </div>
    </div>
</section>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/default/include/footer.php';
?>
