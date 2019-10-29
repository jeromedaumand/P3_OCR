<?php
function limite_ligne($chaine,$max=10){
    // on enlève les balises html
    $chaine = strip_tags($chaine);
    // on défini le délimiteur sur le retour chariot pour le remettre si on a plusieurs lignes
    $delim = "\n";

    // on casse la chaine par le retour chariot  et retourne un array avec chaque ligne
    $expl = explode($delim,$chaine);

    // si l'array est plus grand que la valeur max
    if(count($expl) >= $max){
        $i = 0;
        $chaine = "";

        // on boucle pour n'afficher que le nombre de ligne souhaité
        while($i < $max){
            // on ajoute le mot suivi du délimiteur
            $chaine.= $expl[$i].$delim;
            $i++;
            }
    }
    return $chaine; // on retourne le résultat
}


function date_fr($time){
    //affichage de la date au format FR

    setlocale(LC_TIME,'fr_FR','french','French_France.1252','fr_FR.ISO8859-1','fra');
    $datefmt = new IntlDateFormatter('fr_FR', NULL, NULL, NULL, NULL, 'dd MMMM yyyy');

        // pour une date qui vient d'un champ DATE(TIME) de MySQL
        $time = date_create($time);
        $time = $datefmt->format($time);
        return $time;

}