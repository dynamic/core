<h4>Tags</h4>
<ul>
	<% loop getTags %>
		<% if RelatedPages %>
			<li><a href="$Link" title="View the $Title tag">$Title</a> ($RelatedPages.Count)</li>
		<% end_if %>
	<% end_loop %>
</ul>