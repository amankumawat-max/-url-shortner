<?php

namespace App\Traits;

trait ExportTraits
{
    /**
     * Export records to Excel file (tab-delimited .xls format)
     *
     * @param $records
     * @param $filename
     * @return void
     */
    public function exportToExcel($records, $filename)
    {
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header('Content-Type: application/vnd.ms-excel;');

        $firstRow = true;
        foreach ($records as $row) {
            if ($firstRow) {
                echo implode("\t", array_keys($row)) . "\n";
                $firstRow = false;
            }
            array_walk($row, function (&$str) {
                $str = preg_replace("/\t/", "\\t", $str);
                $str = preg_replace("/\r?\n/", "\\n", $str);
                if (strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
            });
            echo implode("\t", array_values($row)) . "\n";
        }
        exit;
    }
}
