<?php
namespace Yehunwu\api;

class Code
{
	const SUCCESS           = 1;
    const FAILED            = 0;

    const MESSAGES = [
        self::SUCCESS               => '成功',
        self::FAILED                => '失败',
    ];

    static function message(int $code)
    {
        return self::MESSAGES[$code] ?? '';
    }
}
