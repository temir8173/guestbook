<?php


namespace app\services\invitations;


use app\models\Invitation;
use Yii;
use yii\helpers\Json;
use yii\web\UploadedFile;

class InvitationService
{
    public function create(Invitation $invitation): string
    {
        $fileNamesByField = $this->saveFiles($invitation);
        $invitation->field_values = array_merge($invitation->field_values, $fileNamesByField);
        $invitation->save(false);

        return $invitation->url;
    }

    public function update(Invitation $invitation): string
    {
        $fileNamesByField = $this->saveFiles($invitation);
        $invitation->field_values = array_merge_recursive($invitation->field_values, $fileNamesByField);
        $invitation->save(false);

        return $invitation->url;
    }

    public function deleteImage(Invitation $invitation, string $fieldSlug, string $imageName)
    {
        unlink(Yii::getAlias('@webroot') . '/uploads/' . $imageName);

        if (isset($invitation->field_values[$fieldSlug])) {
            $imageNames = $invitation->field_values[$fieldSlug];
            $key = array_search($imageName, $imageNames);
            unset($imageNames[$key]);
            $invitation->field_values = array_merge($invitation->field_values, [$fieldSlug => $imageNames]);
            $invitation->save(false);
        }
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
