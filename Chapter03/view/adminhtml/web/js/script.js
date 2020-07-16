function getColor(){
    var data = document.getElementsByClassName("custom-color");
    for(var i=0; i<data.length; i++){
        var color = data[i].value;
        data[i].style.background = color;
    }
}
function getText(e){
    var data = document.getElementsByClassName("custom-color");
    color = this.value;
    var option = document.getElementById("color_option_section_color_option_group_optionals");
    option.value = color;
}

window.addEventListener("load", getColor);
window.addEventListener("keyup", getText);
