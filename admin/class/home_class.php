<?php
    include("database.php");
?>
<?php
    class home{
        private $db;

        public function __construct()
        {
            $this -> db = new Database();
        }
        public function insert_home($home_name) {
            $query = "INSERT INTO tbl_home(home_name) VALUES ('$home_name')";
            $result = $this -> db -> insert($query);
            header("Location:home_list.php");
            // return $result;
        }
        public function show_home() {
            $query = "SELECT * FROM tbl_home ORDER BY home_id DESC";
            $result = $this -> db -> select($query);
            return $result;
        }
        public function get_home($home_id){
            $query = "SELECT * FROM tbl_home WHERE home_id = '$home_id'";
            $result = $this -> db -> select($query);
            return $result;
        }
        public function update_home($home_name, $home_id) {
            $query = "UPDATE tbl_home SET home_name = '$home_name' WHERE home_id = '$home_id'";
            $result = $this -> db -> update($query);
            header("Location:home_list.php");
            return $result;
        }
        public function delete_home($home_id) {
            $query = "DELETE FROM tbl_home WHERE home_id = '$home_id'";
            $result = $this -> db -> delete($query);
            header("Location:home_list.php");
            return $result;
        }
    }
?>