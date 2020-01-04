<?php
class Task extends Model
{
    public function create($user_name, $user_email, $body)
    {
        $sql = "INSERT INTO tasks (user_name, user_email, body, created_at) VALUES (:user_name, :user_email, :body, :created_at)";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([
            'user_name' => $user_name,
            'user_email' => $user_email,
            'body' => $body,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }
    public function showTask($id)
    {
        $sql = "SELECT * FROM tasks WHERE id =" . $id;
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }
    public function showAllTasks($limit = 3, $offset = 0, $sort_by, $sort_order)
    {
        $sql = "SELECT * FROM tasks ORDER BY ".$sort_by." " .$sort_order. " LIMIT ".$limit." OFFSET ".$offset." ";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
    public function countAllTasks()
    {
        $sql = "SELECT COUNT(*) FROM tasks";
        $req = Database::getBdd()->prepare($sql);
        $req->execute();
        return $req->fetch();
    }
    public function edit($id, $body, $done, $updated_by_admin_at)
    {
        $sql = "UPDATE tasks SET body = :body, done = :done, updated_by_admin_at = :updated_by_admin_at WHERE id = :id";
        $req = Database::getBdd()->prepare($sql);
        return $req->execute([
            ':id' => $id,
            ':body' => $body,
            ':done' => $done,
            ':updated_by_admin_at' => $updated_by_admin_at
        ]);
    }
}