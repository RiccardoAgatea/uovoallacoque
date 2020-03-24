<div id="content">
    <h1>Registrati</h1>
    <form action="" name="signup" method="POST" id="form-signup" onsubmit="return signupValidator('signup-nome', 'signup-cognome', 'signup-nick', 'signup-email', 'signup-password1', 'signup-password2')">
        <fieldset class="form-fieldset">
            <legend class="legend">Registrazione</legend>
            <ul class="form-container">
                <li class="form-element">
                    <label class="label" for="signup-nome">Nome:</label>
                    <input class="barra-input" id="signup-nome" type="text" name="nome"  placeholder="Nome" required="required"/>
                    <span id="signup-nome-message"> </span>
                </li>
                <li class="form-element">
                    <label class="form-label" for="signup-cognome">Cognome:</label>
                    <input class="barra-input" id="signup-cognome" type="text" name="cognome"  placeholder="Cognome" required="required"/>
                    <span id="signup-cognome-message"> </span>
                </li>
                <li class="form-element">
                    <label class="form-label" for="signup-nick">Nickname:</label>
                    <input class="barra-input" id="signup-nick" type="text" name="nickname"  placeholder="Nickname" required="required"/>
                    <span id="signup-nick-message"> </span>
                </li>
                <li class="form-element">
                    <label class="form-label" for="signup-email">Email:</label>
                    <input class="barra-input" id="signup-email" type="email" name="email"  placeholder="E-mail" required="required"/>
                    <span id="signup-email-message"> </span>
                </li>
                <li class="form-element">
                    <label class="form-label" for="signup-password1">Password:</label>
                    <input class="barra-input" id="signup-password1" type="password" name="password1"  placeholder="Password" required="required"/>
                    <span id="signup-password1-message"> </span>
                </li>
                <li class="form-element">
                    <label class="form-label" for="signup-password2">Ripeti Password:</label>
                    <input class="barra-input" id="signup-password2" type="password" name="password2"  placeholder="Password" required="required"/>
                    <span id="signup-password2-message"> </span>
                </li>
                <li class="form-element">
                    <input class="submit" type="submit" value="Registrati" onclick="allLetter(document.signup.nome)" />
                </li>
            </ul>
        </fieldset>
    </form>
</div>
