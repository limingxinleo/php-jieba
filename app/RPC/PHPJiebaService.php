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
namespace App\RPC;

use App\Kernel\Jieba\JiebaInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\RpcMultiplex\Constant;
use Hyperf\RpcServer\Annotation\RpcService;
use PHPJieba\PHPJiebaInterface;

#[RpcService(name: PHPJiebaInterface::NAME, server: 'rpc', protocol: Constant::PROTOCOL_DEFAULT)]
class PHPJiebaService implements PHPJiebaInterface
{
    #[Inject]
    protected JiebaInterface $service;

    public function cut(string $keyword): array
    {
        return $this->service->cut($keyword);
    }

    public function insert(string $keyword): bool
    {
        return $this->service->insert($keyword);
    }
}
