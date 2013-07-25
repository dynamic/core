<% if Thumbnail %>
	<div class="float-left">$Thumbnail.Thumb</div>
<% end_if %>
<header>
	<h3><a href="$Link">$Title</a></h3>
</header>
<% if Abstract %>
	<p>$Abstract</p>
<% else %>
	<p>$Content.LimitWordCount</p>
<% end_if %>
<p>
	<% if Category %>
		<a class="label label-inverse" href="$Category.Link">$Category.Title</a>
	<% end_if %> 
	<time datetime="$Date">$Date.niceUS</time>
</p>