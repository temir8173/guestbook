<?php


use app\models\Template;

class TemplateRepository
{
    public function getIdToNames()
    {
        $templates = Template::find()
            ->select('name')
            ->all();


    }
}