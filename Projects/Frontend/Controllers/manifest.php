<?php namespace Project\Controllers;
use Http,Post,File,URL,logsM;
class manifest extends Controller
{
	public function main($str = NULL)
	{
		Masterpage::title("Manifest");
		$siyahi = adlar();
		$saylar = hesabla($siyahi);
		$kilo = hesabla($siyahi,"kilo");
		$hecm= hesabla($siyahi,"hecm");
		View::siyahi($siyahi);
		View::adlar($siyahi);
		View::saylar($saylar);
		View::kilo($kilo);
		View::hecm($hecm);
		View::tercume(tercume($siyahi));
	}

	public function add()
	{
		Masterpage::title("Adları əlavə et");
		View::error("");
		if(adlar() != false)
		{
			View::error("İlk öncə manifesti silin.");
		}
	}
	public function add_do()
	{
		Http::isAjax() or exit;
		$siyahi = Post::siyahi();
		File::write(FILES_DIR."siyahi.txt",$siyahi);
		echo json_encode(["ok"=>"Əlavə edildi"]);
	}
	public function add_say()
	{
		Masterpage::title("Say əlavə et");
		View::error("");
		if(adlar() == false)
		{
			View::error("İlk öncə adları daxil edin. <a href='".URL::base('manifest/add')."'>Adlar daxil et</a>");
		}
		else if(hesabla(adlar()) != false)
		{
			View::error("İlk öncə manifesti silin.");
		}
	}
	public function add_kilo()
	{
		Masterpage::title("Kilo əlavə et");
		View::error("");
		if(adlar() == false)
		{
			View::error("İlk öncə adları daxil edin. <a href='".URL::base('manifest/add')."'>Adlar daxil et</a>");
		}
		else if(hesabla(adlar(),"kilo") != false)
		{
			View::error("İlk öncə manifesti silin.");
		}
	}
	public function add_hecm()
	{
		Masterpage::title("Həcm əlavə et");
		View::error("");
		if(adlar() == false)
		{
			View::error("İlk öncə adları daxil edin. <a href='".URL::base('manifest/add')."'>Adlar daxil et</a>");
		}
		else if(hesabla(adlar(),"hecm") != false)
		{
			View::error("İlk öncə manifesti silin.");
		}
	}
	public function add_say_do()
	{
		Http::isAjax() or exit;
		$siyahi = Post::siyahi();
		$say = explode("\n",$siyahi);
		if(adlar_say() == count($say))
		{
			File::write(FILES_DIR."say.txt",$siyahi);
			echo json_encode(["ok"=>"Əlavə edildi."]);
		}
		else
		{
			echo json_encode(["error"=>"Yazdığınız saylarda əksiklik və ya artıq var. Yenidən cəhd edin."]);
		}
		
	}
	public function add_kilo_do()
	{
		Http::isAjax() or exit;
		$siyahi = Post::siyahi();
		$say = explode("\n",$siyahi);
		if(adlar_say() == count($say))
		{
			File::write(FILES_DIR."kilo.txt",$siyahi);
			echo json_encode(["ok"=>"Əlavə edildi."]);
		}
		else 
		{
			echo json_encode(["error"=>"Yazdığınız saylarda əksiklik və ya artıq var. Yenidən cəhd edin."]);
		}
		
	}
	public function add_hecm_do()
	{
		Http::isAjax() or exit;
		$siyahi = Post::siyahi();
		$say = explode("\n",$siyahi);
		if(adlar_say() == count($say))
		{
			File::write(FILES_DIR."hecm.txt",$siyahi);
			echo json_encode(["ok"=>"Əlavə edildi."]);
		}
		else
		{
			echo json_encode(["error"=>"Yazdığınız saylarda əksiklik və ya artıq var. Yenidən cəhd edin."]);
		}
		
	}
	public function add_tercume()
	{
		Masterpage::title("Tərcümələri əlavə et");
		View::error("");
		if(adlar() == false)
		{
			View::error("İlk öncə adları daxil edin. <a href='".URL::base('manifest/add')."'>Adlar daxil et</a>");
		}
	}
	public function add_tercume_do()
	{
		Http::isAjax() or exit;
		$siyahi = Post::siyahi();
		$say = explode("\n",$siyahi);
		if(adlar_say() == count($say))
		{
			File::write(FILES_DIR."tercume.txt",$siyahi);
			echo json_encode(["ok"=>"Əlavə edildi."]);
		}
		else
		{
			echo json_encode(["error"=>"Yazdığınız tərcümələrdə əksiklik və ya artıq var. Yenidən cəhd edin."]);
		}
		
	}
	public function delete()
	{
		Http::isAjax() or exit;
		File::write(FILES_DIR."siyahi.txt","");
		File::write(FILES_DIR."say.txt","");
		File::write(FILES_DIR."kilo.txt","");
		File::write(FILES_DIR."hecm.txt","");
		File::write(FILES_DIR."tercume.txt","");
		logsM::add("delete_manifest");
		echo "Silindi.";
	}
}