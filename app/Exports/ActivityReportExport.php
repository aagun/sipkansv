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

class ActivityReportExport
{
    private ActivityReportService $activityReportService;

    private array $filter;

    private string $template;

    private const CONTENT_TYPE_BASE64 = "data:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;base64,";

    public function __construct(
        ActivityReportService $activityReportService,
        mixed $filter,
        string $template = '/docs/template.xlsx')
    {
        $this->activityReportService = $activityReportService;
        $this->filter = $filter;
        $this->template = $template;
    }

    public function collection(): Collection
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


        $row_index = 8;
        foreach ($this->collection() as $item) {
            $cell_index = 0;
            $keys = getObjectKeys($item);

            foreach ($keys as $key) {
                $opts =  $this->getColumnOption($cell_index);
                $cell = $worksheet->getCell("{$opts['cell']}{$row_index}",)->setValue($item[ $key ]);
                $cell_index++;

                if (!isset($opts['type'])) continue;
                $cell->getStyle()
                    ->getNumberFormat()
                    ->setFormatCode($this->getColumnFormat($opts[ 'type' ]));
            };

            $row_index++;
        }

        return [
            'content' => $this->writeXlsxAsBase64($spreadsheet),
            'filename' => $this->composeSpreadFilename('laporan_kegiatan'),
        ];
    }

    public function composeSpreadFilename(string $filename, string $ext = Excel::XLSX): string
    {
        $timestamp = Carbon::now()->format('YmdHis');
        return "{$timestamp}_$filename.{$ext}";
    }

    /**
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function writeXlsxAsBase64(Spreadsheet $spreadsheet): string
    {
        IOFactory::createWriter($spreadsheet, Excel::XLSX);
        $writer = new WriteXlsx($spreadsheet);
        ob_start();
        $writer->save('php://output');
        $encoded_spreadsheet = base64_encode(ob_get_contents());
        ob_end_clean();

        return self::CONTENT_TYPE_BASE64 . $encoded_spreadsheet;
    }

    public function getColumnOption(int $cellIndex): array
    {
        return $this->columnsOptions()[$cellIndex];
    }

    public function columnsOptions(): array
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
                'type' => 'number',
            ],
            [
                'cell' => 'AE',
                'type' => 'number',
            ],
            [
                'cell' => 'AF',
                'type' => 'number',
            ],
            [
                'cell' => 'AG',
                'type' => 'number',
            ],
            ['cell' => 'AH'],
            ['cell' => 'AI'],
            ['cell' => 'AJ'],
        ];
    }

    public function getColumnFormat($format): string
    {
        return $this->columnFormats()[$format];
    }

    public function columnFormats(): array
    {
        return [
            'number' => NumberFormat::FORMAT_NUMBER,
            'decimal' => NumberFormat::FORMAT_NUMBER_00,
            'date' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
