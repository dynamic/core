<% if $RSSLink %>
	<h3>Subscribe</h3>
	<p><a href="$RSSLink" target="_blank">RSS Feed</a></p>
<% else_if $DefaultRSSLink %>
	<h3>Subscribe</h3>
	<p><img src="core/images/icons/rss.png"> <a href="$DefaultRSSLink" target="_blank">RSS Feed</a></p>
<% end_if %>