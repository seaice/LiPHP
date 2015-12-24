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
            'Generate'=>array(
                'crud'=>url('generate/crud'),
                'model'=>url('generate/model'),
                'controller'=>url('generate/controller'),
            ),
            'form'=>array(
                'create'=>url('form/create'),
            ),
        );

        return $menu;
    }
}

