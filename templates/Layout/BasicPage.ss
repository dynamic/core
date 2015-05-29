<% include SideBar %>
<div class="content unit size3of4 lastUnit">
    <article>
        <% if $Image %><p>$Image.PaddedImage(800,550)</p><% end_if %>

        <h1>$Title</h1>
        <% if $SubTitle %><h3>$SubTitle</h3><% end_if %>
        <div class="content">$Content</div>
        <div class="content typography">$Content</div>
		
	</article>
			
	$Form
	$PageComments
			
</div>
