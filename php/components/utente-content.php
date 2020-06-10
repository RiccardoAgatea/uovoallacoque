<div id="content">
    <div class="foto-nome">
        <img class="foto-utente"
             src="<PlaceholderImmagineUtente />"
             alt="la tua immagine del profilo" />
        <h1 class="nome-utente">
            <PlaceholderNicknameUtente />
        </h1>
        <p class="info-attuale">E-mail attuale:
            <PlaceholderEmailUtente />
        </p>
    </div>
    <addPlaceholder />
        <!-- link modifica dati -->
        <p id="link-modifica-dati">
            Per modificare i tuoi dati vai su:
            <a id="modifica-link"
               href="<rootFolder />/php/modifica-utente.php">Modifica
                dati</a>
        </p>

    <!--Eliminazione account-->
    <errorPlaceholder />
    <form id="form-elimina-account" class="print-hide"
          method="post"
          action="<rootFolder />/php/handle-elimina-account.php"
          class="cambio-info">
        <fieldset class="form-fieldset fieldset-elimina-account">
            <legend class="legend">Eliminazione Account</legend>
            <label for="user-password-elimina">Password:</label>
            <input type="password"
                   id="user-password-elimina"
                   name="user-password-elimina"
                   class="barra-input" />
            <input type="submit"
                   value="Elimina account"
                   class="submitutente" />
        </fieldset>
        <p id="attenzione-elimina-account">
            <strong>Attenzione!</strong> L&apos;eliminazione
            dell&apos;account non &egrave; reversibile, e comporta
            la rimozione di tutti i commenti e i voti associati.
        </p>
    </form>
    <backToTopPlaceholder />

</div>
