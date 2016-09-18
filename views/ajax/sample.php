<?php

$sheet = $objPHPExcel->setActiveSheetIndex(0);

$attributes = $json['attributes'];
$models = $json['models'];
$info = $json['info'];
$num = 0;
foreach ($attributes as $k => $v) {
    $sheet->setCellValue($excelChar[$num] . '1', $k);
    $sheet->setCellValue($excelChar[$num] . '2', $v);
    $num++;
}

$sheet->setCellValue('A3', $info);

$num = 0;
if ($models)
    foreach ($attributes as $k => $v) {
        $start = 4;
        foreach ($models[$k] as $key => $val) {
            $sheet->setCellValue($excelChar[$num] . $start, $val);
            $start++;
        }
        $num++;
    }

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="' . $json['filename']);
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
