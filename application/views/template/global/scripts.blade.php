<!-- Bootstrap/Core Scripts -->
<script src="/js/jquery.js"></script>
<script src="/js/jquery-ui.js"></script>
<script src="/js/underscore.js"></script>
<script src="/js/bootstrap.js"></script>
<script src="/js/handlebars.js"></script>
<script src="/js/utils/handlebars.helpers.js"></script>
<!-- Battle.net Scripts -->
<script src="http://us.battle.net/d3/static/js/tooltips.js"></script>
<!-- D3Up Scripts -->
<script src="/js/d3up.js"></script>
<script src="/js/utils/tooltip.js"></script>
<script type="text/javascript" charset="utf-8">
$(function(){
  var hash = window.location.hash;
  hash && $('ul.nav a[href="' + hash + '"]').tab('show');
  $('html').scrollTop();

  $('.nav-tabs a').click(function (e) {
    var scrollmem = $('body').scrollTop();
    window.location.hash = this.hash;
    $('body').scrollTop(scrollmem);
    $(this).tab('show');
  });
});
</script>
<!-- The D3Up Tooltip Div -->
<div id="d3up-tooltip"></div>
<div id="d3up-tooltip-compare"></div>
@yield('scripts')