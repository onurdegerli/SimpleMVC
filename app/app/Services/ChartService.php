<?php declare(strict_types=1);

namespace App\Services;

use App\Services\Structures\ChartStructure;

class ChartService
{
    public function get(array $data): ChartStructure
    {
        if (!$data) {
            return new ChartStructure();
        }

        $labels = array_keys($data[0]['data']);
        $dataset = array_map(static function($row) {
            return [
                'data' => array_values($row['data']),
                'lineTension' => 0,
                'backgroundColor' => 'transparent',
                'borderColor' => random_hexadecimal_color(),
                'borderWidth' => 4,
                'pointBackgroundColor' => '#007bff',
                'label' => $row['label']
            ];
        }, $data);

        if (!$dataset) {
            return new ChartStructure();
        }

        $chartStructure = (new ChartStructure());
        $chartStructure->labels = $labels;
        $chartStructure->dataset = $dataset;

        return $chartStructure;
    }
}