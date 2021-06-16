<?php

namespace App\Controller\Admin;

class CommentController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Comment');
    }

    public function index(?int $page = \null, ?string $message = \null)
    {
        $limit = 10;

        \extract($this->Comment->pending());
        \extract($this->paging($page, $statement, $limit));

        $this->render('admin.comment.index', compact('page', 'message', 'comments', 'nbPages', 'previous', 'next'));
    }

    public function edit($id)
    {
        $this->Comment->update($id, [
            'approved' => 1
        ]);
        $message = "Commentaire validé";
        return $this->index(null, $message);
    }

    public function delete($id)
    {
        $this->Comment->delete($id);
        $message = "Commentaire supprimé";
        return $this->index(null, $message);
    }
}
