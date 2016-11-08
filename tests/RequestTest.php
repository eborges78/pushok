<?php

/*
 * This file is part of the Pushok package.
 *
 * (c) Arthur Edamov <edamov@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pushok\Tests;

use PHPUnit\Framework\TestCase;
use Pushok\Notification;
use Pushok\Payload;
use Pushok\Request;

class RequestTest extends TestCase
{
    public function testOptionsForProductionRequest()
    {
        $payload = Payload::create();
        $message = new Notification($payload, '123');
        $request = new Request($message, true);

        $this->assertEquals([
            84 => 3,
            10002 => 'https://api.push.apple.com/3/device/123',
            3 => 443,
            47 => 1,
            10015 => '{"aps":[]}',
            19913 => 1,
            13 => 30,
            42 => 1
        ], $request->getOptions());
    }

    public function testOptionsForSandboxRequest()
    {
        $payload = Payload::create();
        $message = new Notification($payload, '123');
        $request = new Request($message, false);

        $this->assertEquals([
            84 => 3,
            10002 => 'https://api.development.push.apple.com/3/device/123',
            3 => 443,
            47 => 1,
            10015 => '{"aps":[]}',
            19913 => 1,
            13 => 30,
            42 => 1
        ], $request->getOptions());
    }
}
