<?php
include '../../inc/config.php'; 

$queryStr = parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY);
$articleID = base64_decode($queryStr);

$article = CallAPI("GET", "https://classaction.zendesk.com/api/v2/help_center/articles/" . $articleID . ".json", false, array(
  'Authorization: Basic amVyZW1pYWhAY2xhc3NhY3Rpb25hcHAuY29tL3Rva2VuOnc3eUFnR1NVUUpJRVhnM004bzdIeHRQRGhlSTI3Mjc2b0dDSXFMNFo='
));

$json = json_decode($article);

$authorData = CallAPI("GET", "https://classaction.zendesk.com/api/v2/users/" . $json->article->author_id . ".json", false, array(
    'Authorization: Basic amVyZW1pYWhAY2xhc3NhY3Rpb25hcHAuY29tL3Rva2VuOnc3eUFnR1NVUUpJRVhnM004bzdIeHRQRGhlSTI3Mjc2b0dDSXFMNFo='
  ));

$authorJson = json_decode($authorData);
$postDate = date_create($json->article->updated_at);

$commentsData = CallAPI("GET", "https://classaction.zendesk.com/api/v2/help_center/articles/" . $articleID . "/comments.json", false, array(
    'Authorization: Basic amVyZW1pYWhAY2xhc3NhY3Rpb25hcHAuY29tL3Rva2VuOnc3eUFnR1NVUUpJRVhnM004bzdIeHRQRGhlSTI3Mjc2b0dDSXFMNFo='
  ));

$commentsJson = json_decode($commentsData);

//var_dump($json);

include ROOT . '/template_start.php'; 
include ROOT . '/page_head.php'; 
?>

<section class="site-section site-section-light site-section-top themed-background-default">
  <div class="container">
    <h1 class="text-center animation-slideDown"><strong>Our Blog</strong></h1>
    <h2 class="h3 text-center animation-slideUp">Learn more about class actions and how we can help!</h2>
  </div>
</section>
<section class="site-content site-section">
    <div class="faq-post container">
        <div class="mt-neg20">
            <div class="col-md-10 col-md-offset-1 pl0">    
                <a href="/faq/">Back to FAQ's</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-md-offset-1 site-block">
                <h2 class="text-theme-dark-navy"><strong><?= $json->article->title ?></strong></h2>
                <img src="<?= $authorJson->user->photo->content_url ?>" alt="Author" class="avatar img-circle animation-fadeIn360">
                <?= $authorJson->user->name ?> on <?= date_format($postDate, 'M j, Y g:i a') ?>
            </div>
        </div>
        <div class="row mt-neg20">
            <div class="col-md-10 col-md-offset-1 site-block">
                <article>
                    <?= $json->article->body ?>
                </article>
            </div>
        </div>
        <hr>
        <div class="row feedbackRow">
            <div id="feedbackBtns" class="col-md-10 col-md-offset-1 site-block text-center">
                <span class="text-primary"><strong>Was this article helpful?</strong></span>
                <br />
                <a id="articleHelpfulYes" href="javascript:void(0)" class="btn btn-sm btn-primary">Yes</a>
                <a id="articleHelpfulNo" href="javascript:void(0)" class="btn btn-sm btn-primary ml10">No</a>
                <input type="hidden" id="aid" value="<?= $articleID ?>">
            </div>
            <div id="feedbackThanks" class="col-md-10 col-md-offset-1 site-block text-center hidden">
                <span class="text-primary"><strong>Thank you for your feedback!</strong></span>
            </div>
        </div>
        <hr class="feedbackRow">
    </div>
</section>
<section class="site-content site-section">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 site-block">
                <h3 class="site-heading"><strong>User</strong> Comments</h3>
                <ul class="media-list">
                    <?php
                    if(is_array($commentsJson->comments) && count($commentsJson->comments) > 0) {
                        foreach($commentsJson->comments as $comment) {

                    ?>
                    <li class="media">
                        <div class="media-body">
                            <span class="text-muted pull-right"><small><em>1 min ago</em></small></span>
                            <span class="text-primary"><strong>Ella Parker</strong></span>
                            <p>Donec lacinia venenatis metus at bibendum? In hac habitasse platea dictumst. Proin ac nibh rutrum lectus rhoncus eleifend. Sed porttitor pretium venenatis. Suspendisse potenti. Aliquam quis ligula elit. Aliquam at orci ac neque semper dictum. Sed tincidunt scelerisque ligula, et facilisis nulla hendrerit non. Suspendisse potenti. Pellentesque non accumsan orci. Praesent at lacinia dolor. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </li>
                    <?php }
                    } else { ?>
                    <li class="media">
                        <div class="media-body">
                            <h5><strong>There are no comments for this article yet.</strong></h5>
                        </div>
                    <?php } ?>
                    <li class="media">
                        <div class="media-body">
                            <form action="blog_post.php" method="post" onsubmit="return false;">
                                <textarea id="article-comment" name="article-comment" class="form-control" rows="4" placeholder="Enter your comment.."></textarea>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil"></i> Post</button>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<?php include ROOT . '/page_footer.php'; ?>
<?php include ROOT . '/template_scripts.php'; ?>
<script src="../../js/pages/faqVote.js"></script>
<?php include ROOT . '/template_end.php'; ?>