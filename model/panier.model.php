<?php

require_once("../core/Model.php");


class PanierModel{


    public $fournisseur;
    public array $articles=[];
    public $total=0;


     public function addArticle($article,$fournisseur,$qteAppro){
       $montantArticle=$this->montantArticle($article["prixAppro"],$qteAppro);
       $key=$this->articleExiste($article);
       if( $key!=-1){
          $this->articles[$key]["qteAppro"]+=$qteAppro;
          $this->articles[$key]["montantArticle"]+=$montantArticle;
       }else{
        $article["qteAppro"]=$qteAppro;
        $article["montantArticle"]=$montantArticle;
        $this->articles[]=$article;   
       }
       $this->fournisseur=$fournisseur;
       $this->total=$this->total+=$montantArticle;
       
}


public function montantArticle($prix,$qteAppro){
    return $prix*$qteAppro;
}

public function articleExiste($article):int{
   foreach($this->articles as $key => $value){
    if($value["id"]==$article["id"] ){
        return $key;
    }
   }
   return -1;
}

public function clear($article):void{
    $this->articles[]=0;
    $this->total=0;
    $this->fournisseur=null;
}
}
?>