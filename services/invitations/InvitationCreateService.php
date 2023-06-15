<?php


namespace app\services\invitations;


use app\models\Invitation;
use yii\web\UploadedFile;

class InvitationCreateService
{
    public function process(Invitation $invitation): string
    {
        $fileNamesByField = [];
        foreach ($invitation->files as $fieldSlug => $filesByField) {
            $names = [];
            foreach ($filesByField as $file) {
                /** @var UploadedFile $file */
                $name = preg_replace("/\s+/", "_", $file->baseName)
                    . '_' . time()
                    . '.' . $file->extension;
                $file->saveAs('uploads/' . $name);
                $names[] = $name;
            }
            $fileNamesByField[$fieldSlug] = $names;
        }

        $invitation->setFieldImageNames($fileNamesByField);
        $invitation->save(false);

        return $invitation->url;
    }
}
