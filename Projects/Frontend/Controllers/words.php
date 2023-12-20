<?php namespace Project\Controllers;
use wordsM,Post,URL,File,Pagination,URI,logsM;
class words extends Controller 
{
	public function main(...$str)
	{
		Masterpage::title("Sözlər");
		$totalRows = wordsM::say();
		View::data(wordsM::select()->result());
		$say = URI::segment(-1);
		View::say(intval($say)+1);
		View::totalRows($totalRows);
		View::pagination(Pagination::output("bootstrap")->css(["current"=>"page-item active","links"=>"page-item","prev"=>"page-item","next"=>"page-item","first"=>"page-item","last"=>"page-item"])->url("words")->limit(20)->totalRows($totalRows)->countLinks(5)->create(URI::segment(-1)));
	}
	public function add()
	{
		Masterpage::title("Add");
	}
	public function add_do($az=null,$en=null,$ch=null)
	{
		$red=false;
		if(empty($az) && empty($en) && empty($ch)){
			$az = Post::az();
			$en = Post::en();
			$ch = Post::ch();
			$red = true;
		}
		$az = trim($az);$en=trim($en);$ch=trim($ch);
		if(!wordsM::check($az,$en,$ch)){
			wordsM::insert($az,$en,$ch);
			logsM::add("words_add");
		}else logsM::add("words_add",0);
		if($red){
			redirect(URL::base("words"));
		}
		return;
	}
	public function edit($id)
	{
		Masterpage::title("Edit");
		$w = wordsM::selectRow($id)->row();
		View::w($w);
		View::id($id);
	}
	public function edit_do()
	{
		if(Post::az() && Post::en() && Post::ch())
		{
			$az = Post::az();
			$en = Post::en();
			$ch = Post::ch();
			$id = Post::id();
			wordsM::update($az,$en,$ch,$id);
			logsM::add("words_edit",$id." nömrəli id güncəlləndi.");
			redirect(URL::base("words/edit/".$id));
		}
	}
	public function delete($id)
	{
		wordsM::delete($id);
		logsM::add("words_delete");
		redirect(URL::base("words"));
	}
}