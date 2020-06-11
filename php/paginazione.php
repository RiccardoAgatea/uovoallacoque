<?php
function getPaginazioneCommenti($corrente, $totPagine, $id)
{
    if ($totPagine <= 1) {
        $out = "";
    } else {
        if ($totPagine < 6) {
                $out = "<ul class=\"paginazione\">";
            if ($corrente != 1) {
                $out .= "<li><a href=\"?";
                $out .= "id=$id";
                $out .= "&amp;pagina=" . strval($corrente - 1) . "\">Precedente</a></li>";
            }
            for ($i = 1; $i <= $totPagine; $i++) {
                if ($i != $corrente) {
                    $out .= "<li><a href=\"?";
                    $out .= "id=$id";
                    $out .= "&amp;pagina=" . $i . "\">" . $i . "</a></li>";
                } else {
                    $out .= "<li>$i</li>";
                }
            }
            if ($corrente < $totPagine) {
                $out .= "<li><a href=\"?";
                $out .= "id=$id";
                $out .= "&amp;pagina=" . strval($corrente + 1) . "\">Successiva</a></li>";
            }
            $out .= "</ul>";
        }

        else {
            $out = "<ul class=\"paginazione\">";
            if ($corrente != 1) {
                $out .= "<li><a href=\"?";
                $out .= "id=$id";
                $out .= "&amp;pagina=" . strval($corrente - 1) . "\">Precedente</a></li>";
            }
            if($corrente >= 4) {
                $out .= "<li><a href=\"?";
                $out .= "id=$id";
                $out .= "&amp;pagina=" . strval(1) . "\">1</a></li>";
            }
            if ($corrente >= 5) {
                $out .= "<li> ... </li>";
            }
            for ($i = $corrente-2; $i <= $totPagine && $i<= $corrente+2; $i++) {
                if ($i != $corrente && $i>=1) {
                    $out .= "<li><a href=\"?";
                    $out .= "id=$id";
                    $out .= "&amp;pagina=" . $i . "\">" . $i . "</a></li>";
                } else if ($i>=1){
                    $out .= "<li>$i</li>";
                }
            }
            if ($corrente <= $totPagine-4) {
                $out .= "<li> ... </li>";
            }
            if($corrente <= $totPagine-3) {
                $out .= "<li><a href=\"?";
                $out .= "id=$id";
                $out .= "&amp;pagina=" . strval($totPagine) . "\">". $totPagine . "</a></li>";
            }
            if ($corrente < $totPagine) {
                $out .= "<li><a href=\"?";
                $out .= "id=$id";
                $out .= "&amp;pagina=" . strval($corrente + 1) . "\">Successiva</a></li>";

                
            }
            $out .= "</ul>";
        }
        
    }

    return $out;
}

function getPaginazioneRicette($totPagine, $tipo, $corrente)
{
    if ($totPagine<=1) {
        $out="";
    }
    else {
        if($totPagine<6) {
                $out = "<ul class=\"paginazione\">";
            if ($corrente != 1) {
                $out .= "<li><a href=\"?";
                if ($tipo == 0) {
                    $out .= "termine-ricerca={$_GET["termine-ricerca"]}";
                } else {
                    $out .= "id=$tipo";
                }
                $out .= "&amp;pagina=" . strval($corrente-1) . "\">Precedente</a></li>";
            }
            for ($i = 1; $i <= $totPagine; $i++) {
                if ($i != $corrente) {
                    $out .= "<li><a href=\"?";
                    if ($tipo == 0) {
                        $out .= "termine-ricerca={$_GET["termine-ricerca"]}";
                    } else {
                        $out .= "id=$tipo";
                    }
                    $out .= "&amp;pagina=" . $i . "\">" . $i . "</a></li>";
                } else {
                    $out .= "<li>$i</li>";
                }
            }
            if ($corrente < $totPagine) {
                $out .= "<li><a href=\"?";
                if ($tipo == 0) {
                    $out .= "termine-ricerca={$_GET["termine-ricerca"]}";
                } else {
                    $out .= "id=$tipo";
                }
                $out .= "&amp;pagina=" . strval($corrente+1) . "\">Successiva</a></li>";
            }
            $out .= "</ul>";
        }
        else {
            $out = "<ul class=\"paginazione\">";
            if ($corrente != 1) {
                $out .= "<li><a href=\"?";
                if ($tipo == 0) {
                    $out .= "termine-ricerca={$_GET["termine-ricerca"]}";
                } else {
                    $out .= "id=$tipo";
                }
                $out .= "&amp;pagina=" . strval($corrente-1) . "\">Precedente</a></li>";
            }
            if($corrente >= 4) {
                $out .= "<li><a href=\"?";
                if ($tipo == 0) {
                    $out .= "termine-ricerca={$_GET["termine-ricerca"]}";
                } else {
                    $out .= "id=$tipo";
                }
                $out .= "&amp;pagina=" . strval(1) . "\">1</a></li>";
            }
            if ($corrente >= 5) {
                $out .= "<li> ... </li>";
            }

            for ($i = $corrente-2; $i <= $totPagine && $i<= $corrente+2; $i++) {
                if ($i != $corrente && $i>=1) {
                    if ($i != $corrente) {
                        $out .= "<li><a href=\"?";
                        if ($tipo == 0) {
                            $out .= "termine-ricerca={$_GET["termine-ricerca"]}";
                        } else {
                            $out .= "id=$tipo";
                        }
                        $out .= "&amp;pagina=" . $i . "\">" . $i . "</a></li>";
                    } 
                }
                else if ($i>=1) {
                    $out .= "<li>$i</li>";
                }
            }

            if ($corrente <= $totPagine-4) {
                $out .= "<li> ... </li>";
            }
            if($corrente <= $totPagine-3) {
                $out .= "<li><a href=\"?";
                if ($tipo == 0) {
                    $out .= "termine-ricerca={$_GET["termine-ricerca"]}";
                } else {
                    $out .= "id=$tipo";
                }
                $out .= "&amp;pagina=" . strval($totPagine) . "\">". $totPagine . "</a></li>";
            }
            if ($corrente < $totPagine) {
                $out .= "<li><a href=\"?";
                if ($tipo == 0) {
                    $out .= "termine-ricerca={$_GET["termine-ricerca"]}";
                } else {
                    $out .= "id=$tipo";
                }
                $out .= "&amp;pagina=" . strval($corrente+1) . "\">Successiva</a></li>";
            }
            $out .= "</ul>";
        }
        
    }
    

    return $out;
}

