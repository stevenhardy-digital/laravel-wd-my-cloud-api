<?php

namespace StevenHardyDigital\LaravelWdMyCloudApi\OAuth;


use Laravel\Socialite\Two\AbstractProvider;
use Laravel\Socialite\Two\ProviderInterface;
use Laravel\Socialite\Two\User;
use StevenHardyDigital\LaravelWdMyCloudApi\MyCloud;

class MyCloudProvider extends AbstractProvider implements ProviderInterface
{

     /**
     * Scopes defintions.
     */
    const SCOPE_READONLY = 'read-only';
    const SCOPE_OPENID = 'openid';
    const SCOPE_NAS_READ_ONLY = 'nas_read_only';
    const SCOPE_NAS_READ_WRITE = 'nas_read_write';
    const SCOPE_OFFLINE_ACCESS = 'offline_access';
    const SCOPE_DEVICE_READ = 'device_read';
    const SCOPE_USER_READ = 'user_read';

    const MYCLOUD_API_URL = 'https://wdc.auth0.com';

    protected $scopes = [
        'read-only',
        'openid',
        'email',
        'nas_read_only',
        'nas_read_write',
        'offline_access',
        'device_read',
        'user_read',
    ];

    /**
     * {@inheritdoc}
     */
    protected function getAuthUrl($state)
    {
        return $this->buildAuthUrlFromBase(static::MYCLOUD_API_URL . '/authorize', $state);
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenUrl()
    {
        return static::MYCLOUD_API_URL . '/oauth/token';
    }

    /**
     * {@inheritdoc}
     */
    public function getAccessToken($code)
    {
        $response = $this->getHttpClient()->post($this->getTokenUrl(), [
            'headers' => ['Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret)],
            'body'    => $this->getTokenFields($code),
        ]);

        return $this->parseAccessToken($response->getBody());
    }

    /**
     * {@inheritdoc}
     */
    protected function getTokenFields($code)
    {
        return array_add(
            parent::getTokenFields($code), 'grant_type', 'authorization_code'
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function getUserByToken($token)
    {
        $response = $this->getHttpClient()->get('https://api.spotify.com/v1/me', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }

    /**
     * {@inheritdoc}
     */
    protected function formatScopes(array $scopes, $scopeSeparator)
    {
        return implode($scopeSeparator, $scopes);
    }

    /**
     * {@inheritdoc}
     */
    protected function mapUserToObject(array $user)
    {
        return (new User)->setRaw($user)->map([
            'id'       => $user['id'],
            'nickname' => $user['display_name'],
            'name'     => $user['display_name'],
            'avatar'   => !empty($user['images']) ? $user['images'][0]['url'] : null,
        ]);
    }

}