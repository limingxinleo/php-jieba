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
use PHPJieba;
class IndexController extends Controller
{
    public function index()
    {
        $key = $this->request->input('keyword');
        if ($key) {
            $result = PHPJieba::cut($key, true);
        }

        return $this->response->success($result);
    }
}
