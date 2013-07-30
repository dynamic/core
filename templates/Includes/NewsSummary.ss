<% if PreviewThumb %>
	<div class="float-left">$PreviewThumb.Thumb</div>
<% end_if %>
<header>
	<h3><a href="$Link">$Title</a></h3>
</header>
<% if DateAuthored %>$DateAuthored.NiceUS<% end_if %>
<% if Abstract %>
	<p>$Abstract.LimitWordCount</p>
<% else %>
	<p>$Content.LimitWordCount</p>
<% end_if %>
<p>
	<% if Category %>
		<a class="label label-inverse" href="$Category.Link">$Category.Title</a>
	<% end_if %> 
	<time datetime="$Date">$Date.niceUS</time>
</p>