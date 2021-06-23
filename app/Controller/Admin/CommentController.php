<?php

namespace App\Controller\Admin;

class CommentController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Comment');
    }

    /**
     * Display of Comments pending validation
     * @param null|int $page
     * @param null|string $message
     * @return void
     */
    public function index(?int $page = \null, ?string $message = \null)
    {
        // Set the number of comments per page
        $limit = 10;

        \extract($this->Comment->pending());
        \extract($this->paging($page, $statement, $limit));

        $alert = $this->Comment->alert();
        $this->render('admin.comment.index', compact('page', 'message', 'comments', 'nbPages', 'previous', 'next', 'alert'));
    }

    /**
     * Comment validation
     * @param int $id
     * @return void
     */
    public function edit(int $id)
    {
        $this->Comment->update($id, [
            'approved' => 1
        ]);
        $message = "Commentaire validé";
        return $this->index(null, $message);
    }

    /**
     * Delete a Comment
     * @param int $id
     * @return void
     */
    public function delete(int $id)
    {
        $this->Comment->delete($id);
        $message = "Commentaire supprimé";
        return $this->index(null, $message);
    }
}
