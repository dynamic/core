<% if $RSSLink %>
	<h4>Subscribe</h4>
	<p><a href="$RSSLink" target="_blank">RSS Feed</a></p>
<% else_if $DefaultRSSLink %>
	<h4>Subscribe</h4>
	<p><img src="$ThemeDir/images/icons/rss.png"> <a href="$DefaultRSSLink" target="_blank">RSS Feed</a></p>
<% end_if %>