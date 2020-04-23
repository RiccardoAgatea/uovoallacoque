<span id="apriNav"
      onclick="openSideNav()">&#9776; </span>

<ul id="menu">
       <li id="home">
              <a href="<rootFolder />/index.php">
                     Home
              </a>
       </li>
       <li id="primi">
              <a href="<rootFolder />/php/elenco.php?id=1">
                     Primi Piatti
              </a>
       </li>
       <li id="secondi">
              <a href="<rootFolder />/php/elenco.php?id=2">
                     Secondi Piatti
              </a>
       </li>
       <li id="dolci">
              <a href="<rootFolder />/php/elenco.php?id=3">
                     Dolci
              </a>
       </li>
</ul>
<div id="barra_ricerca">
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


<ul id="mySidenav"
    class="sidenav">
       <li id="chiudiNav"><a href="javascript:void(0)"
                 class="closebtn"
                 onclick="closeSideNav()">&times;</a></li>

       <li id="home"><a href="<rootFolder />/index.php">Home</a></li>
       <li id="primi"><a href="<rootFolder />/php/elenco.php?id=1">Primi
                     Piatti</a></li>
       <li id="secondi"><a
                 href="<rootFolder />/php/elenco.php?id=2">Secondi
                     Piatti</a>
       </li>
       <li id="dolci"><a
                 href="<rootFolder />/php/elenco.php?id=3">Dolci</a>
       </li>
       <!-- accedi e registrati? -->
</ul>
