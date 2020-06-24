<div id="content">
    <div class="foto-nome">
        <img class="foto-utente"
             src="<PlaceholderImmagineUtente />"
             alt="la tua immagine del profilo" />
        <h1 class="nome-utente">
            <PlaceholderNicknameUtente />
        </h1>
        <p class="info-attuale"> <span xml:lang="en" lang="en">E-mail</span> attuale:
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
    <form id="form-elimina-account" class="print-hide cambio-info"
          method="post"
          action="<rootFolder />/php/handle-elimina-account.php">
        <fieldset class="form-fieldset fieldset-elimina-account">
            <legend class="legend">Eliminazione <span xml:lang="en" lang="en">Account</span></legend>
            <label for="user-password-elimina"><span xml:lang="en" lang="en">Password</span>:</label>
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
            dell&apos;<span xml:lang="en" lang="en">account</span> non &egrave; reversibile, e comporta
            la rimozione di tutti i commenti e i voti associati.
        </p>
    </form>
    <backToTopPlaceholder />

</div>
