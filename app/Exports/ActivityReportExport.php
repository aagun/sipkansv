<?php

namespace App\Exports;

use App\Services\ActivityReportService;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\App;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx as WriteXlsx;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use App\Services\ObservationService;
use App\Services\DistrictService;

class ActivityReportExport
{
    private const CONTENT_TYPE_BASE64 = "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,";

    private const PREFIX_FILTER_VALUE = ":     ";

    private ActivityReportService $activityReportService;
    private ObservationService $observationService;
    private DistrictService $districtService;
    private array $filter;
    private string $template;
    private string $userDepartment;

    public function __construct(
        DistrictService $districtService,
        ObservationService $observationService,
        ActivityReportService $activityReportService,
        mixed $filter,
        string $userDepartment,
        string $template = '/docs/template.xlsx')
    {
        $this->observationService = $observationService;
        $this->districtService = $districtService;
        $this->activityReportService = $activityReportService;
        $this->filter = $filter;
        $this->userDepartment = $userDepartment;
        $this->template = $template;
    }

    private function collection(): Collection
    {
        return $this->activityReportService->export($this->filter);
    }

    /**
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function execute(): array
    {
        $spreadsheet = IOFactory::load(App::basePath($this->template));
        $worksheet = $spreadsheet->getActiveSheet();


        $row_index = 11;
        foreach ($this->collection() as $item) {
            $cell_index = 0;
            $keys = getObjectKeys($item);

            foreach ($this->filterOptions() as $filterOption) {
                $worksheet
                    ->getCell($filterOption['cell'])
                    ->setValue($filterOption['value']);
            }

            foreach ($keys as $key) {
                $opts = $this->getColumnOption($cell_index);
                $cell = $worksheet->getCell("{$opts['cell']}{$row_index}",)->setValue($item[ $key ]);
                $cell_index++;

                if (!isset($opts[ 'type' ])) continue;
                $cell->getStyle()
                    ->getNumberFormat()
                    ->setFormatCode($this->getColumnFormat($opts[ 'type' ]));
            };

            $row_index++;
        }


        $observation_id = $this->getValueFilter('observation_id');

        if ($observation_id && $this->observationService->exists($observation_id)) {
            $observation_id = $this->observationService->findOne($observation_id)->name;
            $observation_id = str_replace(' ', '_', ucwords(trim($observation_id)));
            $observation_id = preg_replace('/[^\w.-]/', '_', ucwords(trim($observation_id)));
        }

        return [
            'content' => $this->writeXlsxAsBase64($spreadsheet),
            'filename' => $this->composeSpreadFilename($observation_id, $this->userDepartment),
        ];
    }

    private function composeSpreadFilename(string $observationType, string $department, string $ext = Excel::XLSX): string
    {
        $filename = 'Rekap';

        if ($observationType) {
            $filename = $filename . "_".$observationType;
        }

        if ($department) {
            $department = str_replace(" ", "_", ucwords(trim($department)));
            $filename = $filename . "_".$department;
        }

        $timestamp = Carbon::now()->format('YmdHis');
        return "{$filename}_{$timestamp}.{$ext}";
    }

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    private function writeXlsxAsBase64(Spreadsheet $spreadsheet): string
    {
        IOFactory::createWriter($spreadsheet, Excel::XLSX);
        $writer = new WriteXlsx($spreadsheet);
        ob_start();
        $writer->save('php://output');
        $encoded_spreadsheet = base64_encode(ob_get_contents());
        ob_end_clean();

        return self::CONTENT_TYPE_BASE64 . $encoded_spreadsheet;
    }

    private function getColumnOption(int $cellIndex): array
    {
        return $this->columnsOptions()[ $cellIndex ];
    }

    private function columnsOptions(): array
    {
        return [
            [
                'cell' => 'A',
                'type' => 'number',
            ],
            ['cell' => 'B'],
            ['cell' => 'C'],
            ['cell' => 'D'],
            [
                'cell' => 'E',
                'type' => 'date',
            ],
            ['cell' => 'F'],
            ['cell' => 'G'],
            ['cell' => 'H'],
            ['cell' => 'I'],
            ['cell' => 'J'],
            ['cell' => 'K'],
            ['cell' => 'L'],
            ['cell' => 'M'],
            ['cell' => 'N'],
            [
                'cell' => 'O',
                'type' => 'number',
            ],
            [
                'cell' => 'P',
                'type' => 'number',
            ],
            [
                'cell' => 'Q',
                'type' => 'date',
            ],
            ['cell' => 'R'],
            ['cell' => 'S'],
            ['cell' => 'T'],
            ['cell' => 'U'],
            ['cell' => 'V'],
            ['cell' => 'W'],
            ['cell' => 'X'],
            ['cell' => 'Y'],
            ['cell' => 'Z'],
            ['cell' => 'AA'],
            [
                'cell' => 'AB',
                'type' => 'number',
            ],
            [
                'cell' => 'AC',
                'type' => 'number',
            ],
            [
                'cell' => 'AD',
                'type' => 'decimal',
            ],
            [
                'cell' => 'AE',
                'type' => 'decimal',
            ],
            [
                'cell' => 'AF',
                'type' => 'decimal',
            ],
            [
                'cell' => 'AG',
                'type' => 'decimal',
            ],
            ['cell' => 'AH'],
            ['cell' => 'AI'],
            ['cell' => 'AJ'],
        ];
    }

    private function getColumnFormat($format): string
    {
        return $this->columnFormats()[ $format ];
    }

    private function columnFormats(): array
    {
        return [
            'number' => NumberFormat::FORMAT_NUMBER,
            'decimal' => NumberFormat::FORMAT_NUMBER_00,
            'date' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }

    private function getValueFilter($key): string
    {
        return $this->filter[ $key ] ?? '';
    }

    private function getValueModelName($name, $serviceVClass): string
    {
        $id = $this->getValueFilter($name);
        if ($id === '') return self::PREFIX_FILTER_VALUE;
        return $this->selectNameById((int) $id, $serviceVClass);
    }

    private function selectNameById($id, $serviceClass): string
    {
        return !$this->isExistsById($serviceClass, $id)
            ? self::PREFIX_FILTER_VALUE
            : self::PREFIX_FILTER_VALUE . $serviceClass->findOne($id)->name;
    }

    private function isExistsById($serviceClass, $id)
    {
        return $serviceClass->exists($id);
    }

    public function filterOptions(): array
    {
        $observation = $this->getValueModelName('observation_id', $this->observationService);
        $district = $this->getValueModelName('district_id', $this->districtService);
        $year = self::PREFIX_FILTER_VALUE . $this->getValueFilter('year');

        return [
            [
                'cell' => 'B5',
                'name' => 'Jenis Pengawasan',
                'value' =>  $observation,
            ],
            [
                'cell' => 'B6',
                'name' => 'Kabupaten',
                'value' => ucwords($district),
            ],
            [
                'cell' => 'B7',
                'name' => 'Tahun',
                'value' => $year,
            ],
        ];
    }
}
