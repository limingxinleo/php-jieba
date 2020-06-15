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
namespace App\Controller;

use Hyperf\Di\Annotation\Inject;

class IndexController extends Controller
{
    public function index()
    {
        $result = [];
        $key = $this->request->input('keyword');
        if ($key) {
            $result = di()->get('PHPJieba')->cut($key);
        }

        return $this->response->success($result);
    }
}
