<?php

namespace App\Test\Business\Warehouse;

use App\Test\Business\WorkerInterface;

class WarehouseWorker implements WorkerInterface
{
    public function loadBoxes(): void
    {
        echo "the worker is loading a truck" . "<br>";
    }

    public function writeReport(): \App\Test\Business\ReportInterface
    {
        echo "the truck is loaded" . "<br>";
        $boxes = [];
        $box1 = new Box("1", 1, [1, 2, 3]);
        $boxes[] = $box1;
        return new WarehouseReport(1, $boxes, "pdf");
    }
}
