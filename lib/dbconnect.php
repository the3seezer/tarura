<?php if (session_status() == PHP_SESSION_NONE) {
session_start();
}
// include("fix_mysql_to_msqli.error.php");
//error_reporting(0);
include("config.php");
include("functions.php");

class dbClass
{
    //////////////////////////////
    /*
	DATABASE CONNECTION
	*/
    ////////////////////////////////
    private $hostname = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db = DB_NAME;
    private $connection;
    public $msg;

    function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        $this->connection = new PDO(
            "mysql:host={$this->hostname};dbname={$this->db}",
            $this->user,
            $this->pass
        );
        // set the PDO error mode to exception
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return true;
    }
	public function selectvehicle()
	{
	$sel = $this->connection->prepare("SELECT `id`, `regn`, `date`, `nida`, `mobile`, `location` FROM `vehicle` ");
        $sel->execute();
        return $sel;	
	}

    public function selectvehiclebyid($id)        
	{
	$sel = $this->connection->prepare("SELECT `id`, `regn`, `date`, `nida`, `mobile`, `location` FROM `vehicle` WHERE id = $id ");
        $sel->execute();
        return $sel;	
	}
    
	public function addvehicle($regn,$date,$nida,$mobile,$location)
	{
	$sel = $this->connection->prepare("INSERT INTO `vehicle`(`regn`, `date`, `nida`, `mobile`, `location`)  VALUES ('$regn','$date','$nida','$mobile','$location')");
        $sel->execute();
        return $sel;	
	}

    public function editvehicle($regn,$date,$nida,$mobile,$location,$id)
	{
	$sel = $this->connection->prepare("UPDATE `vehicle` SET `regn`='$regn',`date`='$date',`nida`='$nida',`mobile`='$mobile',`location`='$location' WHERE id=$id ");
        $sel->execute();
        return $sel;	
	}

    public function deletevehicle($id)
	{
	$sel = $this->connection->prepare("DELETE FROM `vehicle` WHERE id='$id' ");
        $sel->execute();
        return $sel;	
	}
	
	public function selectbill()
	{
	$sel = $this->connection->prepare("SELECT `bid`, `veid`, `amount`, `penalty`, `status` FROM `bill`");
        $sel->execute();
        return $sel;	
	}
    
    public function addbill($bid,$veid,$amount,$penalty,$status)
	{
	$sel = $this->connection->prepare("INSERT INTO `bill`(`bid`, `veid`, `amount`, `penalty`, `status`) VALUES ('$bid','$veid','$amount','$penalty','$status')");
        $sel->execute();
        return $sel;
    }

public function selectbillbybid($bid)
	{
	$sel = $this->connection->prepare("SELECT  `veid`, `amount`, `penalty`, `status` FROM `bill` WHERE bid='$bid' ");
        $sel->execute();
        return $sel;	
	}
    
public function editbill($bid,$veid,$amount,$penalty,$status)
	{
	$sel = $this->connection->prepare("UPDATE `bill` SET `veid`='$veid',`amount`='$amount',`penalty`='$penalty',`status`='$status' WHERE bid='$bid'");
        $sel->execute();
        return $sel;
    }

    public function deletebill($bid)
	{
	$sel = $this->connection->prepare("DELETE FROM `bill` WHERE bid='$bid'");
        $sel->execute();
        return $sel;
    }
    
	
}
?>