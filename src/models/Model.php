<?php
namespace qiaoliu\hw3\models;

abstract class Model
{
	public $con;
	
	function __construct() {
		$this->con = $this::connectToServer();
        $this::useDatabase();
	}

    public abstract function getResult($formvals);

	private function connectToServer() {
		$con = mysqli_connect("127.0.0.1","root");
		if (!$con) {
			die("can not connect to database server: " . mysqli_error($this->con));
		}
		return $con;
	}

	private function useDatabase() {
		$db = mysqli_select_db($this->con, "image_rating");
		if (!$db && !self::CreateDatabase()) {
    		die("database doesn't exist or can not be created: " . mysqli_error($this->con));
    	}
        $db = mysqli_select_db($this->con, "image_rating");
	}

	protected function ensureTable($table) {
        $result = mysqli_query($this->con, "SHOW TABLES");
        $exist = false;
        if ($result) {
            while ($row = mysqli_fetch_array($result, MYSQL_ASSOC)) {
            	if (strcasecmp($row["Tables_in_image_rating"], $table) == 0) {
            		$exist = true;
            		break;
            	}
            }
        }
        if (!$exist) {
        	self::CreateTable($table);
        }
    }


    private function CreateDatabase()
    {
        $qry = sprintf("CREATE DATABASE image_rating");
        return mysqli_query($this->con, $qry);
    }

    private function CreateTable($table)
    {
        switch ($table) {
        	case 'USER':
        	$qry = sprintf("CREATE TABLE USER (
        		userid INT(12) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        		userName VARCHAR(12) NOT NULL, 
        		password VARCHAR(12) NOT NULL
        		)");
        		break;

        	case 'IMAGE':
         	$qry = sprintf("CREATE TABLE IMAGE (
         		imageid INT(12) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
         		caption VARCHAR(50) NOT NULL,
         		userid INT(12) NOT NULL, 
         		date_time datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
         		location VARCHAR(150) NOT NULL,
         		scoreSum INT(12),
         		numOfVotes INT(11)
         		)");
        		break;

        	case 'RATE':
        	$qry = sprintf("CREATE TABLE RATE (
         		imageid INT(12), 
         		userid INT(12) NOT NULL, 
         		score INT(12),
         		CONSTRAINT image_userPair PRIMARY KEY (imageid, userName)
         		)");
        		break;
        }
              
        if(!mysqli_query($this->con, $qry))
        {
            die ("Table doesn't exist in database or can not be created : " . mysqli_error($this->con));
        }
    }

    protected function closeConnection() {
    	mysqli_close($this->con);
    }
}