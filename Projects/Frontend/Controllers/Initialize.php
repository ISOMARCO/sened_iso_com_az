<?php namespace Project\Controllers;
use Session,URL;
class Initialize extends Controller
{
    /**
     * The codes to run at startup.
     * It enters the circuit before all controllers. 
     * You can change this setting in Config/Starting.php file.
     */
    public function main()
    {
        Theme::active('Default');
        Masterpage::headPage('Sections/head')
                  ->bodyPage('Sections/body')
                  ->browserIcon(FILES_DIR . 'favicon.ico')
                  ->backgroundImage(FILES_DIR . 'background.jpg');
    }
}