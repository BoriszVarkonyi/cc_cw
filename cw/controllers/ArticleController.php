<?php
include "./models/Article.php";

class ArticleController {
    private $dbConnection;

    function __construct() {
        include "includes/db.php";
        $this->dbConnection = $connection;
    }

    function getArticles($desc_limit = -1) {
        $articles = array();
        if($desc_limit == -1) {
            $qry_get_articles = "SELECT * FROM cw_articles ORDER BY id DESC;";
        } else {
            $qry_get_articles = "SELECT * FROM cw_articles ORDER BY id DESC LIMIT $desc_limit;";
        }
        $do_get_articles = mysqli_query($this->dbConnection, $qry_get_articles);
        if($do_get_articles) {
            while ($row = mysqli_fetch_assoc($do_get_articles)) {
                $article = new Article($row);
                array_push($articles, $article);
            }
        } else {
            echo mysqli_error($this->dbConnection);
        }
        return $articles;
    }

    function getArticlesSearch($search_query) {
        $qry_get_articles = "SELECT * FROM cw_articles WHERE title LIKE '%$search_query%';";
        $do_get_articles = mysqli_query($this->dbConnection, $qry_get_articles);
        if($do_get_articles) {
            $articles = array();
            while ($row = mysqli_fetch_assoc($do_get_articles)) {
                $article = new Article($row);
                array_push($articles, $article);
            }
            return $articles;
        } else {
            echo mysqli_error($this->dbConnection);
            return array();
        }
    }

    function getArticle($id) {
        $qry_get_article = "SELECT * FROM cw_articles WHERE id = '$id';";
        $do_get_articles = mysqli_query($this->dbConnection, $qry_get_article);
        if($do_get_articles && mysqli_num_rows($do_get_articles) != 0) {
            $row = mysqli_fetch_assoc($do_get_articles);
            return new Article($row);
        } else {
            echo mysqli_error($this->dbConnection);
        }
    }
}
?>