<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Kernel\Jieba;

use Hyperf\Contract\ConfigInterface;
use Psr\Container\ContainerInterface;

class JiebaFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get(ConfigInterface::class)->get('jieba.dict', []);

        var_dump(123);
        return new \PHPJieba(
            $config['dict'],
            $config['hmm'],
            $config['user'],
            $config['idf'],
            $config['stop_words']
        );
    }
}
