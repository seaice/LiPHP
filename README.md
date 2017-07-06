# LiPHP

it is not the best,but it is likely what you want.

# Composer

composer install

# ORM
```
$model = M('user');
```
## where
```
$model->where('id', 1)
      ->where('id', '>', 1)
      ->where('id', 'in', [1,2,3])
      ->where([
          ['id','in',array(1,2,3)],
          ['score','>',10],
      ])
```
## whereSql
```

```
## order




