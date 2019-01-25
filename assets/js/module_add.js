var value = document.getElementById("number_module").value;

function setDisplay(){
	if(document.getElementById("is_subject").checked){
		document.getElementById("div_module_number").style.display = 'none';
		value = document.getElementById("number_module").value;
		document.getElementById("number_module").value = 0;
	} else {
		document.getElementById("div_module_number").style.display = '';
		document.getElementById("number_module").value = value;
	}
}

setDisplay();