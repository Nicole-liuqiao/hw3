<?php
namespace qiaoliu\hw3\models;

class SignUpModel extends Model
{
	/**
     * @param $formvar array of username and password from form
     * @return $errMsg errMsg after check username and password against data in databas
     *
     */   
    public function getResult($formvars) {
		$result = "";
		$this::ensureTable("USER");

        if (self::CheckDuplicate($formvars['username'])){
            $result = "UserName already exist.";
            $this::closeConnection();
            return $result;
        }

        $errorMsg = self::InsertIntoTable($formvars);
        if ($errorMsg) {
            $result = "Register fails: " . $errorMsg . "\n Please Retry";
            $this::closeConnection();
            return $result;
        }

	}

	private function CheckDuplicate($value) {
        $qry = sprintf("select userid from USER where userName = '" . $value . "'");
        $qryResult = mysqli_query($this->con, $qry);
        return mysqli_num_rows($qryResult);
    }

    private function InsertIntoTable($values) {
        $errMsg = "";
        $insert_query = sprintf('insert into USER (
            userName,
            password
            )
            values
            (
            "' . $values['username'] . '",
            "' . $values['password'] . '"
            )');   
        if(!mysqli_query($this->con, $insert_query)) {
            $errMsg = mysqli_error($this->con);
        }
        return $errMsg;
    }
}
