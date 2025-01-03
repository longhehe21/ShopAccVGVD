<?php
    include_once 'admin/database.php';
?>
<?php
    class product{
        private $db;

        public function __construct()
        {
            $this -> db = new Database();
        }
        
        public function show_product($cartegory_id){
            $sql ="SELECT *
            FROM tbl_product
            WHERE cartegory_id = $cartegory_id 
            ";
            $result = $this->db->select($sql);
            return $result;
        }
        public function select_product_All(){
            $sql = "SELECT tbl_product.*, tbl_brand.brand_name, tbl_cartegory.cartegory_name
                FROM tbl_product
                JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id
                JOIN tbl_cartegory ON tbl_product.cartegory_id = tbl_cartegory.cartegory_id
                ";
            $result = $this -> db -> select($sql);
            return $result;
        }
        
    }
?>