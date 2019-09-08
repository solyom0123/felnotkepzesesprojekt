

function pushSend() {
    var uzenet = document.getElementById("form-row-m").value;
    var kepzes = document.getElementById("form-row-aktiv-kepzes-list").value;
   
   if(kepzes!=-1){
    var value = new Array(uzenet, kepzes);
    var slink = 'server.php';
    $.post(slink, {
        muv: "pushSend",
        param: value

    }, function (data, status) {
        //////console.log(data);
        
            megsem();


    });
   }
}
