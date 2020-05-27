<div id="inserimento-commento">
    <h3>Inserisci un nuovo commento</h3>
    <form id="commento-form" method="post" action="<rootFolder />/php/handle-commenti.php?ricetta=<ricettaPlaceholder />">
        <label for="commento">
            Scrivi il tuo commento
        </label>
        <textarea wrap="hard" id="scrivi-commento" name="scrivi-commento"></textarea>
        <input class="commento-submit" type="submit" value="Commenta"/>
    </form>
</div>