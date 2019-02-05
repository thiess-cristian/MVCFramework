<?php

namespace App\Controllers;


use App\Models\Post;
use App\Models\PostUserScore;
use App\Models\Thread;
use Framework\Controller;

class ThreadController extends Controller
{
    public function showThread(array $params): void
    {
        $thread = new Thread();

        $posts = $thread->getPosts($params);

        $postUserScoreModel = new PostUserScore();

        session_start();

        $uid = $_SESSION['uid'];

        $userScores = $postUserScoreModel->getAllScoreUser($uid);

        foreach ($posts as &$value) {
            foreach ($userScores as $score) {
                if ($value['id'] == $score['id_post']) {
                    $value['score_user'] = $score['score_user'];
                }
            }
        }

        $subject = $thread->getThreadSubject($params);

        $data['posts'] = $posts;
        $data['subject'] = $subject['subject'];
        $data['thread_id'] = $params['id'];

        $this->view('/Thread.html.twig', $data);
    }

    public function postReply(array $params): void
    {
        $content = $_POST['content'];

        $split_query = null;
        if (isset($params['query'])) {
            parse_str($params['query'], $split_query);
        }

        session_start();
        $userId = $_SESSION['uid'];

        $post = new Post();

        $post->createPost($content, $split_query['thread_id'], $userId);

        header("Location:/thread/" . $split_query['thread_id']);
    }


    public function addReplyText(array $params): void
    {

        $post = new Post();

        $split_query = null;
        if (isset($params['query'])) {
            parse_str($params['query'], $split_query);
        }
        $replyContent = $post->getPost($split_query['id']);

        $params['reply_content'] = $replyContent['content'];
        $this->view('/Thread.html.twig', $params);
        // header("Location:/thread/".$split_query['thread_id']);
    }

    public function deletePost(array $params): void
    {
        $post = new Post();

        $split_query = null;
        if (isset($params['query'])) {
            parse_str($params['query'], $split_query);
        }

        $post->delete($split_query['id']);

        header("Location:/thread/" . $split_query['thread_id']);
    }

    public function deleteThread(array $params): void
    {
        $thread = new Thread();

        $split_query = null;
        if (isset($params['query'])) {
            parse_str($params['query'], $split_query);
        }

        $thread->delete($split_query['thread_id']);

        header("Location:/");
    }

    public function reportPost(array $params): void
    {
        $post = new Post();

        $split_query = null;
        if (isset($params['query'])) {
            parse_str($params['query'], $split_query);
        }

        $post->reportPost($split_query['id']);

        header("Location:/thread/" . $split_query['thread_id'] . "#" . $split_query['id']);
    }

    public function votePost(array $params): void
    {
        $post = new Post();

        $split_query = null;
        if (isset($params['query'])) {
            parse_str($params['query'], $split_query);
        }

        $post->votePost($split_query['id'], $split_query['score']);

        header("Location:/thread/" . $split_query['thread_id']);
    }
}