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
namespace App\Kernel\Jieba;

use Hyperf\Contract\ConfigInterface;
use Psr\Container\ContainerInterface;

class Jieba implements JiebaInterface
{
    protected $jieba;

    public function __construct(ContainerInterface $container)
    {
        $config = $container->get(ConfigInterface::class)->get('jieba.dict', []);
        $words = $container->get(ConfigInterface::class)->get('jieba.user_words', []);

        $this->jieba = new \PHPJieba(
            $config['dict'],
            $config['hmm'],
            $config['user'],
            $config['idf'],
            $config['stop_words']
        );

        foreach ($words as $word) {
            $this->jieba->insert($word);
        }
    }

    public function cut(string $keyword): array
    {
        return $this->jieba->cut($keyword);
    }

    public function insert(string $keyword): bool
    {
        return $this->jieba->insert($keyword);
    }
}
