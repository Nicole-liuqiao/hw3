<?php
namespace qiaoliu\hw3\models;

require_once ("Model.php");

class Test extends Model
{
	public function getResult($formvars) {
		$errMsg = "";
		$this::ensureTable("USER");
		$value = $formvars['username'];

        $qry = sprintf("select * from USER where userName = '" . $formvars['username'] . "' and password = '" . $formvars['password'] . "'");
        $qryResult = mysqli_query($this->con, $qry);
        print_r($qryresult);
        if (!$qryResult) {
        	$errMsg = mysqli_error($this->con);
        	return $result;
        }

        return mysqli_num_rows($qryResult)? "" : "username doesn't exist or username and password doesn't match";
    }
}


$formvars['username'] = 'admin12';
$formvars['password'] = '123';
$test = new Test();
$errMsg = $test->getResult($formvars);
echo $errMsg;

