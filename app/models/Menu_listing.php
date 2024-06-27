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
        //Query Uddate
        $this->db->query('INSERT INTO ordered (id_user, id_menu, amount) VALUES (:id_user, :id_menu, :amount)');
        $this->db->bind('id_user', $data['id_user']);
        $this->db->bind('id_menu', $data['id_menu']);
        $this->db->bind('amount', $data['amount']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getAllOrderedItemByUserID($id)
    {
        $this->db->query('SELECT SUM(amount) AS jumlah, k.id, m.nama_menu, m.harga, k.amount, m.imagepath FROM ordered k JOIN menu m ON k.id_menu = m.id WHERE id_user = :id GROUP BY id_menu');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function addPayment($data){

        $this->db->query('INSERT INTO transaction (id_user,amount) VALUES (:id_user, :amount)');
        $this->db->bind('id_user', $data['user_id']);
        $this->db->bind('amount', $data['amount']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function addFavorite($data){

        $this->db->query('INSERT INTO favorite (id_user, id_menu) VALUES (:id_user, :id_menu)');
        $this->db->bind('id_user', $data['id_user']);
        $this->db->bind('id_menu', $data['id_menu']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function getAllFavorite($id){
        $this->db->query('SELECT favorite.*,menu.nama_menu,menu.harga,menu.description, menu.imagepath FROM favorite JOIN menu ON menu.id = favorite.id_menu WHERE favorite.id_user =:id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->resultSet();
    }

    public function updateQuantity($id, $quantity) {
        $this->db->query('UPDATE ordered SET amount = :quantity WHERE id = :id');
        $this->db->bind('quantity', $quantity);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteFavorite($data){
        $this->db->query('DELETE FROM favorite WHERE id = :id AND id_user =:id_user');
        $this->db->bind('id', $data['id']);
        $this->db->bind('id_user', $data['user_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function deleteKeranjang($id){
        $this->db->query('DELETE FROM ordered WHERE id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function plusQuantity($id){
        $this->db->query('UPDATE ordered SET amount = amount + 1 WHERE id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function minusQuantity($id){
        $this->db->query('UPDATE ordered SET amount = amount - 1 WHERE id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getItemById($id){
        $this->db->query('SELECT * FROM ordered WHERE id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->single();
    }
}