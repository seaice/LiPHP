<?php 
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
                '分类'=>url('newsClass/admin'),
                '内容管理'=>url('news/admin'),
            ),
            '教程管理'=>array(
                // '教程分类'=>url('course/class'),
                '教程'=>url('course/model'),
            ),
            '项目管理'=>array(
                '分类'=>url('projectClass/admin'),
                '项目'=>url('project/admin'),
            ),
            '网址管理'=>array(
                '网址'=>url('site/admin'),
            ),
            'form'=>array(
                'create'=>url('form/create'),
            ),
        );

        return $menu;
    }
}

