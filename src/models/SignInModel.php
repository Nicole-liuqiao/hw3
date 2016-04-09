<?php
namespace qiaoliu\hw3\models;

class SignInModel extends Model
{
    /**
     * @param $formvar array of username and password from form
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
            $errMsg = mysqli_error($this->con);
            return $result;
        }
        
        // if no row in $qryResult, the data doesn't exist in database.
        return mysqli_num_rows($qryResult)? "" : "username doesn't exist or username and password doesn't match";
    }
}
