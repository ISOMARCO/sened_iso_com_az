<?php namespace Project\Controllers;
use Http,Upload,Folder,fileinfo,Post,File,logsM,PHPExcel,PHPExcel_IOFactory,wordsM;
class fileupload extends Controller
{
	public function main()
	{
		Masterpage::title("Sənəd Yüklə");
		$folder = Folder::files(FILES_DIR."sened");
		View::folder($folder);
		View::folder_say(count($folder));
		View::fileinfo(fileinfo::info()->row());
	}
	public function do()
	{
		Http::isAjax() or exit;
		Upload::extensions("xlsx","xls")->target(FILES_DIR."sened")->start("file");
		if(Upload::error()) {echo Upload::error();exit;}
		$path = Upload::info()->path;
		fileinfo::name_update($path);
		// tercumeleri elave et start
		$info = fileinfo::info()->row();
		if($info->tercume == 0){
		$phpexcel = new PHPExcel();
		$reader = PHPExcel_IOFactory::createReaderForFile($path);
		$excel = $reader->load($path);
		$worksheet = $excel->getSheetByName("PL");
		$start = $info->start;$end = $info->end;
		for($i = $start;$i<=$end;$i++)
		{
			$en = trim($worksheet->getCell($info->en.$i)->getValue());
			$az = trim($worksheet->getCell($info->az.$i)->getValue());
			$ch = trim($worksheet->getCell($info->ch.$i)->getValue());
			if(!empty($en) && !empty($az) && !empty($ch))
			{
				if(!wordsM::check($az,$en,$ch)){
					wordsM::insert($az,$en,$ch);
				}
			}
		}
		}
		// tercumeleri elave et end
		logsM::add("file_upload");
		echo "Sənəd Yükləndi.";exit;
	}
	public function invoice()
	{
		return;
	}
	public function delete()
	{
		$path = fileinfo::info()->row()->name;
		File::delete($path);
		fileinfo::delete_update();
		logsM::add("file_delete");
		redirect("fileupload");
	}
	public function file_info()
	{
		Http::isAjax() or exit;
		$az = Post::az();
		$en = Post::en();
		$ch = Post::ch();
		$say = Post::say();
		$no_pcs = Post::no_pcs();
		$kg = Post::kg();
		$cbm = Post::cbm();
		$alicilar = Post::alicilar();
		$start = Post::start();
		$end = Post::end();
		$tercume=Post::tercume();
		if($tercume) $tercume=1;
		else $tercume=0;
		if(empty($az) || empty($en) || empty($ch) || empty($say) || empty($no_pcs) || empty($kg) || empty($cbm) || empty($alicilar) || empty($start) || empty($end)) {echo json_encode(["error"=>"Bütün xanaları doldurmalısınız!"]);exit;}
		fileinfo::update(["az"=>$az,"en"=>$en,"ch"=>$ch,"say"=>$say,"no_pcs"=>$no_pcs,"kg"=>$kg,"cbm"=>$cbm,"alicilar"=>$alicilar,"start"=>$start,"end"=>$end,"tercume"=>$tercume]);
		logsM::add("file_info_change");
		echo json_encode(["ok"=>true]);exit;
	}
}