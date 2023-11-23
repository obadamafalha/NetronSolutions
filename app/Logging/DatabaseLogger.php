<?php

namespace App\Logging;

use App\Models\AppLog;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use Illuminate\Support\Facades\DB;

class DatabaseLogger extends AbstractProcessingHandler
{
    public function __construct($level = Logger::DEBUG, $bubble = true)
    {
        parent::__construct($level, $bubble);
    }

    protected function write(array $record): void
    {
        AppLog::create([
            'message' => $record['formatted'],
            'level' => $record['level_name'],
            'context' => json_encode($record['context']),
            'created_at' => now(),
        ]);
    }
}

