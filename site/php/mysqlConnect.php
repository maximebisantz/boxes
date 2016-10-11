<?php 



class MysqlConnect{

    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "splash";
    
    private $conn;
    
    private function connect(){
        $conn = mysqli_connect($this->servername, $this->username, $this->password, $this->db);
        if(!$conn){
            die ("connection failed" . $conn->connect_error());
        }else{
            $this->conn = $conn;
        }
    }
    
    private function isBox($boxId){
        $this->connect();
        
        if($boxId == 0){
            return false;
        }
        
        $query = "SELECT boxid FROM ajax WHERE boxid = $boxId";
        $result = $this->conn->query($query);

        
        if($result->num_rows){
            return true;
        }else{
            return false;
        }
        $this->conn->close();        
    }
    
    public function getAllBoxes(){
        $this->connect();
        
        $query = "SELECT * FROM ajax";
        $result = $this->conn->query($query);
        
        if($result->num_rows > 0){
            $resultObject = array();
            
            while($row = $result->fetch_assoc()){
                //$resultObject[$row['boxid']] = array($row['title'] , $row['text']);
                array_push($resultObject, $row);
            }
            $this->conn->close();
            return json_encode($resultObject);
        }
        
    }
    
    public function getBoxContent($boxId){
        $this->connect();
        
        $query = "SELECT boxid, title, text FROM ajax WHERE boxid = $boxId";
        $result = $this->conn->query($query);
        $row = $result->fetch_assoc();

        $this->conn->close();
        
        return json_encode($row);
    }
    
    public function setBoxContent($boxId, $boxTitle, $boxContent){
        $this->connect();
        
        if($this->isBox($boxId) && $boxId != 0){
            $query = "UPDATE ajax SET title='$boxTitle', text='$boxContent' WHERE boxid='$boxId'";
        }else{
            $query = "INSERT into ajax (title, text) VALUES ('$boxTitle', '$boxContent')";
        }
        
        $result = $this->conn->query($query);
        
        if($result === TRUE){
            // get the last inserted ID.
            $last_id = $this->conn->insert_id;
            if($last_id == 0){
                $last_id = $boxId;
            }

            // send the box ID and the message as JSON.
            $response = array();
            $response[$last_id] = "Data saved successfully";
            return json_encode($response);
        }else{
            echo ("data not saved : " . $this->conn->error);
        }
        $this->conn->close();
        
    }
    
    public function deleteBox($boxId){
        $this->connect();
        
        $query = "DELETE FROM ajax WHERE boxid='$boxId'";
        $result = $this->conn->query($query);
        
        
        if($result === TRUE){
            echo "Box $boxId deleted";
        }else{
            echo "Box $boxId not deleted";
        }
        
        $this->conn->close();
    }
    
    
};

// $my = new MysqlConnect();
// $my->setBoxContent(105, "test", "test test");

?>