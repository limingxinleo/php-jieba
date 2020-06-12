<?php

declare(strict_types=1);

namespace App\Command;

use Hyperf\Command\Command as HyperfCommand;
use Hyperf\Command\Annotation\Command;
use Psr\Container\ContainerInterface;

/**
 * @Command
 */
class DebugCommand extends HyperfCommand
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        parent::__construct('debug');
    }

    public function configure()
    {
        parent::configure();
        $this->setDescription('Hyperf Demo Command');
    }

    public function handle()
    {
        // $libc = \FFI::load(BASE_PATH . "/cjieba-0.3.0/lib/jieba.h");
//         $c = \FFI::cdef(<<<CTYPE
// Jieba NewJieba(const char* dict_path, const char* hmm_path, const char* user_dict);
// CTYPE
//             , BASE_PATH . "/cjieba-0.3.0/jieba.so");
        $ffi = \FFI::cdef(
            'void printf(char *const str, ...);',
            'libc.so.6'
        );

        $ffi->printf('Hello %s!', 'world');
        $this->line('Hello Hyperf!', 'info');
    }
}
