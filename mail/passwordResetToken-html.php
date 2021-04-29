<?php
 
use yii\helpers\Html;
 
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 't' => $user->password_reset_token]);
?>
 
<table border="0" cellpadding="0" align="center" cellspacing="0" width="600" style="min-width:600px;border-collapse:collapse; border:1px solid #efefef; background-color:#fff; box-shadow: 0px 0px 35px rgba(0,0,0,0.05); border-radius:4px; color:#333; font-family: Helvetica Neue, Helvetica, Arial, Sans-Serif; font-size: 14px;  ">
<tbody>
<tr>
    <td align="center" valign="top" style="padding: 20px 0 18px; font-size: 30px; border-bottom: 1px solid #efefef; position: relative;">
        Сәлеметсіз бе <?= Html::encode($user->username) ?>!
    </td>
</tr>
<tr>
    <td>
        <div style="padding:30px; line-height:23px;">
		    <p>Құпия сөзіңізді өзгерту үшін келесі сілтемені басыңыз:</p>
		    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
	    </div>
    </td>
</tr>

</tbody>
</table>