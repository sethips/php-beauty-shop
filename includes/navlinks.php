<div class="content">
    <?php
        //echo $_SERVER['REQUEST_URI'];
        $links = explode("/", $_SERVER["REQUEST_URI"]);
        echo "<a href='./'>Home</a> <span> > </span>";
        for($i = 1; $i < count($links); $i++) {
            //if last link, dont make it a link
            $link = $links[$i];
            if(preg_match('/\bproduct\b/', $link)) $link = urldecode(preg_replace("/_/", " ", substr($link, 13, strlen($link)))) ;
            if($i === count($links) -1 ) echo "<span'>$link</span>";
            else echo "<a href='./$link'>$link</a><span> > </span>";
        }
    ?>
</div>