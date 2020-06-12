<div id="content">
       <h1>Registrati</h1>
       <h2 id="termini-di-servizio">Termini di servizio</h2>
       <p>Con la registrazione avrai accesso alle funzionalit&agrave; riservate del sito. In particolare potrai visualizzare e scrivere i commenti e votare le ricette.</p>
       <p>Su questo sito non sono permessi insulti o spam quindi se un tuo commento ne contiene verr&agrave; eliminato dagli amministratori.</p>
       <form action="<rootFolder />/php/handle-signup.php"
             method="post"
             id="form-signup">
              <fieldset class="form-fieldset">
                     <legend class="legend">Inserisci i tuoi dati
                     </legend>
                     <ul class="form-container form-centered">
                            <li class="form-element">
                                   <label class="form-label"
                                          for="signup-nick">Nickname:</label>
                                   <input class="barra-input"
                                          id="signup-nick" 
                                          type="text"
                                          name="nickname"
                                          value="<nicknamePlaceholder />" />
                                   <span id="signup-nick-message"
                                         class="warning"> <errorNicknamePlaceholder /> </span>
                            </li>
                            <li class="form-element">
                                   <label class="form-label"
                                          for="signup-email">Email:</label>
                                   <input class="barra-input"
                                          id="signup-email"
                                          type="text"
                                          name="email"
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
                                          value="<password1Placeholder />" />
                            </li>
                            <li class="form-element">
                                   <label class="form-label"
                                          for="signup-password2">Ripeti
                                          Password:</label>
                                   <input class="barra-input"
                                          id="signup-password2"
                                          type="password"
                                          name="password2" />
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
