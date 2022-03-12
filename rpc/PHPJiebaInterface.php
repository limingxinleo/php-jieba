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
namespace PHPJieba;

interface PHPJiebaInterface
{
    public const NAME = 'PHPJiebaService';

    public const PORT = 9504;

    public function cut(string $keyword): array;

    public function insert(string $keyword): bool;
}
