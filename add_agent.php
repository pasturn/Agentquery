<?php 

function add_agentdate(){
		global $wpdb;
		$name = $_POST["name"];
		$wechat = $_POST["wechat"];
		$addyear= $_POST["addyear"];
		$addmonth = $_POST["addmonth"];
		$addday= $_POST["addday"];
		$adddate = $addyear.$addmonth.$addday;
		if(empty($wechat)|| empty($name) || empty($addyear)|| empty($addmonth)|| empty($addday)){
		echo "<div id='message' class='updated'>请检查代理商数据是否填写完整！</div>";
		return;
		}
		$table_name = $wpdb->prefix . "agentquery";

		$data_array = array(  

		'name' => $name,  

		'wechat' => $wechat ,

		'adddate' => $adddate,

		);  
		$wpdb->insert($table_name,$data_array); 
		echo "<div id='message' class='updated'>数据添加成功！请勿刷新此页面，防止数据重复提交！</div>";
		
}

function query_agentinfo(){
		global $wpdb;
		$querystr = "SELECT * FROM wp_agentquery ORDER BY id ASC";  
		$results = $wpdb->get_results($querystr);  
		$i=0;
		echo "<form action='' method='post' id='delagentdate_form'><table border='0'  width='700' style='text-align:center;' >";
		echo "<tr ><th>序号</th><th>代理商</th><th>微信号</th><th>授权日期</th><td><input type='submit' value='删除' /></td></tr>";
		while ($i< count($results)){  
			echo "<tr><td>";
			echo $results[$i]->id;
			echo "</td><td>";
			echo $results[$i]->name;
			echo "</td><td>";
			echo $results[$i]->wechat;
			echo "</td><td>";
			echo $results[$i]->adddate;
			echo "</td><td>";
			echo "<input type='radio' value='".$results[$i]->id."' name='del'>";
			echo "</td></tr>";
		$i++;  }
			echo "<input type='hidden' name='delagentdate' value='1' /></table></form>";
}
 function del_agentdate(){
		global $wpdb;
		$id=$_POST['del']; 
		$sql="delete from wp_agentquery where id ='$id'";
		$result=$wpdb->query($sql);
		}
		
		
if($_POST["delagentdate"]){
		 del_agentdate();
}

?>
	<div class="wrap">
	
		<?php screen_icon();?>
		
		<h2>代理商验证插件</h2>
		
		<form action="" method="post" id="agentquery_form">
		
		<input type="hidden" name="addagentdate" value="1" />
			<hr></hr>
			<h3><label for="tips">+新增授权代理商</label></h3>
			
			<?php 
			
		if($_POST['addagentdate']){
	add_agentdate();
}
			?>

			<p>
			
			代理商：<input type="text" name="name" id="agentname" placeholder="请输入代理商名称" />
			
			微信号：<input type="text" name="wechat" id="agentwechat" placeholder="请输入代理商微信号"/>
			
			授权时间：<input type="text" size="4" maxlength="4"  name="addyear" id="addyear" placeholder="年" max="2020" min="1990"/>-<input type="text" size="2" maxlength="2"  name="addmonth" id="addmonth" placeholder="月" max="12" min="01"/>-<input type="text" size="2" maxlength="2"  name="addday" id="addday" placeholder="日" max="31" min="01" />
			
			<input type="submit" value="添加" />
			
			</p>
			
		</form>
		<hr></hr>
		<h3><label for="tips">*授权代理商列表</label></h3>
	
<?php 
	query_agentinfo();
?>
<hr></hr>
<center>WordPress代理商验证插件 ©Pasturn All rights reserved. </center>
	</div>
