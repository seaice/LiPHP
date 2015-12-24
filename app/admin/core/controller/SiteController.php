<?php
use Li\Log;
use Li\Controller;
use Li\Redis;
use Li\Captcha;
use Li\Upload;

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
        $model = Test::model();

        $starttime = explode(' ',microtime());

        for($i=0; $i < 1; $i++)
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
                ->find();
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
        $file = 
            array(
              "name"=> "a71ea8d3fd1f413458fdd278261f95cad0c85eea.jpg",
              "type"=> "image/jpeg",
              "tmp_name"=> "F:\xampp\tmp\phpBA0B.tmp",
              "error"=>'',
              "size"=>'123',
            );

        $upload = new Upload();
        $upload->allowType='jpg,gif,png';

        if(false==$upload->save($file))
        {
            debug($upload->getError());
        }

        // $upload->saveRemoteImage('http://img4.cache.netease.com/ent/2015/12/15/20151215112500b0c08.jpg');
        die;

        // Log::log()->trade->debug("123");

        // $test = new Tes123123t();


        $data = News::model()->findByPk(3);
        // SELECT * FROM `news` WHERE (id = '2') LIMIT 1

        $data = News::model()->find(array(
            // 'field'=>'id',
            'condition'=>array(
                array('id','=',3),
            )
        ));
        // SELECT * FROM `news` WHERE (id = '1') LIMIT 1


        $data = News::model()->findAll(array(
            'field'=>'*',
            'condition'=>array(
                array('id','>',2),
                array('title','!=',''),
                // array('id','in',array(1,2,3)),
                array('id','between',array(1,500)),
            ),
            'order'=>'id desc',
        ));
        // SELECT * FROM `news` WHERE (id > '2') AND (title != '') AND (id IN ('1','2','3')) AND (id BETWEEN '1' AND '5') ORDER BY id desc

        $data = News::model()->count(array(
            'field'=>'*',
            'condition'=>array(
                array('id','>',2),
                array('title','!=',''),
                // array('id','in',array(1,2,3)),
                array('id','between',array(1,500)),
            ),
            'order'=>'id desc',
        ));
        // SELECT COUNT(*) as `count` FROM `news` WHERE (id > '2') AND (title != '') AND (id BETWEEN '1' AND '500') ORDER BY id desc


        // $data = News::model()
        //     ->leftJoin('news_class','news_class.id=news.class')
        //     ->findAll(array(
        //         'field'=>'news.*,news_class.name',
        //         'condition'=>array(
        //             array('news.id','>',2),
        //             array('title','!=',''),
        //             array('news.id','in',array(1,2,3)),
        //             array('news.id','between',array(1,5)),
        //         ),
        //         'order'=>'news.id desc',
        //     )
        // );
        // SELECT news.*,news_class.name FROM `news` LEFT JOIN news_class ON news_class.id=news.class WHERE (news.id > '2') AND (title != '') AND (news.id IN ('1','2','3')) AND (news.id BETWEEN '1' AND '5') ORDER BY news.id desc


        // debug($data);
        // debug($data);

        // debug($_SESSION['name']);
        // $_SESSION['name'] = 'my name is hh';
        // debug($_SESSION);


        // $r = new \Redis();
        // $r->connect('127.0.0.1', '6379');

        // $test = Redis::redis()->test->get('myname');

        // $r->set('myname','ikodota');

        // $test = $r->get('myname');

        // debug($_SESSION);
        // debug(microtime());
        // for($i=1;$i<10000;$i++)
        // {
        //     $str = substr(sha1(rand()), 0, 4);
        // }
        // debug(microtime());
        // $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // for($i=1;$i<10000;$i++)
        // {
        //     $str = (substr(str_shuffle($pool), 0, 4));
        // }
        // debug(microtime());

        $this->display();
    }

    public function CaptchaAction()
    {
        $captcha = new Captcha();
        $captcha->generate(1);
    }

    public function uploadAction()
    {

        debug($_FILES);
    }
}

