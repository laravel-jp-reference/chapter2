<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;

class Inspire extends Command
{
    /**
     * コンソールコマンドの識別名
     *
     * @var string
     */
    protected $signature = 'inspire';

    /**
     * コンソールコマンドの説明
     *
     * @var string
     */
    protected $description = 'Display an inspiring quote';

    /**
     * コンソールコマンドの実行
     *
     * @return mixed
     */
    public function handle()
    {
        $this->comment(PHP_EOL.Inspiring::quote().PHP_EOL);
    }
}
