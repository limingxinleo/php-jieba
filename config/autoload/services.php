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
use Hyperf\RpcMultiplex\Constant;
use PHPJieba\PHPJiebaInterface;

return [
    'consumers' => [
        [
            'name' => PHPJiebaInterface::NAME,
            'service' => PHPJiebaInterface::class,
            'id' => PHPJiebaInterface::class,
            'protocol' => Constant::PROTOCOL_DEFAULT,
            'load_balancer' => 'random',
            'nodes' => [
                ['host' => '127.0.0.1', 'port' => PHPJiebaInterface::PORT],
            ],
            'options' => [
                'connect_timeout' => 5.0,
                'recv_timeout' => 5.0,
                'settings' => [
                    // 包体最大值，若小于 Server 返回的数据大小，则会抛出异常，故尽量控制包体大小
                    'package_max_length' => 1024 * 1024 * 2,
                ],
                // 重试次数，默认值为 2
                'retry_count' => 2,
                // 重试间隔，毫秒
                'retry_interval' => 10,
                // 多路复用客户端数量
                'client_count' => 4,
                // 心跳间隔
                'heartbeat' => 20,
            ],
        ],
    ],
];
