<?php
namespace gii\core\controller;

use Li\Controller;

class SiteController extends Controller
{
    public function indexAction()
    {
        $this->assign('menu', S('Menu')->getMenu());
        $this->display();
    }

    public function hahaAction()
    {
        echo 'haha';
    }

    public function dashboardAction()
    {
        $this->display();
    }
}
