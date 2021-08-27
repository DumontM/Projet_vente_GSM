$(document).ready(function(){console.log("La page est pret")});

//Fonction utilisée sur ../View/affichageGSM.php pour la recherche avec clic
recherche =false;

function rechercheVide()
{
    //console.log("je suis dans la fonction recherche vide");
    var rechercheVide = document.getElementById("recherche").value;
    if(recherche == '')
    {
        $.ajax(

            {
                url:"../Controller/affichageGSM.php",
                type: "POST",
                data:
                    {
                        rechercheVide:rechercheVide,
                    },
                success: function(data)
                {
                    //console.log("je suis dans le success Ajax");
                    console.log("la valeur de data est : "+data);
                    $("#messages").html(data);
                }
            })
    }
}

function rechercheTrue()
{
    recherche = true;
    rechercheSaisie()
}

function rechercheSaisie()
{
    console.log('rentre dans la fonction rechercheSaisie')
    if(($("#recherche").val().length>2) || (recherche == true))
    {
        recherche=$("#recherche").val();
        console.log("valeur de #recherche dans le if => "+recherche)
        $.ajax(
            {
                    url:"../Controller/affichageGSM.php",
                    type:"POST",
                    data:
                        {
                            rechercheGSM:$("#recherche").val()
                        },

                    success: function(data)
                    {
                        console.log("je suis dans le success Ajax rechercheSaisie");
                        console.log("la valeur de reponse de rechercheSaisie est "+data);
                        $("#messages").html(data);
                    },
                error: function()
                {
                    //console.log("erreur ajax");
                    $("#messages").html("La recherche n'a rien donné !!!!");
                }
                })
    }
    console.log("je sors de la fonction rechercheSaisie")

}

//fonction actif inactif
function actifInactif(id)
{
    //console.log("id gsm: "+id)
    var Id =document.getElementById("actifOuInactif").value;
    var bt =document.getElementById("btnActif"+id).value;
    //console.log("valeur bt: "+bt);

    if(bt === 'Actif')
    {
        document.getElementById('btnActif'+id).value = 'Inactif'
    }
    else
    {
        document.getElementById('btnActif'+id).value = 'Actif'
    }
    //console.log("fini le premier if else")

    //console.log("rentre dans la fonction ajax")
    let actif="";
    //console.log("valeur : "+bt);
    if(bt == 'Actif')
    {
        //console.log(bt+" du if");
         actif = 0;
    }
    else
    {
        //console.log(bt+ " du else");
        actif=1;
    }

        $.ajax(
            {
                    url:"../Controller/actifInactif.php",
                    type:"POST",
                    dataType:"json",
                    data:
                        {
                            actif:actif,
                            id:Id,
                        },
                    async:true
                })/*.done(function(data)
        {
            console.log(data+" c'est le data");
        })*/
}

(function($){

    $('.addPanier').click(function(event){
        event.preventDefault();
        $.get($(this).attr('href'),{},function(data){
            if(data.error){
                alert(data.message);
            }else{
                if(confirm(data.message + '. Voulez vous consulter votre panier ?')){
                    location.href = 'Panier.php';
                }else{
                    $('#total').empty().append(data.total);
                    $('#count').empty().append(data.count);
                }
            }
        },'json');
        return false;
    });

})(jQuery);
/*(function ($)
{
    $('.btnpanier').click(function())
    {
        $.post(('../Controller/Panier.php',id,function(data)
        {
            if(data.error)
            {
                alert(data.message);
            }
            else
            {
                if(confirm(data.message + 'Voulez vous consulter votre panier ?'))
                {
                    location.href = '../Controller/Panier.php';
                }
                else
                {
                    $('#total').empty().append(data.total);
                    $('#comter').empty().append(data.count);
                }
            }
        },'json');
        return false;
    }
})(jQuery);*/
