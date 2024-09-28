<?php

declare(strict_types=1);

namespace App\Http\Integrations\Fortnox\Requests;

use Saloon\Enums\Method;
use Saloon\Http\Request;

final class GetInvoicesRequest extends Request
{
    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;

    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return 'https://api.fortnox.se/3/invoices';
    }
}
