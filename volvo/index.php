<?PHP
error_reporting(0);
// TEST CODE for implementing data gathering for valve servers. //
 
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb" >

<head>

  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="robots" content="index, follow" />
  <meta name="keywords" content="kickboxing, boxing, fitness, circuit, workout, 30 minute hit" />
  <meta name="author" content="Admin" />
  <meta name="description" content="&quot;30 Minute Hit&quot; was created to accommodate the busy lives of modern day women. This exhilarating and challenging fitness circuit consists of techniques taken from boxing, kickboxing, general self defense, and core stability training. Research and experience has proven that boxing / kickboxing is one of the most effective cardiovascular workouts" />
  
  <title>myStream</title>
  <link href="favicon.ico" rel="shortcut icon" type="image/x-icon" />
  <link rel="stylesheet" href="css/default.css" type="text/css" />
  <script type="text/javascript" src="js/jquery.js"></script>
 
</head>
<body>
<?PHP
	$config['key']= '901087C61FF99A2E0E5189F89F383B8C';
	$config['path'] = 'api.steampowered.com/';
	$config['cache'] = 5* 3600; 
	include('includes/functions.php');

	$config['key']= '901087C61FF99A2E0E5189F89F383B8C';
	$config['path'] = 'api.steampowered.com/';
//	https://api.steampowered.com/IDOTA2Match_570/GetMatchDetails/V001/?match_id=27110133&key=


	//GET LIVE HEROES 
	$url = 'IEconDOTA2_570/GetHeroes/v0001/?language=en_us&key='.$config['key'];
	$hero = json_decode(curl($url,1));
	
	foreach($hero as $hh => $h) {
	foreach($h->heroes as $dd => $d) {
			$d->img = 'http://media.steampowered.com/apps/dota2/images/heroes/'.preg_replace('/npc_dota_hero_/','',$d->name).'_sb.png';
			$heroes[$d->id] = $d;
			
	}
	}
?>
<div id="Wrapper">
	<div id="navBarBGRepeat">
	
	<div id="navBarShadow"></div>
	<div id="navBarBG">
	header
	</div>
	</div>
	<div id="mainContentWrap">
		<div id="mainContent">
<?PHP
	//print_r($heroes[55]);
	//END GET LIVE HEROES	
	
	$url= 'IDOTA2Match_570/GetMatchHistory/V001/?key='.$config['key'] .'&player_name=pap0t';
	$data = json_decode(curl($url,1,1*3600));

	foreach($data as $dd => $d) {

		foreach($d->matches as $mm => $m) {
			echo '<ul class="MatchList">';
			echo '<li>
				 <div class="matchId">'.$m->match_id .'</div>';
			echo '<div class="timeStart">'.date('M, d. Y H:m:s',$m->start_time) .'</div>';;
	
			echo '<ul class="herolistsmall">';
			foreach($m->players as $pp => $m) {			
				echo '<li class="player'.$m->player_slot.'"><a href="?account_id='.$m->account_id.'"><img title="'.$heroes[$m->hero_id]->localized_name.'" src="'.$heroes[$m->hero_id]->img.'" /></a></li>';			
			}
			echo '</li></ul>';
			echo '</ul>';
		}
	
	}
	
	//print_r($data);
?>		
	<div class="clear"></div>
		</div>
	</div>
</div>

</body>
</html>