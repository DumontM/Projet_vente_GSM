<?php
    //pages avec les détails du GSM
?>

<div class="container text-center">
    <div class="row-center">
        <header id="header" class="header">
            <h1><?php echo $Titre ?></h1>
        </header>
    </div>

    <div class="row-center">
        <section class="section">
            <article class="article">
                <?php

                    if($gsm->data)
                    {
                        echo
                        '<table class="table table-striped font-weight-bold">
                                    <thead class="table table-dark">
                                        <tr>
                                            <th colspan="2">Détail</th>
                                            <th colspan="6">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table table-bordered">';


                        //affiche le tableau
                        foreach ($gsm->data as $key=>$values)
                        {
                            if($id === $values->id_gsm)
                            {
                                // affiche le nom du modéle du GSM
                                echo '<tr><td colspan="2">Modéle</td><td colspan="6">'.$values->nomModele.'</td></tr>';

                                //affiche le nom de la marque
                                echo '<tr><td colspan="2">Marque</td><td colspan="6">'.$values->nomMarque.'</td></tr>';

                                //affiche le logo de la marque
                                echo '<tr><td colspan="2">Logo</td>';
                                if ($values->logo != NULL)
                                {
                                    echo '<td colspan="6"<div class="text-center"><img src="../View/Images/Logo/'.$values->logo.'" alt='.$values->nomMarque.' height="80" width="80"></div></td>';
                                }
                                else
                                {
                                    echo '<td colspan="6">Aucune image pour ce modèle.</td>';
                                }
                                echo '</tr>';
                                //echo '<tr><td colspan="2">Logo Marque</td><td colspan="6"><img src="../View/Images/Logo/'.$values->logo.'" height="80" width="80"></td></tr>';

                                //affiche la couleur du GSM
                                echo '<tr><td colspan="2">couleur</td><td colspan="6">'.$values->couleur.'</td></tr>';

                                //affiche la taille de l'écran
                                echo '<tr><td colspan="2">Ecran</td><td colspan="6">'.$values->ecran.'"</td></tr>';

                                // affiche le processeur
                                echo '<tr><td colspan="2">Processeur</td><td colspan="6">'.$values->processeur.'</td></tr>';

                                //affiche la mémoire du GSM
                                echo '<tr><td colspan="2">Mémoire</td><td colspan="6">'.$values->memoire.' GB</td></tr>';

                                //affiche la taille du GSM
                                echo '<tr><td colspan="2">Taille GSM</td><td colspan="6">'.$values->taille.' mm</td></tr>';

                                //affiche le poid du GSM
                                echo '<tr><td colspan="2">Poid</td><td colspan="6">' . number_format($values->poids, 2, ',', '') . ' gr</td></tr>';

                                //condition pour image
                                echo '<tr><td colspan="2">Photo</td colspan="6">';
                                if ($values->image != NULL)
                                {
                                    echo '<td colspan="6"<div class="text-center"><img src="../View/Images/GSM/'.$values->image.'" alt="'.$values->nomModele.'" height="150" width="100" onclick="document.location.href="></div></td>';
                                }
                                else
                                {
                                    echo '<td colspan="6">Aucune image pour ce modèle.</td>';
                                }
                                echo '</tr>';

                                //affiche le prix
                                echo '<tr><td colspan="2">Prix</td>';
                                echo '<td colspan="6">' . number_format($values->prix, 2, ',', '') . ' euros</td></tr></tbody>';

                                //echo "<td>$idRole</td>";
                                //permet de masquer si l'utilisateur est un client
                                if($idRole === 2 || $idRole === 3)
                                {
                                    //permet de verifier si il est actif ou inactif
                                    if ($values->actif == 1)
                                    {
                                        $actifOrInactif="Actif";
                                    }
                                    else
                                    {
                                        $actifOrInactif="Inactif";
                                    }

                                    // bouton Actif/inacti()
                                    echo '<tfoot class="table"><tr><th colspan="1"><div class="text-center"></br>
                                        <input type="hidden" name="actifinactif" id="actifOuInactif" value='.$values->id_gsm.'>
                                        <input type="submit" name="btnActif" id="btnActif'.$values->id_gsm.'" onclick="actifInactif('.$values->id_gsm.')" value='.$actifOrInactif.' class="btn-block">';
                                    echo '</div></th>';

                                    //bouton modifier GSM qui récupere les info et les envois vers controleModeles puis vers modifierGSM
                                    echo '<th colspan="2"><div class="text-center">';
                                    $formModif=new Form("formModif","formModif","POST","checkGSM.php","");
                                    $formModif->hidden("","idGSM","idGSM","$values->id_gsm");
                                    $formModif->hidden("","idModele","idModole","$values->modeles_id");
                                    $formModif->hidden("","idMarque","idMarque","$values->marques_id");
                                    $formModif->hidden("","imei","imei","$values->imei");
                                    $formModif->hidden("","modele","modele","$values->nomModele");
                                    $formModif->hidden("","couleur","couleur","$values->couleur");
                                    $formModif->hidden("","ecran","ecran",$values->ecran);
                                    $formModif->hidden("","processeur","processeur","$values->processeur");
                                    $formModif->hidden("","memoire","memoire","$values->memoire");
                                    $formModif->hidden("","taille","taille","$values->taille");
                                    $formModif->hidden("","poids","poids","$values->poids");
                                    $formModif->hidden("","image","image","$values->image");
                                    $formModif->hidden("","prix","prix","$values->prix");
                                    $formModif->hidden("","actif","actif","$values->actif");
                                    $formModif->hidden("","marque","marque","$values->nomMarque");
                                    $formModif->hidden("","logo","logo","$values->logo");
                                    $formModif->setSubmit("btnModif","btnModif","","Modifier le GSM","btn-block");
                                    echo $formModif->getMyFrom();
                                    echo '</div></th>';

                                    echo '<th colspan="2"><div class="text-center">';
                                    $formSup=new Form('FormSupp','FormSupp','POST','checkGSM.php','');
                                    $formSup->hidden("","idGSM","idGSM","$values->id_gsm");
                                    $formSup->hidden("","idModele","idModole","$values->modeles_id");
                                    $formSup->setSubmit("btnSupp","btnSupp","","Supprimer le GSM","btn-block");
                                    echo $formSup->getMyFrom();
                                    echo '</div></th>';
                                }

                                //icone ajout panier
                                echo '<th colspan="2"><div class="text-center"></br>';
                                $formPanier = new Form("formPanier","formPanier","POST","","");
                                $formPanier->hidden("","idGSM","$values->id_gsm","$values->id_gsm");
                                //$formPanier->hidden("","actif","actif","$values->actif");
                                //$formPanier->hidden("","prix","$values->prix","$values->prix");
                                $formPanier->button("btnPanier","btnPanier2","btnPanier2","","","",'<i class="bi bi-cart-plus"></i> Ajout au panier');
                                echo $formPanier->getMyFrom();
                                echo '</div></th>';

                                //Bouton retour
                                echo '<th colspan="2"><div class="text-center"></br>';
                                $formRetour = new Form("retour","retour","POST","../Controller/GSM.php","");
                                $formRetour -> setSubmit("btnRetour","btnRetour","","Retour","btn-block");
                                echo $formRetour ->getMyFrom();
                                echo '</div></th></tr>';
                            }
                        }
                        echo '</tfoot></table>';
                    }
                    else
                    {
                        echo 'Le modéle n\'existe pas';
                    }
                ?>
            </article>
        </section>
    </div>
</div>