<?php

class ArticleController{
    public function indexAction($args){
        echo "All my articles";
        echo "<br>";
        echo "<hr>";
    
        $db = new DBEngine();

        $articles = $db->getArticles();

        foreach($articles as $article){
            echo "<br>";
            echo "Titre : ".$article['title'];
            echo "<br>";
            echo "Content : ".$article['content'];
            echo "<br>";
            echo "Date : ".Helper::dateFr($article['created_at']);
            echo "<br>";
        }

    }
}