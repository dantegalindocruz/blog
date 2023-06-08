<?php
class Category {
    protected $db; // reference to the database object that was created in the Blog Container class

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function createCategory(array $category) : bool {
        $sql = 'INSERT INTO category (name, description) VALUES(:name, :description)';
        $this->db->runSQL($sql, $category);    
        return true;
    }

    public function get_single_category($id) {
        $sql = "SELECT name, description FROM category WHERE id = :id";
        return $this->db->runSQL($sql, [$id])->fetch();
    }

    public function get_all_categoriies() {
        $sql = 'Select name, description from category';
        return $this->db->runSQL($sql)->fetchAll();
    }

    public function get_limited_categories($amount) {
        $sql = 'SELECT name, description FROM category LIMIT :amount';
        return $this->db->runSQL($sql, [$amount])->fetchAll();
    }
}
?>