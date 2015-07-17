<% require css('flexslider/thirdparty/flexslider/flexslider.css') %>
<% require css('flexslider/css/silverstripe-flexslider.css') %>
<% if $SlideShow %>
<div class="flexslider">
    <ul class="slides">
    	<% loop $SlideShow %>
            <li class="line">
                <div class="unit size3of5 slide">
                    <% if $PageLink %><a href="$PageLink.Link" title="$PageLink.MenuTitle.XML"><% end_if %>
                    <% if $Image %>
                        <img src="$Slide.URL"  alt="$Name.XML" class="slide">
                    <% end_if %>
                    <% if $PageLink %></a><% end_if %>
                </div>
                <div class="unit size2of5 lastUnit slide">
                    <h2>$Name</h2>
                    <% if $Description %>
                        <p>$Description</p>
                    <% end_if %>
                    <% if PageLink %>
                        <p><button onclick="location.href='{$PageLink.Link}'">Learn More</button></p>
                    <% end_if %>
                </div>
            </li>
        <% end_loop %>
    </ul>
</div>
<% end_if %>
<% require javascript('framework/thirdparty/jquery/jquery.js') %>
<% require javascript('flexslider/thirdparty/flexslider/jquery.flexslider-min.js') %>