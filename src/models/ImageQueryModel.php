<?php
namespace qiaoliu\hw3\models;

class ImageQueryModel extends Model
{
	public function getResult($webUserid) {
		$result = [];
		$result['recent'] = [];
		$result['popularity'] = [];

		$this->ensureTable("IMAGE");
		$this->ensureTable("USER");
		$this->ensureTable("RATE");

		/**
		 * @param $qry array ['recent', 'popularity']
		 */
		$qry = [];
		$qry["recent"] = sprintf("SELECT imageid, caption, userid, scoreSum, numOfVotes, date_time, location 
			                      from IMAGE ORDER BY date_time DESC LIMIT 3");
		$qry["popularity"] = sprintf("SELECT imageid, caption, userid, scoreSum, numOfVotes, date_time, location 
			                          from IMAGE ORDER BY numOfVotes DESC, date_time DESC LIMIT 10");
		$RatingMap = [];
		if (!empty($webUserid)) {
			$qryRating = sprintf("SELECT imageid, score from RATE where userid = " . $webUserid);
			$qryRatingRes = mysqli_query($this->con, $qryRating);
			if (!$qryRatingRes) {
        		die("database error: " . mysqli_error($this->con));
        	}
        	$num = mysqli_num_rows($qryRatingRes);
        	for ($i = 0; $i < $num; $i++) {
        		$row = mysqli_fetch_assoc($qryRatingRes);
        		$RatingMap[$row['imageid']] = $row['score'];
        	}

		}

        // loop for recent and popularity
        foreach ($qry as $key => $value) {
        	
        	$qryResult = mysqli_query($this->con, $value);
        	
        	if (!$qryResult) {
        		die("database error: " . mysqli_error($this->con));
        	}

        	$num = mysqli_num_rows($qryResult);
        	for ($i = 0; $i < $num; $i++) {
        		$row = mysqli_fetch_assoc($qryResult);

        		// get username from USER table;
        		$userid = $row["userid"];
        		$qryUserName = sprintf("SELECT userName from USER where userid = '%d'", $userid);
        		$qryUserNameResult = mysqli_query($this->con, $qryUserName);
	        	if (!$qryUserNameResult) {
	        		die("database error: " . mysqli_error($this->con));
	        	}
	        	while ($namerow = mysqli_fetch_assoc($qryUserNameResult)) {
	        		$result[$key][$i]["username"] = $namerow['userName'];
	        	}

                $result[$key][$i]["imageid"] = $row["imageid"];
	        	$result[$key][$i]["caption"] = $row["caption"];
				$result[$key][$i]["date"] = $row["date_time"];
				$result[$key][$i]["location"] = $row["location"];
				// get average rating score
				if (empty($row['numOfVotes']) || $row['numOfVotes'] == 0 ) {
					$result[$key][$i]["rating"] = 0;
				} else {
					$result[$key][$i]["rating"] = $row["scoreSum"] / $row["numOfVotes"];
				}

				if (array_key_exists($row['imageid'], $RatingMap)) {
					$result[$key][$i]["webUserScore"] = $RatingMap[$row['imageid']];					
				} else {
					$result[$key][$i]["webUserScore"] = 0;						
				}

        	}
        	mysqli_free_result($qryResult);
		}

		$this->closeConnection();

		return $result;
	}
}
