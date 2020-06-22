function getColor(){
    var data = document.getElementsByClassName("custom-color");
    for(var i=0; i<data.length; i++){
        var color = data[i].value;
        data[i].style.background = color;
    }
}

window.addEventListener("load", getColor);
