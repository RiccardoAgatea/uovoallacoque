<div id="inserimento-commento">
    <h3>Inserisci un nuovo commento</h3>
    <form id="inserisci-commento-form" method="post" action="<rootFolder />/php/handle-commenti.php?ricetta=<ricettaPlaceholder />">
    	<fieldset class="fieldset-noborder">
	        <label for="scrivi-commento">
	            Scrivi il tuo commento
	        </label>
	        <textarea rows="" cols="" id="scrivi-commento" name="scrivi-commento"></textarea>
			<span id="scrivi-commento-message" class="warning"> <errorCommentoPlaceholder /> </span>
	        <input class="commento-submit" type="submit" value="Commenta"/>
	    </fieldset>
	</form>
	<form id="annulla-commento" method="post" action="<rootFolder />/php/ricetta.php?id=<ricettaPlaceholder />&pagina=<paginaRicettaPlaceholder />#sezione-commenti">
		<fieldset class="fieldset-noborder">
			<input class="commenti-input-annulla" type="submit" value="Annulla">
		</fieldset>
	</form>
</div>