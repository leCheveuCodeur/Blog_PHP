<?php

namespace App\Controller\Admin;

class CommentController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Comment');
    }

    public function index(?int $page = \null)
    {
        $limit = 1;

        \extract($this->Comment->pending());
        \extract($this->paging($page, $statement, $limit));

        $this->render('admin.comment.index', compact('page', 'comments', 'nbPages', 'previous', 'next'));
    }

    public function edit($id)
    {
        $this->Comment->update($id, [
            'approved' => 1
        ]);
        return \header('Location: index.php?p=admin.comment.index');
    }

    public function delete($id)
    {
        $this->Comment->delete($id);
        return \header('Location: index.php?p=admin.comment.index');
    }
}
