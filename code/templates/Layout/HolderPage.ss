<div class="twelve columns alpha typography">
	<article>
		$Breadcrumbs
		<h2>$Title</h2>
		<% if $SubTitle %><h3>$SubTitle</h3><% end_if %>
		
		<div class="content typography">$Content</div>
	
		<% if Items %>			
			<header class="resultsHeader">
				<% if Filter %><h3 class="pull-left">$Filter</h3><% end_if %>
				<p class="pull-right">Displaying $Items.FirstItem - $Items.LastItem of $Items.Count</p>
			</header>
		
			<% loop Items %>
				<article class="$EvenOdd clearfix half-bottom">
					$Summary
				</article>
			<% end_loop %>

			<% with Items %>
				<% include Pagination %>
			<% end_with %>

		<% end_if %>
		
	</article>
	
</div>
<div class="four columns sidebar omega">
	<aside>
		
		<% include SideBar %>
		
		<% include TagList %>
	</aside>
</div>