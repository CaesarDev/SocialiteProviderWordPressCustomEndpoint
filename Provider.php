<?php

namespace CaesarDev\SocialiteProviderWordPressCustomEndpoint;

use SocialiteProviders\Manager\OAuth2\User;
use Laravel\Socialite\Two\ProviderInterface;
use SocialiteProviders\Manager\OAuth2\AbstractProvider;

class Provider extends AbstractProvider implements ProviderInterface
{
    /**
     * Unique Provider Identifier.
     */
    const IDENTIFIER = 'WORDPRESS';

    /**
     * The scopes being requested.
     *
     * @var array
     */
    protected $scopes = [];

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase(config('services.wordpress.api_top_endpoint') . 'oauth/authorize', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return config('services.wordpress.api_top_endpoint') . 'oauth/token';
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token){


        $response = $this->getHttpClient()->get(
            config('services.wordpress.api_top_endpoint') . 'wp-json/wp/v2/users/me?context=edit&access_token='.$token
        );



        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        return (new User())->setRaw($user)->map(
            [
                'id' => $user['id'],
                'nickname' => $user['username'],
                'name' => $user['name'],
                'email' => array_get($user, 'email'),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenFields($code)
    {
        return array_merge(parent::getTokenFields($code), [
            'grant_type' => 'authorization_code',
        ]);
    }
}
