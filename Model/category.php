<?php

class category {
    private $category_id;
    private $category_name;
    private $category_des;
    

    // Constructor
    public function __construct($category_id, $category_name, $category_des) {
        $this->category_id = $category_id;
        $this->category_name = $category_name;
        $this->category_des = $category_des;
        
    }

    // Getter methods
    public function getcategory_id() {
        return $this->category_id;
    }

    public function getcategory_des() {
        return $this->category_des;
    }

    public function getcategory_name() {
        return $this->category_name;
    }

    
}

?>
