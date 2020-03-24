function isPasswordEqual(password, passwordConfirm){
	let pwd1 = document.getElementById(password);
	let pwd2 = document.getElementById(passwordConfirm);

	return  pwd1.value === pwd2.value;
}

function checkEmail(email) { //passo l'id della mail che voglio controllare, per esempio "signup-email"
	let regex = new RegExp("^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$"); //presa da stackoverflow, matcha il 99% delle mail cit.
	let test = document.getElementById(email).value.toLowerCase();

	return (regex.test(test)) && !(test === ""); //la regex mi restituisce vero se matcha con il test, inoltre non voglio che il campo dati sia vuoto
}

function checkElementByRegex(id, regex) {
	let test = document.getElementById(id).value;
	return (regex.test(test)) && !(test === "");
}

function printError(condition, id, message){ // se condition è true significa che matcha la regex, passo l'id dell'elemento che voglio stampare, passo il messaggio da settare nel caso di errori
	if (condition) { 
		document.getElementById(id).innerHTML = ""; //mi serve perchè se non ho errori devo nascondere il messaggio di errore se esiste
		return true;
    }else {
		document.getElementById(id).innerHTML = message; 
		return false;
	}
}

function loginValidator(email) {
	let emailChecked = checkEmail(email);

	printError(emailChecked, email.toString()+"-message", "Email non corretta");

	return emailChecked;
}

function signupValidator(name, surname, nickname, email, password, passwordConfirm) {
	let nameChecked = checkElementByRegex(name, RegExp("^[A-Za-z]+$") );
	let surnameChecked = checkElementByRegex(surname, RegExp("^[A-Za-z]+$") );
	let nicknameChecked = checkElementByRegex(nickname, RegExp("^[A-Za-z0-9]+$") ); 
	let emailChecked = checkEmail(email);
	let passwordChecked = isPasswordEqual(password, passwordConfirm);

	printError(nameChecked, name.toString()+"-message", "Il nome deve contenere solo lettere");
	printError(surnameChecked, surname.toString()+"-message", "Il cognome deve contenere solo lettere");
	printError(nicknameChecked, nickname.toString()+"-message", "Il nickname deve contenere solo lettere e numeri");
	printError(emailChecked, email.toString()+"-message", "Email non corretta");
	printError(passwordChecked, passwordConfirm.toString()+"-message", "Password diverse");

	if(nameChecked && surnameChecked && nicknameChecked && emailChecked && passwordChecked) { //se matchano tutte ritorno true
		return true;
	} else {
		return false;
	}
}