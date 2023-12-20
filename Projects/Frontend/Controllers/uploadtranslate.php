<?php namespace Project\Controllers;
use PHPExcel,fileinfo,PHPExcel_IOFactory,PHPExcel_Style_Alignment,PHPExcel_Style_Border,File,logsM,wordsM;
class uploadtranslate extends Controller
{
    public function main()
    {
        $info = fileinfo::info()->row();
        $path = $info->name;
        $file_ext = explode(".",File::info($path)->basename);
		$file_ext = end($file_ext);
        $start = $info->start;
		$end = $info->end;
		$phpexcel = new PHPExcel();
		$reader = PHPExcel_IOFactory::createReaderForFile($path);
		$excel = $reader->load($path);
		$worksheet = $excel->getSheetByName("PL");
        $border = ['borders'=>['allborders'=>['style'=>PHPExcel_Style_Border::BORDER_THIN]]];
		$border_med = ['borders'=>['allborders'=>['style'=>PHPExcel_Style_Border::BORDER_MEDIUM]]];
        $phpexcel->getActiveSheet()->setCellValue("A8","İngilis");
        $phpexcel->getActiveSheet()->setCellValue("B8","Çin");
        $phpexcel->getActiveSheet()->setCellValue("C8","Azərbaycan");
        $phpexcel->getActiveSheet()->getColumnDimension("A")->setWidth(35);
		$phpexcel->getActiveSheet()->getColumnDimension("B")->setWidth(35);
		$phpexcel->getActiveSheet()->getColumnDimension("C")->setWidth(35);
		$phpexcel->getActiveSheet()->getStyle("A8:C8")->applyFromArray($border_med);
		$phpexcel->getActiveSheet()->getStyle("A8:C8")->getFont()->setName("Arial")->setSize(14);
        // excelden bilgilerin alinmasi
        $s=0;
        for($i=$start;$i<$end;$i++)
        {
			$phpexcel->getActiveSheet()->getStyle("A".(8+$s).":C".(8+$s))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$phpexcel->getActiveSheet()->getStyle("A".(8+$s).":C".(8+$s))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$s++;
			$phpexcel->getActiveSheet()->getStyle("A".(8+$s).":C".(8+$s))->getFont()->setName("Arial")->setSize(10);
			$phpexcel->getActiveSheet()->getStyle("A".(8+$s).":C".(8+$s))->applyFromArray($border);
            $phpexcel->getActiveSheet()->setCellValue("A".(8+$s),$worksheet->getCell($info->en.$i)->getValue());
            $phpexcel->getActiveSheet()->setCellValue("B".(8+$s),$worksheet->getCell($info->ch.$i)->getValue());
            $translate = wordsM::translate($worksheet->getCell($info->en.$i),$worksheet->getCell($info->ch.$i))->result();
            if(count($translate)>1) $phpexcel->getActiveSheet()->setCellValue("C".(8+$s),"Bu sözün tərcümə sayı 1dən çoxdur.");
            else if(count($translate) == 1) $phpexcel->getActiveSheet()->setCellValue("C".(8+$s),$translate[0]->w_az);
            else $phpexcel->getActiveSheet()->setCellValue("C".(8+$s)," ");
        }
		$phpexcel->getActiveSheet()->getStyle("A".(8+$s).":C".(8+$s))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$phpexcel->getActiveSheet()->getStyle("A".(8+$s).":C".(8+$s))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        if($file_ext === "xlsx")
		{
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="TRANSLATE.xlsx"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel2007');
			$objWriter->save('php://output');
		}else if($file_ext === "xls")
		{
			// Redirect output to a client’s web browser (Excel5)
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="TRANSLATE.xls"');
			header('Cache-Control: max-age=0');
			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($phpexcel, 'Excel5');
			$objWriter->save('php://output');
		}

		
		exit;
    }
}