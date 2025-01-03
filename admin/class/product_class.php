<?php
    include("database.php");
?>
<?php
    class product{
        private $db;

        public function __construct()
        {
            $this -> db = new Database();
        }

        public function show_cartegory() {
            $query = "SELECT * FROM tbl_cartegory ORDER BY cartegory_id DESC";
            $result = $this -> db -> select($query);
            return $result;
        }
        public function show_brand() {
            // $query = "SELECT * FROM tbl_brand ORDER BY brand_id DESC";
            $query = "SELECT tbl_brand.*, tbl_cartegory.cartegory_name FROM tbl_brand INNER JOIN tbl_cartegory ON tbl_brand.cartegory_id = tbl_cartegory.cartegory_id ORDER BY tbl_brand.brand_id DESC";
            $result = $this -> db -> select($query);
            return $result;
        }
        
        public function show_product_ajax($category_id) {
            $sql = "SELECT tbl_product.*, tbl_brand.brand_name, tbl_cartegory.cartegory_name
                    FROM tbl_product
                    JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id
                    JOIN tbl_cartegory ON tbl_product.cartegory_id = tbl_cartegory.cartegory_id
                    WHERE tbl_product.cartegory_id = $category_id"; // Thêm điều kiện WHERE để lọc theo category_id
            $result = $this->db->select($sql);
            return $result;
        }
        
        public function delete_product($product_id) {
            $query_get_images = "SELECT product_img,product_images FROM tbl_product WHERE product_id = '$product_id'";
            $images_result = $this->db->select($query_get_images);
        
            if ($images_result) {
                $images_row = $images_result->fetch_assoc();
                $product_img = $images_row['product_img'];
                $product_img_path = "uploads/" .trim($product_img);
                if (file_exists($product_img_path)) {
                    unlink($product_img_path);
                }
                $product_images = $images_row['product_images'];
                $image_names = explode(',',$product_images);
                foreach ($image_names as $image_name) {
                    $image_path = trim($image_name);
                    if (file_exists($image_path)) {
                        unlink($image_path);
                    }
                }
                $query = "DELETE FROM tbl_product WHERE product_id = '$product_id'";
                $result = $this->db->delete($query);
                header("Location: productlist.php");
                return $result;
            } else {
                return false;
            }
        }
        
        public function insert_product($data,$product_images_JSON, $product_image) {
            $product_name = $data["product_name"];
            $cartegory_id = $data["cartegory_id"];
            $brand_id = $data["brand_id"];
            $product_price = $data["product_price"];
            $product_price_new = $data["product_price_new"];
            $product_desc = $data["product_desc"];
            $product_img = $product_image;
            $product_images = $product_images_JSON;
            $filetarget = basename($_FILES['product_img']['name']);
            $filestye = strtolower(pathinfo($product_img, PATHINFO_EXTENSION));
            $filesize = $_FILES["product_img"]['size'];
            if(file_exists("uploads/$filetarget")){
                $alert = "File đã tồn tại";
                return $alert;
            }else{
                if($filestye !="jpg" && $filestye !="png" && $filestye !="jpeg"){
                    $alert = "Chỉ chọn file jpg , png hoặc jpeg";
                    return $alert;
                }
                else{
                    if($filesize>10000000){
                        $alert ="File Không được lớn hơn 10mb";
                    }else{
                    move_uploaded_file($_FILES['product_img']['tmp_name'],"uploads/".$_FILES['product_img']['name']);
                    $query = "INSERT INTO tbl_product 
                    (product_name,
                    cartegory_id,
                    brand_id,
                    product_price,
                    product_price_new,
                    product_desc,
                    product_img,
                    product_images) VALUES 
                    ('$product_name',
                    '$cartegory_id',
                    '$brand_id',
                    '$product_price',
                    '$product_price_new',
                    '$product_desc',
                    '$product_img',
                    '$product_images')";
                    $result = $this -> db -> insert($query);
                }
                    }
                    
                    }
            
            header("Location:productlist.php");
            return $result;
        }
        public function select_product_All(){
            $sql = "SELECT tbl_product.*, tbl_brand.brand_name, tbl_cartegory.cartegory_name
                FROM tbl_product
                JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id
                JOIN tbl_cartegory ON tbl_product.cartegory_id = tbl_cartegory.cartegory_id";
            $result = $this -> db -> select($sql);
            return $result;
        }

        public function get_product_for_edit($product_id) {
            $query = "SELECT * FROM tbl_product WHERE product_id = '$product_id'";
            $result = $this->db->select($query);
            return $result->fetch_assoc();
        }
        public function show_brand_ajax($cartegory_id) {
            $query = "SELECT tbl_brand.*, tbl_cartegory.cartegory_name 
                      FROM tbl_brand 
                      INNER JOIN tbl_cartegory ON tbl_brand.cartegory_id = tbl_cartegory.cartegory_id 
                      WHERE tbl_brand.cartegory_id = '$cartegory_id'";
            $result = $this->db->select($query);
            return $result;
        }
        public function update_product($data, $product_images_JSON, $product_image,$product_id) {
            $product_name = $data["product_name"];
            $cartegory_id = $data["cartegory_id"];
            $brand_id = $data["brand_id"];
            $product_price = $data["product_price"];
            $product_price_new = $data["product_price_new"];
            $product_desc = $data["product_desc"];
            $product_img = $product_image;
            $product_images = $product_images_JSON;
            
            $filetarget = basename($product_image);
            $filestye = strtolower(pathinfo($product_img, PATHINFO_EXTENSION));
            $filesize = $_FILES["product_img"]['size'];
        
            if (file_exists("uploads/$filetarget")) {
                $alert = "File đã tồn tại";
                return $alert;
            } else {
                if ($filestye != "jpg" && $filestye != "png" && $filestye != "jpeg") {
                    $alert = "Chỉ chọn file jpg , png hoặc jpeg";
                    return $alert;
                } else {
                    if ($filesize > 10000000) {
                        $alert = "File Không được lớn hơn 10mb";
                    } else {
                        move_uploaded_file($_FILES['product_img']['tmp_name'], "uploads/" . $_FILES['product_img']['name']);
        
                        $query = "UPDATE tbl_product SET 
                            cartegory_id = '$cartegory_id',
                            product_name = '$product_name',
                            product_price = '$product_price',
                            product_price_new = '$product_price_new',
                            product_desc = '$product_desc',
                            product_img = '$product_img',
                            product_images = '$product_images',
                            brand_id = '$brand_id' 
                            WHERE product_id = '$product_id'";
                        
                        $result = $this->db->update($query);
                    }
                }
            }
            header("Location:productlist.php");
            return $result;
        }
        
        public function get_types_by_category($category_id) {
            // Truy vấn CSDL để lấy các loại sản phẩm dựa trên category_id
            $query = "SELECT * FROM tbl_type WHERE category_id = '$category_id'";
            $result = $this->db->select($query);
            return $result;
        }
        
                public function select_product_by_category($category_id){
            $sql = "SELECT tbl_product.*, tbl_brand.brand_name, tbl_cartegory.cartegory_name
                    FROM tbl_product
                    JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id
                    JOIN tbl_cartegory ON tbl_product.cartegory_id = tbl_cartegory.cartegory_id
                    WHERE tbl_product.cartegory_id = '$category_id'";
            $result = $this -> db -> select($sql);
            return $result;
            }
            
        public function get_product_description ($product_id){
            $sql = "SELECT product_desc FROM tbl_product WHERE product_id = $product_id";
            $result = $this -> db -> select($sql);
            return $result;
        }
        
        public function get_product($product_id){
            $query = "SELECT tbl_product.*, tbl_brand.brand_name, tbl_cartegory.cartegory_name 
                      FROM tbl_product 
                      JOIN tbl_brand ON tbl_product.brand_id = tbl_brand.brand_id 
                      JOIN tbl_cartegory ON tbl_product.cartegory_id = tbl_cartegory.cartegory_id 
                      WHERE product_id = '$product_id'";
            $result = $this -> db -> select($query);
            return $result;
        }













       
       
        
        public function get_brand($brand_id){
            $query = "SELECT * FROM tbl_brand WHERE brand_id = '$brand_id'";
            $result = $this -> db -> select($query);
            return $result;
        }
       
        public function delete_brand($brand_id) {
            $query = "DELETE FROM tbl_brand WHERE brand_id = '$brand_id'";
            $result = $this -> db -> delete($query);
            header("Location:brandlist.php");
            return $result;
        }
        
    }
?>