<?php


namespace app\services;


use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Provider\Google;
use Yii;

class OauthGoogleService
{
    public AbstractProvider $provider;

    function __construct()
    {
        $this->provider = new Google([
            'clientId' => Yii::$app->params['googleClientId'],
            'clientSecret' => Yii::$app->params['googleClientSecret'],
            'redirectUri' => Yii::$app->params['googleRedirectUri'],
        ]);
    }

    public function getAuthorizationUrl(string $returnUrl): string
    {
        $authorizationUrl = $this->provider->getAuthorizationUrl();
        Yii::$app->session->set('googleAuthState', $this->provider->getState());
        Yii::$app->session->set('oauthReturnUrl', $returnUrl);
        return $authorizationUrl;
    }

    /**
     * @throws IdentityProviderException
     */
    public function getAuthorizationData($code): array
    {
        $accessToken = $this->provider->getAccessToken("authorization_code", compact("code"));
        $authInfo = $this->provider->getResourceOwner($accessToken);
        return $authInfo->toArray();
    }
}