<?php
namespace qiaoliu\hw3\models;

class SignInModel extends Model
{
    /**
     * @param $formvar array ['username' => someuser, 'password' => somepassword]
     * @return $errMsg errMsg after check username and password against data in databas
     *
     */         

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
        } else {
            $errMsg = "username doesn't exist or username and password doesn't match";
        }
        return $errMsg;
    }
}
