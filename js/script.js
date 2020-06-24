function printError(condition, id, message) { // se condition è true significa che matcha la regex, passo l'id dell'elemento che voglio stampare, passo il messaggio da settare nel caso di errori
	id = id.toString() + "-message";
	if (condition) {
		document.getElementById(id).innerHTML = ""; //mi serve perchè se non ho errori devo nascondere il messaggio di errore se esiste
	} else {
		document.getElementById(id).innerHTML = message;
	}
}

// --------- CONTROLLI --------
function isPasswordEqual(password, passwordConfirm) {
	var pwd1 = document.getElementById(password);
	var pwd2 = document.getElementById(passwordConfirm);
	var result = pwd1.value === pwd2.value;
	printError(result, passwordConfirm, "Password diverse");
	return result;
}

function checkEmail(email) { //passo l'id della mail che voglio controllare, per esempio "signup-email"
	var regex = new RegExp("^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$"); 
	var test = document.getElementById(email).value.toLowerCase();
	var result = (regex.test(test)) && !(test === ""); 
	printError(result, email, "Email non corretta");
	return result;
}

function checkNickname(nickname) {
	var test = document.getElementById(nickname).value;
	var regex = new RegExp("^[A-Za-z0-9]{3,20}$");
	var result = (regex.test(test)) && !(test === "");
	printError(result, nickname, "Il nickname deve contenere solo lettere e numeri e la sua lunghezza deve essere compresa tra 3 e 20 caratteri");
	return result;
}

function checkImage(image) { 
	var test = document.getElementById(image).value;
	var fileSize = document.getElementById(image).files[0].size;
	var extensions = ['png', 'jpg', 'jpeg', 'svg'];
	var isImage = extensions.includes(test.split('.').pop()); 
	var result = isImage && fileSize < 153600; 
	printError(result, image, "Il formato non &egrave; valido o la dimensione egrave; superiore a 150KB"); 
	return result;
}

function checkTitolo(titolo) {
	var test = document.getElementById(titolo).value;
	var regex = new RegExp("^.{3,55}$");
	var result = (regex.test(test)) && !(test === "");
	printError(result, titolo, "La lunghezza massima &egrave; di 55 caratteri ciao");
	return result;
}

function checkDifficolta(difficolta) {
	var test = document.getElementById(difficolta).value;
	var regex = new RegExp("^[1-5]$");
	var result = (regex.test(test)) && !(test === "");
	printError(result, difficolta, "L'intervallo valido &egrave; tra 1 e 5");
	return result;
}

function checkTempo(tempo) {
	var test = document.getElementById(tempo).value;
	var regex = new RegExp("^[1-9][0-9]*$");
	var result = (regex.test(test)) && !(test === "");
	printError(result, tempo, "Sono ammessi solo valori interi positivi");
	return result;
}

function checkKeywords(keywords) {
	var test = document.getElementById(keywords).value;
	var regex = new RegExp("^[A-Za-z0-9]+$");
	var result = (regex.test(test)) && !(test === "");
	printError(result, keywords, "Le keywords devono contenere solo lettere e numeri");
	return result;
}

function checkCommento(commento) {
	var test = document.getElementById(commento).value.toString();
	test = test.trim();
	var result = test.length !== 0 || !(test === "");
	printError(result, commento, "Non puoi lasciare vuoto il commento");
	return result;
}

function loginValidator(campo) {
	var campoString = document.getElementById(campo).value;
	var result = campoString.toString().length !== 0;
	printError(result, campo, "Questo campo non pu&ograve; essere vuoto"); 
	return result;
}

function signupValidator(nickname, email, password, passwordConfirm) {
	var nicknameChecked = checkNickname(nickname);
	var emailChecked = checkEmail(email);
	var passwordChecked = isPasswordEqual(password, passwordConfirm);

	return (nicknameChecked && emailChecked && passwordChecked); 
}

function ricettaValidator(titolo, difficolta, tempo, image, keywords) {
	var titoloChecked = checkTitolo(titolo);
	var difficoltaChecked = checkDifficolta(difficolta);
	var tempoChecked = checkTempo(tempo);
	var imageChecked = checkImage(image);
	var keywordsChecked = checkKeywords(keywords);
	return (titoloChecked && difficoltaChecked && tempoChecked && imageChecked && keywordsChecked);
}

// --------- MENU --------

function openSideNav() {

	var apriNav = document.querySelector('.open-button');
	var chiudiNav = document.querySelector('.chiudi-nav');
	var nav = document.querySelector('.nav');

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
var loginForm = document.getElementById("form-login");
if (loginForm) {
	loginForm.addEventListener("submit", function (event) {
		if (!loginValidator("login-nickname") || !loginValidator("login-password")) {
			event.preventDefault();
		}
	});
}

//------ SIGN UP ---------
var signupForm = document.getElementById("form-signup");
if (signupForm) {
	signupForm.addEventListener("submit", function (event) {
		if (!signupValidator('signup-nick', 'signup-email', 'signup-password1', 'signup-password2')) {
			event.preventDefault();
		}
	});
}

//------RICETTA------
var ricettaForm = document.getElementById("form-add");
if (ricettaForm) {
	ricettaForm.addEventListener("submit", function (event) {
		if (!ricettaValidator('add-nome', 'add-difficolta', 'add-tempo', 'add-immagine', 'add-keywords')) {
			event.preventDefault();
		}
	});
}

var editRicettaForm = document.getElementById("form-edit");
if (editRicettaForm) {
	editRicettaForm.addEventListener("submit", function (event) {
		if (!ricettaValidator('edit-nome', 'edit-difficolta', 'edit-tempo', 'edit-immagine', 'edit-keywords')) {
			event.preventDefault();
		}
	});
}

//------- COMMENTI -------
var inserisciCommenti = document.getElementById("inserisci-commento-form");
if (inserisciCommenti) {
	inserisciCommenti.addEventListener("submit", function (event) {
		if (!checkCommento('scrivi-commento')) {
			event.preventDefault();
		}
	});
}

var modificaCommenti = document.getElementById("modifica-commento-form");
if (modificaCommenti) {
	modificaCommenti.addEventListener("submit", function (event) {
		if (!checkCommento('modifica-commento')) {
			event.preventDefault();
		}
	});
}

//------- CAMBIO ATTRIBUTI UTENTE-------
var passwordUtente = document.getElementById("form-user-password");
if (passwordUtente) {
	passwordUtente.addEventListener("submit", function (event) {
		if (!isPasswordEqual('user-password1', 'user-password2')) {
			event.preventDefault();
		}
	});
}
var formUtenteEmail = document.getElementById("form-utente-email");
if (formUtenteEmail) {
	formUtenteEmail.addEventListener("submit", function (event) {
		if (!checkEmail('user-email')) {
			event.preventDefault();
		}
	});
}

var formUtenteNick = document.getElementById("form-utente-nick");
if (formUtenteNick) {
	formUtenteNick.addEventListener("submit", function (event) {
		if (!checkNickname('user-nickname')) {
			event.preventDefault();
		}
	});
}

var formUtenteImg = document.getElementById("form-utente-img");
if (formUtenteImg) {
	formUtenteImg.addEventListener("submit", function (event) {
		if (!checkImage('user-immagine')) {
			event.preventDefault();
		}
	});
}
