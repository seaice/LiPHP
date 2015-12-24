<?php
use Li\Controller;

class SiteController extends Controller 
{
    public function indexAction()
    {

        $menu = Menu::service();
        $this->assign('menu', Menu::service()->getMenu());

        $this->display();
    }

    public function test_1Action()
    {
        $model = TestModel::model();

        $starttime = explode(' ',microtime());

        for($i=0; $i < 1000; $i++)
        {
            $data = $model
                    // ->where('id','=', 1)
                    // ->where(array(
                    //     'id'=>'3',
                    // ))
                    // ->where('id','=', 3)
                    ->where('id', $i)
                    // ->where('uid','=', 2)
                    // ->where('role', '>', 1)
                    // ->leftJoin('test_attr', 'test.id=test_attr.id')
                    // ->orderBy('test.id desc')
                    // ->groupBy('role')
                    // ->limit(1,2)
                    ->page(1,4)
                    ->get();
        }

        debug($data);

        //程序运行时间
        $endtime = explode(' ',microtime());
        $thistime = $endtime[0]+$endtime[1]-($starttime[0]+$starttime[1]);
        $thistime = round($thistime,3);
        echo "本网页执行耗时：".$thistime." 秒。".time();

        echo 'hello world';
    }

    public function test_2Action()
    {
        $starttime = explode(' ',microtime());
        $dns = 'mysql:dbname=shb_test;host=127.0.0.1;port=3306';
        $pdo = new \PDO($dns, 'root', 'admin');

        for($i=0; $i < 1000; $i++)
        {
            unset($smt);

            $smt = $pdo->prepare('SELECT * FROM test WHERE id=:id LIMIT 0, 4');
            $smt->bindValue(':id', $i);

            $ret = $smt->execute();
            // debug($ret);
            // debug($smt->errorInfo());
            $data = $smt->fetchAll();
        }
        debug($data);

        //程序运行时间
        $endtime = explode(' ',microtime());
        $thistime = $endtime[0]+$endtime[1]-($starttime[0]+$starttime[1]);
        $thistime = round($thistime,3);
        echo "本网页执行耗时：".$thistime." 秒。".time();
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

