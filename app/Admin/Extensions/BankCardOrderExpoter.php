<?php
namespace App\Admin\Extensions;

use Maatwebsite\Excel\Facades\Excel;
use Dcat\Admin\Grid\Exporters\AbstractExporter;


class BankCardOrderExpoter extends AbstractExporter
{
    public function export()
    {
        Excel::create('bank_card_order', function($excel) {

            $excel->sheet('Sheetname', function($sheet) {

                 // 最多导出10W条数据
                 // 必须设置maxSize，当否则选择导出所有选项时只能导出默认的20条数据。
                $maxSize = 100000;

                // 这段逻辑是从表格数据中取出需要导出的字段
                $rows = collect($this->buildData(1, $maxSize))->map(function ($item) {
                    return array_only($item, ['id', 'title', 'content', 'rate', 'keywords']);
                });

                $sheet->rows($rows);

            });

        })->export('xls');
    }
}