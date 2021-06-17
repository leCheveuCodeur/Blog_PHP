<?php

namespace App\Controller;

class CommentController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Comment');
    }

    /**
     * Display the view to submit a comment
     * @param int $id 
     * @return void 
     */
    public function add(int $id)
    {
        if (!empty($_POST) && !empty($_SESSION)) {
            $comment = $this->Comment->create([
                'content' => $_POST['content'],
                'firstDate' => date('Y-m-d G:i:s', time() + 3600 * 2),
                'lastDate' => date('Y-m-d G:i:s', time() + 3600 * 2),
                'user_id' => $_SESSION['auth'],
                'post_id' => $id
            ]);

            \header('Location: index.php?p=post.show.' . $id);
        }
    }
}
