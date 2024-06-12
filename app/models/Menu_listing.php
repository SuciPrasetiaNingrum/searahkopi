<?php
class Menu_listing
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllList()
    {
        $this->db->query('SELECT * FROM menu');
        return $this->db->resultSet();
    }

    public function addItem($data)
    {
        $this->db->query('INSERT INTO ordered (id_user, id_menu, amount) VALUES (:id_user, :id_menu, :amount)');
        $this->db->bind('id_user', $data['id_user']);
        $this->db->bind('id_menu', $data['id_menu']);
        $this->db->bind('amount', $data['amount']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getAllOrderedItems()
    {
        $this->db->query('SELECT COUNT(*) AS jumlah, k.id, m.nama_menu, m.harga, k.amount FROM ordered k JOIN menu m ON k.id_menu = m.id');
        return $this->db->resultSet();
    }
}
