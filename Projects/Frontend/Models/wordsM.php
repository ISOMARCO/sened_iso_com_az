<?php 
class wordsM extends Model 
{
	public static function select()
	{
		return DB::orderBy("w_id","DESC")->limit(intval(URI::segment(-1)),20)->words();
	}
	public static function selectRow($id)
	{
		return DB::where("w_id",$id)->words();
	}
	public static function update($az,$en,$ch,$id)
	{
		return DB::where("w_id",$id)->update("words",[
			"w_az"=>$az,
			"w_en"=>$en,
			"w_ch"=>$ch
		]);
	}
	public static function check($az,$en,$ch)
	{
		$az = trim($az);$en = trim($en);$ch = trim($ch);
		$en = str_replace("'","",$en);
		if(DB::isExists("words","w_az",$az) && DB::isExists("words","w_en",$en) && DB::isExists("words","w_ch",$ch))
			return true;
		return false;
	}
	public static function insert($az,$en,$ch)
	{
		$az = trim($az);$en = trim($en);$ch = trim($ch);
		$en = str_replace("'","",$en);
		return DB::insert("words",[
			"w_az"=>$az,
			"w_en"=>$en,
			"w_ch"=>$ch
		]);
	}
	public static function delete($id)
	{
		return DB::where("w_id",$id)->delete("words");
	}
	public static function search($az,$en,$ch)
	{
		$az = trim($az);$en = trim($en);$ch = trim($ch);
		return DB::whereLike("w_az",$az,"and")->whereLike("w_en",$en,"and")->whereLike("w_ch",$ch)->words();
	}
	public static function say()
	{
		return DB::select("w_id")->words()->totalRows();
	}
	public static function translate($en,$ch)
	{
		return DB::select("w_az")->where("w_en",$en)->where("w_ch",$ch)->words();
	}
}