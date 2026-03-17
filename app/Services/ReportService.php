<?php

namespace App\Services;

class ReportService
{
    public function kpi(): array
    {
        return [
            'revenue' => 55000000,
            'orders' => 320,
            'newUsers' => 78,
        ];
    }
}
