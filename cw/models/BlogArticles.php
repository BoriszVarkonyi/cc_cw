<?php
class Article {
    public $id;
    public $title;
    public $body;
    public $author;
    public $date;
    public $lastEdit;
    public $pic;

    function __construct($row) {
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->body =  $row['body'];
        $this->author = $row['author'];
        $this->date = $row['date'];
        $this->lastEdit = $row['last_edit'];
        $this->pic =  "../article_pics/" . $row['id'] . ".png";
    }
}

class BlogArticles {
    public $articles = array();

    function __construct($desc_limit = -1) {
        include "db.php";

        if($desc_limit == -1) {
            $qry_get_articles = "SELECT * FROM cw_articles ORDER BY id DESC;";
        } else {
            $qry_get_articles = "SELECT * FROM cw_articles ORDER BY id DESC LIMIT $desc_limit;";
        }
        $do_get_articles = mysqli_query($connection, $qry_get_articles);
        if($do_get_articles) {
            while ($row = mysqli_fetch_assoc($do_get_articles)) {
                $article = new Article($row);
                array_push($this->articles, $article);
            }
        } else {
            echo mysqli_error($connection);
        }
    }
}
?>