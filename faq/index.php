<?php
include '../inc/config.php'; 

$articles = CallAPI("GET", "https://classaction.zendesk.com/api/v2/help_center/articles.json", false, array(
  'Authorization: Basic amVyZW1pYWhAY2xhc3NhY3Rpb25hcHAuY29tL3Rva2VuOnc3eUFnR1NVUUpJRVhnM004bzdIeHRQRGhlSTI3Mjc2b0dDSXFMNFo='
));

$json = json_decode($articles);

//var_dump($json);

include '../inc/template_start.php'; 
include '../inc/page_head.php'; 
?>

<section class="site-section site-section-light site-section-top themed-background-default">
  <div class="container">
    <h1 class="text-center animation-slideDown"><strong>Our Blog</strong></h1>
    <h2 class="h3 text-center animation-slideUp">Learn more about class actions and how we can help!</h2>
  </div>
</section>
<section class="site-content site-section">
  <div class="faq container">
    <div class="row">
      <div class="col-sm-12">
        <?php 
        if(is_array($json->articles) && count($json->articles) > 0) {
          //var_dump(array_column($json->articles, 'updated_at'));
          array_multisort(array_map(function($e) {
            return is_object($e) ? $e->updated_at : $e['updated_at'];
          }, $json->articles), SORT_DESC, $json->articles);

          foreach($json->articles as $article) {
            if(!$article->draft) {
              $authorData = CallAPI("GET", "https://classaction.zendesk.com/api/v2/users/" . $article->author_id . ".json", false, array(
                'Authorization: Basic amVyZW1pYWhAY2xhc3NhY3Rpb25hcHAuY29tL3Rva2VuOnc3eUFnR1NVUUpJRVhnM004bzdIeHRQRGhlSTI3Mjc2b0dDSXFMNFo='
              ));

              $authorJson = json_decode($authorData);
              $articleID = base64_encode($article->id);
              $postDate = date_create($article->updated_at);
        ?>
        <div class="site-block mb70">
          <div class="row">
            <!--<div class="col-md-4">
              <p>
                <a href="blog_post.php">
                  <img src="/img/placeholders/photos/photo9.jpg" alt="image" class="img-responsive">
                </a>
              </p>
            </div>-->
            <div class="col-md-12">
              <h3 class="site-heading"><strong><a href="/faq/post/?<?= $articleID ?>"><?= $article->title ?></a></strong></h3>
              <p><?= mb_substr(strip_tags($article->body), 0, 350) ?><a href="/faq/post/?i=<?= $articleID ?>">... Read More</a></p>
            </div>
          </div>
          <div class="clearfix">
            <p class="pull-right">
              <a href="/faq/post/?<?= $articleID ?>" class="label label-primary p10">Read more...</a>
            </p>
            <ul class="list-inline pull-left">
              <li><i class="fa fa-calendar"></i> <?= date_format($postDate, 'M j, Y g:i a') ?></li>
              <li><img src="<?= $authorJson->user->photo->content_url ?>" alt="Author" class="avatar img-circle animation-fadeIn360"> Author: <?= $authorJson->user->name ?></li>
              <li><i class="fa fa-thumbs-o-up"></i> <strong><?= $article->vote_sum ?></strong> people found this article useful</a></li>
            </ul>
          </div>
        </div>
        <?php }
          }
        } ?>
        <!-- END Blog Post -->

        <!-- Pagination -->
        <!--<div class="text-right">
            <ul class="pagination">
                <li><a href="javascript:void(0)"><i class="fa fa-angle-left"></i></a></li>
                <li class="active"><a href="javascript:void(0)">1</a></li>
                <li><a href="javascript:void(0)">2</a></li>
                <li><a href="javascript:void(0)">3</a></li>
                <li><a href="javascript:void(0)">4</a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-angle-right"></i></a></li>
            </ul>
        </div>-->
        <!-- END Pagination -->
      </div>
    </div>
  </div>
</section>

<?php include '../inc/page_footer.php'; ?>
<?php include '../inc/template_scripts.php'; ?>
<?php include '../inc/template_end.php'; ?>