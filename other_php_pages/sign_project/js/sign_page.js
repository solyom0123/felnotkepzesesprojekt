/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var context;
var act_l;
var ACT_L_ID = 0;
//student manage functions
/**
 * 
 * @returns {undefined}
 */
function changeL(act_l_id) {

    if (act_l_id == 0) {
        act_l = hungarian_titles;
        ACT_L_ID = act_l_id;
    } else {

        act_l = english_titles;
        ACT_L_ID = act_l_id;
    }
    setText();
}
function setText() {
    document.getElementById("command").innerHTML = act_l[0];
    document.getElementById("list_title").innerHTML = act_l[1];

}

function courseList() {

    var slink = 'server.php';
    $.post(slink, {
        muv: "list_course",
        param: "value"

    }, function (data, status) {
        ////console.log(data);
        if (data != "none;//") {
            var value = "";
            var spStudents = data.split("//");
            for (var i = 0; i < spStudents.length; i++) {
                if (!checkEmptyString(spStudents[i])) {
                    var spStudent = spStudents[i].split(";");
                    console.log(spStudent);
                    value += '<div class="card" style="width:200px" onclick="giveParam(' + spStudent[0] + ');' + "link('student_page');" + " setElozo('course_page')" + '">' +
                            '<img class="card-img-top" src="./img/course.png" alt="Card image" style="width:100%">' +
                            '<div class="card-body">' +
                            '<h4 class="card-title">' + spStudent[1] + '</h4>' +
                            '<p class="card-text">' + spStudent[2] + '</p>' +
                            '</div>' +
                            '</div>';
                }
            }
            document.getElementById("list_items").innerHTML = value;
        } else {
            var value = '';
            document.getElementById("list_items").innerHTML = value;
        }


    });
}
var clickX = new Array();
var clickY = new Array();
var clickDrag = new Array();
var paint;

function addClick(x, y, dragging)
{
  clickX.push(x);
  clickY.push(y);
  clickDrag.push(dragging);
}
function redraw(){
  context.clearRect(0, 0, context.canvas.width, context.canvas.height); // Clears the canvas
  context.rect(0, 0, context.canvas.width, context.canvas.height);
  context.fillStyle = "white";
  context.fill();
  context.fillStyle = "black";
  
  context.strokeStyle = "#df4b26";
  context.lineJoin = "round";
  context.lineWidth = 5;
			
  for(var i=0; i < clickX.length; i++) {		
    context.beginPath();
    if(clickDrag[i] && i){
      context.moveTo(clickX[i-1], clickY[i-1]);
     }else{
       context.moveTo(clickX[i]-1, clickY[i]);
     }
     context.lineTo(clickX[i], clickY[i]);
     context.closePath();
     context.stroke();
  }
    showSendButton();
}
function showSendButton(){
    if(clickX.length>0){
        document.getElementById('sendBtnGreen').style.display="block";
    }else{
        document.getElementById('sendBtnGreen').style.display="none";
    
    }
}
function loadCanvas(s_id) {
        
        document.getElementById('student').value=s_id;
        canvas_simple = document.getElementById('canvaskem');
	if(typeof G_vmlCanvasManager != 'undefined') {
		canvas_simple = G_vmlCanvasManager.initElement(canvas_simple);
	}
        context = canvas_simple.getContext("2d");
	clickX = new Array();
		clickY = new Array();
		clickDrag = new Array();
	
        clearCanvas();
        showSendButton();
	// Add mouse events
	// ----------------
	$('#canvaskem').mousedown(function(e)
	{
		// Mouse down location
		var mouseX = e.pageX - this.offsetLeft;
		var mouseY = e.pageY - this.offsetTop;
		
		paint = true;
		addClick(mouseX, mouseY, false);
		redraw();
	});
	
	$('#canvaskem').mousemove(function(e){
		if(paint){
			addClick(e.pageX - this.offsetLeft, e.pageY - this.offsetTop, true);
			redraw();
		}
	});
	
	$('#canvaskem').mouseup(function(e){
		paint = false;
	  	redraw();
	});
	
	$('#canvaskem').mouseleave(function(e){
		paint = false;
	});
	
	$('#clearCanvasSimple').mousedown(function(e)
	{
		clickX = new Array();
		clickY = new Array();
		clickDrag = new Array();
		clearCanvas(); 
                showSendButton();
	});
	
	// Add touch event listeners to canvas element
	canvas_simple.addEventListener("touchstart", function(e)
	{
		// Mouse down location
		var mouseX = (e.changedTouches ? e.changedTouches[0].pageX : e.pageX) - this.offsetLeft,
			mouseY = (e.changedTouches ? e.changedTouches[0].pageY : e.pageY) - this.offsetTop;
		
		paint = true;
		addClick(mouseX, mouseY, false);
		redraw();
	}, false);
	canvas_simple.addEventListener("touchmove", function(e){
		
		var mouseX = (e.changedTouches ? e.changedTouches[0].pageX : e.pageX) - this.offsetLeft,
			mouseY = (e.changedTouches ? e.changedTouches[0].pageY : e.pageY) - this.offsetTop;
					
		if(paint){
			addClick(mouseX, mouseY, true);
			redraw();
		}
		e.preventDefault()
	}, false);
	canvas_simple.addEventListener("touchend", function(e){
		paint = false;
	  	redraw();
	}, false);
	canvas_simple.addEventListener("touchcancel", function(e){
		paint = false;
	}, false);
}
function clearCanvas()
{       context.clearRect(0, 0, context.canvas.width, context.canvas.height); // Clears the canvas
        context.rect(0, 0, context.canvas.width, context.canvas.height);
  context.fillStyle = "white";
  context.fill();
	
}
function send(){
   var s_id= document.getElementById('student').value;
   var canvas = document.getElementById('canvaskem');
   var dataURL = canvas.toDataURL();
    $.post("server.php", {
      muv: "save_img",
     imgBase64: dataURL,
     param: s_id
  
    }, function (data, status) {
        console.log(data);
    link("course_page");
console.log('saved'); 
  

    });

   
}
function studentListSign(c_id) {

    var slink = 'server.php';
    $.post(slink, {
        muv: "list_student",
        param: c_id

    }, function (data, status) {
        console.log(data);
        if (data != "none;//") {
            var value = "";
            var spStudents = data.split("//");
            for (var i = 0; i < spStudents.length; i++) {
                if (!checkEmptyString(spStudents[i])) {
                    var spStudent = spStudents[i].split(";");

                    value += '<div class="card_st" style="width:200px" onclick="giveParam(' + spStudent[0] + ');' + "link('canvas_page');" + " setElozo('course_page')" + '">' +
                            '<img class="card-img-top" src="./img/img_avatar1.png" alt="Card image" style="width:100%">' +
                            '<div class="card-body">' +
                            '<h4 class="card-title">' + spStudent[1] + '</h4>' +
                            '<p class="card-text">' + spStudent[2] + '</p>' +
                            '</div>' +
                            '</div>';
                }
            }
            document.getElementById("list_items").innerHTML = value;
        } else {
            var value = '';
            document.getElementById("list_items").innerHTML = value;
        }


    });
}