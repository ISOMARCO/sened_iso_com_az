<?php namespace Project\Controllers;
use fileinfo,PHPExcel_IOFactory,File,logsM;
class uploadmanifest extends Controller
{
	public function main()
	{
		$info = fileinfo::info()->row();
		$path = $info->name;
		$start = $info->start;
		$end = $info->end;
		$reader = PHPExcel_IOFactory::createReaderForFile($path);
		$excel = $reader->load($path);
		$worksheet = $excel->getSheetByName("PL");
		$az = array();$en = array();$ch = array();$say = array();$no_pcs = array();$kq = array();$cbm = array();$adlar = array();
		for($i=$start;$i<=$end;$i++)
		{
			array_push($az,$worksheet->getCell($info->az.$i)->getValue());
			array_push($en,$worksheet->getCell($info->en.$i)->getValue());
			array_push($ch,$worksheet->getCell($info->ch.$i)->getValue());
			array_push($say,$worksheet->getCell($info->say.$i)->getValue());
			array_push($no_pcs,$worksheet->getCell($info->no_pcs.$i)->getValue());
			array_push($kq,$worksheet->getCell($info->kg.$i)->getValue());
			array_push($cbm,$worksheet->getCell($info->cbm.$i)->getValue());
			array_push($adlar,$worksheet->getCell($info->alicilar.$i)->getValue());
		}
		File::write(FILES_DIR."siyahi.txt",implode(" \n",$adlar));
		File::write(FILES_DIR."say.txt",implode(" \n",$say));
		File::write(FILES_DIR."kilo.txt",implode(" \n",$kq));
		File::write(FILES_DIR."hecm.txt",implode(" \n",$cbm));
		File::write(FILES_DIR."tercume.txt",implode(" \n",$az));
		logsM::add("upload_manifest");
		redirect("excel");
		exit;
	}
}