<?php
/**
 * Created by PhpStorm.
 * User: yuri
 * Date: 15.02.18
 * Time: 12:16
 */

namespace Blog\Controller;

use Blog\Model\Entry;
use Blog\MVC\Controller;

class BlogEntryController extends Controller
{
    public function listAction()
    {
        $entries = Entry::findAll($this->dbh);

        return $this->render('default/blog_list', array_merge($_SESSION, ['entries' => $entries]));
    }

    public function detailAction()
    {
        $id = $this->requestData['id'];
        $entry = Entry::findById($this->dbh, $id);

        $data = [
            'comments' => [
                [
                    'url'
                ],
                []
            ],
            'comments_count' => 12120,
            'entry' => $entry
        ];

        return $this->render('default/blog_detail', array_merge($_SESSION, $data));
    }

    public function addAction()
    {
        if ($this->requestMethod == "POST") {

            Entry::insert($this->dbh, $this->requestData);

            return $this->redirect302('/');
        }

        return $this->render('default/blog_add', array_merge($_SESSION, []));
    }
}