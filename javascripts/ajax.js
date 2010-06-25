var searchBox;

$(document).ready(function(){

  searchBox = $("#searchBox");
 
 setSearch();

});

function setSearch(){

searchBox.focus(function(){
if(searchBox.val() == "Search"){
    searchBox.val(""); 
    }
 });
}


//ajaxFunc = function in ajax.php (check_username_exists)
//callBack = function that does something with ajax request
//paramName = parameter passed into ajax.php
//paramValue = value of parameter
//htmlID = html ID to load content into
//defaultHtml = default content if ajax fails
function makeAjaxRequest(ajaxFunc, callBack, paramName, paramValue, htmlID, defaultHtml){

    if (window.XMLHttpRequest) {
        http = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }

    var url = '../../ajax.php?';
    if(paramName.length > 0) {
        var fullurl = url + 'do=' + ajaxFunc + '&' + paramName + '=' + encodeURIComponent(paramValue);
        http.open("GET", fullurl, true);
        http.send(null);
        http.onreadystatechange = callBack;
    }else{
        document.getElementById(htmlID).innerHTML = defaultHtml;
        }
  
}

function makeFacebookRequest(paramName, paramValue, paramName2, paramValue2){


	alert('paramName');
	alert('paramValue');
	alert('paramName2');
	alert('paramValue2');
    if (window.XMLHttpRequest) {
        http = new XMLHttpRequest();
    } else if (window.ActiveXObject) {
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }

    var url = '../../ajax.php?';
    if(paramName.length > 0 && paramName2.length > 0) {
        var fullurl = url + 'do=' + 'facebook_user' + '&' + paramName + '=' + encodeURIComponent(paramValue) + '&' + paramName2 + '=' + encodeURIComponent(paramValue2);
        http.open("GET", fullurl, true);
        http.send(null);
    }
		
}

//callback function for facebook
function statechange_facebook() {
	if(http.readyState==3){
		//window.location='raid2/250_A/insert.php';
	}
}

//callback function for getting artists
function statechange_artists() {
    if (http.readyState == 4) {
        var xmlObj = http.responseXML;
        var html = xmlObj.getElementsByTagName('result').item(0).firstChild.data;   
        document.getElementById('second').innerHTML = html;
    }
}

//function to get artists
function loadArtists(genre_id)
{
    document.getElementById('second').innerHTML = "";
    makeAjaxRequest('load_artist_select', statechange_artists, 'genre_id', genre_id, 'second', '');
	document.getElementById('last').innerHTML = "";
}

//callback function for getting albums
function statechange_albums() {
  if (http.readyState == 4) {
      var xmlObj = http.responseXML;
      var html = xmlObj.getElementsByTagName('result').item(0).firstChild.data;
      document.getElementById('last').innerHTML = html;
  }
}

//function to get albums
function loadAlbums(artist_id)
{
    document.getElementById('last').innerHTML = "";
    makeAjaxRequest('load_album_select', statechange_albums, 'artist_id', artist_id, 'last', '');
}

//callback function for loading most played tab
function statechange_tabs() {
  if (http.readyState == 4) {
      var xmlObj = http.responseXML;
      var html = xmlObj.getElementsByTagName('result').item(0).firstChild.data;
      document.getElementById('tabs_div').innerHTML = html;
  }	
}

//function for changing tabs
function loadTab(tab_name)
{
	document.getElementById('tabs_div').innerHTML = "";
	makeAjaxRequest('load_tab', statechange_tabs, 'tab_name', tab_name, 'tabs_div', '');
}
  
//callback function for rating up albums
function statechange_rateUp(){
  if (http.readyState == 4) {
      //reload the page?
  }  
}

//function to rate up albums
function rateUpAlbum(album_id){
    makeAjaxRequest('rate_album_up', statechange_rateUp, 'album_id', album_id, 'temp', '');
}

//callback function for rating up albums
function statechange_rateDown(){
  if (http.readyState == 4) {
      //reload the page?
  }  
}

//function to rate up albums
function rateDownAlbum(album_id){
    makeAjaxRequest('rate_album_down', statechange_rateDown, 'album_id', album_id, 'temp', '');
}

function search(){
    var searchBox = document.getElementById("searchBox");
    var url = "search.php";
    
    var fullUrl = url + "?terms=" + encodeURI(searchBox.value);
    
    loadContent(fullUrl);
    
    return false;
}

function statechange_randomAlbum(){
    if (http.readyState == 4) {
      var xmlObj = http.responseXML;
      if(xmlObj.getElementsByTagName('result').item(0).firstChild){
      var html = xmlObj.getElementsByTagName('result').item(0).firstChild.data;
      //document.getElementById('random').innerHTML = html;
      loadContent("info.php?album=" + html);
      
      return false;
      }
  }	
}

function randomAlbum()
{
    makeAjaxRequest('random_album', statechange_randomAlbum, 'album_row', randAlbum, 'temp', '');
}