<?php
class Category {
    protected $db; // reference to the database object that was created in the Blog Container class

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get_single_category($id) {
        $sql = "SELECT name, description, navigation FROM category WHERE id = :id";
        return $this->db->runSQL($sql, [$id])->fetch();
    }

    public function get_all_categoriies() {
        $sql = 'Select name, id from category';
        return $this->db->runSQL($sql)->fetchAll();
    }

    public function get_limited_categories($amount) {
        $sql = 'SELECT name, description FROM category LIMIT :amount';
        return $this->db->runSQL($sql, [$amount])->fetchAll();
    }

    public function update_category($id, $arguments): bool {
        $sql = 'UPDATE category SET name = :name, description = :description, navigation = :navigation WHERE id = :id';
        $arguments['id'] = $id;
        $this->db->runSQL($sql, $arguments);
        return true;
    }

    public function create_category(array $arguments) : bool {
        $sql = 'INSERT INTO category (name, description, navigation) VALUES (:name, :description, :navigation);';
        $this->db->runSQL($sql, $arguments);
        return true;
    }

}
?>