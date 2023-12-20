<?php namespace Project\Controllers;
use CURL,telegramBot,Cache;
class bitcoin extends Controller 
{
    public function main()
    {
        $result=CURL::init()->url('https://rest.coinapi.io/v1/assets?apikey=181F9D62-6059-4A04-B62F-9E4DB171DD6A')->header(false)->returntransfer(true)->exec();
        $result = json_decode($result);
    	
        $btcPrice = $result[1]->price_usd;
      	$btcPrice = intval($btcPrice);
    	$ethPrice = $result[126]->price_usd;
    	$ethPrice = round($ethPrice,2);
      	if(Cache::select("prices"))
        {
          $btcPerc = (($btcPrice/Cache::select("prices")['bitcoin'])*100)-100;
          $ethPerc = (($ethPrice/Cache::select("prices")['ethereum'])*100)-100;
          telegramBot::sendMessage('Bitcoin Price: '.intval($btcPrice)." ".round($btcPerc,2)."% (".Cache::select("prices")['bitcoin'].")\n Ethereum Price: ".$ethPrice." ".round($ethPerc,2)."% (".Cache::select("prices")['ethereum'].")");
          Cache::delete("prices");
          Cache::insert("prices",['bitcoin'=>$btcPrice,'ethereum'=>$ethPrice],"7 day");
        }else{
        	Cache::insert("prices",['bitcoin'=>$btcPrice,'ethereum'=>$ethPrice],"7 day");
            telegramBot::sendMessage('Bitcoin Price: '.$btcPrice."\n Ethereum Price: ".$ethPrice);
        }
    }
}