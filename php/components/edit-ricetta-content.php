<div id="content">
       <h1>Modifica ricetta </h1>
       <form action="<rootFolder />/php/handle-edit-ricetta.php?id=<idPlaceholder/>&amp;pagina=<paginaPlaceholder/>"
             name="edit-form"
             method="post"
             id="form-edit"
             enctype="multipart/form-data">
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
                                          <li class="item-radio-container">
                                                 <label for="primo">Primo</label>  
                                                 <input class="radio-ricetta" type="radio" id="primo" name="tipo" value="1"/>
                                                 
                                          </li>
                                          <li class="item-radio-container">   
                                                 <label for="secondo">Secondo</label> 
                                                 <input class="radio-ricetta" type="radio" id="secondo" name="tipo" value="2"/>
                                                 
                                          </li>
                                          <li class="item-radio-container">   
                                                 <label for="dolce">Dolce</label>
                                                 <input class="radio-ricetta" type="radio" id="dolce" name="tipo" value="3"/>
                                                 
                                          </li>
                                   </ul>
                                   <span id="edit-tipo-message"
                                         class="warning"> <errorTipoPlaceholder /> </span>
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
                                          name="ingredienti"><ingredientiPlaceholder/></textarea>
                                   <span id="edit-ingredienti-message"
                                         class="warning"> </span>
                            </li>
			       <li class="form-element">
                                   <label class="form-label"
                                          for="edit-procedura"> Modifica procedura: </label>
                                   <textarea wrap="hard"
                                          class="barra-input"
                                          id="edit-procedura"
                                          name="procedura"><proceduraPlaceholder/></textarea>
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
       <annullaPlaceholder />
       <backToTopPlaceholder />
</div>
