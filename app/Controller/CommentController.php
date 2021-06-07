<?php

namespace App\Controller;

class CommentController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Comment');
    }

    public function add()
    {
        if (!empty($_POST) && !empty($_SESSION)) {
            $comment = $this->Comment->create([
                'content' => $_POST['content'],
                'firstDate' => date('Y-m-d G:i:s', time() + 3600 * 2), //TODO voir pour améliorée la datation en la rendant international et adpater à l'utilisateur
                'lastDate' => date('Y-m-d G:i:s', time() + 3600 * 2),
                'user_id' => $_SESSION['auth'],
                'post_id' => $_GET['id']
            ]);

<<<<<<< HEAD
<<<<<<< Updated upstream
        if ($category === false) {
            $this->notFound();
=======
            \header('Location: index.php?p=post.show.'.$_GET['id']);
>>>>>>> Stashed changes
=======
            \header('Location: index.php?p=post.show&id='.$_GET['id']);
>>>>>>> feature/comment/#7
        }
    }
}
