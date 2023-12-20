<?php namespace Project\Controllers;
use wordsM,URL,Get,Session,File,Email;
class Home extends Controller
{
    public function main(String ...$parameters)
    {
        Masterpage::title('Sened');
        $az=Get::az();
        $en=Get::en();
        $ch=Get::ch();
        $w=wordsM::search(trim($az),trim(addslashes($en)),trim($ch));
        View::data($w->result());
        View::say($w->totalRows());
        View::sayy(1);
    }
    public function s404()
    {
        Masterpage::title('404! File Not Found');
    }
}