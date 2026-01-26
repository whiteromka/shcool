<?php

namespace App\Test\Business\Warehouse;

use App\Test\Business\ReportInterface;
use App\Test\Business\WorkerInterface;

class WarehouseReport implements ReportInterface
{
    private string $truckId;

    /**
     * @var Box[]
     */
    private array $boxes;

    private string $format;

    public function __construct(string $truckId, array $boxes, string $format)
    {
        $this->truckId = $truckId;
        $this->boxes = $boxes;
        $this->format = $format;
    }

    public function showInfo(): array
    {
        $boxesIds = [];
        foreach ($this->boxes as $box) {
            $boxesIds[] = $box->getId();
        }
        return [
            "boxesIds" => $boxesIds,
            "truckId" => $this->truckId,
            "data1" => "data1",
            "data2" => "data2"
        ];
    }
}
