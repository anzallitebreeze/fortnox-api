<?php

declare(strict_types=1);

namespace App\Http\Integrations\Fortnox;

use Illuminate\Config\Repository as Config;
use Saloon\Helpers\OAuth2\OAuthConfig;
use Saloon\Http\Connector;
use Saloon\Traits\OAuth2\AuthorizationCodeGrant;
use Saloon\Traits\Plugins\AcceptsJson;

final class FortnoxConnector extends Connector
{
    use AcceptsJson;
    use AuthorizationCodeGrant;

    public function __construct(protected Config $appConfig) {}

    /**
     * The Base URL of the API.
     */
    public function resolveBaseUrl(): string
    {
        return 'https://api.fortnox.se/3';
    }

    /**
     * The OAuth2 configuration
     */
    protected function defaultOauthConfig(): OAuthConfig
    {
        return OAuthConfig::make()
            ->setClientId($this->appConfig->get('fortnox.client_id'))
            ->setClientSecret($this->appConfig->get('fortnox.client_secret'))
            // ->setRedirectUri('https://6c14-103-203-73-31.ngrok-free.app/auth-code')
            ->setRedirectUri(config('fortnox.redirect').'/auth-code')
            ->setDefaultScopes($this->appConfig->get('fortnox.scopes', []))
            ->setAuthorizeEndpoint($this->appConfig->get('fortnox.auth_endpoint'))
            ->setTokenEndpoint($this->appConfig->get('fortnox.token_endpoint'));
    }
}
