<?php
namespace qiaoliu\hw3\models;

class UserMainModel extends Model
{
	/**
     * @param $formvar array of username and password from form. It's null here
     * @return $errMsg errMsg after check
     *
     */   
    public function getResult($formvars) {
		$result = "";
		$this::ensureTable("USER");
        $this::ensureTable("IMAGE");

        $userid = $_SESSION['userid'];
        $filename  = './src/resources/' . 'userid' . $userid .
                     "-" . 'time' . time() . "-" . $_POST['caption'] . "-" .
                      $_FILES['photo']['name']; 
        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $filename)) {
            $result = "copy file in server side fails";
            return $result;
        }
        
        $result = self::InsertIntoTable($_POST['caption'], $userid, $filename);

        $this::closeConnection();
	}

    private function InsertIntoTable($caption, $userid, $location) {
        $errMsg = "";
        $caption =  mysqli_real_escape_string($this->con, $caption);
        $location = mysqli_real_escape_string($this->con, $location);
        $userid = (int)$userid;
        $insert_query = sprintf("insert into IMAGE (
            caption,
            userid,
            location
            )
            values
            ('" . $caption . "',"  . $userid . ", '" . $location . "')");
  
        if(!mysqli_query($this->con, $insert_query)) {
            $errMsg = mysqli_error($this->con);
        }
        return $errMsg;
    }
}
