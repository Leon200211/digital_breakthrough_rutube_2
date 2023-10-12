<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/default/include/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/default/include/header.php';
?>


<section>
    <div class="container">
        <div class="videos-list">

            <?php foreach ($this->data as $profile): ?>
        <div class="video">
            <div>Фото профиля</div>
            <img style="max-width: 400px; max-height: 150px;" src="/templates/default/assets/img/<?=$profile['photo']?>">
            <div>
                Название: <?=$profile['name']?>
            </div>
            <div>
                Описание: <?=$profile['description']?>
            </div>
            <div style="display: flex; justify-content: space-between; margin-top: 10px;">
                <div>
                    <?=$profile['date_create']?>
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