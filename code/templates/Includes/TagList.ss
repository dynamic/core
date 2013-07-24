<h4>Tags</h4>
<ul>
	<% loop getTags %>
		<% if Pages %>
			<li><a href="$Link" title="View the $Title tag">$Title</a> ($Pages.Count)</li>
		<% end_if %>
		<li>
	<% end_loop %>
</ul>