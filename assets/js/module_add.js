function setDisplay(){
	if(document.getElementById("is_subject").checked){
		document.getElementById("div_module_number").style.display = 'none';
	} else {
		document.getElementById("div_module_number").style.display = '';
	}
}

setDisplay();