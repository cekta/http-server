<?php
declare(strict_types=1);

namespace Cekta\HTTP\Server\Exception;

use Cekta\HTTP\Server\ExceptionInterface;
use RuntimeException;

class OutputSent extends RuntimeException implements ExceptionInterface
{
    public function __construct()
    {
        parent::__construct('Output has been emitted previously');
    }

}
