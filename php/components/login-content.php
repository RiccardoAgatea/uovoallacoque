<div id="content">
    <h1>Accedi</h1>
    <form action="<rootFolder />/php/handle-login.php"
          method="post"
          id="form-login">
        <fieldset class="form-fieldset">
            <legend class="legend">Inserisci le tue credenziali</legend>
            <ul class="form-container form-centered">
                <li class="form-element">
                    <label class="form-label"
                           for="login-nickname"><span xml:lang="en" lang="en">Nickname</span>:</label>
                    <input class="barra-input"
                           id="login-nickname"
                           type="text"
                           name="nickname"
                           value="<emailPlaceholder />" />
                    <span id="login-nickname-message"
                          class="warning"> </span>
                </li>
                <li class="form-element">
                    <label class="form-label"
                           for="login-password"><span xml:lang="en" lang="en">Password</span>:</label>
                    <input class="barra-input"
                           id="login-password"
                           type="password"
                           name="password"
                           value="<passwordPlaceholder />" /> 
                           <span id="login-password-message"
                          class="warning"> <errorPlaceholder /> </span>
                </li>
                <li class="form-element">
                    <input class="submit"
                           type="submit"
                           value="Accedi" />
                </li>
            </ul>
        </fieldset>
    </form>
    <p id="registrazione">Non sei ancora registrato? <a
           href="<rootFolder />/php/signup.php">Registrati</a>
    </p>
    <backToTopPlaceholder />
</div>
