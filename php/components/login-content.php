<div id="content">
    <h1>Accedi</h1>
    <form action="<rootFolder />/php/handle-login.php"
          method="post"
          id="form-login">
        <fieldset class="form-fieldset">
            <legend class="legend">Inserisci le tue credenziali</legend>
            <ul class="form-container">
                <li class="form-element">
                    <label class="form-label"
                           for="login-email">Email:</label>
                    <input class="barra-input"
                           id="login-email"
                           type="email"
                           name="email"
                           placeholder="E-mail"
                           value="<emailPlaceholder />" />
                    <span id="login-email-message"
                          class="warning"> <errorEmailPlaceholder /> </span>
                </li>
                <li class="form-element">
                    <label class="form-label"
                           for="login-password">Password:</label>
                    <input class="barra-input"
                           id="login-password"
                           type="password"
                           name="password"
                           placeholder="Password"
                           value="<passwordPlaceholder />" /> <span id="
                           login-password-message"
                          class="warning"> <errorPasswordPlaceholder /> </span>
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
