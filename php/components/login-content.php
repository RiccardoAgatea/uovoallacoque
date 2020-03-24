<div id="content">
    <h1>Accedi</h1>
    <form action="#" method="POST" id="form-login" onsubmit="return loginValidator('login-email')" >
        <fieldset class="form-fieldset">
            <legend class="legend">Accedi</legend>
            <ul class="form-container">
                <li class="form-element">
                    <label class="label" for="login-email">Email:</label>
                    <input class="barra-input" id="login-email" type="mail" name="email" placeholder="E-mail" required="required" /> 
                    <span id="login-email-message"> </span>
                </li>
                <li class="form-element">
                    <label class="label" for="login-password">Password:</label>
                    <input class="barra-input" id="login-password" type="password" name="password" placeholder="Password" required="required"/> <span id="login-password-message"> </span>
                </li>
                <li class="form-element">
                    <input class="submit" type="submit" value="Accedi"/>
                </li>
            </ul>
        </fieldset>
    </form>
    <p id="registrazione">Non sei ancora registrato? <a href="<rootFolder />/php/signup.php">Registrati</a></p>
</div>
