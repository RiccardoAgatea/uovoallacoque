<div id="content">
    <h1>Registrati</h1>
    <form action="<rootFolder />/php/handle-signup.php" name="signup" method="POST" id="form-signup" onsubmit="return signupValidator('signup-nick', 'signup-email', 'signup-password1', 'signup-password2')">
        <fieldset class="form-fieldset">
            <legend class="legend">Registrazione</legend>
            <ul class="form-container">
                <li class="form-element">
                    <label class="form-label" for="signup-nick">Nickname:</label>
                    <input class="barra-input" id="signup-nick" type="text" name="nickname"  placeholder="Nickname" required="required"/>
                    <span id="signup-nick-message" class="warning"> </span>
                </li>
                <li class="form-element">
                    <label class="form-label" for="signup-email">Email:</label>
                    <input class="barra-input" id="signup-email" type="email" name="email"  placeholder="E-mail" required="required"/>
                    <span id="signup-email-message" class="warning"> </span>
                </li>
                <li class="form-element">
                    <label class="form-label" for="signup-password1">Password:</label>
                    <input class="barra-input" id="signup-password1" type="password" name="password1"  placeholder="Password" required="required"/>
                    <span id="signup-password1-message" class="warning"> </span>
                </li>
                <li class="form-element">
                    <label class="form-label" for="signup-password2">Ripeti Password:</label>
                    <input class="barra-input" id="signup-password2" type="password" name="password2"  placeholder="Password" required="required"/>
                    <span id="signup-password2-message" class="warning"> </span>
                </li>
                <li class="form-element">
                    <input class="submit" type="submit" value="Registrati"/>
                </li>
            </ul>
        </fieldset>
    </form>
</div>
