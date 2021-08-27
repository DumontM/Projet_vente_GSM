
<div class="container text-center">
    <div class="row-center">
        <header id="header" class="header">
            <h1><?php echo $Titre ?></h1>
        </header>
    </div>

    <div class="row-center">
        <section class="section text-center">
            <article class="article text-center">
                <form method="POST" action="basket.php">
                    <table class="table table-striped font-weight-bold">
                        <thead class="table table-dark">
                        <tr>
                            <th>Image</th>
                            <th>Modèle</th>
                            <th>Marques</th>
                            <th>Couleur</th>
                            <th>Prix</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <?php

                        foreach($produit as $key => $values)
                        {
                            echo'
                                    <body class="table table-bordered">
                                        <tr>';
                            if ($values->image != NULL)
                            {
                                echo'<td>';
                                $formImage=new Form("formImage","formImage","POST","../Controller/detailGSM.php","");
                                $formImage->hidden("","idImg","idImg","$values->id_gsm");
                                $formImage->image("img",'img',"../View/Images/GSM/$values->image","$values->nomModele","150","100");
                                echo $formImage->getMyFrom();
                                echo '</td>';
                            }
                            else
                            {
                                echo '<td>Aucune image </br> pour ce modèle.</td>';
                            }
                            echo '<td>'.$values->nomModele.'</td>';
                            if($values->logo != NULL)
                            {
                                echo '<td><img src="../View/Images/Logo/'.$values->logo.'" height="80" width="80"></td>';
                            }
                            else
                            {
                                echo '<td>'.$values->nomMarque.'</td>';
                            }
                            echo '<td>'.$values->couleur.'</td>
                                            <td>'.number_format($values->prix, 2,',','').'€</td>
                                            <td><a href="basket.php?del='.$values->id.'"><i class="fa fa-trash" aria-hidden="true"></i><i class="bi bi-trash"></i></a></td>
                                        </tr>
                                    </body>';
                        }

                        ?>


                        <tfoot>
                        <tr>
                            <td class="total" colspan="2" align="right">Total :</td>
                            <td class="totalPrix" colspan="3"><span class="totalPrix"><?php number_format($panier->total(),2,',','') ?> €</span></td>
                            <td class="validercommande"><input type="submit" value="Valider la commande"></td>
                        </tr>
                        </tfoot>

                    </table>
                </form>
            </article>
        </section>
    </div>
</div>