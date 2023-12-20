<?php namespace Project\Controllers;
use PHPExcel,PHPExcel_IOFactory,PHPExcel_Style_Border,PHPExcel_Style_NumberFormat,PHPExcel_Style_Alignment;
class excel extends Controller 
{
	public function main()
	{
		$siyahi = adlar();
		$tourist_name=siyahi();
		$tel = siyahi("tel");
		$say = hesabla($siyahi);
		$kilo = hesabla($siyahi,"kilo");
		$kub = hesabla($siyahi,"hecm");
		$tercume = tercume($siyahi);
		if($siyahi == false){echo "Manifest əlavə etməmisiniz.";exit;}
		$excel = new PHPExcel();
		$excel->getActiveSheet()->setTitle("Manifest");
		$excel->getActiveSheet()->setCellValue("A6","NO");
		$excel->getActiveSheet()->setCellValue("B6","KOD");
		$excel->getActiveSheet()->setCellValue("C6","B/L NO");
		$excel->getActiveSheet()->setCellValue("D6","TOURIST NAME");
		$excel->getActiveSheet()->setCellValue("E6","TOURIST PHONE");
		$excel->getActiveSheet()->setCellValue("F6","TOTAL LOADED");
		$excel->getActiveSheet()->setCellValue("G6","TOTAL WEIGHT");
		$excel->getActiveSheet()->setCellValue("H6","TOTAL CUB");
		$excel->getActiveSheet()->setCellValue("I6","RATE");
		$excel->getActiveSheet()->setCellValue("J6","OWER WEIGHT");
		$excel->getActiveSheet()->setCellValue("K6","OWER RATE");
		$excel->getActiveSheet()->setCellValue("L6","OW1 AMOUNT");
		$excel->getActiveSheet()->setCellValue("M6","TOTAL AMOUNT");
		$excel->getActiveSheet()->setCellValue("N6","DESCRIPTION");
		$excel->getActiveSheet()->setCellValue("O6","EX. EXPLANATION");
		$excel->getActiveSheet()->setCellValue("P6","EXTRA FEE");
		$excel->getActiveSheet()->setCellValue("Q6","R");

		$excel->getActiveSheet()->mergeCells("A1:Q1");
		$excel->getActiveSheet()->setCellValue("A1","CARGO  MANIFEST  CASPIAN SHIPPING CHINA YIWU  NO:  01    JANUARY");
		$excel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->getActiveSheet()->getStyle("A1")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
		$excel->getActiveSheet()->getRowDimension('1')->setRowHeight(23.25);
		$excel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true)->setName("Arial")->setSize(18);
		$excel->getActiveSheet()->setCellValue("A3","CONTAINER NO: ");
		$excel->getActiveSheet()->getStyle("A3")->getFont()->setBold(true)->setName("Arial")->setSize(12);
		$excel->getActiveSheet()->getStyle("A3")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
		$excel->getActiveSheet()->setCellValue("D3","HLXU 6283770");
		$excel->getActiveSheet()->getStyle("D3")->getFont()->setBold(true)->setName("Arial")->setSize(14);
		$excel->getActiveSheet()->getStyle("D3")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
		$excel->getActiveSheet()->setCellValue("G3","DATE:");
		$excel->getActiveSheet()->getStyle("G3")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
		$excel->getActiveSheet()->getStyle("G3")->getFont()->setBold(true)->setName("Arial")->setSize(12);
		$excel->getActiveSheet()->setCellValue("H3","  18/06/2021");
		$excel->getActiveSheet()->getStyle("H3")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
		$excel->getActiveSheet()->getStyle("H3")->getFont()->setBold(true)->setName("Arial")->setSize(12);		
		$excel->getActiveSheet()->mergeCells("N3:P3");
		$excel->getActiveSheet()->setCellValue("N3","LOADED:              FAHAI");
		$excel->getActiveSheet()->getStyle("N3")->getFont()->setBold(true)->setName("Arial")->setSize(11);
		$excel->getActiveSheet()->getStyle("N3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
		$excel->getActiveSheet()->getStyle("N3")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
		$excel->getActiveSheet()->setCellValue("D4","SEAL N:D118312");
		$excel->getActiveSheet()->getStyle("D4")->getFont()->setName("Arial")->setSize(9);
		$excel->getActiveSheet()->getStyle("D4")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
		$excel->getActiveSheet()->setCellValue("E4","NO:");
		$excel->getActiveSheet()->getStyle("E4")->getFont()->setBold(true)->setName("Calibri")->setSize(11);
		$excel->getActiveSheet()->getStyle("E4")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);
		$excel->getActiveSheet()->setCellValue("N4","No : ");
		$excel->getActiveSheet()->getStyle("N4")->getFont()->setBold(true)->setName("Calibri")->setSize(11);
		$excel->getActiveSheet()->getStyle("N4")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_BOTTOM);

		$excel->getActiveSheet()->getStyle("A6:Q6")->getAlignment()->setWrapText(true);
		$excel->getActiveSheet()->getStyle("A6:Q6")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$excel->getActiveSheet()->getStyle("A6:Q6")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->getActiveSheet()->getStyle("F:F")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$excel->getActiveSheet()->getColumnDimension("D")->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension("A")->setWidth(3.71);
		$excel->getActiveSheet()->getColumnDimension("B")->setWidth(4.57);
		$excel->getActiveSheet()->getColumnDimension("C")->setWidth(10.71);
		$excel->getActiveSheet()->getColumnDimension("E")->setWidth(11.28);
		$excel->getActiveSheet()->getColumnDimension("F")->setWidth(7.28);
		$excel->getActiveSheet()->getColumnDimension("G")->setWidth(7.14);
		$excel->getActiveSheet()->getColumnDimension("H")->setWidth(5.71);
		$excel->getActiveSheet()->getColumnDimension("I")->setWidth(6.14);
		$excel->getActiveSheet()->getColumnDimension("J")->setWidth(7.71);
		$excel->getActiveSheet()->getColumnDimension("K")->setWidth(6);
		$excel->getActiveSheet()->getColumnDimension("L")->setWidth(6.71);
		$excel->getActiveSheet()->getColumnDimension("M")->setWidth(6.71);
		$excel->getActiveSheet()->getColumnDimension("N")->setAutoSize(true);
		$excel->getActiveSheet()->getColumnDimension("O")->setWidth(11.85);
		$excel->getActiveSheet()->getColumnDimension("P")->setWidth(6.14);
		$excel->getActiveSheet()->getColumnDimension("Q")->setWidth(3.14);
		$excel->getActiveSheet()->getRowDimension("6")->setRowHeight(45);
		$excel->getActiveSheet()->getStyle("A6:Q6")->getFont()->setBold(true);		
		$excel->getActiveSheet()->getStyle("D:D")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
		$excel->getActiveSheet()->getStyle("M:M")->getNumberFormat()->setFormatCode('0');
		$excel->getActiveSheet()->getStyle("A:Q")->getFont()->setBold(true)->setName("Arial");
		$border = ['borders'=>['allborders'=>['style'=>PHPExcel_Style_Border::BORDER_THIN]]];
		$border_med = ['borders'=>['allborders'=>['style'=>PHPExcel_Style_Border::BORDER_MEDIUM]]];
		$excel->getActiveSheet()->getStyle("A6:Q6")->applyFromArray($border_med);
		$excel->getActiveSheet()->getStyle("A:Q")->getFont()->setSize(10);
		$excel->getActiveSheet()->getStyle("A6:Q6")->getFont()->setSize(10);
		for($i=0;$i<count($siyahi);$i++)
		{
			$excel->getActiveSheet()->getStyle("A".($i+7).":Q".($i+7))->applyFromArray($border);
			$excel->getActiveSheet()->setCellValue("A".($i+7),$i+1);
			$excel->getActiveSheet()->setCellValue("B".($i+7),"");
			$excel->getActiveSheet()->setCellValue("C".($i+7),"");
			$excel->getActiveSheet()->setCellValue("D".($i+7),$tourist_name[$i]);
			$excel->getActiveSheet()->setCellValue("E".($i+7),$tel[$i]);
			$excel->getActiveSheet()->setCellValue("F".($i+7),$say[$i]);
			$excel->getActiveSheet()->setCellValue("G".($i+7),$kilo[$i]);
			$excel->getActiveSheet()->setCellValue("H".($i+7),$kub[$i]);
			$excel->getActiveSheet()->setCellValue("I".($i+7),100);
			$excel->getActiveSheet()->setCellValue("J".($i+7),"=G".($i+7)."-220*H".($i+7));
			$excel->getActiveSheet()->setCellValue("K".($i+7),"0.14");
			$excel->getActiveSheet()->setCellValue("L".($i+7),"=J".($i+7)."*K".($i+7));
			$excel->getActiveSheet()->setCellValue("M".($i+7),"=H".($i+7)."*I".($i+7)."+L".($i+7));
			$excel->getActiveSheet()->setCellValue("N".($i+7),$tercume[$i]);
			$excel->getActiveSheet()->setCellValue("Q".($i+7),"R");
		}
		$excel->getActiveSheet()->setCellValue("D".(8+count($siyahi)),"B.ABBAS");
		$excel->getActiveSheet()->getStyle("A".(7+count($siyahi)).":Q".(7+count($siyahi)))->applyFromArray($border);
		$excel->getActiveSheet()->getStyle("A".(8+count($siyahi)).":Q".(8+count($siyahi)))->applyFromArray($border);
		$excel->getActiveSheet()->setCellValue("C".(6+count($siyahi)+3),"Total");
		$excel->getActiveSheet()->setCellValue("F".(6+count($siyahi)+3),"=SUM(F7:F".(7+count($siyahi)-1).")");
		$excel->getActiveSheet()->setCellValue("G".(6+count($siyahi)+3),"=SUM(G7:G".(7+count($siyahi)-1).")");
		$excel->getActiveSheet()->setCellValue("H".(6+count($siyahi)+3),"=SUM(H7:H".(7+count($siyahi)-1).")");
		$excel->getActiveSheet()->setCellValue("M".(6+count($siyahi)+3),"=SUM(M7:M".(7+count($siyahi)-1).")");
		$border = ['borders'=>['allborders'=>['style'=>PHPExcel_Style_Border::BORDER_THIN]]];
		$excel->getActiveSheet()->getStyle("A".(6+count($siyahi)+3).":Q".(6+count($siyahi)+3))->applyFromArray($border_med);
		$excel->getActiveSheet()->getStyle("Q6:Q".(6+count($siyahi)+3))->applyFromArray($border_med);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="MANIFEST.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0

		$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$objWriter->save('php://output');
		exit;
	}
}