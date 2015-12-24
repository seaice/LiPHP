<?php
use Li\Controller;


class SiteController extends Controller 
{
    public function indexAction()
    {
        $this->assign('words', 'hello world!');
        $this->display();
    }
}

