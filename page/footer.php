</section><!--end .section_3-->
</div><!--end .content-main-->
    <footer>
        <div class="main-footer">
            <div class="footer-info">
                <div class="logo-footer">
                    <a href="javascript:void(0);"><img src="/frontend/images/logo-footer.png" alt=""></a>
                </div>
                <div class="footer-content">
                    <p>
                        <a href="" target="">Terms of Use</a>
                        <span class="line"></span>
                        <a href="" target="">Payment</a>
                        <span class="line"></span>
                        <a class="frm-payment" href="/nap-the">Account Security</a>
                    </p>
                    <p>Copyright © zPlay.eu - 2019. All rights reserved.</p>
                    <p>ARMORED KINGDOM 2019</p>
                </div>
            </div>
        </div>
    </footer>

</div><!--end wrap-->

<div class="popup-w hidden popup_panel"> </div>
<div class="popup hidden">
    <!-- <div id="popup_message">Please login to receive a gift code.</div> -->
    <div id="popup_message"><label id="label"></label></div>
    <p>See guide <a href="/gift-code">Here</a></p>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script type="text/javascript" src="/frontend/js/jquery.popup.min.js"></script>
<script type="text/javascript" src="/frontend/fancybox/source/jquery.fancybox.pack.js"></script>
<script type="text/javascript" src="/frontend/js/config_popup.js"></script>
<script type="text/javascript" src="/frontend/js/swiper.min.js"></script>
<script type="text/javascript" src="/frontend/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

<script type="text/javascript" src="/frontend/fancybox/source/helpers/jquery.fancybox-buttons.js"></script>
<script type="text/javascript" src="/frontend/fancybox/source/helpers/jquery.fancybox-media.js"></script>
<script type="text/javascript" src="/frontend/fancybox/source/helpers/jquery.fancybox-thumbs.js"></script>

<script type="text/javascript" src="/frontend/js/frontend.js"></script>
<script type="text/javascript" src="/frontend/js/front-end.js"></script>
<script type="text/javascript" src="/frontend/js/script.js"></script>
<script type="text/javascript" src="/frontend/js/account.js"></script>

<script type="text/javascript">
    var root = "/";
    var user_login = "<?php echo $_SESSION['username'];?>";
    var uri = "";
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.3";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<script type="text/javascript" charset="utf-8" async defer>
    $(document).ready(function(){
        setTimeout(function(){openCloseBalon();},10000);
    });

    function openCloseBalon(){
        $('.balon').toggleClass('mini');
    }

    function hideBalon(){
        $('.balon').addClass('hide');
    }
   
</script>

</body>
</html>
