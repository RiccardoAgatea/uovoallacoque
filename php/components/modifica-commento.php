<div id="inserimento-commento">
    <h3>Modifica il commento</h3>
    <form id="modifica-commento-form" method="post" action="<rootFolder />/php/handle-modifica-commento.php?ricetta=<ricettaPlaceholder />&amp;idcommento=<idCommentoPlaceholder />&amp;pagina=<paginaPlaceholder />">
    	<fieldset class="fieldset-noborder">
	        <label for="modifica-commento">
	            Modifica il tuo commento
	        </label>
	        <textarea rows="" cols="" id="modifica-commento" name="modifica-commento"><testoCommentoDaModificarePlaceholder /></textarea>
	        <span id="modifica-commento-message" class="warning"> <errorCommentoPlaceholder /> </span>
	        <input class="commento-submit" type="submit" value="Modifica"/>
	    </fieldset>
	</form>
	<form id="annulla-commento" method="post" action="<rootFolder />/php/ricetta.php?id=<ricettaPlaceholder />&amp;pagina=<paginaRicettaPlaceholder />#sezione-commenti">
		<fieldset class="fieldset-noborder">
			<input class="commenti-input-annulla" type="submit" value="Annulla"/>
		</fieldset>
	</form>
</div>