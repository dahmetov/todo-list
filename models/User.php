<?php
class User extends Model
{
    public function getByLogin($login)
    {

        $sql = "SELECT * FROM users WHERE login = ?";
        $req = Database::getBdd()->prepare($sql);
        $req->execute([$login]);
        return $req->fetch();
    }
}