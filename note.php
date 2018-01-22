# 开发笔记

phpexcel  in thinkphp

autoset width

/*    this file will word in the end of the export       */

In my case this line didn't make much of a difference
\PHPExcel_Shared_Font::setAutoSizeMethod('exact');
  Iterating all the sheets
  /** @var PHPExcel_Worksheet $sheet */
 foreach ($p->getAllSheets() as $sheet) {
      Iterating through all the columns
      The after Z column problem is solved by using numeric columns; thanks to the columnIndexFromString method
     for ($col = 0; $col <= \PHPExcel_Cell::columnIndexFromString($sheet->getHighestDataColumn()); $col++) {
         $sheet->getColumnDimensionByColumn($col)->setAutoSize(true);
     }
 }
