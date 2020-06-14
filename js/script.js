// --------- CONTROLLI --------
function isPasswordEqual(password, passwordConfirm) {
	let pwd1 = document.getElementById(password);
	let pwd2 = document.getElementById(passwordConfirm);
	let result = pwd1.value === pwd2.value;
	printError(result, passwordConfirm.toString() + "-message", "Password diverse");
	return result;
}

function checkEmail(email) { //passo l'id della mail che voglio controllare, per esempio "signup-email"
	let regex = new RegExp("^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$"); //presa da stackoverflow, matcha il 99% delle mail cit.
	let test = document.getElementById(email).value.toLowerCase();
	let result = (regex.test(test)) && !(test === ""); //la regex mi restituisce vero se matcha con il test, inoltre non voglio che il campo dati sia vuoto
	printError(result, email.toString() + "-message", "Email non corretta");
	return result;
}

function checkNickname(nickname) {
	let test = document.getElementById(nickname).value;
	let regex = new RegExp("^[A-Za-z0-9]{3,20}$");
	let result = (regex.test(test)) && !(test === "");
	printError(result, nickname.toString() + "-message", "Il nickname deve contenere solo lettere e numeri e la sua lunghezza deve essere compresa tra 3 e 20 caratteri");
	return result;
}

function checkImage(image) { //image=stringa"user-immagine"
	let test = document.getElementById(image).value;
	let fileSize = document.getElementById(image).files[0].size;
	let extensions = ['png', 'jpg', 'jpeg', 'svg'];
	let isImage = extensions.includes(test.split('.').pop()); //split taglia dove c'è il punto e pop prende in considerazione quello che c'è dopo il punto
	let result = isImage && fileSize < 153600; 
	printError(result, image.toString() + "-message", "Il formato non &egrave; valido o la dimensione egrave; superiore a 150KB"); 
	return result;
}

// validazione del nome della ricetta, lunghezza massima 55
function checkTitolo(titolo) {
	let test = document.getElementById(titolo).value;
	let regex = new RegExp("^.{3,55}$");
	let result = (regex.test(test)) && !(test === "");
	printError(result, titolo.toString() + "-message", "La lunghezza massima &egrave; di 55 caratteri ciao");
	return result;
}

// difficoltà -> da uno a 5
function checkDifficolta(difficolta) {
	let test = document.getElementById(difficolta).value;
	let regex = new RegExp("^[1-5]$");
	let result = (regex.test(test)) && !(test === "");
	printError(result, difficolta.toString() + "-message", "L'intervallo valido &egrave; tra 1 e 5");
	return result;
}

// tempo -> solo numeri
function checkTempo(tempo) {
	let test = document.getElementById(tempo).value;
	let regex = new RegExp("^[1-9][0-9]*$");
	let result = (regex.test(test)) && !(test === "");
	printError(result, tempo.toString() + "-message", "Sono ammessi solo valori interi positivi");
	return result;
}

function checkKeywords(keywords) {
	let test = document.getElementById(keywords).value;
	let regex = new RegExp("^[A-Za-z0-9]+$");
	let result = (regex.test(test)) && !(test === "");
	printError(result, keywords.toString() + "-message", "Le keywords devono contenere solo lettere e numeri");
	return result;
}

function checkCommento(commento) {
	let test = document.getElementById(commento).value;
	let regex = new RegExp("^.$");
	let result = (regex.test(test)) && !(test === "");
	printError(result, commento.toString() + "-message", "Non puoi lasciare vuoto il commento");
	return result;
}

function printError(condition, id, message) { // se condition è true significa che matcha la regex, passo l'id dell'elemento che voglio stampare, passo il messaggio da settare nel caso di errori
	if (condition) {
		document.getElementById(id).innerHTML = ""; //mi serve perchè se non ho errori devo nascondere il messaggio di errore se esiste
	} else {
		document.getElementById(id).innerHTML = message;
	}
}

function loginValidator(nickname) {
	let nicknameChecked = document.getElementById(nickname).value.length;
	if (nicknameChecked === 0) return false;
	else return true;
}

function signupValidator(nickname, email, password, passwordConfirm) {
	let nicknameChecked = checkNickname(nickname);
	let emailChecked = checkEmail(email);
	let passwordChecked = isPasswordEqual(password, passwordConfirm);

	//prima le valuto tutte e poi le ritorno :'(
	return (nicknameChecked && emailChecked && passwordChecked); //se matchano tutte ritorno true
}
//function ricetta validator
function ricettaValidator(titolo, difficolta, tempo, image, keywords) {
	let titoloChecked = checkTitolo(titolo);
	let difficoltaChecked = checkDifficolta(difficolta);
	let tempoChecked = checkTempo(tempo);
	let imageChecked = checkImage(image);
	let keywordsChecked = checkKeywords(keywords);
	return (titoloChecked && difficoltaChecked && tempoChecked && imageChecked && keywordsChecked);
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
	loginForm.addEventListener("submit", function (event) {
		if (!loginValidator("login-nickname")) {
			event.preventDefault();
		}
	});
}

//------ SIGN UP ---------
const signupForm = document.getElementById("form-signup");
if (signupForm) {
	signupForm.addEventListener("submit", function (event) {
		if (!signupValidator('signup-nick', 'signup-email', 'signup-password1', 'signup-password2')) {
			event.preventDefault();
		}
	});
}

//------RICETTA------
const ricettaForm = document.getElementById("form-add");
if (ricettaForm) {
	ricettaForm.addEventListener("submit", function (event) {
		if (!ricettaValidator('add-nome', 'add-difficolta', 'add-tempo', 'add-immagine', 'add-keywords')) {
			event.preventDefault();
		}
	});
}

const editRicettaForm = document.getElementById("form-edit");
if (editRicettaForm) {
	editRicettaForm.addEventListener("submit", function (event) {
		if (!ricettaValidator('edit-nome', 'edit-difficolta', 'edit-tempo', 'edit-immagine', 'edit-keywords')) {
			event.preventDefault();
		}
	});
}

//------- CAMBIO ATTRIBUTI UTENTE-------
const passwordUtente = document.getElementById("form-user-password");
if (passwordUtente) {
	passwordUtente.addEventListener("submit", function (event) {
		if (!isPasswordEqual('user-password1', 'user-password2')) {
			event.preventDefault();
		}
	});
}
const formUtenteEmail = document.getElementById("form-utente-email");
if (formUtenteEmail) {
	formUtenteEmail.addEventListener("submit", function (event) {
		if (!checkEmail('user-email')) {
			event.preventDefault();
		}
	});
}

const formUtenteNick = document.getElementById("form-utente-nick");
if (formUtenteNick) {
	formUtenteNick.addEventListener("submit", function (event) {
		if (!checkNickname('user-nickname')) {
			event.preventDefault();
		}
	});
}

const formUtenteImg = document.getElementById("form-utente-img");
if (formUtenteImg) {
	formUtenteImg.addEventListener("submit", function (event) {
		if (!checkImage('user-immagine')) {
			event.preventDefault();
		}
	});
}
