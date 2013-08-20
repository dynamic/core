<div class="row">
	$Breadcrumbs
</div>
<div class="twelve columns alpha typography">
	<article>
		<h2>$Title</h2>
		<% if $SubTitle %><h3>$SubTitle</h3><% end_if %>
		<div class="content typography">$Content</div>
	</article>
		
	<% if $Message %><h4>$Message</h4><% end_if %>

	<% if Children %>	
		<% loop Children %>
			<section class="row $EvenOdd clearfix">
				<% if Summary %>
				$Summary
				<% else %>
				<h3><a href="$Link">$Title</a></h3>
				$Content.FirstParagraph(html)
				<% end_if %>
			</section>
		<% end_loop %>
	<% else %>
		<p>No entries</p>
	<% end_if %>
</div>
<div class="four columns sidebar omega">
	<aside>
		<%-- <% include RssLink %>
		<% include TagList %> --%>
	</aside>
</div>