<?php
namespace admin\core\controller;

use Li\GridView;

class SiteController extends Controller 
{
    public function indexAction()
    {
        $this->assign('menu', S('Menu')->getMenu());
        $this->display();
    }

    public function dashboardAction()
    {
        $this->display();
    }
}
