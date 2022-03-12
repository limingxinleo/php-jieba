<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace HyperfTest\Cases;

use HyperfTest\HttpTestCase;
use PHPJieba\PHPJiebaInterface;

/**
 * @internal
 * @coversNothing
 */
class JiebaTest extends HttpTestCase
{
    public function testCut()
    {
        $res = $this->client->json('/', [
            'keyword' => '我在中山公园吃炸鸡',
        ]);

        $this->assertSame(0, $res['code']);
        $this->assertSame(['我', '在', '中山公园', '吃', '炸鸡'], $res['data']);
    }

    public function testHttpCut()
    {
        $res = $this->http->json('/', [
            'keyword' => '我在中山公园吃炸鸡',
        ]);

        $this->assertSame(0, $res['code']);
        $this->assertSame(['我', '在', '中山公园', '吃', '炸鸡'], $res['data']);
    }

    public function testRPCCut()
    {
        $res = di()->get(PHPJiebaInterface::class)->cut('我在中山公园吃炸鸡');

        $this->assertSame(['我', '在', '中山公园', '吃', '炸鸡'], $res);
    }
}
