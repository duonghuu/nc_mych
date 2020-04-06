<?php 
	session_start();
	@define ( '_lib' , '../../libraries/');
	include_once _lib."config.php";
	include_once _lib."constant.php";
	include_once _lib."functions.php";
	include_once _lib."class.database.php";
	$d = new database($config['database']);
	$id_daily=$_SESSION['logindaily']["id_daily"];

	if (isset($_POST["level"])) {
		 $level = $_POST["level"];
		 $table = $_POST["table"];
		$id=$_POST["id"];
		 $type = $_POST["type"];
		switch ($level) {
			case '0':{
				$id_temp= "id_list";
		
				break;
			}
			case '1':{
				$id_temp= "id_cat";
				break;
			}
			case '2':{
				$id_temp= "id_item";
				break;
			}
			default:
				echo 'error ajax'; exit();
				break;
		}
		
		
		if ($level==0)
		{
			if ($id_daily>0)
			{
				
				$d->reset();
				$sql = "select id, id_list from table_daily where id=".$id_daily." ";
				$d->query($sql);
				$rs_daily=$d->fetch_array();
				
				if ($rs_daily["id_list"]!="")
				{
					$where_daily .= " and id IN (".$rs_daily["id_list"].")";
				}
				else 
				{
					$where_daily .= " and id IN (0)";
				}
	
			}
		}
		else if ($level==1)
		{
			
			if ($id_daily>0)
			{
				
				$d->reset();
				$sql = "select id, id_cat from table_daily where id=".$id_daily." ";
				$d->query($sql);
				$rs_daily=$d->fetch_array();
				
				if ($rs_daily["id_cat"]!="")
				{
					$where_daily .= " and id IN (".$rs_daily["id_cat"].")";
				}
				else 
				{
					$where_daily .= " and id IN (0)";
				}
	
			}
			
		}
		
		else if ($level==2)
		{
			
			if ($id_daily>0)
			{
				
				$d->reset();
				$sql = "select id, id_item from table_daily where id=".$id_daily." ";
				$d->query($sql);
				$rs_daily=$d->fetch_array();
				
				if ($rs_daily["id_item"]!="")
				{
					$where_daily .= " and id IN (".$rs_daily["id_item"].")";
				}
				else 
				{
					$where_daily .= " and id IN (0)";
				}
	
			}
			
		}
		
		echo $sql="select * from ".$table." where $id_temp=".$id." and type='".$type."' $where_daily  order by stt ";
		$stmt=mysql_query($sql);
		$str='
			<option>Chọn danh mục</option>			
			';
		while ($row=@mysql_fetch_array($stmt)) 
		{
			if($row["id"]==(int)@$id_select)
				$selected="selected";
			else 
				$selected="";

			$str.='<option value='.$row["id"].' '.$selected.'>'.$row["ten_vi"].'</option>';			
		}
		echo  $str;
				
		
	}
?>
