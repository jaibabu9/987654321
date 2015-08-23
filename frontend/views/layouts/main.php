<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv-v3.7.2.min.js"></script>
      <script src="js/respond-v1.4.2.min.js"></script>
    <![endif]-->
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <?php $this->head() ?>
</head>
<body  class="mediBg">
    <?php $this->beginBody() ?>

    <div class="wrap">
         <?php
         /*
            NavBar::begin([
                'brandLabel' => 'My Company',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'About', 'url' => ['/site/about']],
                ['label' => 'Contact', 'url' => ['/site/contact']],
                ['label' => 'Articles', 'url' => ['/article/create']],
                ['label' => 'Invites', 'url' => ['/invite/invitations']],
                ['label' => 'Comment', 'url' => ['/comment/create']],
                ['label' => 'Referral', 'url' => ['/referral/create']],
                ['label' => 'Profiles', 'url' => ['/profile']],
                ['label' => 'Users', 'url' => ['/user']],
                ['label' => 'Search', 'url' => ['/user/searchdoc']],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
           
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);*/
?>
   <div class="bg-sky-effect">
        <div class="moving-one"></div>
        <div class="moving-two"></div>
        <div class="moving-three"></div>
    </div> 

<header  class="bg-blue headerHgt posFixedTop " role="banner" data-ng-app="headerLogin">
    <div class="container">
        <div class="row ">    
            <!-- Header Start here -->
            <div class="col-md-5 margTop15px">
                <div class="logo">
                    <a class="" href="javascript:void(0);"><img src="images/medi-logo.png" width="150" height="40" alt="Medi-Easy"/></a>
                </div>
            </div>
            <div class="col-md-3 margTop25px ">
                <div class="userText"></div>
            </div>
            <div class="col-md-4 col-xs-12 margTop20px padLeftNull fRight moveTab">
                <div class=" form-group" id="userDisplay">
                    <input type="text" class="input-md " name="username"  data-ng-model="username" placeholder="User Name" id="userName" />
                    <input  type="reset" class="btn btn-white" id="nextBtn" value="Next" /> 
                </div>
                 <div class=" form-group displayNone" id="passDisplay">
                     <a href="#" class="fontSize11 displayBlock link-white forgotPass">Forgot Password</a>
                     <input type="password" class="input-md " data-ng-model="password" name="password" id="passWord" placeholder="Password" />
                     <input  type="reset" class="btn btn-white" value="Login" /> 
                </div>
            </div>
        </div>
    </div>

</header>




<?php

            //NavBar::end();


        ?>

      <div id="contentArea">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
     </div>
 

<!-- Footer Start here -->
<footer class="bg-blue posFixedBot">
    <div class="footer-nav">
        <div class="container">
            <div class="row ">  
                  <ul>
                    <li class="fNav-list"><a href="#" >Log In</a></li>
                    <li class="fNav-list"><a href="#" >Sign Up</a></li>
                    <li class="fNav-list"><a href="#" >About</a></li>
                    <li class="fNav-list"><a href="#">Help</a></li>
                    <li class="fNav-list"><a href="#" >Advertise</a></li>
                    <li class="fNav-list"><a href="#" >Press</a></li>
                    <li class="fNav-list"><a href="#" >Careers</a></li>
                    <li class="fNav-list"><a href="#">Privacy</a></li>
                    <li class="fNav-list"><a href="#">Terms</a></li>
                    <li class="fNav-list"><a href="#">FAQ</a></li>
                    <li class="fNav-list"><a href="#">Contact Us</a></li>
                    <li class="fNav-list"><a href="#">Developers</a></li>
                  </ul>
              </div>
        </div>
   </div>
<div class="copyRight">
<p>Copyrights &copy; 2014. Medi-Point All Rights are Reserved</p>
</div>
</footer>

    <?php $this->endBody() ?>
</div>
</body>
</html>
<?php $this->endPage() ?>
