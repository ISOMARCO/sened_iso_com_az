<?php namespace Project\Controllers;
use PHPExcel,fileinfo,PHPExcel_IOFactory,PHPExcel_Style_Alignment,PHPExcel_Style_Border,File,logsM;
class uploadinv extends Controller
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
		$phpexcel->getActiveSheet()->mergeCells("A12:B12");
		$phpexcel->getActiveSheet()->mergeCells("C12:D12");
		$phpexcel->getActiveSheet()->mergeCells("F12:H12");
		$phpexcel->getActiveSheet()->setCellValue("A12","FROM:");
		$phpexcel->getActiveSheet()->setCellValue("C12","NINGBO, CHINA");
		$phpexcel->getActiveSheet()->setCellValue("E12","TO:");
		$phpexcel->getActiveSheet()->setCellValue("F12","BAKU, AZERBAIJAN");
		$phpexcel->getActiveSheet()->setCellValue("A13","N/S");
		$phpexcel->getActiveSheet()->setCellValue("B13","HS CODE");
		$phpexcel->getActiveSheet()->setCellValue("C13","DESCRIPTION OF GOODS");
		$phpexcel->getActiveSheet()->setCellValue("D13","QNTY (CTN)");
		$phpexcel->getActiveSheet()->setCellValue("E13","GW, KG.");
		$phpexcel->getActiveSheet()->setCellValue("F13","NW, KG.");
		$phpexcel->getActiveSheet()->setCellValue("G13","CTN PRICE (CIP,USD)");
		$phpexcel->getActiveSheet()->setCellValue("H13","AMOUNT(CIP,USD)");
		$phpexcel->getActiveSheet()->setCellValue("L13","KUBLAR");
		$phpexcel->getActiveSheet()->setCellValue("M13","KASSA1");
		$phpexcel->getActiveSheet()->setCellValue("N13","KASSA1");
		$phpexcel->getActiveSheet()->setCellValue("O13","PCS");
		$phpexcel->getActiveSheet()->getStyle("A12:O12")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$phpexcel->getActiveSheet()->getStyle("A12:O12")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$phpexcel->getActiveSheet()->getStyle("A13:O13")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$phpexcel->getActiveSheet()->getStyle("A13:O13")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$phpexcel->getActiveSheet()->getStyle("L13:O13")->getFont()->setSize(10)->setName("Arial");
		$phpexcel->getActiveSheet()->getStyle("L13:O13")->applyFromArray($border);
		$phpexcel->getActiveSheet()->getStyle("A12:H12")->getFont()->setBold(true)->setName("Times New Roman");
		$phpexcel->getActiveSheet()->getStyle("A13:H13")->getFont()->setName("Arial Cyr");
		$phpexcel->getActiveSheet()->getStyle("D13:G13")->getAlignment()->setWrapText(true);
		$phpexcel->getActiveSheet()->getStyle("A12:H12")->getFont()->setSize(10);
		$phpexcel->getActiveSheet()->getStyle("A13:H13")->getFont()->setSize(9);
		$phpexcel->getActiveSheet()->getColumnDimension("A")->setWidth(4.39); // -0.76
		$phpexcel->getActiveSheet()->getColumnDimension("B")->setWidth(9.14); // -0.76
		$phpexcel->getActiveSheet()->getColumnDimension("C")->setWidth(25.51); // -0.76
		$phpexcel->getActiveSheet()->getColumnDimension("D")->setWidth(9.14); // -0.76
		$phpexcel->getActiveSheet()->getColumnDimension("E")->setWidth(9.14); // -0.76
		$phpexcel->getActiveSheet()->getColumnDimension("F")->setWidth(9.14); // -0.76
		$phpexcel->getActiveSheet()->getColumnDimension("G")->setWidth(10.26); // -0.76
		$phpexcel->getActiveSheet()->getColumnDimension("H")->setWidth(16.35); // -0.76
		$phpexcel->getActiveSheet()->getColumnDimension("I")->setAutoSize(true);
		$phpexcel->getActiveSheet()->getColumnDimension("J")->setAutoSize(true);
		$phpexcel->getActiveSheet()->getColumnDimension("K")->setAutoSize(true);
		$phpexcel->getActiveSheet()->getColumnDimension("L")->setWidth(9.14); // -0.76
		$phpexcel->getActiveSheet()->getColumnDimension("M")->setWidth(9.14); // -0.76
		$phpexcel->getActiveSheet()->getColumnDimension("N")->setWidth(9.14); // -0.76
		$phpexcel->getActiveSheet()->getColumnDimension("O")->setWidth(9.14); // -0.76
		$phpexcel->getActiveSheet()->getRowDimension('13')->setRowHeight(36);
		$phpexcel->getActiveSheet()->getStyle("A12:H12")->applyFromArray($border_med);
		$phpexcel->getActiveSheet()->getStyle("A13:H13")->applyFromArray($border_med);
		// excelden bilgilerin alinmasi
		$s = 0;$say=0;
		for($i=$start;$i<=$end;$i++)
		{
			$phpexcel->getActiveSheet()->setCellValue("C".(14+$s),$worksheet->getCell($info->en.$i)->getValue());
			$phpexcel->getActiveSheet()->setCellValue("A".(14+$s),$s+1);
			$phpexcel->getActiveSheet()->setCellValue("I".(14+$s),$worksheet->getCell($info->alicilar.$i)->getValue());
			$phpexcel->getActiveSheet()->setCellValue("D".(14+$s),$worksheet->getCell($info->say.$i)->getValue());
			$phpexcel->getActiveSheet()->setCellValue("E".(14+$s),$worksheet->getCell($info->kg.$i)->getValue());
			$phpexcel->getActiveSheet()->setCellValue("F".(14+$s),"=E".(14+$s)."-D".(14+$s));
			$phpexcel->getActiveSheet()->setCellValue("J".(14+$s),$worksheet->getCell($info->az.$i)->getValue());
			$phpexcel->getActiveSheet()->setCellValue("K".(14+$s),$worksheet->getCell($info->ch.$i)->getValue());
			$phpexcel->getActiveSheet()->setCellValue("L".(14+$s),$worksheet->getCell($info->cbm.$i)->getValue());
			$phpexcel->getActiveSheet()->setCellValue("O".(14+$s),$worksheet->getCell($info->no_pcs.$i)->getCalculatedValue());
			$phpexcel->getActiveSheet()->setCellValue("M".(14+$s),20000);
			$phpexcel->getActiveSheet()->setCellValue("N".(14+$s),"=M".(14+$s)."-M".(14+$s)."*18%");
			$phpexcel->getActiveSheet()->setCellValue("H".(14+$s),"=N".(14+$s)."/1.7/0.36/72*L".(14+$s));
			$phpexcel->getActiveSheet()->setCellValue("G".(14+$s),"=H".(14+$s)."/D".(14+$s));
			$phpexcel->getActiveSheet()->getStyle("A".(14+$s).":O".(14+$s))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$phpexcel->getActiveSheet()->getStyle("A".(14+$s).":O".(14+$s))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$phpexcel->getActiveSheet()->getStyle("A".(14+$s).":O".(14+$s))->applyFromArray($border);
			$phpexcel->getActiveSheet()->getStyle("A".(14+$s).":O".(14+$s))->getFont()->setName("Arial")->setSize(10);
			$phpexcel->getActiveSheet()->getStyle("H".(14+$s))->getNumberFormat()->setFormatCode("0.00");
			$phpexcel->getActiveSheet()->getStyle("G".(14+$s))->getNumberFormat()->setFormatCode("0.0000");
			$s++;
		}
		$phpexcel->getActiveSheet()->getStyle("A".(14+$s).":H".(14+$s))->applyFromArray($border_med);
		$phpexcel->getActiveSheet()->setCellValue("D".(14+$s),"=SUM(D14:D".(14+$s-1).")");
		$phpexcel->getActiveSheet()->setCellValue("E".(14+$s),"=SUM(E14:E".(14+$s-1).")");
		$phpexcel->getActiveSheet()->setCellValue("F".(14+$s),"=SUM(F14:F".(14+$s-1).")");
		$phpexcel->getActiveSheet()->setCellValue("F".(14+$s+1),"TOTAL:(USD)");
		$phpexcel->getActiveSheet()->setCellValue("H".(14+$s+1),"=SUM(H14:H".(14+$s-1).")");
		$phpexcel->getActiveSheet()->setCellValue("L".(14+$s),"=SUM(L14:L".(14+$s-1).")");
		$phpexcel->getActiveSheet()->getStyle("L".(14+$s))->getFont()->setBold(true)->setName("Arial")->setSize(10);
		$phpexcel->getActiveSheet()->getStyle("L".(14+$s))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$phpexcel->getActiveSheet()->getStyle("L".(14+$s))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$phpexcel->getActiveSheet()->getStyle("D".(14+$s).":H".(14+$s))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$phpexcel->getActiveSheet()->getStyle("D".(14+$s).":H".(14+$s))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$phpexcel->getActiveSheet()->getStyle("D".(14+$s).":H".(14+$s))->getFont()->setBold(true)->setName("Arial")->setSize(10);
		$phpexcel->getActiveSheet()->mergeCells("F".(14+$s+1).":G".(14+$s+1));
		$phpexcel->getActiveSheet()->getStyle("F".(14+$s+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$phpexcel->getActiveSheet()->getStyle("F".(14+$s+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
		$phpexcel->getActiveSheet()->getStyle("F".(14+$s+1))->getFont()->setBold(true)->setName("Arial Cyr")->setSize(10);
		$phpexcel->getActiveSheet()->getRowDimension(strval(14+$s))->setRowHeight(18.75);
		$phpexcel->getActiveSheet()->getRowDimension(strval(14+$s+1))->setRowHeight(24.75);
		$phpexcel->getActiveSheet()->getStyle("H".(14+$s+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$phpexcel->getActiveSheet()->getStyle("H".(14+$s+1))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
		$phpexcel->getActiveSheet()->getStyle("H".(14+$s+1))->getFont()->setBold(true)->setName("Arial Cyr")->setSize(10);
		$phpexcel->getActiveSheet()->getStyle("H".(14+$s+1))->getNumberFormat()->setFormatCode("0.00");
		$phpexcel->createSheet();
		logsM::add("upload_invoice");
		if($file_ext === "xlsx")
		{
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="INVOICE.xlsx"');
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
			header('Content-Disposition: attachment;filename="INVOICE.xls"');
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