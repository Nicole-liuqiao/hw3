<?php
namespace qiaoliu\hw3\models;

class RateModel extends Model
{
	/**
     * @param $formvar array of username asnd password from form
     * @return $errMsg errMsg after check username and password against data in databas
     *
     */   
    public function getResult($formvar) {
		//$result = "";
		$this::ensureTable("RATE");
        $this::ensureTable("IMAGE");
        $this::ensureTable("USER");


        $score = intval($formvar);

        self::InsertIntoRATE($_SESSION['userid'], $_POST['imageid'], $score);
        self::InsertIntoIMAGE($score, $_POST['imageid']);
        $this->closeConnection();

	}

    private function InsertIntoRATE($userid, $imageid, $score) {
        $errMsg = "";
        $insert_query = sprintf('insert into RATE (
            imageid,
            userid,
            score
            )
            values
            (
            "' . $imageid . '",
            "' . $userid . '",
            "' . $score . '"
            )');   
        if(!mysqli_query($this->con, $insert_query)) {
            $errMsg = mysqli_error($this->con);
        }
        return $errMsg;
    }

        private function InsertIntoImage($imageid, $score) {
        $errMsg = "";
        $totalScore = $score;
        $totoalVotes;
        $getQry = sprintf("SELECT scoreSum, numOfVotes 
                                  from IMAGE WHERE imageid = " . $imageid);
        $getQryRes = mysqli_query($this->con, $getQry);
        if (!$getQryRes) {
            $errMsg = mysqli_error($this->con);
        }
        $num = mysqli_num_rows($getQryRes);
        for ($i = 0; $i < $num; $i++) {
            $row = mysqli_fetch_assoc($getQryRes);
            $totalScore += $row['scoreSum'];
            $totalVotes = $row['numOfVotes'] + 1;
        }

        //update IMAGE set scoreSum=1, numOfVotes=1 where imageid=1;
        $update_query = sprintf('update IMAGE set scoreSum=' . $totalScore . 
                                ', numOfVotes=' . $totalVotes . ' where imageid=' . $imageid);
        if(!mysqli_query($this->con, $update_query)) {
            $errMsg = mysqli_error($this->con);
        }
        return $errMsg;
    }
}
