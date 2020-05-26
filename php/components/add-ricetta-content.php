<div id="content">
       <h1>Aggiungi ricetta</h1>
       <form action="<rootFolder />/php/handle-add-ricetta.php"
             name="add-form"
             method="POST"
             id="form-add" >
              <fieldset class="form-fieldset">
                     <legend class="legend">
                            Inserisci i dati della nuova ricetta
                     </legend>
                     <ul class="form-container">
                            <li class="form-element">
                                   <label class="form-label"
                                          for="add-nome"> Nome della ricetta: </label>
                                   <input class="barra-input"
                                          id="add-nome"
                                          type="text"
                                          name="nome"
                                          placeholder="Nome ricetta"
                                          required="required" />
                                   <span id="add-nome-message"
                                         class="warning"> </span>
                            </li>
                            <li class="form-element">
                                   <label for="add-immagine"> Immagine:</label>
                                   <input class="barra-input"
                                          type="file"
                                          id="add-immagine"
                                          name="immagine"
                                          placeholder="Immagine ricetta"
                                          required="required" />
                                   <span id="add-immagine-message"
                                          class="warning"> </span>
                            </li>
				<li> 
                                   <span> Tipo della ricetta: </span>
                                   <ul> 
                                          <li> 
                                                 <input type="radio" id="primo" name="tipo" value="primo">
                                                 <label for="primo">Primo</label> 
                                          </li>
                                          <li> 
                                                 <input type="radio" id="secondo" name="tipo" value="secondo">
                                                 <label for="secondo">Secondo</label> 
                                          </li>
                                          <li> 
                                                 <input type="radio" id="dolce" name="tipo" value="dolce">
                                                 <label for="dolce">Dolce</label>
                                          </li>
                                   </ul>
                            </li>
                            <li class="form-element">
                                   <label class="form-label"
                                          for="add-difficolta"> Difficolt&agrave; della ricetta: </label> 
                                   <input class="barra-input"
                                          id="add-difficolta"
                                          type="text"
                                          name="difficolta"
                                          placeholder="Difficolta ricetta"
                                          required="required" />
                                   <span id="add-difficolta-message"
                                         class="warning"> </span>
                            </li>
                            <li class="form-element">
                                   <label class="form-label"
                                          for="add-tempo"> Tempo: </label>
                                   <input class="barra-input"
                                          id="add-tempo"
                                          type="text"
                                          name="tempo"
                                          placeholder="Tempo in minuti"
                                          required="required" />
                                   <span id="add-tempo-message"
                                         class="warning"> </span>
                            </li>
			       <li class="form-element">
                                   <label class="form-label"
                                          for="add-ingredienti"> Ingredienti: </label>
                                   <textarea wrap="hard"
                                          class="barra-input"
                                          id="add-ingredienti"
                                          name="ingredienti"
                                          required="required"> </textarea>
                                   <span id="add-ingredienti-message"
                                         class="warning"> </span>
                            </li>
			       <li class="form-element">
                                   <label class="form-label"
                                          for="add-procedura"> Procedura: </label>
                                   <textarea wrap="hard"
                                          class="barra-input"
                                          id="add-procedura"
                                          name="procedura"
                                          required="required"> </textarea>
                                   <span id="add-procedura-message"
                                         class="warning"> </span>
                            </li>
                            <li class="form-element">
                                   <input class="submit"
                                          type="submit"
                                          value="Aggiungi" /> 

                            </li>
                     </ul>
              </fieldset>
       </form>
       <backToTopPlaceholder />
</div>
