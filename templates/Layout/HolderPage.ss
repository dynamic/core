<div class="twelve columns alpha typography">
	<article>
		$Breadcrumbs
		<h2>$Title</h2>
		<% if $SubTitle %><h3>$SubTitle</h3><% end_if %>
		
		<div class="content typography">$Content</div>
		
		<header class="row resultsHeader">
			<% if $Message %><h4>$Message</h4><% end_if %>
			<!--<p class="pull-right">Displaying $Items.FirstItem - $Items.LastItem of $Items.Count</p>-->
		</header>
	
		<% if Items %>	
		
			<% loop Items %>
				<div class="row $EvenOdd clearfix">
					<section> 
						$Summary
					</section>
				</div>
			<% end_loop %>

			<% with Items %>
				<% include Pagination %>
			<% end_with %>

		<% else %>
		
			<p>No entries</p>
		
		<% end_if %>
		
	</article>
	
</div>
<div class="four columns sidebar omega">
	<aside>
		
		<% include SideBar %>
		
		<% include TagList %>
	</aside>
</div>