


</div>
<!--[if lte IE 8]>
<div class="old-browser js-old">
Вы используете старый браузер. Сайт может отображаться некорректно
</div>
<![endif]-->
<script src="//maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script src="/js/lib.js"></script>
<script src="/js/common.js"></script>
<script>
    BX.ready(function(){
        var upButton = document.querySelector('[data-role="eshopUpButton"]');
        BX.bind(upButton, "click", function(){
            var windowScroll = BX.GetWindowScrollPos();
            (new BX.easing({
                duration : 500,
                start : { scroll : windowScroll.scrollTop },
                finish : { scroll : 0 },
                transition : BX.easing.makeEaseOut(BX.easing.transitions.quart),
                step : function(state){
                    window.scrollTo(0, state.scroll);
                },
                complete: function() {
                }
            })).animate();
        })
    });  
</script>
</body>
</html>