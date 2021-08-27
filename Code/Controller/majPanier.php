<?php
    /**
     * vérifie que la session n'est déja pas ouverte
     */
    if(session_status() == PHP_SESSION_NONE)
    {
    session_start();
    }

    require_once '../Model/Panier.php';

    $panier = new Panier();

?>

    <li class="nav-item">
        <a class="nav-link" href="ajoutPanier.php"><i class="fas fa-shopping-cart"></i> Panier
            <?php
            if (isset ($_SESSION['panier']))
            {
            ?>  <small><span id="countNbrElementPanier">(<?php echo $panier->countNbrElementsPanier() ?>)</span>
                <div>
                    Total: <?php echo number_format($panier->total(), 2, ',', ' '); ?> €</small>
                </div>
            <?php
            }
            ?>
        </a>
    </li>