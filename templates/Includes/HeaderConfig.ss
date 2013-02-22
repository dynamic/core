<% control SiteConfig %>
	<% if TitleLogo = Logo %>
		<% if Logo %>
			<h1 class="remove-bottom">
				<a href="/">
					<img src="$Logo.SiteLogo.URL" alt="$Title.XML" width="$Logo.SiteLogo.Width" height="$Logo.SiteLogo.Height">
				</a>
			</h1>
		<% end_if %>
	<% else_if TitleLogo = Title %>
		<% if Title %><h1 class="remove-bottom"><a href="/">$Title</a></h1><% end_if %>
		<% if Tagline %><h5>$Tagline</h5><% end_if %>
		
	<% end_if %>
<% end_control %>