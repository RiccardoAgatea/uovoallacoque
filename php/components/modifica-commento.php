<div id="inserimento-commento">
    <h3>Modifica il commento</h3>
    <form id="commento-form" method="post" action="<rootFolder />/php/handle-modifica-commento.php?ricetta=<ricettaPlaceholder />&idcommento=<idCommentoPlaceholder />&amp;pagina=<paginaPlaceholder />">
    	<fieldset class=fieldset-noborder>
	        <label for="commento">
	            Modifica il tuo commento
	        </label>
	        <textarea rows="" cols="" id="modifica-commento" name="modifica-commento"><testoCommentoDaModificarePlaceholder /></textarea>
	        <input class="commento-submit" type="submit" value="Modifica"/>
	    </fieldset>
    </form>
</div>