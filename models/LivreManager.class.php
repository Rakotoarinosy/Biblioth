<?php 
require_once "Model.class.php";
require_once "Livre.class.php";

class LivreManager extends Model{
    private $livres;//tableau de Livre
    
    public function ajoutLivre($livre){
        $this->livres[] = $livre;
    }

    public function getLivres(){
        return $this->livres;
    }
    
    public function chargementLivres(){
        $req = $this->getBdd()->prepare("SELECT * FROM livres");
        $req->execute();
        $mesLivres = $req->fetchAll(PDO::FETCH_ASSOC);
        $req -> closeCursor();

        foreach($mesLivres as $livre){
            $l = new Livre ($livre['id'],$livre['titre'],$livre['nbPages'],$livre['image']);
            $this->ajoutLivre($l);
        }
    }

    public function getLivreById($id){
        $id = intval($id);
        for ($i=0; $i < count($this->livres);$i++){
            if($this->livres[$i]->getId() === $id){
                return $this->livres[$i];
            }
        }
        throw   new Exception ("Le livre n'existe pas");
    }
    public function ajoutLivreBd($titre,$nbPages,$image){
        $req = "
        INSERT INTO livres (titre,nbPages,image)
        values (:titre,:nbPages,:image)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindvalue(":titre",$titre,PDO::PARAM_STR);
        $stmt->bindvalue(":nbPages",$nbPages,PDO::PARAM_INT);
        $stmt->bindvalue(":image",$image,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $livre = new Livre($this->getBdd()->lastInsertId(),$titre,$nbPages,$image);
            $this->ajoutLivre($livre);
        }
    }

    public function suppressionLivreBD($id){
        $req = "
        delete from livres WHERE id = :idLivres
        ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindvalue(":idLivres",$id,PDO::PARAM_INT);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $livre = $this->getLivreById($id);
            unset($livre);
        }
    }

    public function modificationLivreBD($id,$titre,$nbPages,$image){
        $req = "
        update livres
        set titre = :titre, nbPages = :nbPages, image = :image
        where id = :id";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindvalue(":id",$id,PDO::PARAM_INT);
        $stmt->bindvalue(":titre",$titre,PDO::PARAM_STR);
        $stmt->bindvalue(":nbPages",$nbPages,PDO::PARAM_INT);
        $stmt->bindvalue(":image",$image,PDO::PARAM_STR);
        $resultat = $stmt->execute();
        $stmt->closeCursor();

        if($resultat > 0){
            $this->getLivreById($id)->setTitre($titre);
            $this->getLivreById($id)->setnbPages($nbPages);
            $this->getLivreById($id)->setImage($image);
        }
    }
}

?>