<div id="content">
       <h1>Aggiungi ricetta</h1>
       <form action="<rootFolder />/php/handle-add-ricetta.php"
             name="add-form"
             method="post"
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
                                          value = "<nomePlaceholder />" />
                                   <span id="add-nome-message"
                                         class="warning"> <errorNomePlaceholder /> </span>
                            </li>
                            <li class="form-element">
                                   <label for="add-immagine"> Immagine:</label>
                                   <input class="barra-input"
                                          type="file"
                                          id="add-immagine"
                                          name="immagine"
                                          value = "<imgPlaceholder />" />
                                   <span id="add-immagine-message"
                                          class="warning"> <errorImgPlaceholder /> </span>
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
                                          value = "<difficoltaPlaceholder />" />
                                   <span id="add-difficolta-message"
                                         class="warning"> <errorDifficoltaPlaceholder /> </span>
                            </li>
                            <li class="form-element">
                                   <label class="form-label"
                                          for="add-tempo"> Tempo: </label>
                                   <input class="barra-input"
                                          id="add-tempo"
                                          type="text"
                                          name="tempo"
                                          value = "<tempoPlaceholder />" />
                                   <span id="add-tempo-message"
                                         class="warning"> <errorTempoPlaceholder /> </span>
                            </li>
			                     <li class="form-element">
                                   <label class="form-label"
                                          for="add-ingredienti"> Ingredienti: </label>
                                   <textarea wrap="hard"
                                          class="barra-input"
                                          id="add-ingredienti"
                                          name="ingredienti"> </textarea>
                            </li>
			                       <li class="form-element">
                                   <label class="form-label"
                                          for="add-procedura"> Procedura: </label>
                                   <textarea wrap="hard"
                                          class="barra-input"
                                          id="add-procedura"
                                          name="procedura"> </textarea>
                            </li>
                            <li class="form-element">
                                   <input class="submit"
                                          type="submit"
                                          value="Aggiungi" /> 

                            </li>
                     </ul>
              </fieldset>
       </form>

       <form action="<rootFolder />/php/add-ricetta.php"
          method="post"
          id="annulla-modifiche"
        >
        <fieldset class="form-fieldset annulla-modifiche-ricetta">
            <legend class="legend">Annulla la ricetta</legend>
            <input class="submit"
                     type="submit"
                     value="Annulla" />
        </fieldset>
    </form>
       <backToTopPlaceholder />
</div>
