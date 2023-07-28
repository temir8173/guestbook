<?php

use app\models\Template;

/**
 * @var Template[] $templates
 */

?>

<?= $this->render('_templates_section', ['templates' => $templates]) ?>
