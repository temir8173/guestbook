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

<?php

if ($invitation->template->is_deprecated) {
    echo $this->render(
        'view/' . $invitation->template->slug . '/_header',
        ['invitation' => $invitation]
    );

    $fieldValues = $invitation->field_values;
    foreach ($invitation->sections as $section)
    {
        echo $this->render(
            'view/' . $invitation->template->slug . '/_' . $section,
            compact('invitation', 'newMessage', 'fieldValues')
        );
    }

    echo $this->render(
        'view/' . $invitation->template->slug . '/_footer',
        ['invitation' => $invitation]
    );
} else {
    $fieldValues = $invitation->field_values;
    echo $this->render(
        'templates/' . $invitation->template->slug,
        compact('invitation', 'newMessage', 'fieldValues')
    );
}

?>

<?php if (Yii::$app->user->id || $invitation->is_demo) {
    echo $this->render('_edit_toolbar', ['invitation' => $invitation]);
} ?>

<?= $this->render('@app/views/layouts/modals/_auth_modal'); ?>

<?php if (
        $invitation->audio
        && file_exists(Yii::getAlias('@app') . '/web/' . Audio::AUDIO_PATH . $invitation->audio)
) { ?>
    <div class="audio" data-audio-src="<?= '/' . Audio::AUDIO_PATH . $invitation->audio ?>">

        <div class="play-button">
            <img src="/images/play.gif">
        </div>
        <div class="stop-button">
            <img class="sound-off-gif" src="/images/on-progress.gif">
        </div>

    </div>
<?php } ?>