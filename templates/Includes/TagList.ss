<% if $getTags %>
	<h3>Tags</h3>
	<ul>
		<% loop $getTags %>
			<% if $RelatedPages %>
				<li><a href="$Link" title="View the $Title tag">$Title</a> ($RelatedPages)</li>
			<% end_if %>
		<% end_loop %>
	</ul>
<% end_if %>