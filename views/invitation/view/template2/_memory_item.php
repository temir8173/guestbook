<?php

/**
 * @var string $url
 */

use app\helpers\CloudServiceHelper;

?>
<?php if ($url) { ?>
    <a target="_blank" href="<?= $url ?>" class="download-item">

        <?php if (
            CloudServiceHelper::detectType($url)
            === CloudServiceHelper::GOOGLE_DRIVE
        ) { ?>
            <div class="download-img">
                <img src="./images/google-drive.svg" alt="">
            </div>
            <div class="download-title">
                Google drive
            </div>
        <?php } ?>

        <?php if (
            CloudServiceHelper::detectType($url)
            === CloudServiceHelper::YANDEX_DISK
        ) { ?>
            <div class="download-img">
                <img src="./images/yandex-disk.svg" alt="">
            </div>
            <div class="download-title">
                Yandex Диск
            </div>
        <?php } ?>

        <?php if (
            CloudServiceHelper::detectType($url)
            === CloudServiceHelper::MAILRU
        ) { ?>
            <div class="download-img">
                <img src="./images/mail.ru-cloud.png" alt="">
            </div>
            <div class="download-title">
                Mail.ru Облако
            </div>
        <?php } ?>
    </a>
<?php } ?>