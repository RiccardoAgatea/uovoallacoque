<?php

function inserimentoLingua($testo)
    {
        while (preg_match('/\[([A-Za-z]{2}?)=(.*?)\]/', $testo, $output)) {
            $tag='<span xml:lang="'.$output[1].'">'.$output[2].'</span>';
            $testo = str_replace($output[0], $tag, $testo);
        }
        return $testo;
    }