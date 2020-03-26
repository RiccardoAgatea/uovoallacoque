<div id="content">
	<div class="foto-nome">
        <img class="foto-utente" src="" alt=""/>
        <p class="nome-utente"> Nome Utente<PlaceholderNomeUtente /> </p>
    </div>
    <form action="" method="POST" id="form-utente" onsubmit="return userValidator('user-nickname', 'user-password1', 'user-password2')" >
        <fieldset class="form-fieldset">
            <ul class="form-container">
                <li class="form-element">
                    <label for="user-nickname">Nuovo nickname:</label>
                    <input class="barra-input" id="user-nickname" type="text" name="user-nickname" placeholder="Nickname" required="required" /> 
                    <span id="user-nickname-message"> </span>
                </li>
                <li class="form-element">
                    <label for="user-password1">Nuova password:</label>
                    <input class="barra-input" id="user-password1" type="password" name="user-password1" placeholder="Password" required="required" /> 
                    <span id="user-password1-message"> </span>
                </li>
                <li class="form-element">
                    <label for="user-password2">Conferma password:</label>
                    <input class="barra-input" id="user-password2" type="password" name="user-password2" placeholder="Conferma password" required="required" /> 
                    <span id="user-password2-message"> </span>
                </li>
                <li class="form-element">
                    <label for="user-immaginee">Nuova immagine:</label>
                    <input class="barra-input" type="image" id="user-immagine" name="user-immagine" placeholder="Immagine" required="required" /> 
                    <span id="user-immagine-message"> </span>
                </li>
                <li class="form-element">
                    <input class="submit" type="submit" value="Salva modifiche"/>
                </li>
            </ul>
        </fieldset>
    </form>
</div>