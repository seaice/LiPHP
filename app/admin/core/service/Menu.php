<?php 
namespace admin\core\service;

use Li\Service;

class Menu extends Service 
{
    public static function service($className=__CLASS__)
    {
        return parent::service($className);
    }

    public function getMenu()
    {
        $menu = array(
            'Dashboard'=>url('site/dashboard'),
            '新闻管理'=>array(
                '添加'=>url('site/dashboard'),
                '管理'=>url('site/dashboard'),
            ),
        );

        return $menu;
    }
}
