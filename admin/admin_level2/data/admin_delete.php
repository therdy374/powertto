<?php
	session_start();
	require_once('../includes/pdocon.php');

	if(isset($_GET['admin_id'])){

		$database = new Connection();
		$db = $database->open();
		try{
			$sql = "DELETE FROM tb_admin WHERE admin_id = '".$_GET['admin_id']."' ";
			$db->exec($sql);
		
		}
		catch(PDOException $e){
			$_SESSION['message'] = $e->getMessage();
		}
		$database->close();
	}
	else{
		$_SESSION['message'] = 'Select User to delete first';
	}
	echo "<script>alert('User Deleted.');
	document.location.href = '/yesbet/admin/data/index.php';
	</script>";
?>