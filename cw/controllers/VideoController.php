<?php
include "./models/Video.php";

class VideoController {
    private $dbConnection;

    function __construct() {
        include "includes/db.php";
        $this->dbConnection = $connection;
    }

    function getVideos($desc_limit = -1) {
        if($desc_limit == -1) {
            $qry_get_videos = "SELECT * FROM cw_videos;";
        } else {
            $qry_get_videos = "SELECT * FROM cw_videos ORDER BY Date_of_creation DESC LIMIT $desc_limit;";

        }
        $do_get_videos = mysqli_query($this->dbConnection, $qry_get_videos);
        if($do_get_videos) {
            $videos = array();
            while ($row = mysqli_fetch_assoc($do_get_videos)) {
                $video = new Video($row);
                array_push($videos, $video);
            }
            return $videos;
        } else {
            echo mysqli_error($this->dbConnection);
            return array();
        }
    }

    function getVideosSearch($search_query) {
        $qry_get_videos = "SELECT * FROM cw_videos WHERE title LIKE '%$search_query%';";
        $do_get_videos = mysqli_query($this->dbConnection, $qry_get_videos);
        if($do_get_videos) {
            $videos = array();
            while ($row = mysqli_fetch_assoc($do_get_videos)) {
                $video = new Video($row);
                array_push($videos, $video);
            }
            return $videos;
        } else {
            echo mysqli_error($this->dbConnection);
            return array();
        }
    }
    
    function getVideoById($id) {
        $get_video_data = "SELECT * FROM cw_videos WHERE id = '$id'";
        $do_get_video_data = mysqli_query($this->dbConnection, $get_video_data);
    
        if ($row = mysqli_fetch_assoc($do_get_video_data)) {
            return new Video($row);
        } else {
            echo mysqli_error($this->dbConnection);
        }
    }
}
?>