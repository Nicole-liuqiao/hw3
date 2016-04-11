<?php
namespace qiaoliu\hw3\models;

class UserUploadModel extends Model
{
	/**
     * @param $formvar array of username and password from form
     * @return $errMsg errMsg after check username and password against data in databas
     *
     */   
    public function getResult($formvars) {
		$result = "";
		$this::ensureTable("USER");
        $this::ensureTable("IMAGE");

        if (!empty($_FILES['photo']['error'])) {
            $result = "There is error: " . $_FILES['photo']['error'];
            return $result;
        }

        if (strcmp($_FILES['photo']['type'], 'image/jpeg')) {
            $result = "Only support jpeg format";
            return $result;
        }
        if ($_POST['MAX_FILE_SIZE'] < $_FILES['photo']['size']) {
            $result = "file is too large";
            return $result;
        }

        $userid = $_SESSION['userid'];
        $filename  = getcwd() . '/src/resources/' . 'userid' . $userid . "-" . $_FILES['photo']['name']; 
        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $filename)) {
            $result = "copy file in server side fails";
            return $result;
        }

        echo "--caption: --";
        var_dump($_POST['caption']);
        echo "--userid: --";
        var_dump($_SESSION['userid']);
        echo "--location: --";
        var_dump($filename);
        
        $result = self::InsertIntoTable($_POST['caption'], $userid, $filename);

        var_dump($result);

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
        echo "-------";
        var_dump($insert_query); 
                echo "-------";
  
        if(!mysqli_query($this->con, $insert_query)) {
            $errMsg = mysqli_error($this->con);
        }
        return $errMsg;
    }
}
