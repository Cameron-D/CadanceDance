<?php
if(isset($_POST['submit'])) {
	if(isset($_POST['video']) && isset($_POST['bpm'])) {
		if(preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $_POST['video'], $matches)) {
			header("Location: ".$matches[0]."/".intval($_POST['bpm'])."/".((isset($_POST['start']) && $_POST['start']!=0) ? intval($_POST['start']) : ""));
		} else {
			header("Location: index.php?e");
		}
	} else {
		header("Location: index.php?e");
	}
	exit;
}
$vid = (isset($_GET['vid'])) ? $_GET['vid'] : "qKif0NrIiJA";
$bpm = (isset($_GET['bpm'])) ? intval($_GET['bpm']) : 128;
$start = (isset($_GET['start'])) ? intval($_GET['start']) : 0;
if(!isset($_GET['vid'])) { $start=35; }
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Cadance Dance</title>
		<link rel="stylesheet" type="text/css" href="/s/style.css" />
		<script type="text/javascript">var bpm=<?php echo $bpm; ?>;var video='<?php echo $vid; ?>';var time=<?php echo $start; ?>;</script>
	</head>
	<body>
<?php
if(isset($_GET['e'])) {
	echo '<div id="error">Looks like you didn\'t enter a valid video URL :/</div>';
}
?>
		<div id="animation">
			<img src="/s/frame1_04.jpg" id="frame1" />
			<img src="/s/frame2_04.jpg" id="frame2" />
			<img src="/s/frame3_04.jpg" id="frame3" />
			<img src="/s/frame4_04.jpg" id="frame4" />
			<img src="/s/frame5_04.jpg" id="frame5" />
			<img src="/s/frame6_04.jpg" id="frame6" />
			<img src="/s/frame7_04.jpg" id="frame7" />
			<img src="/s/frame8_04.jpg" id="frame8" />
			<img src="/s/frame9_04.jpg" id="frame9" />
			<img src="/s/frame10_04.jpg" id="frame10" />
		</div>
		<div id="lights"></div>
		<div id="party"></div>
		<div id="video">
			<div id="ytapiplayer"></div><!--Shamefully stolen from discodiscord because lazy-->
			<a href="#" id="play">Play</a><a href="#" id="stop">Pause</a>
			<a href="#" id="lightson">Turn the lights on</a>
			<a href="#" id="partyhard">PARTY HARD! (Epilepsy Warning)</a>
		</div>
		<div id="create">
			<div id="meta">
				<a id="vidlink" href="http://youtu.be/<?php echo $vid; ?>">View on YouTube</a>
			</div>
			<div id="createcontent">
				<form action="/index.php" method="post">
				Play <input type="text" name="video" size="30" value="http://youtu.be/<?php echo $vid; ?>" /><br />
				at <input type="text" name="bpm" size="3" value="<?php echo $bpm; ?>" /> BPM, starting at <input type="text" name="start" size="3" value="0" /> seconds.<br /><br />
				<input type="submit" name="submit" value="Set Music" />
				</form>
			</div>
			<a href="#" id="showcreate">Hide</a>
		</div>
		<div id="footer">
			Created by <a href="http://cazzaserver.com/">Cameron:D</a>. Inspired by <a href="http://www.discodiscord.com/">Disco Discord</a> and <a href="http://www.youtube.com/watch?v=jtanVLvpLZg">KirbyStompFilms' video</a>.
		</div>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js" ></script>
		<script type="text/javascript" src="/s/script.js"></script>
	</body>
</html>