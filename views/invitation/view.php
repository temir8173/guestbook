<?php

use app\models\Audio;
use app\models\Invitation;
use app\models\Wish;

/**
 * @var Invitation $invitation
 * @var Wish $newMessage
 */

$this->title = $invitation->name;
?>

<?= $this->render(
    'view/' . $invitation->template->slug . '/_header',
    ['invitation' => $invitation]
); ?>

<?php

$fieldValues = $invitation->field_values;
foreach ($invitation->sections as $section)
{
    echo $this->render(
        'view/' . $invitation->template->slug . '/_' . $section,
        compact('invitation', 'newMessage', 'fieldValues')
    );
}

?>

<?= $this->render('_edit_toolbar', ['invitation' => $invitation]); ?>

<?= $this->render('@app/views/layouts/modals/_login'); ?>
<?= $this->render('@app/views/layouts/modals/_signup'); ?>
<?= $this->render('@app/views/layouts/modals/_recover'); ?>

<?= $this->render(
    'view/' . $invitation->template->slug . '/_footer',
    ['invitation' => $invitation]
); ?>

<div class="audio" data-audio-src="<?= '/' . Audio::AUDIO_PATH . $invitation->audio ?>">

    <div class="play-button">
        <img src="/images/play.gif">
    </div>
    <div class="stop-button">
        <img class="sound-off-gif" src="/images/on-progress.gif">
    </div>

</div>
