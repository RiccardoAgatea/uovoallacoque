<div id="content">
  <h1>Aggiungi ricetta</h1>
  <p class= "add-edit-ricetta-info">Si invita l'amministratore ad aggiungere eventuali parole straniere con la seguente sintassi: [lingua=parola]. Esempio: [fr=<span xml:lang="fr">coque</span>]</p>
  <p>I campi contrassegnati con * sono obbligatori.</p>
  <form action="<rootFolder />/php/handle-add-ricetta.php"
        method="post"
        id="form-add"
        enctype="multipart/form-data">
    <fieldset class="form-fieldset">
      <legend class="legend">
        Inserisci i dati della nuova ricetta
      </legend>
      <ul class="form-container">
        <li class="form-element">
          <label class="form-label"
            for="add-nome"> Nome della ricetta*: </label>
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
          <span> Tipo della ricetta*: </span>
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
          <span id="add-tipo-message"
                class="warning"> <errorTipoPlaceholder /> </span>
        </li>
        <li class="form-element">
          <label class="form-label"
            for="add-difficolta"> Difficolt&agrave; della ricetta (da 1 a 5)*: </label>
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
            for="add-tempo"> Tempo (in minuti)*: </label>
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
            for="add-keywords"> Keywords (separate da virgola): </label>
          <input class="barra-input"
            id="add-keywords"
            type="text"
            name="keywords"
            value = "<keywordsPlaceholder />" />
          <span id="add-keywords-message"
                class="warning"> <errorKeywordsPlaceholder /> </span>
        </li>
            <li class="form-element">
          <label class="form-label"
            for="add-ingredienti"> Ingredienti (separati da virgola)*: </label>
          <textarea rows="" cols=""
            class="barra-input"
            id="add-ingredienti"
            name="ingredienti"><ingredientiPlaceholder /></textarea>
        </li>
          <li class="form-element">
          <label class="form-label"
            for="add-procedura"> Procedura*: </label>
          <textarea rows="" cols=""
            class="barra-input"
            id="add-procedura"
            name="procedura"><proceduraPlaceholder /></textarea>
        </li>
        <li class="form-element">
          <input class="submit"
            type="submit"
            value="Aggiungi" />

        </li>
      </ul>
    </fieldset>
  </form>
  <annullaPlaceholder />
  <backToTopPlaceholder />
</div>
