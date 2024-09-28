<?php

declare(strict_types=1);

use App\Http\Integrations\Fortnox\FortnoxConnector;
use App\Http\Integrations\Fortnox\Requests\GetInvoicesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Saloon\Http\OAuth2\GetAccessTokenRequest;

Route::get('/', function (FortnoxConnector $connector) {
    return redirect(
        $connector->getAuthorizationUrl(),
    );
});

Route::get('/invoices', function (FortnoxConnector $connector) {
    return $connector->send(new GetInvoicesRequest);
});

Route::get('/auth-code', function (FortnoxConnector $connector, Request $request) {
    $code = $request->get('code');

    $authenticator = $connector->getAccessToken(
        code: $code,
        requestModifier: function (GetAccessTokenRequest $request) {
            $clientId = $request->body()->get('client_id');
            $clientSecret = $request->body()->get('client_secret');

            $request->body()->merge([
                'redirect_uri' => config('fortnox.redirect').'/auth-code',
            ]);

            $credentials = base64_encode("{$clientId}:{$clientSecret}");
            $request->headers()->set(['ClientId' => $clientId]);
            $request->headers()->set(['ClientSecret' => $clientSecret]);
            $request->headers()->set(['Authorization' => 'Basic '.$credentials]);
        },
    );

    $token = [
        'accessToken' => $authenticator->getAccessToken(),
        'refreshToken' => $authenticator->getRefreshToken(),
        'expiresAt' => $authenticator->getExpiresAt(),
    ];

    info(print_r([$token], true));

    $connector->authenticate($authenticator);

    dd($token);

    // return $connector->send(new GetInvoicesRequest());
});
