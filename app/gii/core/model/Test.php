<?php
use Li\Model;

class Test extends Model
{
    public $pk = 'id';

    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

}
?>
