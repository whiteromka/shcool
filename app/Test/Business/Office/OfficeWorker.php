<?php

namespace App\Test\Business\Office;

use App\Test\Business\Warehouse\Box;
use App\Test\Business\WorkerInterface;

class OfficeWorker implements WorkerInterface
{

    private function cramNumbers(): void
    {
        echo "calculating" . "<br>";
    }

    public function writeReport(): \App\Test\Business\ReportInterface
    {
        $this->cramNumbers();
        echo "a report on truck loading" . "<br>";
        $boxes = [];
        $box1 = new Box("1", 1, [1, 2, 3]);
        $boxes[] = $box1;
        return new OfficeReport(1, $boxes, "docx");
    }
}
