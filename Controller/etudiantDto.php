<?php

class EtudiantDto
{
    public $civilite;
    public $nom;
    public $prenom;
    public $email;
    public $photo = null;

    public function __construct(
        string $civilite,
        string $nom,
        string $prenom,
        string $email,
        string $photo = null,
    ) {
        $this->civilite = $civilite;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->photo = $photo;
    }

    public static function fromRequest()
    {
        return new self($_POST['civilite'], $_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['photo']);
    }
}
