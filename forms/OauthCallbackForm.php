<?php


namespace app\forms;


use Yii;
use yii\base\Model;

class OauthCallbackForm extends Model
{
    public $state;
    public $code;

    public function rules(): array
    {
        return [
            [['state', 'code'], 'required'],
            ['state', 'validateState'],
        ];
    }

    public function validateState($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $googleAuthState = Yii::$app->session->get("googleAuthState");

            if ($googleAuthState !== $this->state) {
                $this->addError(
                    $attribute,
                    "Invalid googleAuthState. Recieved {$this->state} but {$googleAuthState} expected"
                );
            }
        }
    }
}