<?php foreach($videos as $video) : ?>
    <div class="video_wrapper" onclick="location.href='video.php?vid_id=<?= $video->id ?>'" loading="lazy">
        <img src="http://img.youtube.com/vi/<?= $video->video_id ?>/sddefault.jpg" alt="<?= $video->title ?> thumbnail">
        <div class="video_wrapper_info">
            <p><?= $video->title ?></p>
            <p><?= $video->comp_name ?></p>
        </div>
    </div>
<?php endforeach ?>