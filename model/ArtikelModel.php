<?php

class ArtikelModel extends App
{
    public function all()
    {
        $sql = "SELECT * FROM `artikel` ORDER BY `id` DESC";
        $q = $this->db->prepare($sql);
        $q->execute();
        $row = $q->fetchAll();
        return $row;
    }

    public function one($id)
    {
        $id = filter_var($id, FILTER_VALIDATE_INT);
        $sql = "SELECT * FROM `artikel` WHERE `id` = ?";
        $q = $this->db->prepare($sql);
        $q->execute(array($id));
        $row = $q->fetch();
        return $row;
    }
}