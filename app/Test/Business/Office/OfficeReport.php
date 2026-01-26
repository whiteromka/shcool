<?php

namespace App\Test\Business\Office;

use App\Test\Business\ReportInterface;
use App\Test\Business\Warehouse\Box;

class OfficeReport implements ReportInterface
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
            "truckId" => $this->truckId
        ];
    }
}
