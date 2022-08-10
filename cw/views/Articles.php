<?php foreach($articles as $article) : ?>
    <div class="blog_article" onclick="location.href='article.php?id=<?php echo $article->id ?>'">
        <?php if(file_exists($article->pic)): ?>
            <img src="<?= $article->pic ?>" alt="Article image">
        <?php endif ?>
        <p class="article_title">
            <?= $article->title ?>
        </p>
        <p class="article_brief">
            <?= explode("\n", $article->body)[0] ?>
        </p>
        <div class="article_info">
            <p>
                <?= $article->date ?>
            </p>
            <p>
                <?= $article->author ?>
            </p>
        </div>
    </div>
<?php endforeach ?>
<?php if(count($articles) == 0) : ?>
    <p><?= $i18n->get('nothing_found') ?>.</p>
<?php endif ?>