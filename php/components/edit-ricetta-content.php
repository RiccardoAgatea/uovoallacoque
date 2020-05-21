<div id="content">
       <h1>Modifica ricetta</h1>
       <form action=""
             name=""
             method="POST"
             id="edit-add">
              <fieldset class="form-fieldset">
                     <legend class="legend">
                            Modifica i dati della ricetta
                     </legend>
                     <ul class="form-container">
                            <li class="form-element">
                                   <label class="form-label"
                                          for="edit-nome"> modifica nome della ricetta: </label>
                                   <input value="<nomeRicettaPlaceholder/>" />
                                   <span id="edit-nome-message"
                                         class="warning"> </span>
                            </li>
                            <li class="form-element">
                                   <label for="edit-immagine"> Modifica Immagine:</label>
                                   <input value="<imgSrcPlaceholder/>" />
                                   <span id="edit-immagine-message"
                                          class="warning"> </span>
                            </li>
				<li> 
                                   <span> Modifica tipo della ricetta: </span>
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
                                          for="edit-difficolta"> Modifica difficolt&agrave; della ricetta: </label> 
                                   <input value="<difficoltàPlaceholder/>" />
                                   <span id="edit-difficolta-message"
                                         class="warning"> </span>
                            </li>
                            <li class="form-element">
                                   <label class="form-label"
                                          for="edit-tempo"> Modifica tempo: </label>
                                   <input value="<tempoPlaceholder/>" />
                                   <span id="edit-tempo-message"
                                         class="warning"> </span>
                            </li>
			       <li class="form-element">
                                   <label class="form-label"
                                          for="edit-ingredienti"> Modifica ingredienti: </label>
                                   <input value="<ingredientiPlaceholder/>">
                                   <span id="edit-ingredienti-message"
                                         class="warning"> </span>
                            </li>
			       <li class="form-element">
                                   <label class="form-label"
                                          for="edit-procedura"> Modifica procedura: </label>
                                   <input value="<proceduraPlaceholder/>" />
                                   <span id="edit-procedura-message"
                                         class="warning"> </span>
                            </li>
                            <li class="form-element">
                                   <input class="submit"
                                          type="submit"
                                          value="Aggiungi" onsubmit="ricettaValidator('add-nome','add-difficolta','add-tempo','add-immagine')" />
                            </li>
                     </ul>
              </fieldset>
       </form>
       <backToTopPlaceholder />
</div>
