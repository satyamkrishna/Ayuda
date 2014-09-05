<?php
	require '../../include/core.inc.php';
	require '../../include/loggedin.php';
	require '../../include/dbhelper.inc.php';	
	
	$db = new dbHelper();
	$db->ud_connectToDB();

	if(isset($_POST['func']) && !empty($_POST['func']))
	{
		switch ($_POST['func']) {
			case 'del-faq':
				$db->ud_deleteQuery('ud_faq',array('faqID'=>$_POST['faqID']));
				echo "Ok";
				break;
			case 'add-faq':
				$result = $db->ud_getQuery('SELECT faqID, max( faqID ) +1 as a FROM ud_faq');
				$result = $db->ud_mysql_fetch_assoc_all($result);
				$db->ud_insertQuery('ud_faq',array('faqQuestion'=>$_POST['question'],'faqAnswer'=>$_POST['answer'],'faqVisible'=>1,'faqNumber'=>$result[0]['a']));
				$ret = array("result"=>"Ok","no"=>$result[0]['a']);
				echo json_encode($ret);
				break;
			case 'edit-faq':
				$db->ud_updateQuery('ud_faq',array('faqQuestion'=>$_POST['question'],'faqAnswer'=>$_POST['answer']),array('faqID'=>$_POST['id']));
				echo "Ok";
				break;
			default:
				
				break;
		}
	}
	else {
		echo "Invalid";
	}
?>