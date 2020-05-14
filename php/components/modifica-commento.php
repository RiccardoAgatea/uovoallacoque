<div id="inserimento-commento">
    <h3>Modifica il commento</h3>
    <form id="commento-form" method="POST" action="<rootFolder />/php/handle-modifica-commento.php?ricetta=<ricettaPlaceholder />&idcommento=<idCommentoPlaceholder />&pagina=<paginaPlaceholder />">
        <label for="commento">
            Modifica il tuo commento
        </label>
        <textarea wrap="hard" id="modifica-commento" name="modifica-commento"><testoCommentoDaModificarePlaceholder /></textarea>
        <input class="commento-submit" type="submit" value="Modifica"/>
    </form>
</div>