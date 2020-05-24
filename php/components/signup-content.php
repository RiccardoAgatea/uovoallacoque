<div id="content">
       <h1>Registrati</h1>
       <form action="<rootFolder />/php/handle-signup.php"
             name="signup"
             method="POST"
             id="form-signup">
              <fieldset class="form-fieldset">
                     <legend class="legend">Inserisci i tuoi dati
                     </legend>
                     <ul class="form-container">
                            <li class="form-element">
                                   <label class="form-label"
                                          for="signup-nick">Nickname:</label>
                                   <input class="barra-input"
                                          id="signup-nick"
                                          type="text"
                                          name="nickname"
                                          placeholder="Nickname"
                                          required="required"
                                          value="<nicknamePlaceholder />" />
                                   <span id="signup-nick-message"
                                         class="warning"> <errorNicknamePlaceholder /> </span>
                            </li>
                            <li class="form-element">
                                   <label class="form-label"
                                          for="signup-email">Email:</label>
                                   <input class="barra-input"
                                          id="signup-email"
                                          type="email"
                                          name="email"
                                          placeholder="E-mail"
                                          required="required"
                                          value="<emailPlaceholder />" />
                                   <span id="signup-email-message"
                                         class="warning"> <errorEmailPlaceholder /> </span>
                            </li>
                            <li class="form-element">
                                   <label class="form-label"
                                          for="signup-password1">Password:</label>
                                   <input class="barra-input"
                                          id="signup-password1"
                                          type="password"
                                          name="password1"
                                          placeholder="Password"
                                          required="required"
                                          value="<password1Placeholder />" />
                            </li>
                            <li class="form-element">
                                   <label class="form-label"
                                          for="signup-password2">Ripeti
                                          Password:</label>
                                   <input class="barra-input"
                                          id="signup-password2"
                                          type="password"
                                          name="password2"
                                          placeholder="Password"
                                          required="required" />
                                   <span id="signup-password2-message"
                                         class="warning"> <errorPasswordPlaceholder /> </span>
                            </li>
                            <li class="form-element">
                                   <input class="submit"
                                          type="submit"
                                          value="Registrati" />
                            </li>
                     </ul>
              </fieldset>
       </form>
       <backToTopPlaceholder />
</div>
