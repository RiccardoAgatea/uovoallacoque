<ul id="menu">
<span class="chiudi-nav"> 
					<img class="close-button"  src="<rootFolder />/img/icone/exit.png" alt="esci dal menu"/>
				</span>
	<li id="home" class="elementoMenu">
		<a href="<rootFolder />/index.php">
			Home
		</a>
	</li>
	<li id="primi" class="elementoMenu">
		<a href="<rootFolder />/php/elenco.php?id=1">
			Primi Piatti
		</a>
	</li>
	<li id="secondi" class="elementoMenu">
		<a href="<rootFolder />/php/elenco.php?id=2">
			Secondi Piatti
		</a>
	</li>
	<li id="dolci" class="elementoMenu">
		<a href="<rootFolder />/php/elenco.php?id=3">
			Dolci
		</a>
	</li>
</ul>
<div id="barra-ricerca">
	<form method="get"
	      action="<rootFolder />/php/elenco.php?id=0">
		<label for="termine_ricerca">Cerca:</label>
		<input type="text"
			id="termine_ricerca"
			class="barra-cerca"
			name="termine_ricerca" />
		<input type="image"
			id="immagine-lente"
			src="<rootFolder />/img/icone/lente-ingrandimento.png"
			alt="cerca" />
	</form>
</div>


