<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class DB {

    public function __construct() {
        date_default_timezone_set("Asia/Calcutta");
        error_reporting(E_ERROR | E_PARSE);
        require 'config.php';
        mysql_connect($HOST, $USERNAME, $PASSWORD) or die(mysql_error());
        mysql_select_db($DB) or die(mysql_error());
    }

    public function Execute($query) {
        return mysql_query($query) or die(mysql_error());
    }

    public function LoginUser($user, $pass) {
        $password = md5($pass);
        $q = "select * from admin where (email='$user' OR username='$user') AND password='$password'";
        $r = mysql_query($q) or die(mysql_error());
        if (mysql_affected_rows() == 1) {
            if (session_id() == '') {
                session_start();
            }
            $_SESSION['is_logged'] = true;
            $admin = $this->FetchArray($r);
            unset($admin['password']);
            $_SESSION['data'] = $admin;
            return true;
        } else {
            return false;
        }
    }

    public function FetchArray($r) {
        return mysql_fetch_assoc($r);
    }

    public function Is_logged() {
        if (session_id() == '') {
            session_start();
        }
        if (isset($_SESSION['is_logged'])) {
            return $_SESSION['is_logged'];
            return true;
        } else {

            return false;
        }
    }

	 public function contactInsert($data){
    
    	$name = $data['name'];
    	$pno = $data['pno'];
    	$email = $data['email'];
    	$subject = $data['subject'];
    	$msg = $data['msg']; 
    	$q = "insert into contact(name,pno,email,subject,msg,extra)values('".$name."','".$pno."','".$email."','".$subject."','".$msg."')";
    	 $r = mysql_query($q) or die(mysql_error());
    	 
    	 if(mysql_affected_rows() > 0){
    	 
    	 	$headers = "From: gcmapp@icanstudioz.com" . "\r\n" .
    	 	
    	 	mail($email ,$subject,$msg,$headers);
    	 	
    	 	
    	 	
    	 	$fields['status'] = "success";
    	 	
    	 	echo json_encode($fields, true);
    	 
    	 }
    
    } 


    public function GetUserName() {

        return $_SESSION['data']['username'];
    }

    public function GetUserEmail() {

        return $_SESSION['data']['email'];
    }

    public function LogMeOut() {
        if (session_id() == '') {
            session_start();
        }
		$_SESSION = array();
        $_SESSION['is_logged'] = false;
	
        session_destroy();
    }

    public function getAllUsers($status = NULL) {
        $st = "";
        if ($status == "ACTIVE")
            $st = "WHERE is_active=1";
        $q = "select * from users $st";
        $r = mysql_query($q) or die(mysql_error());
        $users = array();
        while ($row = mysql_fetch_assoc($r)) {
            $users[] = $row;
        }
        return $users;
    }

    public function getAllNotifications() {
        $q = "select * from notifications LIMIT 100";
        $r = mysql_query($q) or die(mysql_error());
        $users = array();
        while ($row = mysql_fetch_assoc($r)) {
            $users[] = $row;
        }
        return $users;
    }
    
   
	

    public function getAllCategories($where = FALSE) {
        $wc = "";
        if ($where) {
            $wc = "WHERE is_active=1";
        }
        $q = "select * from categories $wc";
        $r = mysql_query($q) or die(mysql_error());
        $cat = array();
        while ($row = mysql_fetch_assoc($r)) {
            $cat[] = $row;
        }
        return $cat;
    }

    public function str_lreplace($search, $replace, $subject) {


        return $subject;
    }

    public function getAllUsers_withCategories($where = FALSE, $cat) {
        $wc = "WHERE 1 AND ";
        if (!empty($cat)) {
            foreach ($cat as $key => $value) {
                $wc.="FIND_IN_SET('$value',categories) > 0 OR ";
            }
        }

        $pos = strrpos($wc, "OR");

        if ($pos !== false) {
            $wc = substr_replace($wc, "AND", $pos, strlen("OR"));
        }
        if ($where) {
            $wc.=" is_active=1";
        }
        $q = "select * from users $wc";
        
        $r = mysql_query($q) or die(mysql_error());
        $cat = array();
        while ($row = mysql_fetch_assoc($r)) {
            $cat[] = $row;
        }
        return $cat;
    }
    
    public function deleteCat($cat)
{
	 $r=mysql_query("delete from categories where id='$cat'") or die(mysql_error());
	 if($r){
	 	echo "Category Deleted!";
	 }else{
	 	echo "There is some problem please try again later";
	 }
}

	public function updateCat($data){
		$id=$data["cat_id"];
		$name=$data["cat_name"];
		$desc=$data["cat_desc"];
		
		$q="UPDATE categories set cat_name='$name',cat_desc='$desc' WHERE id='$id'";
		 $r=mysql_query($q)or die("Error Updating DB.");
		 if($r){
	 	echo "Category Updated!";
	 }else{
	 	echo "There is some problem please try again later";
	 }
	}
    public function GetUserByType_withCategories($type, $cat) {
        $wc = " ";
        if (!empty($cat)) {
            foreach ($cat as $key => $value) {
                $wc.="FIND_IN_SET('$value',categories) > 0 OR ";
            }
        }

        $pos = strrpos($wc, "OR");

        if ($pos !== false) {
            $wc = substr_replace($wc, "AND", $pos, strlen("OR"));
        }

        $wc.=" is_active=1";


        $q = "select * from users where app_type='$type' AND $wc ";

      
        $r = mysql_query($q) or die(mysql_error());
        $users = array();
        while ($row = mysql_fetch_assoc($r)) {
            $users[] = $row;
        }
        return $users;
    }

    public function changeUserAccess($type, $id) {
        $q = "UPDATE users SET is_active=$type where uid='$id'";
        $r = mysql_query($q) or die(mysql_error());

        return mysql_affected_rows();
    }

    public function changeCatAccess($type, $id) {
        $q = "UPDATE categories SET is_active=$type where id='$id'";
        $r = mysql_query($q) or die(mysql_error());

        return mysql_affected_rows();
    }

    public function sendNotification($registatoin_ids, $msg, $nid) {

        if (count($registatoin_ids) > 999) {
            $chunk = array_chunk($registatoin_ids, 999);
            $re = array();
            foreach ($chunk as $key => $value) {
                $re[] = $this->sendNoty($value, $msg, $nid, true);
            }
            $f = array();
            foreach ($re as $k => $rep) {

                $report['passed'] += $rep['passed'];
                $report['failed'] += $rep['failed'];
                $report['updated'] += $rep['updated'];
                $report['removed'] += $rep['removed'];
            }
            $report['nid'] = $nid;
            $report['status'] = "";

            $this->AddReport($report);


            echo $report['passed'] . " Users Succees<br>";
            echo $report['failed'] . " Users Failed<br>";
            echo $report['updated'] . " Users ID updated<br>";
            echo $report['removed'] . " Users removed your Application.<br>";
        } else {
            $this->sendNoty($registatoin_ids, $msg, $nid, false);
        }
    }

    public function sendNoty($id, $load, $nid, $is_chunk) {


// Set POST variables
        $url = 'https://android.googleapis.com/gcm/send';

        $fields = array(
            'registration_ids' => $id,
            'data' => $load,
        );

        $headers = array(
            'Authorization: key=' . GOOGLE_API_KEY,
            'Content-Type: application/json'
        );


        // Open connection
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields, true));

        // Execute post

        $result = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $status = "";
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
            $status = "FAIL";
        }

        $report = array();
        // Close connection
        curl_close($ch);
//        echo $result;
        //print_r($id);
        $jsonText = preg_replace('/\s+/', '', $result);
        $decodedText = html_entity_decode($jsonText);
        $myArray = json_decode($decodedText, true);
        //echo $myArray["success"] . "  <==== success<br>";
        //echo $myArray["failure"] . " <====failed<br>";
        //print_r($myArray);
        $report['nid'] = $nid;

        $report['passed'] = $myArray["success"];
        $report['failed'] = $myArray["failure"];
        $report['status'] = $status;

        if ($myArray["failure"] > 0 && $myArray["success"] == 0) {
            $status = "FAIL";
        } elseif ($myArray["failure"] > 0 && $myArray["success"] > 0) {
            $status = "PARTIAL SUCCESS";
        } elseif ($myArray["failure"] == 0 && $myArray["success"] > 0) {
            $status = "SUCCESS";
        }

        $cnt = 0;
        $upd = 0;
        if (is_array($myArray)) {
            foreach ($myArray['results'] as $key => $value12) {
                //print_r($value);
                if (array_key_exists("error", $value12)) {
                    $del = $id[$key];
                    //echo $del." may be deleted!<br>";
                    mysql_query("delete from users where gcm_id='$del'") or die(mysql_error());
                    $cnt++;
                }
                if (array_key_exists("registration_id", $value12)) {
                    $del = $id[$key];
                    $up = $value12['registration_id'];
                    //echo $value12['registration_id']." may be updated!<br>";
                    mysql_query("UPDATE users SET gcm_id='$up' where gcm_id='$del'") or die(mysql_error());
                    $upd++;
                }
            }
        }

        $report['updated'] = $upd;
        $report['removed'] = $cnt;

        if ($is_chunk) {
            return $report;
        } else {
            $this->AddReport($report);


            echo $report['passed'] . " Users Succees<br>";
            echo $report['failed'] . " Users Failed<br>";
            echo $report['updated'] . " Users ID updated<br>";
            echo $report['removed'] . " Users removed your Application.<br>";
        }
    }

    function setUserCategories($param) {
        $email = $param['email'];
        $cat = $param['cat'];

        $q = "UPDATE users SET categories='$cat' where email='$email'";
        $r = mysql_query($q) or die(mysql_error());

        if ($r) {
            return array('status' => 'SUCCESS');
        } else {
            return array('status' => 'FAIL');
        }
    }

    public function GetAppList() {
        $q = "select distinct app_type from users";
        $r = mysql_query($q) or die(mysql_error());
        $apps = array();
        while ($row = mysql_fetch_assoc($r)) {
            $apps[] = $row;
        }
        return $apps;
    }

    public function GetUserByType($type) {
        $q = "select * from users where app_type='$type' AND is_active=1";
        $r = mysql_query($q) or die(mysql_error());
        $users = array();
        while ($row = mysql_fetch_assoc($r)) {
            $users[] = $row;
        }
        return $users;
    }

    public function AddNotification($data) {
        $type = $data['type'];
        $title = mysql_real_escape_string($data['title']);
        $msg = mysql_real_escape_string($data['message']);
        $link = mysql_real_escape_string($data['link']);
        $emotion = mysql_real_escape_string($data['emotion']);

        $query = "INSERT INTO notifications (type,title,message,link,emotion) VALUES ('$type','$title','$msg','$link','$emotion');";
        $r = mysql_query($query) or die(mysql_error());
        if (!$r) {
            return false;
        } else {
            return mysql_insert_id();
        }
    }

    public function AddCategory($data) {

        $title = mysql_real_escape_string($data['cat_name']);
        $msg = mysql_real_escape_string($data['cat_desc']);



        $query = "INSERT INTO categories (cat_name,cat_desc) VALUES ('$title','$msg');";
        $r = mysql_query($query) or die(mysql_error());
        if (!$r) {
            return false;
        } else {
            return mysql_insert_id();
        }
    }

    public function AddReport($data) {
        $nid = $data['nid'];
        $status = $data['status'];
        $passed = $data['passed'];
        $failed = $data['failed'];
        $updated = $data['updated'];

        $query = "INSERT INTO reports (nid,status,passed,failed,updated) VALUES ('$nid','$status','$passed','$failed','$updated');";
        $r = mysql_query($query) or die(mysql_error());
        if (!$r) {
            return false;
        } else {
            return true;
        }
    }

    public function GetGraphsByRange($from, $to) {
        $q = "SELECT * from notifications as noty JOIN reports as report ON noty.nid = report.nid where DATE(noty.time) >= '$from' AND DATE(noty.time) <= '$to'";

        $r = mysql_query($q) or die(mysql_error());
        $data = array();

        while ($row = mysql_fetch_assoc($r)) {
            switch ($row['type']) {
                case 1:
                    $row['type'] = "Simple Notification";
                    break;
                case 2:
                    $row['type'] = "Dialoge Notification";
                    break;
                case 3:
                    $row['type'] = "WebActivity Notification";
                    break;
                case 4:
                    $row['type'] = "Toast Notification";
                    break;
                case 5:
                    $row['type'] = "News Notification";
                    $row['is_news'] = true;
                    break;

                default:
                    break;
            }
            //$row['time']=strtotime($row['time']) * 1000;
            $data[] = $row;
        }

        if (empty($data)) {
            return "NO DATA";
        } else {
            return $data;
        }
    }

    function AddUserGCM($data) {
        $email = $data["email"];
        $app = $data["app_type"];
        $gcm = $data["gcm_id"];
        $q = "INSERT INTO users (email,app_type,gcm_id) VALUES('$email','$app','$gcm')";

        $r = mysql_query($q) or die(mysql_error());
        if (!$r) {
            return false;
        } else {
            return mysql_insert_id();
        }
    }

    function ChangePassword($param) {
        $param = md5($param);
        $which = $this->GetUserName();

        $q = "UPDATE admin set password='$param' where username='$which'";
        $r = mysql_query($q) or die(mysql_error());
        if ($r) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function CheckPassword($param) {
        $param = md5($param);
        $which = $this->GetUserName();
        $q = "SELECT * from admin where password='$param' AND username='$which'";

        mysql_query($q) or die(mysql_error());
        if (mysql_affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    
    function CheckUser($data){
        $email = $data["email"];
        $app = $data["app_type"];
        $gcm = $data["gcm_id"];
        $q = "SELECT * FROM users WHERE email='$email' AND app_type='$app' AND gcm_id='$gcm'";
        
        mysql_query($q) or die(mysql_error());
        if (mysql_affected_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

}

?>