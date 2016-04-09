<?php
namespace qiaoliu\hw3\models;

class ImageQueryModel extends Model
{
	public function getResult($formvals) {
		$result = [];
		$this->ensureTable("IMAGE");

		$qry = [];
		$qry["recent"] = sprintf("SELECT caption, userName, scoreSum, numOfVotes, date, location from IMAGE ORDER BY date DESC LIMIT 3");
		$qry["popularity"] = sprintf("SELECT caption, userName, scoreSum, numOfVotes, date, location from IMAGE ORDER BY numOfVotes DESC, date DESC LIMIT 10");
		
        foreach ($qry as $key => $value) {
        	$qryResult = mysqli_query($this->con, $value);
        	if (!$qryResult) {
        		$result[$key] = [];
        		continue;
        	}
        	$num = mysqli_num_rows($qryResult);
        	for ($i = 0; $i < $num; $i++) {			
	        	$result[$key][$i]["caption"] = $row["caption"];
				$result[$key][$i]["user"] = $row["userName"];
				$result[$key][$i]["rating"] = $row["scoreSum"] / $row["numOfVotes"];
				$result[$key][$i]["date"] = $row["date"];
				$result[$key][$i]["location"] = $row["location"];
        	}
        	mysqli_free_result($qryResult);
		}

		$this->closeConnection();

		return $result;
	}
}
