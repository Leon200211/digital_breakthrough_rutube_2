<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/default/include/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/default/include/header.php';
?>


<section>
    <div class="container">
        <div class="toVidList">
            <a href="/"><ion-icon name="arrow-back-outline"></ion-icon> Назад</a>
        </div>
        <div class="videos-list">

            <?php foreach ($this->data as $banner): ?>
        <div class="video">
            <div>Исходное фото</div>
            <img style="max-width: 400px; max-height: 150px;" src="/files/banner/<?=$banner['photo']?>">
            <div>Фото после обработки</div>
            <img style="max-width: 400px; max-height: 150px;" src="/files/banner/photo/<?=$banner['photo_res']?>">
            <div>
                Название: <?=$banner['name']?>
            </div>
            <div>
                Описание: <?=$banner['description']?>
            </div>
            <div>
                Стиль: <?=$banner['style']?>
            </div>
            <div style="display: flex; justify-content: space-between; margin-top: 10px;">
                <div>
                    <?=$banner['date_create']?>
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
