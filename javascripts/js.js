var randAlbum;

var currentSong;
var index=0;
var playlistArray = new Array(0);
var playlistHash = new Array();
var size=0;

soundManager.url="javascripts/soundmanager/swf/";
soundManager.debugMode=false;

function removeSong(song){
	for(i=0;i<playlistArray.length;i++){
		if(song==playlistHash[playlistArray[i]].sID){
			if(currentSong.sID==song){
				currentSong.stop();
				currentSong=null;
			}
			soundManager.destroySound(playlistHash[playlistArray[i]].sID);
			playlistArray.splice(i,1);
			$("#"+song).remove();
			size--;
		}
	}
}

function playAlbum(album){
	if(currentSong!=null){
		currentSong.stop();
	}
	tempSong=null;
		prepend="";
$.post("functions/playlistAppend.php?album_id="+album, function(data) {
		tempArray = new Array(0);
			$("song",data).each(function(id) {
				song = $("song",data).get(id);
				 prepend = prepend+"<li id="+$("id",song).text();
				 prepend = prepend+"><label>";
				 prepend = prepend+$("name",song).text();
				 prepend = prepend+"</label><em>";
				 prepend = prepend+"<a href='javascript:loadContent(\"info.php?album="+$("album_id",song).text()+"\")'>i</a></em><a href='javascript:removeSong("+$("id",song).text()+")'><img src='images/delete.gif'></a></li>";
				 tempSong = soundManager.createSound({
					id: $("id",song).text(),
					onplay:function(){
						addPlay($('id',song).text());
					},
					url:$("location",song).text(),
					onfinish:function() {
						nextSong();
					}
					});
				 tempArray.unshift(tempSong.sID);
				 playlistHash[tempSong.sID]=tempSong;
		});
			for(i=0;i<tempArray.length;i++){
				playlistArray.unshift(tempArray[i]);
			}
		$("#playlistList").prepend(prepend);
		$('#playlistList li').removeClass("current");
		$("#"+playlistArray[0]).addClass("current");
	currentSong=playlistHash[playlistArray[0]];
		currentSong.play();
	$('#playPauseButton').removeClass("pp");
				$('#playPauseButton').addClass("pause");
	
	
		index=0;
		size+=tempArray.length;
		
		$("#playlistList").sortable({
update: function(event,ui){
		playlistArray=$("#playlistList").sortable('toArray');
		if(currentSong!=null&&currentSong.sID==$(ui.item).attr('id')){
			index=$("#playlistList li").index(ui.item);
		}
		}
			});
				 });
			}

function loadPlaylist(playlist){
	if(currentSong!=null){
		currentSong.stop();
	}
	tempSong=null;
		prepend="";
		$.post("functions/playlistAppend.php?playlist_id="+playlist, function(data) {
		tempArray = new Array(0);
			$("song",data).each(function(id) {
				song = $("song",data).get(id);
				 prepend = prepend+"<li id="+$("id",song).text();
				 prepend = prepend+"><label>";
				 prepend = prepend+$("name",song).text();
				 prepend = prepend+"</label><em>";
				 prepend = prepend+"<a href='javascript:loadContent(\"info.php?album="+$("album_id",song).text()+"\")'>i</a></em><a href='javascript:removeSong("+$("id",song).text()+")'><img src='images/delete.gif'></a></li>";
				 tempSong = soundManager.createSound({
					id: $("id",song).text(),
					onplay:function(){
						addPlay();
					},
					url:$("location",song).text(),
					onfinish:function() {
						nextSong();
					}
					});
				 tempArray.unshift(tempSong.sID);
				 playlistHash[tempSong.sID]=tempSong;

		});
			for(i=0;i<tempArray.length;i++){
				playlistArray.unshift(tempArray[i]);
			}
		$("#playlistList").prepend(prepend);
		$('#playlistList li').removeClass("current");
		$("#"+playlistArray[0]).addClass("current");
	currentSong=playlistHash[playlistArray[0]];
currentSong.play();
		index=0;
		size+=tempArray.length;	
			$("#playlistList").sortable({
update: function(event,ui){
		playlistArray=$("#playlistList").sortable('toArray');
		if(currentSong!=null&&currentSong.sID==$(ui.item).attr('id')){
			index=$("#playlistList li").index(ui.item);
		}
		}
			});	
				 });
			}
function addPlay(){
	$.post("functions/addPlay.php?song_id="+currentSong.sID,function(data){
	});
}

function handleSave(value, setting){
	if(value==""||value=="Enter Playlist Name"){
		var Time = new Date();
		value="Playlist "+(Time.getMonth()+1)+"/"+Time.getDate()+"/"+Time.getFullYear()+" "+Time.getHours()+":"+Time.getMinutes();
	}
	tArray = new Array(0);
	$("#playlistList li").each(function(){
			tArray.push($(this).attr("id"));
	});

	$.post("functions/savePlaylist.php",{'array': tArray.join(","),'name': value},function(data){
			});

		$(".save").replaceWith("<a class='save'>Saved!</a>");
}
function appendAlbum(album){
	tempSong=null;
		prepend="";
$.post("functions/playlistAppend.php?album_id="+album, function(data) {
		tempArray = new Array(0);
			$("song",data).each(function(id) {  
				 song = $("song",data).get(id);
				 prepend = prepend+"<li id="+$("id",song).text();
				 prepend = prepend+"><label>";
				 prepend = prepend+$("name",song).text();
				 prepend = prepend+"</label><em>";
				 prepend = prepend+"<a href='javascript:loadContent(\"info.php?album="+$("album_id",song).text()+"\")'>i</a></em><a href='javascript:removeSong("+$("id",song).text()+")'><img src='images/delete.gif'></a></li>";

				 tempSong = soundManager.createSound({
					id: $("id",song).text(),
					onplay:function(){
						addPlay($('id',song).text());
					},
					url:$("location",song).text(),
					onfinish:function() {
						nextSong();
					}
					});
				 tempArray.unshift(tempSong.sID);
				 playlistHash[tempSong.sID]=tempSong;

		});
			for(i=0;i<tempArray.length;i++){
				playlistArray.push(tempArray[i]);
			}
		$("#playlistList").append(prepend);
		if(currentSong==null){
			index=0;
			size=tempArray.length;
		}else {
			size+=tempArray.length;
		}
		$("#playlistList").sortable({
update: function(event,ui){
		playlistArray=$("#playlistList").sortable('toArray');
		if(currentSong!=null&&currentSong.sID==$(ui.item).attr('id')){
			index=$("#playlistList li").index(ui.item);
		}
		}
			});
				 });
			}



function playSong(song){
	if(currentSong!=null){
		currentSong.stop();
	}
	tempSong=null;
		prepend="";
$.post("functions/playlistAppend.php?song_id="+song, function(data) {
		tempArray = new Array(0);
			$("song",data).each(function(id) {  
				 song = $("song",data).get(id);
				 prepend = prepend+"<li id="+$("id",song).text();
				 prepend = prepend+"><label>";
				 prepend = prepend+$("name",song).text();
				 prepend = prepend+"</label><em>";
				 prepend = prepend+"<a href='javascript:loadContent(\"info.php?album="+$("album_id",song).text()+"\")'>i</a></em><a href='javascript:removeSong("+$("id",song).text()+")'><img src='images/delete.gif'></a></li>";

				 tempSong = soundManager.createSound({
					id: $("id",song).text(),
					onplay:function(){
						addPlay($('id',song).text());
					},
					url:$("location",song).text(),
					onfinish:function() {
						nextSong();
					}
					});
				 tempArray.unshift(tempSong.sID);
				 playlistHash[tempSong.sID]=tempSong;

		});
			for(i=0;i<tempArray.length;i++){
				playlistArray.unshift(tempArray[i]);
			}
		$("#playlistList").prepend(prepend);
		$('#playlistList li').removeClass("current");
		$("#"+playlistArray[0].sID).addClass("current");
	currentSong=playlistHash[playlistArray[0]];
		currentSong.play();
		index=0;
				$("#playPauseButton").removeClass("pp");
				$("#playPauseButton").addClass("pause");

		size+=playlistArray.length;
		$("#playlistList").sortable({
update: function(event,ui){
		playlistArray=$("#playlistList").sortable('toArray');
		if(currentSong!=null&&currentSong.sID==$(ui.item).attr('id')){
			index=$("#playlistList li").index(ui.item);
		}
		}
			});
				 });
			}


function nextSong(){
	if(currentSong!=null){
		currentSong.stop();
		var oldIndex = index;
		if(index+1<size){
			index++;
			currentSong=playlistHash[playlistArray[index]];
			currentSong.play();
		}else{
			currentSong=playlistHash[playlistArray[0]];
			currentSong.play();
			index=0;
		}
	}else{
		currentSong=playlistHash[playlistArray[0]];
		currentSong.play();
		index=0;
	}
	$('#playPauseButton').removeClass("pp");
				$('#playPauseButton').addClass("pause");
	
	$('#playlistList li').removeClass("current");
	if(index<size){
		$("#"+playlistArray[index]).addClass("current");
	}else{
		$("#"+playlistArray[0]).addClass("current");
	}
}


				
function appendSong(song){
	tempSong=null;
		prepend="";
$.post("functions/playlistAppend.php?song_id="+song, function(data) {
		tempArray = new Array(0);
			$("song",data).each(function(id) {  
				 song = $("song",data).get(id);
				 prepend = prepend+"<li id="+$("id",song).text();
				 prepend = prepend+"><label>";
				 prepend = prepend+$("name",song).text();
				 prepend = prepend+"</label><em>";
				 prepend = prepend+"<a href='javascript:loadContent(\"info.php?album="+$("album_id",song).text()+"\")'>i</a></em><a href='javascript:removeSong("+$("id",song).text()+")'><img src='images/delete.gif'></a></li>";

				 tempSong = soundManager.createSound({
					id: $("id",song).text(),
					onplay:function(){
						addPlay($('id',song).text());
					},
					url:$("location",song).text(),
					onfinish:function() {
						nextSong();
					}
					});
				 tempArray.unshift(tempSong.sID);
				 playlistHash[tempSong.sID]=tempSong;

		});
			for(i=0;i<tempArray.length;i++){
				playlistArray.push(tempArray[i]);
			}
	$("#playlistList").append(prepend);
		if(currentSong==null){
			index=0;
			size+=tempArray.length;
		}else {
			size+=tempArray.length;
		}
		$("#playlistList").sortable({
update: function(event,ui){
		playlistArray=$("#playlistList").sortable('toArray');
		if(currentSong!=null&&currentSong.sID==$(ui.item).attr('id')){
			index=$("#playlistList li").index(ui.item);
		}
		}
			});
				 });
			}




function loadSide(song){
	$("#side").load("time.php?song_name="+song);
	soundManager.pause('test');
}
function loadContent(page){
	$("#yui-main").load(page + " #yui-main");
	window.location.hash=page;
//	constructRandomButton();
    genRandomAlbumNum();
//	window.location.hash=$(this).attr('href')
}

function genRandomAlbumNum(){
	randAlbum = Math.floor(Math.random()*randomCount);
}

var lastHash = '';

function pollHash() {
	if(!window.location.hash&&lastHash){
		var pathArray=(window.location.pathname).split("/");
		loadContent(pathArray[pathArray.length-1]);
	}
	if(lastHash !== window.location.hash) {
		lastHash = window.location.hash;
		loadContent(lastHash.substr(1));
	}
}

$(document).ready(function() {
		$(".ff").click(function(){
			nextSong();
			});
		$(".pp").live("click",function(){
			if(currentSong!=null){
				currentSong.togglePause();
			}else{
				nextSong();
				}
				$(this).removeClass("pp");
				$(this).addClass("pause");
			});
		$(".clearPlaylist").live("click",function(){
			playlistArray=new Array(0);
			playlistHash=new Array();
			if(currentSong!=null){
				currentSong.stop();
			}
			currentSong=null;
	$('#playPauseButton').removeClass("pause");
				$('#playPauseButton').addClass("pp");
	
	$("#playlistList li").each(function(){
		$(this).remove();
	});
	});


		$(".pause").live("click",function(){
			currentSong.togglePause();
			$(this).removeClass("pause");
			$(this).addClass("pp");
			});
			$("#playlistList li").live("dblclick",function(){
			});
	/*	$(".save").click(function(){
			savePlaylist();
			});*/
	setInterval(pollHash, 100);
	$('.save').editable(function(value,settings){
		handleSave(value,settings);
		},{
			tooltip: 'Enter Playlist Name',
			data: 'Enter Playlist Name',
			height: 25,
			width: 150
			});






						   
//	var hash = window.location.hash.substr(1);
//	var href = $('#nav li a').each(function(){
//		var href = $(this).attr('href');
//		if(hash==href.substr(0,href.length-5)){
//			var toLoad = hash+'.php #content';
//			$('#content').load(toLoad)
//		}											
//	});
//
//	$('#nav li a').click(function(){
//								  
//		var toLoad = $(this).attr('href')+' #content';
//		$('#content').hide('fast',loadContent);
//		$('#load').remove();
//		$('#wrapper').append('<span id="load">LOADING...</span>');
//		$('#load').fadeIn('normal');
//		window.location.hash = $(this).attr('href').substr(0,$(this).attr('href').length-5);
//		function loadContent() {
//			$('#content').load(toLoad,'',showNewContent())
//		}
//		function showNewContent() {
//			$('#content').show('normal',hideLoader());
//		}
//		function hideLoader() {
//			$('#load').fadeOut('normal');
	//	}
		return false;
		
//	});

});
