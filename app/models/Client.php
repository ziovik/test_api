<?php


class Client
{
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function findAllClients() {
        $this->db->query('SELECT * FROM clients ORDER BY id ASC');

        $results = $this->db->resultSet();

        return $results;
    }

    public function addClient($data) {
        $this->db->query('INSERT INTO  clients ( client_name, address, email,created_on,telephone) VALUES (:client_name, :address, :email, :created_on, :telephone)');

        $this->db->bind(':user_id', $data['user_id']);  // not anybody can insert
        $this->db->bind(':client_name', $data['client_name']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':created_on', $data['created_on']);
        $this->db->bind(':telephone', $data['telephone']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function findClientById($id) {
        $this->db->query('SELECT * FROM clients WHERE id = :id');

        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    public function updateClient($data) {
        $this->db->query('UPDATE clients SET client_name = :client_name, address = :address, email = :email, created_on = :created_on, telephone = :telephone  WHERE id = :id');

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':client_name', $data['client_name']);
        $this->db->bind(':address', $data['address']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':created_on', $data['created_on']);
        $this->db->bind(':telephone', $data['telephone']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteClient($id) {
        $this->db->query('DELETE FROM clients WHERE id = :id');

        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

}