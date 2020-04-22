// --------- CONTROLLI --------

function isPasswordEqual(password, passwordConfirm){
	let pwd1 = document.getElementById(password);
	let pwd2 = document.getElementById(passwordConfirm);
	let result = pwd1.value === pwd2.value;
	printError(result, passwordConfirm.toString()+"-message", "Password diverse");
	return result;
}

function checkEmail(email) { //passo l'id della mail che voglio controllare, per esempio "signup-email"
	let regex = new RegExp("^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$"); //presa da stackoverflow, matcha il 99% delle mail cit.
	let test = document.getElementById(email).value.toLowerCase();
	let result = (regex.test(test)) && !(test === ""); //la regex mi restituisce vero se matcha con il test, inoltre non voglio che il campo dati sia vuoto
	printError(result, email.toString()+"-message", "Email non corretta");
	return result;
}

function checkNickname(nickname) {
	let test = document.getElementById(nickname).value;
	let regex = new RegExp("^[A-Za-z0-9]+$"); 
	let result = (regex.test(test)) && !(test === "");
	printError(result, nickname.toString()+"-message", "Il nickname deve contenere solo lettere e numeri");
	return result;
}

function printError(condition, id, message){ // se condition è true significa che matcha la regex, passo l'id dell'elemento che voglio stampare, passo il messaggio da settare nel caso di errori
	if (condition) { 
		document.getElementById(id).innerHTML = ""; //mi serve perchè se non ho errori devo nascondere il messaggio di errore se esiste
    }else {
		document.getElementById(id).innerHTML = message; 
	}
}

function loginValidator(email) {
	let emailChecked = checkEmail(email);
	return emailChecked;
}

function signupValidator(nickname, email, password, passwordConfirm) {
	let nicknameChecked = checkNickname(nickname); 
	let emailChecked = checkEmail(email);
	let passwordChecked = isPasswordEqual(password, passwordConfirm);

	//prima le valuto tutte e poi le ritorno :'(
	return (nicknameChecked && emailChecked && passwordChecked); //se matchano tutte ritorno true
}

function userValidator(nickname, password, passwordConfirm) {
	let nicknameChecked = checkNickname(nickname); 
	let passwordChecked = isPasswordEqual(password, passwordConfirm);

	return (nicknameChecked && passwordChecked);
}


// --------- MENU --------

function openSideNav() {
	document.getElementById("mySidenav").style.width = "75%";
}
  
function closeSideNav() {
	document.getElementById("mySidenav").style.width = "0";
}


