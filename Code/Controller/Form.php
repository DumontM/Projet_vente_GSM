<?php


class Form
{
    private $myForm = '';
    /**
     * Form constructor.
     * on crée un constructeur de la classe Form
     * @param $name
     * @param $id
     * @param $methode
     * @param $action
     * @param $onSubmit
     * @param string $legende
     */
    public function __construct($name, $id, $methode, $action, $onSubmit)
    {
        $this->myForm ='<form method="'.$methode.'" name="'.$name.'" id="'.$id.'" action="'.$action.'" onsubmit="'.$onSubmit.'" >'.'<div class="form-group">';
    }

    /**
     * on créer la méthode setText
     * @param $label
     * @param $name
     * @param $value
     * @param $id
     * @param $required
     * @param $placeholder
     */
    public function setText($label, $name, $id, $value, $required=false, $placeholder)
    {
        $this->myForm .= '<label for="'.$name.'">'.$label.'</label>'.
            '<input type="text" name="'.$name.'" id="'.$id.'" value="'.$value.'" '.$this ->getRequired($required).' placeholder="'.$placeholder.'"/></br>';
    }

    public function setPassword($label, $name, $id, $value, $required=false, $placeholder)
    {
        $this->myForm .= '<label for="'.$name.'">'.$label.'</label>'.
        '<input type="text" name="'.$name.'" id="'.$id.'" value="'.$value.'" '.$this ->getRequired($required).' placeholder="'.$placeholder.'"/></br>';
    }

    /**
     * on crée une méthode setEmail
     * @param $label
     * @param $name
     * @param $id
     * @param $required
     * @param $placeholder
     * @param $value
     */
    public function setEmail($label, $name, $id, $required=false, $placeholder, $value)
    {
        $this->myForm .= '<label for="'.$name.'>"'.$label.'"</label></br>'.
            '<input type="email" name="'.$name.'" value="'.$value.'" id="'.$id.'" '.$this ->getRequired($required).' placeholder="'.$placeholder.'"/></br>';
    }

    /**
     * on crée une méthode de zone d'option
     * @param $name
     * @param $value
     * @param $id
     * @param $label
     */
    public function setradio($name, $value, $id, $label)
    {
        $this->myForm .='<input type="radio" name="'.$name.'" value="'.$value.'" id="'.$id.'">'.
            '<Label for="'.$name.'>"'.$label.'"</Label></br>';
    }

    /**
     * crée une methode setListe ouverte
     * @param $label
     * @param $name
     * @param $id
     */
    public function setListe($label, $name, $id)
    {
        $this->myForm .= '<p><label for="'.$name.'">'.$label.'</label></br>'.
                            '<select name="'.$name.'" id="'.$id.'">';
    }

    /**
     * option de la methode setListe
     * @param $value
     * @param $option
     */
    public function setListeOption($value, $option)
    {
        $this->myForm .= '<option value="'.$value.'">'.$option.'</option>';
    }

    /**
     * ferme la methode setLListe
     */
    public function closeSetListe()
    {
        $this->myForm .= '</select></p>';
    }

    /**
     * on cree une methode de recherche
     * @param $label
     * @param $value
     * @param $onkeyup
     * @param $placeholder
     */
    public function recherche($label,$name, $id, $value, $onkeyup, $placeholder)
    {
        $this->myForm .= '<label for="'.$name.'>'.$label.'</label></br>'.'<input type="search" name=""'.$name.'" id="'.$id.'" values="'.$value.'"placeholder="'.$placeholder.'" onkeyup="'.$onkeyup.'" />';
    }

    /**
     * on crée une methode cacher les informations à l'utilisateur envoyer
     * @param $label
     * @param $name
     * @param $id
     * @param $require
     * @param $type
     * @param $onblur
     * @param $value
     * @param $placeholder
     */
    public function hidden($label, $name, $id, $value)
    {
        $this->myForm .= '<label for="'.$name.'">'.$label.'</label>'.
                        '<input type="hidden" name="'.$name.'" id="'.$id.'" value="'.$value.'"/>';
    }

    /**
     * on crée une methode number
     * @param $label
     * @param $name
     * @param $id
     * @param false $required
     * @param $value
     * @param $placeholder
     */
    public function setNumber($label, $name, $id, $required=false, $value, $placeholder)
    {
        $this->myForm .= '<label for="'.$name.'">'.$label.'</label>'.
            '<input type="number" name="'.$name.'" id="'.$id.'" value="'.$value.'" '.$this ->getRequired($required).' placeholder="'.$placeholder.'" step=".01"/></br>';
    }

    /**
     * fonction ajout de fichier
     * @param $label
     * @param $name
     * @param $id
     * @param $value
     * @param false $required
     * @param $placeholder
     */
    public function setFile($label, $name, $id, $value, $required=false, $placeholder)
    {
        $this->myForm .= '<label for="'.$name.'">'.$label.'</label>'.
            '<input type="file" name="'.$name.'" id="'.$id.'" value="'.$value.'" '.$this ->getRequired($required).' placeholder="'.$placeholder.'"/></br>';
    }

    /**
     * on cree une methode image
     * @param $name
     * @param $id
     * @param $src
     * @param $alt
     * @param $height
     * @param $width
     */
    public function image($name, $id, $src, $alt, $height, $width)
    {
        $this->myForm .= '<input type="image" name="'.$name.'" id="'.$id.'" src="'.$src.'" alt="'.$alt.' " height="'.$height.'" width="'.$width.'"><br>';
    }

    /**
     * on cree une methode de button
     * @param $class
     * @param $dataToggle
     * @param $dataTarget
     * @param $name
     */
    public function button($class, $name, $id, $onclick, $dataToggle, $dataTarget, $btnName)
    {
        $this->myForm .= '<button type="button" class="'.$class.'" name="'.$name.'" id="'.$id.'" onclick="'.$onclick.'" data-toggle="'.$dataToggle.'" data-target="'.$dataTarget.'">'.$btnName.'</button>';
    }


    /**
     * on crée une méthode setSubmit
     * @param $name
     * @param $id
     * @param $value
     */
    public function setSubmit($name, $id, $onclick, $value, $class)
    {
        $this->myForm .= '<input type="submit" name="'.$name.'" id="'.$id. '" onclick="'.$onclick.'" value="'.$value.'" class="'.$class.'"></br>';
    }

    /**
     * on crée une méthode getForm qui ferme la balise form retroune le formulaire
     */
    public function getMyFrom()
    {
        $this->myForm .= '</div></form>';
        return $this->myForm;
    }

    /**
     * on crée une méthode GetForm qui retourne la valeur required si donné ou pas
     * @param $required
     * @return string
     */
    public function getRequired($required)
    {
        if ($required == true)
        {
            return 'required';
        }
        else
        {
            return '';
        }
    }
}