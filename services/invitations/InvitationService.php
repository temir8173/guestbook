<?php


namespace app\services\invitations;


use app\models\Invitation;
use app\services\OrderService;
use Yii;

class InvitationService
{
    public function __construct(
        private OrderService $orderService,
    ) {}

    public function create(Invitation $invitation): string
    {
        $invitationUrl = $this->save($invitation);

        $this->orderService->create(
            $invitation->id,
            $invitation->user_id,
            (int)$invitation->template->actualPrice
        );

        return $invitationUrl;
    }

    public function update(Invitation $invitation): string
    {
        return $this->save($invitation, true);
    }

    public function deleteImage(Invitation $invitation, string $fieldSlug, string $imageName)
    {
        if (file_exists(Yii::getAlias('@webroot') . '/uploads/' . $imageName)) {
            unlink(Yii::getAlias('@webroot') . '/uploads/' . $imageName);
        }

        if (isset($invitation->field_values[$fieldSlug])) {
            $imageNames = $invitation->field_values[$fieldSlug];
            $key = array_search($imageName, $imageNames);
            unset($imageNames[$key]);
            $invitation->field_values = array_merge($invitation->field_values, [$fieldSlug => $imageNames]);
            $invitation->save(false);
        }
    }

    private function save(Invitation $invitation, bool $isUpdate = false): string
    {
        $invitation->image = $invitation->image ?: ($invitation->oldAttributes['image'] ?? null);
        if ($invitation->imageFile) {
            $name = 'invitation-image-' . $invitation->id
                . '.' . $invitation->imageFile->extension;
            if (file_exists(Yii::getAlias('@webroot') . '/uploads/' . $name)) {
                unlink(Yii::getAlias('@webroot') . '/uploads/' . $name);
            }
            $invitation->imageFile->saveAs('uploads/' . $name);
            $invitation->image = $name;
        }

        $fileNamesByField = $this->saveFiles($invitation);
        $invitation->field_values = $isUpdate
            ? array_merge_recursive($invitation->field_values, $fileNamesByField)
            : array_merge($invitation->field_values, $fileNamesByField);
        $invitation->save(false);

        return $invitation->url;
    }

    private function saveFiles(Invitation $invitation): array
    {
        $fileNamesByField = [];
        foreach ($invitation->files as $fieldSlug => $filesByField) {
            $names = [];
            foreach ($filesByField as $file) {
                $name = preg_replace("/\s+/", "_", $file->baseName)
                    . '_' . time()
                    . '.' . $file->extension;
                $file->saveAs('uploads/' . $name);
                $names[] = $name;
            }
            $fileNamesByField[$fieldSlug] = $names;
        }

        return $fileNamesByField;
    }
}
