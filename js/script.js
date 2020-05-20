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

// validazione immagine -> .png .jpg ; dimensione dell'immagine

// validazione del nome della ricetta, lunghezza massima 70(?)

// difficoltà -> da uno a 5 

// tempo -> solo numeri


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

	const apriNav = document.querySelector('.open-button');
	const chiudiNav = document.querySelector('.chiudi-nav');
	const nav = document.querySelector('.nav');

	apriNav.addEventListener("click", function () {
		nav.classList.add("menu-active");
		chiudiNav.classList.add("chiudi-nav-active");
	});

	chiudiNav.addEventListener("click", function () {
		nav.classList.remove("menu-active");
		nav.classList.add("menu-disable");
		chiudiNav.classList.remove("chiudi-nav-active");
		chiudiNav.classList.add("chiudi-nav-disable");
	});
	
}

// ------- CHIAMATE FUNZIONI -------
openSideNav();

//------ LOGIN ---------
const loginForm = document.getElementById("form-login"); 
if (loginForm) {
	loginForm.addEventListener("submit", function(event) {
		if(!loginValidator("login-email")) {
			event.preventDefault();
		}
	});
}
//------ SIGN UP ---------
const signupForm = document.getElementById("form-signup"); 
if (signupForm) {
	signupForm.addEventListener("submit", function(event) {
		if(!signupValidator('signup-nick', 'signup-email', 'signup-password1', 'signup-password2')) {
			event.preventDefault();
		}
	});
}

//------- CAMBIO ATTRIBUTI UTENTE-------
const passwordUtente = document.getElementById("form-user-password"); 
if (passwordUtente) {
	passwordUtente.addEventListener("submit", function(event) {
		if(!isPasswordEqual('user-password1', 'user-password2')) {
			event.preventDefault();
		}
	});
}
const formUtenteEmail = document.getElementById("form-utente-email"); 
if (formUtenteEmail) {
	formUtenteEmail.addEventListener("submit", function(event) {
		if(!checkEmail('user-email')) {
			event.preventDefault();
		}
	});
}

const formUtenteNick = document.getElementById("form-utente-nick"); 
if (formUtenteNick) {
	formUtenteNick.addEventListener("submit", function(event) {
		if(!checkNickname('user-nickname')) {
			event.preventDefault();
		}
	});
}

const formUtenteImg = document.getElementById("form-utente-img"); 
if (formUtenteImg) {
	formUtenteImg.addEventListener("submit", function(event) {
		if(!true) {
			event.preventDefault();
		}
	});
}






