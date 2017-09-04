<?php

require 'config.php';

if( !defined( 'DATALIFEENGINE' ) ) {
    die( "Hacking attempt!" );
}

if ( isset($_POST['nickname']{3}) ) {
		$search  = "WHERE `name` = '".($_POST['nickname'])."'";
                
} 

$pages_max = mysqli_num_rows($db->query("SELECT `id` FROM banlist"));
	$page_last = floor($pages_max/$cfg['page_output']);
	
	if ( is_numeric($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $page_last ) $page_id = $_GET['page']; else $page_id = 0;
	
	$page_max = $page_id * $cfg['page_output'];



$query_banlist = $db->query("SELECT * FROM {$cfg['dbtable']} {$search} ORDER BY `id` ASC LIMIT  {$page_max}, {$cfg['page_output']}");


while ($row = mysqli_fetch_array($query_banlist)) {
    $bn .= '
			<tr>
				<td>'.$row['name'].'</td>
				<td>'.$row['admin'].'</td>
				<td>'.($row['reason'] ? $row['reason'] : $cfg['text_reason_not']).'</td>
				<td>'.date($cfg['date_format'], $row['time']).'</td>
				<td>'.($row['temptime'] ? date($cfg['date_format'], $row['temptime']) : $cfg['text_ban_forever'].'</font>').'</td>
			</tr>
		';	
}

if (!$bn){
    echo "Список забаненых пуст!";
}




if ( $page_last > 0 ) {
		for($i = 0; $i <= $cfg['page_btn']; ++$i) 
		{
			$page_id_i = $i + ($page_id - $cfg['page_btn']/2);
			if ( $page_id_i >= 0 && $page_id_i <= $page_last ) 
				$pages_btn .= '<a href="?page='.$page_id_i.'" class="button" style="'.($page_id == $page_id_i ? 'background: #fff;' : false).'">'.$page_id_i.'</a> ';
		}
			
		$page = '
			<div class="bl-pages">
				<a href="?page='.($page_id - 1).'" class="button"><</a>
				<a href="?page=0" class="button"><<</a>
				
				'.$pages_btn.'
				
				<a href="?page='.$page_last.'" class="button">>></a>
				<a href="?page='.($page_id + 1).'" class="button">></a>
			</div>
		';
	}
        
        

?>


<link rel="stylesheet" type="text/css" href="templates/style.css">
<div id="tn">
    
    	<? if ( $cfg['search_on'] ) { ?>
		<form method="POST">
			<input type="text" name="nickname" class="input" placeholder="Ник игрока" required/>
			<input type="submit" class="button" value="Найти"/>
		</form>
		
	<? } ?>
    
    
<table class="table_b1" >
    
    <tr class="table_header_b1">
                        <td width="160">Игрок</td>
			<td width="160">Заблокировал</td>
			<td width="160">Причина</td>
			<td width="160">Дата бана</td>
			<td width="160">Дата разбана</td>
                        
                        <?php echo $bn?>
          
    </tr>
</table>
    <?php echo $error.'<br/>'.$page?>
</div>