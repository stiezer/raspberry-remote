
var lastAction = '';
var playing = false;

function lg(a){
	$('#log').prepend($("<pre>"+a+"</pre>"));
}

function updateInterface(){


	lg('updateInterface');
	
	
	$('.loading').css('display','none');
	
	if(playing){
		$('.btn-play').css('display','none');
		$('.btn-stop').css('display','block');
		$('.nav-list').css('display','none');
		$('.controls').css('display','block');		
	}else{
		$('.btn-play').css('display','block');
		$('.btn-stop').css('display','none');
		$('.nav-list').css('display','block');
		$('.controls').css('display','none');
		
	}
	

	
	
}

function sendOMX(action,param){

	lg('send action ' + action + ' to omx with param ' + param);
	
	
	
	data = {
		'action' : action,
		'param' : param,
		'omx' : 1};

	if(param == 'q'){
		playing = false;
	}	
	$.post('index.php/omxplayer/' + action ,data,function(res){

		lg(res);
		updateInterface();
		
	});
}

function lockInterface(){
	lg('lockInterface');
	$('.loading').css('display','block');
}

$(document).ready(function() {


	
	$('.omx').click(function(){
		
		lockInterface();
		

		
		lastAction = $(this).attr('data-action');

		
		sendOMX($(this).attr('data-action'), $(this).attr('data-param'));
		
		if(lastAction == 'start'){
		
			setTimeout(function(){
				playing = true;
				sendOMX('command','p');
				updateInterface();
			}, 2000);
			
		}
		
	});
	

	updateInterface();
});