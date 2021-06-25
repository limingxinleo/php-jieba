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
namespace App\Controller;

use App\Kernel\Jieba\JiebaInterface;
use Hyperf\Di\Annotation\Inject;

class IndexController extends Controller
{
    /**
     * @Inject
     * @var JiebaInterface
     */
    protected $jieba;

    public function index()
    {
        $result = [];
        $key = $this->request->input('keyword');
        if ($key) {
            $result = $this->jieba->cut($key);
        }

        return $this->response->success($result);
    }
}
