<?php
class Video {
    public $url;
    public $comp_name;
    public $prev;
    public $author;
    public $video_id;

    function __construct($row) {
        $this->url = $row['url'];
        $this->comp_name = $row['comp_name'];
        $this->id = $row['id'];
        $this->title = $row['title'];

        parse_str( parse_url( $this->url, PHP_URL_QUERY ), $my_array_of_vars );
        if(isset($my_array_of_vars['v'])) {
            $this->video_id = $my_array_of_vars['v'];
        } else {
            $splitted_str = explode('/', $this->url);
            $this->video_id = $splitted_str[count($splitted_str)-1];
        }
    }
}
?>