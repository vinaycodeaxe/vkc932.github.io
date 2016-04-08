<?php
$url = "https://www.reddit.com/.rss";

if(@simplexml_load_file($url)) {
	$rss=simplexml_load_file($url);
}else{
	echo "ERROR CONNECTING";
	exit(0);
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $rss->title;?></title>

<link rel="stylesheet" type="text/css" href="styles.css" />

<script type="text/javascript">
	


    function toggle_visibility(id) {
       var e = document.getElementById(id);
       if(e.style.display == 'block'){
          e.style.display = 'none';
       		document.getElementById(id+'&').innerHTML = "Show this feed";
       }
       else{
          e.style.display = 'block';
          document.getElementById(id+'&').innerHTML = "Hide this feed";
       }
    }


    pageOpen = new Date();
    function myFunction() {
      var date = new Date();

      	var id='time';

		
	  pageClose =new Date(); 
	  hours=pageClose.getHours()-pageOpen.getHours(); minutes=pageClose.getMinutes()-pageOpen.getMinutes(); 
	  seconds=pageClose.getSeconds()-pageOpen.getSeconds(); time = (seconds + (minutes * 60) + (hours * 60 * 60)); 
	  if(time<60){ 
	  	document.getElementById(id).innerHTML="current time: "+date.toISOString()+"<br>Time Spent By You On This page " + time + " seconds"; } 
	  	else { 
	  		min=(parseInt(time/60)); sec=(time%60); 
	  		document.getElementById(id).innerHTML="current time"+date.toISOString()+"<br>Time Spent By You On This page " + min + " minutes " + sec + " seconds"; 
	  	}
		timer = setTimeout(myFunction,1000);
    }
    
    	


</script>




</head>

<body onload="myFunction()">

<h1>Making A Feed Reader Widget With PHP</h1>
<div id="time" class="topcorner"></div>

<div id="main">

<div id="feedWidget" style="display:block;">
	<div id="activeTab" class>
    	RSS FEED 
    </div>
    
    <div class="line" ></div>
    
    <div id="tabContent">

    	<?php
			$entrys = $rss->entry;
			foreach($entrys as $entry){
			
				
				?>
				<div>

				<?php echo "<div id= ".$entry->id." style='display:block';>" ?>
				<?php echo '<h1><a href="'.$entry->link[0]->attributes()->href.'">'.$entry->title.'</a></h1>';?>
			<?php	
				echo $entry->content;
				?>
				</div>
				 
				<?php echo '<a  id='."'".$entry->id."&'".' onclick="toggle_visibility('."'".$entry->id."'".');">Hide this feed</a>'; ?>				
				</div>
				<?php
			}
		?>


    </div>
</div>

<div class="shadow"></div>


</body>
</html>
