<div id="content">
    <errorPlaceholder />
<!-- form img -->
<form action="<rootFolder />/php/handle-modifica-utente.php?item=img"
          method="post"
          id="form-utente-img"
          class="cambio-info"
          enctype="multipart/form-data">
        <fieldset class="form-fieldset">
            <legend class="legend">Cambio immagine</legend>
            <ul class="form-container">
                <li class="form-element">
                    <label for="user-immagine">Nuova immagine:</label>
                    <input class="barra-input"
                           type="file"
                           id="user-immagine"
                           name="user-immagine" />
                    <span id="user-immagine-message"
                          class="warning"> </span>
                </li>
                <li class="form-element">
                    <label
                           for="user-password-immagine">Password:</label>
                    <input class="barra-input"
                           id="user-password-immagine"
                           type="password"
                           name="user-password-immagine" />
                    <span id="user-password-immagine-message"
                          class="warning"> </span>
                </li>
                <li class="form-element">
                    <input class="submitutente"
                           type="submit"
                           value="Salva modifiche" />
                </li>
            </ul>
        </fieldset>
    </form>

     <!-- form nickname -->
     <form action="<rootFolder />/php/handle-modifica-utente.php?item=nick"
          method="post"
          id="form-utente-nick"
          class="cambio-info">
        <fieldset class="form-fieldset">
            <legend class="legend">Cambio nickname</legend>
            <ul class="form-container">
                <li class="form-element">
                    <label for="user-nickname">Nuovo nickname:</label>
                    <input class="barra-input"
                           id="user-nickname"
                           type="text"
                           name="user-nickname" />
                    <span id="user-nickname-message"
                          class="warning"> </span>
                </li>
                <li class="form-element">
                    <label
                           for="user-password-nickname">Password:</label>
                    <input class="barra-input"
                           id="user-password-nickname"
                           type="password"
                           name="user-password-nickname" />
                    <span id="user-password-nickname-message"
                          class="warning"> </span>
                </li>
                <li class="form-element">
                    <input class="submitutente"
                           type="submit"
                           value="Salva modifiche" />
                </li>
            </ul>
        </fieldset>
    </form>
    <backToTopPlaceholder />
    <!-- form email -->
    <form action="<rootFolder />/php/handle-modifica-utente.php?item=email"
          method="post"
          id="form-utente-email"
          class="cambio-info">
        <fieldset class="form-fieldset">
            <legend class="legend">Cambio e-mail</legend>
            <ul class="form-container">
                <li class="form-element">
                    <label for="user-email">Nuova email:</label>
                    <input class="barra-input"
                           id="user-email"
                           type="text"
                           name="user-email" />
                    <span id="user-email-message"
                          class="warning"> </span>
                </li>
                <li class="form-element">
                    <label for="user-password-email">Password:</label>
                    <input class="barra-input"
                           id="user-password-email"
                           type="password"
                           name="user-password-email" />
                    <span id="user-password-email-message"
                          class="warning"> </span>
                </li>
                <li class="form-element">
                    <input class="submitutente"
                           type="submit"
                           value="Salva modifiche" />
                </li>
            </ul>
        </fieldset>
    </form>
    <backToTopPlaceholder />
    <!-- form password -->
    <form action="<rootFolder />/php/handle-modifica-utente.php?item=psw"
          method="post"
          id="form-user-password"
          class="cambio-info">
        <fieldset class="form-fieldset">
            <legend class="legend">Cambio password</legend>
            <ul class="form-container">
                <li class="form-element">
                    <label for="user-password-password">Password
                        attuale:</label>
                    <input class="barra-input"
                           id="user-password-password"
                           type="password"
                           name="user-password-password"  />
                    <span id="user-password-password-message"
                          class="warning"> </span>
                </li>
                <li class="form-element">
                    <label for="user-password1">Nuova password:</label>
                    <input class="barra-input"
                           id="user-password1"
                           type="password"
                           name="user-password1" />
                    <span id="user-password1-message"
                          class="warning"> </span>
                </li>
                <li class="form-element">
                    <label for="user-password2">Conferma nuova
                        password:</label>
                    <input class="barra-input"
                           id="user-password2"
                           type="password"
                           name="user-password2" />
                    <span id="user-password2-message"
                          class="warning"> </span>
                </li>
                <li class="form-element">
                    <input class="submitutente"
                           type="submit"
                           value="Salva modifiche" />
                </li>
            </ul>
        </fieldset>
    </form>
    <annullaPlaceholder />
    <backToTopPlaceholder />

</div>