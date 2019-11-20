<?php

namespace Cekta\HTTP\Server\Test;

use Cekta\HTTP\Server\SapiEmitter;
use PHPUnit\Framework\TestCase;
use TypeError;

class SapiEmitterTest extends TestCase
{
    public function testInvalidResponse()
    {
        $this->expectException(TypeError::class);
        $emitter = new SapiEmitter();
        $emitter->emit('invalid response');
    }
}

