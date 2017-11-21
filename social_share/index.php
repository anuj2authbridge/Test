<html>
<head><title>Loader</title>

<script type="text/javascript" src="jquery-2.2.3.min.js"></script>
<style>
#overlay {
    position: fixed; /* Sit on top of the page content */
   
    width: 100%; /* Full width (cover the whole page) */
    height: 100%; /* Full height (cover the whole page) */
    top: 0; 
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0,0,0,0.5); /* Black background with opacity */
    z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
    cursor: pointer; /* Add a pointer on hover */
}
</style>
</head>
<body>
<div id="overlay" align="center"> <img src="ajax-loader1.gif" alt="Loading" /></div>
<div>
<ul class="socail-share">
<li>

<a target="_blank" OnClick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=250'); return false;" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fyoursite.com%2Fem%2F4881-01%2F&picture=http%3A%2F%2Fyoursite.com%2Fem%2F4881-01%2Fimg%2Fmercedes-maybach.png&title=title+here&description=Your+description">
 <img src="https://www.newstracklive.com/assets/images/icon/fb.png" alt="Facebook" with="32">
</a>


<a href="https://www.facebook.com/sharer.php?u=https://www.newstracklive.com/news/wifi-bins-will-sell-cheap-data-sub-economy-news-creur-1176941-1.html" class="linkShare" target="_blank"><img src="https://www.newstracklive.com/assets/images/icon/fb.png" alt="Facebook" with="32"></a>


</li>

<li>
<a href="https://twitter.com/share?url=https://www.newstracklive.com/news/wifi-bins-will-sell-cheap-data-sub-economy-news-creur-1176941-1.html" class="linkShare" target="_blank" OnClick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=250'); return false;"><img src="https://www.newstracklive.com/assets/images/icon/tw.png" alt="twitter" with="32"></a>
</li>

<li><a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=https://www.newstracklive.com/news/wifi-bins-will-sell-cheap-data-sub-economy-news-creur-1176941-1.html" class="linkShare" target="_blank" OnClick="window.open(this.href,'targetWindow','toolbar=no,location=0,status=no,menubar=no,scrollbars=yes,resizable=yes,width=600,height=250'); return false;"><img src="https://www.newstracklive.com/assets/images/icon/in.png" alt="linkedin" with="32"></a></li>

<li><a href="https://plus.google.com/share?url=https://www.newstracklive.com/news/wifi-bins-will-sell-cheap-data-sub-economy-news-creur-1176941-1.html" class="linkShare" target="_blank"><img src="https://www.newstracklive.com/assets/images/icon/gp.png" alt="G+" with="32"></a></li>

<li><a href="https://www.newstracklive.com/news/wifi-bins-will-sell-cheap-data-sub-economy-news-creur-1176941-1.html" data-image="https://www.newstracklive.com/uploads/business-news/economy-news/Nov/21/big_thumb/bins_5a13f1aacb357.jpg" data-desc="" class="linkPinIt"><img src="https://www.newstracklive.com/assets/images/icon/pin.png" alt="pin" with="32"></a></li>
</ul>
<form>
<input type="text" name="name" />
<input type="submit" name="save" />
</form>
</div>
</body>
<script>
$(window).load(function(){ 
 //PAGE IS FULLY LOADED 
 //FADE OUT YOUR OVERLAYING DIV
 $('#overlay').fadeOut();
});
</script>
</html>
