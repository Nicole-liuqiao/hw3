<?php
namespace qiaoliu\hw3\models;

require_once ("Model.php");

class Test extends Model
{
    public function getResult($formvars) {
        $errMsg = "";
        $this::ensureTable("USER");

        $qry = sprintf("select * from USER where userName = '" . $formvars['username'] . 
                        "' and password = '" . $formvars['password'] . "'");
        $qryResult = mysqli_query($this->con, $qry);

        if (!$qryResult) {
            die("database abnormal: " . mysqli_error($this->con));
        }

        // if there is one row in $qryResult, user login successfully
        // if there is no row in $qryResult, the data doesn't exist in database.        
        if (mysqli_num_rows($qryResult) == 1) {
            $errMsg = "user login successfully";
        } else {
            $errMsg = "username doesn't exist or username and password doesn't match";
        }
        return $errMsg;
    }
}


$formvars['username'] = 'admin';
$formvars['password'] = '123';
$test = new Test();
$errMsg = $test->getResult($formvars);
echo $errMsg;

