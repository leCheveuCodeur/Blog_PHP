<?php

namespace App\Controller\Admin;

class CommentController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Comment');
    }

    public function index()
    {
        $comments = $this->Comment->pending();
        $this->render('admin.comment.index', \compact('comments'));
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
