<?php 
 class logsM extends Model 
 {
 	public static function add($action,$details=null,$result=1)
 	{
 		return DB::insert("logs",
 			[
 				"action"=>$action,
 				"ip"=>User::ip(),
 				"user_agent"=>User::agent(),
 				"result"=>$result,
 				"details"=>$details
 			]);
 	}
    public static function get()
    {
        return DB::orderBy("id","DESC")->limit(intval(URI::segment(-1)),30)->logs();
    }
    public static function totalRows()
    {
        return DB::select("id")->logs()->totalRows();
    }
 }