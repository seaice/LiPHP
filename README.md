# LiPHP

it is not the best,but it is likely what you want.

# Composer

composer install

# ORM
```
$model = M('User');
```
## create
```
$model = M('User');
$model-name = "li";
if(!$model->save()) {
    var_dump($model->errnors);
}
```

## Retrieve


### use where or whereSql
```
$model->where('id', 1)
      ->where('id', '>', 1)
      ->where('id', 'in', [1,2,3])
      ->where([
          ['id','in',array(1,2,3)],
          ['score','>',10],
      ])
      ->find();
```
```
$model->whereSql('title=%s', 'li')
$model->whereSql('id>%d and id < %d', 6, 9)
$model->whereSql('title like %s and id < %d', "%li%", 100)
```
### use criteria
```
$criteria = new Criteria();
$criteria->where('id', 1);

$model->find($criteria);
```
### relation (support BelongsToRelation)
```
'关系名' => ['当前表列名', 关系, '关联model名', '关联表列名']
```
#### 延迟查询方式
```
Class UserDetail {
    ...
    public function relations()
    {
        return [
            'user' => ['uid', Model::BELONGS_TO , 'User', 'id'],
        ];
    }
    ...
}

$detail = M('UserDetail')->where('uid', 1)->find();

var_dump($detail->user->id);
var_dump($detail->user->name);
```
#### 一次查询方式
```
$detail = M('UserDetail')->where('uid', 1)->with('user')->find();

```

