<?php
class Article {
    public $id;
    public $title;
    public $body;
    public $author;
    public $date;
    public $pic;

    function __construct($row) {
        $this->id = $row['id'];
        $this->title = $row['title'];
        $this->body =  $row['body'];
        $this->author = $row['author'];
        $this->date = $row['date'];
        $this->pic =  "article_pics/" . $row['id'] . ".png";
    }
}
?>