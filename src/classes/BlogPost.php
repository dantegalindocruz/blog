<?php 
 class BlogPost {

    // holds reference to the database object
    protected $db;

    public function __construct(Database $db)
    {
       $this->db = $db; // stores ref to the database object
    }

    
 }
?>