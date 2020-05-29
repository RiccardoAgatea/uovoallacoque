<div id="content">
       <h1>Modifica ricetta </h1>
       <form action="<rootFolder />/php/handle-edit-ricetta.php?id=<idPlaceholder/>&amp;pagina=<paginaPlaceholder/>"
             name="edit-form"
             method="post"
             id="form-edit">
              <fieldset class="form-fieldset">
                     <legend class="legend">
                            Modifica i dati della ricetta
                     </legend>
                     <ul class="form-container">
                            <li class="form-element">
                                   <label class="form-label"
                                          for="edit-nome"> Modifica nome della ricetta: </label>
                                   <input class="barra-input"
                                          id="edit-nome"
                                          type="text"
                                          name="nome"
                                          placeholder="Nome della ricetta"
                                          value="<nomeRicettaPlaceholder/>" />
                                   <span id="edit-nome-message"
                                         class="warning"> <errorNomePlaceholder /> </span>
                            </li>
                            <li class="form-element">
                                   <label for="edit-immagine"> Modifica Immagine:</label>
                                   <input class="barra-input"
                                          type="file"
                                          id="edit-immagine"
                                          name="immagine"
                                          value="<imgSrcPlaceholder/>" />
                                   <span id="edit-immagine-message"
                                          class="warning"> <errorImgPlaceholder /></span>
                            </li>
				<li> 
                                   <span> Modifica tipo della ricetta: </span>
                                   <ul> 
                                          <li> 
                                                 <input type="radio" id="primo" name="tipo" value="primo"/>
                                                 <label for="primo">Primo</label> 
                                          </li>
                                          <li> 
                                                 <input type="radio" id="secondo" name="tipo" value="secondo"/>
                                                 <label for="secondo">Secondo</label> 
                                          </li>
                                          <li> 
                                                 <input type="radio" id="dolce" name="tipo" value="dolce"/>
                                                 <label for="dolce">Dolce</label>
                                          </li>
                                   </ul>
                            </li>
                            <li class="form-element">
                                   <label class="form-label"
                                          for="edit-difficolta"> Modifica difficolt&agrave; della ricetta: </label> 
                                   <input class="barra-input"
                                          id="edit-difficolta"
                                          type="text"
                                          name="difficolta"
                                          value="<difficoltaPlaceholder/>" />
                                   <span id="edit-difficolta-message"
                                         class="warning"> <errorDifficoltaPlaceholder />  </span>
                            </li>
                            <li class="form-element">
                                   <label class="form-label"
                                          for="edit-tempo"> Modifica tempo: </label>
                                   <input class="barra-input"
                                          id="edit-tempo"
                                          type="text"
                                          name="tempo"
                                          value="<tempoPlaceholder/>" />
                                   <span id="edit-tempo-message"
                                         class="warning"> <errorTempoPlaceholder /></span>
                            </li>
			       <li class="form-element">
                                   <label class="form-label"
                                          for="edit-ingredienti"> Modifica ingredienti: </label>
                                   <textarea wrap="hard"
                                          class="barra-input"
                                          id="edit-ingredienti"
                                          name="ingredienti"> <ingredientiPlaceholder/> </textarea>
                                   <span id="edit-ingredienti-message"
                                         class="warning"> </span>
                            </li>
			       <li class="form-element">
                                   <label class="form-label"
                                          for="edit-procedura"> Modifica procedura: </label>
                                   <textarea wrap="hard"
                                          class="barra-input"
                                          id="edit-procedura"
                                          name="procedura"> <proceduraPlaceholder/> </textarea>
                                   <span id="edit-procedura-message"
                                         class="warning"> </span>
                            </li>
                            <li class="form-element">
                                   <input class="submit"
                                          type="submit"
                                          value="Salva modifiche" />
                            </li>
                     </ul>
              </fieldset>
       </form>
       <form action="<rootFolder />/php/ricetta.php?id=<idPlaceholder/>&amp;pagina=<paginaPlaceholder/>"
          method="post"
          id="annulla-modifiche"
        >
        <fieldset class="form-fieldset annulla-modifiche-ricetta">
            <legend class="legend">Annulla le modifiche</legend>
            <input class="submit"
                        type="submit"
                        value="Annulla" />
        </fieldset>
    </form>
       <backToTopPlaceholder />
</div>
