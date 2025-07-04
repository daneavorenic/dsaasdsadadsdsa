<script type="text/jаvascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
<script type="text/jаvascript" src="jQuery.radmenu.min.js"></script>
<script type="text/jаvascript">
jQuery(document).ready(function() {
    
    var posc = $("#radial_container").position();
    var left = $(window).width() / 2;
    
    if ($.browser.opera) {
        $("#big").css({"left": left - 122, "top": posc.top - 13});
    } else {
        $("#big").css({"left": left - 122, "top": posc.top + 3});
    }
    
    jQuery("#radial_container").radmenu({
        listClass: 'list', 
        itemClass: 'item', 
        radius: 220, 
        animSpeed:800, 
        centerX: 0, 
        centerY: 150,
        selectEvent: "click",
        onselect: function($selected) {
            var imgindex = $selected.index() + 1;
            $(".my_class").removeClass("selected");
            $(".img"+imgindex).addClass("selected");
            $("#big").css("background-image", "url('images/"+imgindex+".jpg')");
        },
        angleOffset: 0
    });
    jQuery("#radial_container").radmenu("show");
});
</script>