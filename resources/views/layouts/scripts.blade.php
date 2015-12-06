<!-- our scripts come first because they affect primary UI features -->
<script src="{{ elixir('js/app.js') }}"></script>

<!-- third-party widgets come next because they are secondary UI features -->
<div id="fb-root"></div>
<script src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0&appId=386571371526429" id="facebook-jssdk" async defer></script>

<!-- Analytics comes last because it is not user-facing -->
<script src="https://www.google-analytics.com/analytics.js" async defer></script>
<script>
    (function (i, r) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
            (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
    })(window, 'ga');

    ga('create', 'UA-53384235-1', 'auto');
    ga('send', 'pageview');
</script>

<script>
// Adds .disabled class to navigation when not collapsed since hover is used.
$(window).resize(function(){
   console.log('resize called');
   var width = $(window).width();
   if(width > 992){
       $('.dropdown .dropdown-toggle').addClass('disabled');
   }
   else{
       $('.dropdown .dropdown-toggle').removeClass('disabled');
   }
})
.resize();//trigger the resize event on page load.
</script>
