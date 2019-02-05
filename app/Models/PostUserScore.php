<?php
/**
 * Created by PhpStorm.
 * User: Cristi
 * Date: 2/4/2019
 * Time: 10:14 AM
 */

namespace App\Models;

use Framework\Model;
use \PDO;

class PostUserScore extends Model
{
    protected $table = "post_user_score";

    public function updateScore(string $postId, string $userId, int $score): void
    {
        $this->update(['id_post' => $postId, 'id_user' => $userId], ['score_user' => $score]);
    }

    public function addScore(string $postId, string $userId, int $score): void
    {
        $this->new(['id_post' => $postId, 'id_user' => $userId, 'score_user' => $score]);
    }

    public function findScore(string $postId, string $userId): array
    {
        return $this->find(['id_post' => $postId, 'id_user' => $userId]);
    }

    public function getAllScoreUser($uid): array
    {
        $pdo = $this->newDbCon();

        $sql = "select id_post, score_user from post_user_score  where id_user=?";

        $stmt = $pdo->prepare($sql);

        $stmt->execute([$uid]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function adjustScore(string $postId, string $userId, int &$score): void
    {

        $scoreEntry = $this->findScore($postId, $userId)[0];

        if (empty($scoreEntry)) {
            $this->addScore($postId, $userId, $score);
        } else {
            if (($scoreEntry['score_user'] == -1 && $score == -1)) {
                $score = 1;
                $this->delete($scoreEntry['id']);
            } else if ($scoreEntry['score_user'] == -1 && $score == 1) {
                $this->updateScore($postId, $userId, $score);
                $score += 1;
            } else if ($scoreEntry['score_user'] == 1 && $score == -1) {
                $this->updateScore($postId, $userId, $score);
                $score -= 1;
            } else if ($scoreEntry['score_user'] == 1 && $score == 1) {
                $score = -1;
                $this->delete($scoreEntry['id']);
            }
        }
    }

}