
<!DOCTYPE html>
<html lang="zh-cn">

<!-- Mirrored from v3.bootcss.com/examples/carousel/ by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 26 Jan 2014 11:51:22 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../public/assets/docs-assets/ico/favicon.png">

    <title>留言发布系统首页</title>

    <!-- Bootstrap core CSS -->
    <link href="public/assets/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../public/assets/docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.0/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <!-- Custom styles for this template -->
    <link href="public/assets/bootstrap-3.3.5-dist/css/carousel.css" rel="stylesheet">
    <script src="public/assets/bootstrap-3.3.5-dist/js/jquery-1.11.1.min.js"></script>
</head>
<!-- NAVBAR
================================================== -->
<body>
<?php
require "./app/back/view/layout/nav.php";
?>
<!-- Carousel
================================================== -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
        <?php $i = 1; foreach ($students as  $student) : ?>
            <div class="item <?php if ($i == 1)echo "active"; $i=2; ?>">
                <img data-src="holder.js/900x500/auto/#777:#7a7a7a/text:First slide" alt="First slide">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>恭喜 <?php echo $student["name"];?>同学在本站注册成功</h1>
                        <p>成为本站第<code><?php echo $student["id"];?></code>个注册用户，拥有的特权为：免费发表修改留言，2G云盘共享空间，永久保存文件</p>
                        <p><a class="btn btn-lg btn-primary" href="register.php" role="button">注册成为本站会员</a></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>



    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div><!-- /.carousel -->



<!-- Marketing messaging and featurettes
================================================== -->
<!-- Wrap the rest of the page in another container to center all the content. -->

<div class="container marketing">
    <!-- Button trigger modal -->
    <button style="margin-bottom: 20px;" class="btn btn-primary btn-lg glyphicon glyphicon-plus center-block" data-toggle="modal" data-target="#myModal">
        发表新留言
    </button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">发表新的留言</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon">@</span>
<!--                        <input type="text" class="form-control" placeholder="发表留言">-->
                        <form action="index.php?m=back&c=MessageBoard&a=publish" method="post">
                            <textarea name="content" class="form-control input-group-lg" name="" id="" cols="50" rows="10"></textarea>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">点击发表</button></form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- Three columns of text below the carousel -->
    <div class="row">
        <?php
        foreach ($messages as  $message) : ?>
            <div class="alert alert-success">
                <h2 class="glyphicon glyphicon-star">
                    <small class="text-warning">
                        <?php $username = $message["username"];  echo $username;?>
                    </small>
                    <small class="glyphicon glyphicon-film"> </small>
                    <small class="glyphicon glyphicon-globe"> </small>
                </h2>
                <div class="alert-info">
                    <h4 style="margin-top: 20px;" class="text-info"><?php echo $message["content"];?></h4>
                    <h3>
                        <a href=""><small class="glyphicon glyphicon-comment">&nbsp;</small></a>
                        <a href=""><small class="glyphicon glyphicon-thumbs-up">  </small></a>
                    </h3>
                </div>

                <p class="text-right">用户 <?php echo $username;?>发表于：<?php echo $message["create_time"];?></p>
            </div>
        <?php endforeach; ?>

        <div class="col-lg-4">
            <img class="img-circle" data-src="holder.js/140x140" alt="Generic placeholder image">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <img class="img-circle" data-src="holder.js/140x140" alt="Generic placeholder image">
            <h2>Heading</h2>
            <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
            <img class="img-circle" data-src="holder.js/140x140" alt="Generic placeholder image">
            <h2>Heading</h2>
            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
            <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div><!-- /.col-lg-4 -->
    </div><!-- /.row -->

    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading">First featurette heading. <span class="text-muted">It'll blow your mind.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5">
            <img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-5">
            <img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
        <div class="col-md-7">
            <h2 class="featurette-heading">Oh yeah, it's that good. <span class="text-muted">See for yourself.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading">And lastly, this one. <span class="text-muted">Checkmate.</span></h2>
            <p class="lead">Donec ullamcorper nulla non metus auctor fringilla. Vestibulum id ligula porta felis euismod semper. Praesent commodo cursus magna, vel scelerisque nisl consectetur. Fusce dapibus, tellus ac cursus commodo.</p>
        </div>
        <div class="col-md-5">
            <img class="featurette-image img-responsive" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
        </div>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->


    <!-- FOOTER -->
    <footer>
        <p class="pull-right"><a href="#">Back to top</a></p>
        <p>&copy; 2013 Company, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </footer>

</div><!-- /.container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="public/assets/bootstrap-3.3.5-dist/js/jquery-1.11.1.min.js"></script>
<script src="public/assets/bootstrap-3.3.5-dist/js/bootstrap.js"></script>
<script src="public/assets/bootstrap-3.3.5-dist/js/holder.min.js"></script>
</body>

<!-- Mirrored from v3.bootcss.com/examples/carousel/ by HTTrack Website Copier/3.x [XR&CO'2013], Sun, 26 Jan 2014 11:51:22 GMT -->
</html>
