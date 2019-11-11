<?php

declare(strict_types=1);

namespace Cekta\HTTP\Server;

use Cekta\HTTP\Server\Exception\HeaderSent;
use Cekta\HTTP\Server\Exception\OutputSent;
use Psr\Http\Message\ResponseInterface;

class SapiEmitter
{
    public function emit(ResponseInterface $response): void
    {
        if (headers_sent()) {
            throw new HeaderSent();
        }

        if (ob_get_level() > 0 && ob_get_length() > 0) {
            throw new OutputSent();
        }

        $this->emitHeaders($response);
        header(sprintf(
            'HTTP/%s %d%s',
            $response->getProtocolVersion(),
            $response->getStatusCode(),
            ($response->getReasonPhrase() ? ' ' . $response->getReasonPhrase() : '')
        ), true, $response->getStatusCode());
        echo $response->getBody();
    }

    private function emitHeaders(ResponseInterface $response): void
    {
        $statusCode = $response->getStatusCode();
        foreach ($response->getHeaders() as $header => $values) {
            $name = ucwords($header, '-');
            $replace = $name === 'Set-Cookie' ? false : true;
            foreach ($values as $value) {
                header("$name: $value", $replace, $statusCode);
                $replace = false;
            }
        }
    }
}
