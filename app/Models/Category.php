<?php


namespace App\Models;


use Framework\Model;
use \PDO;

class Category extends Model
{
    public function getThreadsFromCategory(array $params): array
    {
        $pdo = $this->newDbCon();

        $sql = "select t.id,t.subject,t.created,u.name,t.user_account_id
              from thread t join user_account u on t.user_account_id=u.id
              where t.category_id=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$params['id']]);

        $data = $stmt->fetchAll();

        return $data;
    }

    public function getCategoryName(array $params): array
    {
        $pdo = $this->newDbCon();

        $sql = "select name from category where id=?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$params['id']]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data;

    }
}