<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 15.02.18
 * Time: 15:42
 */

namespace Blog\Model;

use Blog\MVC\Model;

class Entry
{
    public static function findAll(\PDO $dbh)
    {
        /** @var \PDOStatement $sth */
        $sth = $dbh->query('SELECT * FROM entry');

        return $sth->fetchAll();
    }

    public static function findById(\PDO $dbh, $id)
    {
        /** @var \PDOStatement $sth */
        $sth = $dbh->prepare('SELECT * FROM entry WHERE id=:id');
        $sth->bindValue(':id', $id, \PDO::PARAM_INT);

        $result = $sth->execute();

        return $sth->fetch();
    }

    public static function insert(\PDO $dbh, $data)
    {
        $author = $_SESSION['user'];
        $url = '';

        /** @var \PDOStatement $sth */
        $sth = $dbh->prepare('INSERT INTO entry VALUES (NULL,?,?,?,CURRENT_TIMESTAMP,?)');

        $sth->bindParam(1, $author, \PDO::PARAM_STR);
        $sth->bindParam(2, $data['name'], \PDO::PARAM_STR);
        $sth->bindParam(3, $url, \PDO::PARAM_STR);
        $sth->bindParam(4, $data['remark'], \PDO::PARAM_STR);

        $result = $sth->execute();

        return $result;
    }
}
