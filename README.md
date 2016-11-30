# Usage
``` php
use Polyu\Crm\Facebook\Facebook;
use Polyu\Crm\Facebook\FacebookPost;
use Polyu\Crm\Facebook\FacebookComment;

$fb = new Facebook('app-d', 'app-secret');
$fbPost = new FacebookPost('page-id', $fb);
$fbPost->getPosts(10); // [['message' => 'I go to school by bus', 'id' => '1xxxxx'], ...]

$fbComment = new FacebookComment($posts[0]['id'], $fb);
$fbComment->getComments(10);
```
# Create your own class
Create classes and extend **AbstractFacebookEntity**.