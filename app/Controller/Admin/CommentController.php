<?php

namespace App\Controller\Admin;

use Core\Services\HTML\Paging;

class CommentController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Comment');
    }

    /**
     * Display of Comments pending validation
     * @param null|string $message
     * @return void
     */
    public function index(?string $message = \null): void
    {
        \extract($this->Comment->pending());
        \extract(Paging::generate(6, 'admin.comment.index', $this->Comment, $statement));

        $alert = $this->Comment->alert();
        $this->render('admin.comment.index', compact('paging', 'message', 'comments', 'alert'));
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
        return $this->index('Commentaire validé');
    }

    /**
     * Delete a Comment
     * @param int $id
     * @return void
     */
    public function delete(int $id)
    {
        $this->Comment->delete($id);
        return $this->index('Commentaire supprimé');
    }
}
