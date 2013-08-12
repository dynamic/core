<div class="row">
	$Breadcrumbs
</div>
<div class="twelve columns alpha">
	<article>
		<h2>$Title</h2>
		
		<% if Image %><p class="half-bottom">$Image.LargePadded(600,400)</p><% end_if %>
		
		<% if SubTitle %><h3>$SubTitle</h3><% end_if %>
		
		<div class="toolbar">
			<% include ShareThis %>
		</div>
		
		<div class="typography">
			$Content
		</div>
		
		<% if SlideShow %>
			<div class="slideshow clearfix">
				<% include FlexSlider %>
			</div>
		<% end_if %>
		
		<% if Tags %><p><% include Tags %></p><% end_if %>
		
	</article>
			
	$Form
	$PageComments
			
</div>
<div class="four columns sidebar omega">
	<aside>
		<% include SideBar %>
		
		<% with Parent %>
			<% include TagList %>
		<% end_with %>
	</aside>
</div>