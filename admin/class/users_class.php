<?php
    include "database.php";
?>
<?php
    class user{
        private $db;

        public function __construct()
        {
            $this -> db = new Database();
        }

        public function show_users() {
            $query = "SELECT * FROM  tbl_users WHERE role = 0 ORDER BY id DESC";
            $result = $this -> db -> select($query);
            return $result;
        }
        public function delete_users($id) {
            $query = "DELETE FROM tbl_users WHERE id = '$id'";
            $result = $this -> db -> delete($query);
            header("Location:userlist.php");
            return $result;
        }
        
    }
?>