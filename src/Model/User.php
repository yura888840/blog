<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 15.02.18
 * Time: 15:42
 */

namespace Blog\Model;

class User
{
    public static function findByNameAndPass(\PDO $dbh, $name, $password)
    {
        /** @var \PDOStatement $sth */
        $sth = $dbh->prepare('SELECT * FROM user WHERE login=:name AND password=:pass');
        $sth->bindValue(':name', $name, \PDO::PARAM_STR);
        $sth->bindValue(':pass', static::hashPassword($password), \PDO::PARAM_STR);

        $result = $sth->execute();

        return $sth->fetch();
    }

    protected static function hashPassword($pass)
    {
        //@todo implement
        return $pass;
    }
}
