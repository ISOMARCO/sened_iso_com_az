<?php 

class bitcoinM extends Model 
{
    public static function insert($data)
    {
        return DB::insert('bitcoin',$data);
    }
}