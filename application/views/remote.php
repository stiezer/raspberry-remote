<?php 
	
	
	$dir = DOWNLOAD_DIR .(isset($_GET['dir']) ? '/' . $_GET['dir'] : '');
	
	$files = array();

	if ($handle = opendir($dir)) {
	    while (false !== ($entry = readdir($handle))) {
	        if ($entry != "." && $entry != "..") {
				$files[] = $entry;
	        }
	    }
	    closedir($handle);
	}

	
	function is_playable($f){
	
		$parts = explode('.',$f);
		$ext = end($parts);
		
		
		$extensions = array('mp4','mov');
		return (in_array($ext,$extensions));
	}
 
 
 /*
	 
	 1 Increase Speed
2 Decrease Speed
j Previous Audio stream
k Next Audio stream
i Previous Chapter
o Next Chapter
n Previous Subtitle stream
m Next Subtitle stream
s Toggle subtitles
q Exit OMXPlayer
Space or p Pause/Resume
- Decrease Volume
+ Increase Volume
Left Seek -30
Right Seek +30
Down Seek -600
Up Seek +600
	 
	 
 */

?><html>
<head>

	
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">

	
</head>
<body>

	<div class="alert loading alert-danger">
		LOADING...
	</div>
	<div class="container">
	
	<h1>Remote G</h1>
		
	<div class="controls">
		<div class="btn-group">
		  <button type="button" class="btn btn-default omx" data-action="command" data-param="i">
		  	<span class="fa fa-fast-backward"></span>
		  </button>		  
		  <button type="button" class="btn btn-default omx" data-action="command" data-param="p">
		  	<span class="fa fa-play  btn-play"></span>
		  	<span class="fa fa-pause  btn-pause"></span>
		  </button>		  
		  <button type="button" class="btn btn-default omx" data-action="command" data-param="q">
		  	<span class="fa fa-stop"></span>
		  </button>
		  <button type="button" class="btn btn-default omx" data-action="command" data-param="o">
		  	<span class="fa fa-fast-forward"></span>
		  </button>		  
		</div>
		
		<div class="btn-group pull-right">
		
		  <button type="button" class="btn btn-default omx" data-action="command" data-param="-">
		  	<span class="fa fa-volume-down"></span>
		  </button>	
		  <button type="button" class="btn btn-default omx" data-action="command" data-param="+">
		  	<span class="fa fa-volume-up"></span>
		  </button>	
		</div>
	</div>
		<ul class="nav nav-list">	 	
		<?php foreach($files as $f) :  ?>
			<?php 
				$path = str_replace($dir.'/','',$f);
				
				$link = is_dir($dir .'/'. $path) ? '?dir=' .$path : '#';

			 ?>
		
			<li><a href="<?php print $link ?>" class="file">
				<?php print $path; ?>
								
				<?php if(is_playable($f)) : ?>
					<i class="fa fa-play pull-right omx" data-action="start" data-param="<?php  print $dir.'/'.$f ?>"></i>
				<?php endif; ?>
			</a></li>
		<?php endforeach; ?>
		</ul>
		<h1>LOG</h1>
		
		<div id="log">
		
		</div>
	</div>

	<script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script src="/static/js/app.js"></script>

</body>
</html>