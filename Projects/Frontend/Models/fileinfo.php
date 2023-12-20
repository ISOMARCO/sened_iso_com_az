<?php 

class fileinfo extends Model
{
	public static function info()
	{
		return DB::where("id",1)->file_info();
	}
	public static function update($arr)
	{
		return DB::where("id",1)->update("file_info",
			[
				"az"=>$arr["az"],
				"en"=>$arr["en"],
				"ch"=>$arr["ch"],
				"say"=>$arr["say"],
				"no_pcs"=>$arr["no_pcs"],
				"kg"=>$arr["kg"],
				"cbm"=>$arr["cbm"],
				"alicilar"=>$arr["alicilar"],
				"start"=>$arr["start"],
				"end"=>$arr["end"],
				"tercume"=>$arr["tercume"]
			]
	);
	}

	public static function delete_update()
	{
		return DB::where("id",1)->update("file_info",["end"=>NULL,"name"=>NULL]);
	}

	public static function name_update($name)
	{
		return DB::where("id",1)->update("file_info",["name"=>$name]);
	}
}