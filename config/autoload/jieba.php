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
return [
    'dict' => [
        'dict' => BASE_PATH . '/storage/dict/jieba.dict.utf8',
        'hmm' => BASE_PATH . '/storage/dict/hmm_model.utf8',
        'user' => BASE_PATH . '/storage/dict/user.dict.utf8',
        'idf' => BASE_PATH . '/storage/dict/idf.utf8',
        'stop_words' => BASE_PATH . '/storage/dict/stop_words.utf8',
    ],
    'user_words' => [
        '知我探索',
    ],
];
