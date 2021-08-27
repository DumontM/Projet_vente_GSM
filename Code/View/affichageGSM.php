<?php
//pages affiche resultat recherche gsm
?>

<?php
if($GSM->data)
{
    //affiche le tableau
    echo'
                                    <table class="table table-striped font-weight-bold" id="GSM">
                                        <thead class="table table-dark table-borderedle">
                                            <tr>
                                                <th>Modèle</th>
                                                <th>Marque</th>
                                                <th>Image</th>
                                                <th>Prix</th>
                                                <th>Panier</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table table-bordered">';


    foreach ($GSM -> data as $key => $values)
    {
        echo "<tr class='TrGSM'>";
        // affiche le nom du modéle du GSM
        echo '<td>';
        $formDetail=new Form("detail","detail","POST","../Controller/detailGSM.php","");
        $formDetail->hidden("","detailGSM","detailGSM","$values->id_gsm");
        $formDetail->setSubmit("detailDuGSM","detailDuGSM","","$values->nomModele","btn btn-link font-weight-bold");
        echo $formDetail->getMyFrom();
        echo '</td>';

        //affiche le logo ou le nom  de la marque

        if($values->logo != NULL)
        {
            echo '<td><img src="../View/Images/Logo/'.$values->logo.'" height="80" width="80"></td>';
        }
        else
        {
            echo '<td>'.$values->nomMarque.'</td>';
        }

        //condition pour image
        if ($values->image != NULL)
        {
            echo'<td>';
            $formImage=new Form("formImage","formImage","POST","../Controller/detailGSM.php","");
            $formImage->hidden("","idImg","idImg","$values->id_gsm");
            $formImage->image("img",'img',"../View/Images/GSM/$values->image","$values->nomModele","150","100");
            echo $formImage->getMyFrom();
            echo '</td>';
        }
        else echo '<td>Aucune image </br> pour ce modèle.</td>';

        //afficher le prix
        echo '<td>'.number_format($values->prix, 2,',','').' euros</td>';

        //icone ajout panier
        echo '<td><button><a class="add addpanier" href="../Controller/ajoutPanier.php?idGSM='.$values->id_gsm.'"><i class="bi bi-cart-plus"></i></a></button>';
        /*
        echo '<td>';
        $formModeles= new Form("formModeles","formModeles","POST","","");
        $formModeles->hidden("","idGSM","$values->id_gsm","$values->id_gsm");
        $formModeles -> button("btnpanier","btnPanier1","btnPanier1","","","",'<i class="bi bi-cart-plus"></i>');
        echo $formModeles->getMyFrom();
        */
        echo '</td></tr>';

    }
    echo '</tbody></table>';
}
else
{
    echo "Le modéle n'existe pas.";
}
?>