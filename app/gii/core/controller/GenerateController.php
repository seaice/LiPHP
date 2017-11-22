<?php
namespace gii\core\controller;

use Li\Db;
use Li\Controller;
use Li\File;

class GenerateController extends Controller
{
    // public function tableAction()
    // {
    //     $db=Db::db()->default;
    //     $table=$db->query('SHOW TABLES');

    //     // $this->display();
    // }

    public function generateAction()
    {
        $this->assign('project', S('Generate')->getProject());
        $this->assign('column', S('Generate')->getColumns($_GET['table']));

        $this->display();
    }

    /**
     * 预览文件
     */
    public function previewModelAction()
    {
        $project=$_POST['project'];
        $env=$_POST['env'];
        $db=$_POST['db'];
        $table=$_POST['table'];

        $file=S('Generate')->getModelFile($project, $env, $db, $table);
        $file['diff']=true;
        if ($file['exist']) {
            if (S('Generate')->getModelCode($this, $project, $env, $db, $table) == file_get_contents($file['path'])) {
                $file['diff']=false;
            }
        }

        $this->assign('files', array($file));

        echo $this->fetch('generate/file_list');
    }

    /**
     * model生成，处理生成文件逻辑
     */
    public function modelAction()
    {
        $this->assign('project', S('Generate')->getProject());
        $flagGenerate=false;
        if (IS_POST) {
            $project=$_POST['project'];
            $env=$_POST['env'];
            $db=$_POST['db'];
            $table=$_POST['table'];

            $this->assign('columns', S('Generate')->getColumns($project, $env, $db, $table));
            if (isset($_POST['generate'])) {
                if (!empty($_POST['file'])) {
                    $this->_generateCodeFile($_POST['file']);

                    $flagGenerate=true;
                }
            }
        }

        $this->assign('flagGenerate', $flagGenerate);
        $this->display();
    }

    /**
     * 预览model代码逻辑
     */
    public function modelCodeAction()
    {
        $project = $_GET['project'];
        $env     = $_GET['env'];
        $db      = $_GET['db'];
        $table   = $_GET['table'];

        if (1 == get('diff')) {
            $file = S('Generate')->getModelFile($project, $env, $db, $table);
            $lines1 = file($file['path']);
            $lines2 = S('Generate')->getModelCode($this, $project, $env, $db, $table);
            $compare = S('Generate')->textDiff($lines1, $lines2);

            $this->assign('diff', $compare);
            $this->display('template/diff');
        } else {
            $html=S('Generate')->getModelCode($this, $project, $env, $db, $table);
            highlight_string($html);
        }
    }
    /**
     * 查看controller代码
     */
    public function controllerCodeAction()
    {
        $project    = $_GET['project'];
        $controller = $_GET['controller'];
        $env        = $_GET['env'];
        $db         = $_GET['db'];
        $table      = $_GET['table'];

        if (1 == get('diff')) {
            $file = S('Generate')->getControllerFile($project, $controller, $env, $db, $table);
            $lines1 = file($file['path']);
            $lines2 = S('Generate')->getControllerCode($this, $project, $controller, $env, $db, $table);
            $compare = S('Generate')->textDiff($lines1, $lines2);

            $this->assign('diff', $compare);
            $this->display('template/diff');
        } else {
            $html = S('Generate')->getControllerCode($this, $project, $controller, $env, $db, $table);
            highlight_string($html);
        }
    }

    /**
     * 查看admin代码
     */
    public function adminCodeAction()
    {
        $project=$_GET['project'];
        $env=$_GET['env'];
        $db=$_GET['db'];
        $table=$_GET['table'];
        $controller=S('Generate')->transName($table, false);

        if (1 ==  get('diff')) {
            $file=S('Generate')->getTemplateFile($project, $env, $db, $table, 'admin');
            $lines1 = file($file['path']);
            $lines2 = S('Generate')->getAdminCode($this, $project, $controller);
            $compare = S('Generate')->textDiff($lines1, $lines2);

            $this->assign('diff', $compare);
            $this->display('template/diff');
        } else {
            $html=S('Generate')->getAdminCode($this, $project, $controller);
            highlight_string($html);
        }
    }
    /**
     * 查看create代码
     */
    public function createCodeAction()
    {
        $project=$_GET['project'];
        $env=$_GET['env'];
        $db=$_GET['db'];
        $table=$_GET['table'];

        $controller=S('Generate')->transName($table, false);

        if (1 == get('diff')) {
            $file=S('Generate')->getTemplateFile($project, $env, $db, $table, 'create');
            $lines1 = file($file['path']);
            $lines2 = S('Generate')->getCreateCode($this, $project, $controller);
            $compare = S('Generate')->textDiff($lines1, $lines2);

            $this->assign('diff', $compare);
            $this->display('template/diff');
        } else {
            $html=S('Generate')->getCreateCode($this, $project, $controller);
            highlight_string($html);
        }
    }
    /**
     * 查看create代码
     */
    public function updateCodeAction()
    {
        $project=$_GET['project'];
        $env=$_GET['env'];
        $db=$_GET['db'];
        $table=$_GET['table'];

        $controller=S('Generate')->transName($table, false);

        if (1 == get('diff')) {
            $file=S('Generate')->getTemplateFile($project, $env, $controller, $table, 'update');
            $lines1 = file($file['path']);
            $lines2 = S('Generate')->getUpdateCode($this, $project, $controller);
            $compare = S('Generate')->textDiff($lines1, $lines2);

            $this->assign('diff', $compare);
            $this->display('template/diff');
        } else {
            $html=S('Generate')->getUpdateCode($this, $project, $controller);
            highlight_string($html);
        }
    }

    public function _formCodeAction()
    {
        $project=$_GET['project'];
        $env=$_GET['env'];
        $db=$_GET['db'];
        $table=$_GET['table'];

        if (1 == get('diff')) {
            $file=S('Generate')->getTemplateFile($project, $env, $db, $table, '_form');
            $lines1 = file($file['path']);
            $lines2 = S('Generate')->getFormCode($this, $project, $env, $db, $table);
            $compare = S('Generate')->textDiff($lines1, $lines2);

            $this->assign('diff', $compare);
            $this->display('template/diff');
        } else {
            $html=S('Generate')->getFormCode($this, $project, $env, $db, $table);
            highlight_string($html);
        }
    }


    public function controllerAction()
    {
        $this->assign('project', S('Generate')->getProject());
        $flagGenerate=false;
        if (IS_POST) {
            if (isset($_POST['generate'])) {
                if (!empty($_POST['file'])) {
                    $this->_generateCodeFile($_POST['file']);
                    $flagGenerate=true;
                }
            }
        }

        $this->assign('flagGenerate', $flagGenerate);

        $this->display();
    }

    /**
     * 预览生成的controller文件
     */
    public function previewControllerAction()
    {
        $project=$_POST['project'];
        $controller=$_POST['controller'];

        $file=S('Generate')->getControllerFile($project, $controller);
        $file['diff']=true;

        if ($file['exist']) {
            if (S('Generate')->getControllerCode($this, $project, $controller) == file_get_contents($file['path'])) {
                $file['diff']=false;
            }
        }

        $this->assign('files', array($file));

        echo $this->fetch('generate/file_list');
    }

    // private function __formCode($project,$env,$db,$table)
    // {
    //     $this->assign('columns', S('Generate')->getColumns($project,$env,$db,$table));
    //     $html=$this->fetch('template/template_form');

    //     return $html;
    // }

    public function previewCrudAction()
    {
        $project    = $_POST['project'];
        $env        = $_POST['env'];
        $db         = $_POST['db'];
        $table      = $_POST['table'];

        // model file
        $fileModel = S('Generate')->getModelFile($project, $env, $db, $table);
        $fileModel['diff'] = true;
        if ($fileModel['exist']) {
            if (S('Generate')->getModelCode($this, $project, $env, $db, $table) == file_get_contents($fileModel['path'])) {
                $fileModel['diff'] = false;
            }
        }

        $this->clearAllAssign();
        $controller = S('Generate')->transName($table);

        // controller file
        $fileController=S('Generate')->getControllerFile($project, $controller, $env, $db, $table);
        $fileController['diff'] = true;

        if ($fileController['exist']) {
            if (S('Generate')->getControllerCode($this, $project, $controller, $table) == file_get_contents($fileController['path'])) {
                $fileController['diff'] = false;
            }
        }
        $this->clearAllAssign();

        $controller = S('Generate')->transName($table, false);

        // admin file
        $fileAdmin=S('Generate')->getTemplateFile($project, $env, $db, $table, 'admin');
        $fileAdmin['diff']=true;

        if ($fileAdmin['exist']) {
            if (S('Generate')->getAdminCode($this, $project, $controller) == file_get_contents($fileAdmin['path'])) {
                $fileAdmin['diff']=false;
            }
        }
        $this->clearAllAssign();

        // create file
        $fileCreate=S('Generate')->getTemplateFile($project, $env, $db, $table, 'create');
        $fileCreate['diff']=true;

        if ($fileCreate['exist']) {
            // debug(strlen(S('Generate')->getCreateCode($this,$project,$controller)));
            // debug(strlen(file_get_contents($fileCreate['path'])));
            // echo '<div style="display:none;">'.S('Generate')->getCreateCode($this,$project,$controller).'</div>';
            // echo '<div style="display:none;">'.(file_get_contents($fileCreate['path'])).'</div>';

            if (S('Generate')->getCreateCode($this, $project, $controller) == file_get_contents($fileCreate['path'])) {
                $fileCreate['diff']=false;
            }
        }
        $this->clearAllAssign();

        // update file
        $fileUpdate=S('Generate')->getTemplateFile($project, $env, $db, $table, 'update');
        $fileUpdate['diff']=true;

        if ($fileUpdate['exist']) {
            if (S('Generate')->getUpdateCode($this, $project, $controller) == file_get_contents($fileUpdate['path'])) {
                $fileUpdate['diff']=false;
            }
        }
        $this->clearAllAssign();

        // _form file
        $fileForm=S('Generate')->getTemplateFile($project, $env, $db, $table, '_form');
        $fileForm['diff']=true;

        if ($fileForm['exist']) {
            // debug(S('Generate')->getFormCode($this,$project,$env,$db,$table));
            // debug(file_get_contents($fileForm['path']));
            // debug(strlen(S('Generate')->getFormCode($this,$project,$env,$db,$table)));
            // debug(strlen(file_get_contents($fileForm['path'])));
            if (S('Generate')->getFormCode($this, $project, $env, $db, $table) == file_get_contents($fileForm['path'])) {
                $fileForm['diff']=false;
            }
        }

        $this->assign('files', array($fileModel,$fileController,$fileAdmin,$fileCreate,$fileUpdate,$fileForm));

        echo $this->fetch('generate/file_list');
    }

    public function crudAction()
    {
        $this->assign('project', S('Generate')->getProject());
        $flagGenerate=false;

        if (IS_POST) {
            $project=$_POST['project'];
            $env=$_POST['env'];
            $db=$_POST['db'];
            $table=$_POST['table'];

            $this->assign('columns', S('Generate')->getColumns($project, $env, $db, $table));

            if (isset($_POST['generate'])) {
                if (!empty($_POST['file'])) {
                    $this->_generateCodeFile($_POST['file']);
                    $flagGenerate=true;
                }
            }
        }
        $this->assign('flagGenerate', $flagGenerate);
        $this->display();
    }

    private function _generateCodeFile($files)
    {
        foreach ($files as $value) {
            $value = explode('/', $value);
            if ($value[0] == 'model') {
                $file=S('Generate')->getModelFile($value[1], $value[2], $value[3], $value[4]);
                file_put_contents($file['path'], S('Generate')->getModelCode($this, $value[1], $value[2], $value[3], $value[4]));
            } elseif ($value[0] == 'controller') {
                $file=S('Generate')->getControllerFile($value[1], $value[2]);
                file_put_contents($file['path'], S('Generate')->getControllerCode($this, $value[1], $value[2]));
            } elseif ($value[0] == 'template') {
                $controller = S('Generate')->transName($value[4], false);

                $file=S('Generate')->getTemplateFile($value[1], $value[2], $value[3], $value[4], $value[5]);
                $templateFunc = 'get'.ucfirst($value[5]).'Code';
                    // debug($value);
                if ($value[5] == '_form') {
                    File::write($file['path'], S('Generate')->getFormCode($this, $value[1], $value[2], $value[3], $value[4]));
                } else {
                    File::write($file['path'], S('Generate')->$templateFunc($this, $value[1], $controller));
                }
                
                // die;
                // file_put_contents($file['path'],$this->$templateFunc($project,$value[1]));
            }
            
            // $file=S('Generate')->getModelFile($project,$env,$db,$value);
            // file_put_contents($file['path'],$this->_modelCode($project,$env,$db,$value));
            
            // $file=S('Generate')->getModelFile($project,$env,$db,$value);
            // file_put_contents($file['path'],$this->_modelCode($project,$env,$db,$value));
            
            // $file=S('Generate')->getModelFile($project,$env,$db,$value);
            // file_put_contents($file['path'],$this->_modelCode($project,$env,$db,$value));
            $flagGenerate=true;
        }
    }
}
