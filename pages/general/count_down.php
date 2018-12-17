<?
if($_SESSION['ROLE'] == 'judge') echo '<h1>Contest&nbsp;ID:&nbsp;'.$_SESSION['CONTEST']['ID'].'</h1>';
echo '<h1>Contest has not start yet!!</h2>';
echo '<h2 id="count_down">'.(strtotime($_SESSION['CONTEST']['BEGIN'])-time()).'</h2>';
echo '<div class="pure-g" style="text-align: center;">';
foreach($participants as $name) echo '<div class="pure-u-1-3 pure-u-md-1-6"><p>'.htmlentities($name).'</p></div>';
echo '</div>';
?>
<script>
var timeleft = document.getElementById("count_down").innerHTML;
setTimeout(function(){ location = '' }, 20000);
setInterval( function(){
	document.getElementById("count_down").innerHTML = Math.floor(timeleft/3600)+" : "+Math.floor(timeleft/60%60)+" : "+Math.floor(timeleft%60);
	if(timeleft == 0) window.location = '';
	timeleft--;
},1000);
</script>