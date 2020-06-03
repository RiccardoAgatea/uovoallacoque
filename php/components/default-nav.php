<ul id="menu">
	<li id="home"
		class="elemento-menu">
		<a href="<rootFolder />/index.php">
			Home
		</a>
	</li>
	<li id="primi"
		class="elemento-menu">
		<a href="<rootFolder />/php/elenco.php?id=1">
			Primi Piatti
		</a>
	</li>
	<li id="secondi"
		class="elemento-menu">
		<a href="<rootFolder />/php/elenco.php?id=2">
			Secondi Piatti
		</a>
	</li>
	<li id="dolci"
		class="elemento-menu">
		<a href="<rootFolder />/php/elenco.php?id=3">
			Dolci
		</a>
	</li>
</ul>
<div id="barra-ricerca">
	<form method="get"
		  action="<rootFolder />/php/elenco.php?id=0"
		  id="form-barra-ricerca">
		  <fieldset class="fieldset-noborder">
			<label for="termine-ricerca">Cerca:</label>
			<input type="text"
				   id="termine-ricerca"
				   class="barra-cerca"
				   name="termine-ricerca" />
			<input type="image"
				   id="immagine-lente"
				   src="<rootFolder />/img/icone/lente-ingrandimento.png"
				   alt="cerca" />
		  </fieldset>
	</form>
</div>
