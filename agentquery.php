<?php
/*
Plugin Name: 代理商验证
Plugin URI: http://dev.pasturn.com
Description: 此插件可用于代理商验证。
Version: 1.0
Author: Pasturn
Author URI: http://pasturn.com
*/
function agentquery_install () {   

    global $wpdb;

    $table_name = $wpdb->prefix . "agentquery";  //获取表前缀，并设置新表的名称

    if($wpdb->get_var("show tables like $table_name") != $table_name) {  //判断表是否已存在

        $sql = "CREATE TABLE " . $table_name . " (
			
			id mediumint(9) NOT NULL AUTO_INCREMENT,

			name text NOT NULL,
		  
			wechat text NOT NULL,
			
			adddate date  NOT NULL,
			
			UNIQUE KEY  id (id)
			
			);";

        require_once(ABSPATH . "wp-admin/includes/upgrade.php");  //引用wordpress的内置方法库

        dbDelta($sql);

    }

}

register_activation_hook(__FILE__,'agentquery_install');


function agentquery_admin_page(){

	add_menu_page('代理商验证插件','代理商','manage_options', __FILE__,'add_agent',plugins_url('agentquery/agent.png'),72);
	
	}

add_action('admin_menu', 'agentquery_admin_page');

function add_agent() {
	include(dirname(__FILE__).'/add_agent.php');
}
?>
