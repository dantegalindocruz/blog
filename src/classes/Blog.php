<?php
   class BLog {
    // sotres reference to Database object
    protected $db = null;
    // stores reference to Blog Post object
    protected $blog_post = null;
    // stores reference to Member object
    protected $member = null;
    // stores reference to Category object
    protected $category = null;

    public function __construct($dsn, $username, $password)
    {
       $this->db = new Database($dsn, $username, $password); 
    }

    public function getBlogPost() {
        if($this->blog_post === null) {
            $this->blog_post = new BlogPost($this->db);
        }

        return $this->blog_post;
    }

    public function getMember() {
        if($this->member === null) {
            $this->member = new Member($this->db);
        }
        return $this->member;
    }

    public function getCategory() {
        if($this->category === null) {
            $this->category = new Category($this->db);;
        }
        return $this->category;
    }
   }
?>