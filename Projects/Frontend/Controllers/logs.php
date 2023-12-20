<?php namespace Project\Controllers;
use logsM,Pagination,URI;
class logs extends Controller 
{
	public function main()
	{
		Masterpage::title("Logs");
		$log = logsM::get();
		$say = View::say($log->totalRows());
		View::logs($log->result());
		View::num(intval(URI::segment(-1))+1);
		View::pagination(Pagination::output("bootstrap")->css(["current"=>"page-item active","links"=>"page-item","prev"=>"page-item","next"=>"page-item","first"=>"page-item","last"=>"page-item"])->url("logs")->limit(30)->totalRows(logsM::totalRows())->countLinks(5)->create(URI::segment(-1)));
	}
}