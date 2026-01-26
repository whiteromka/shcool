<?php

namespace App\Test\Business;

interface WorkerInterface
{
    public function writeReport(): ReportInterface;
}
