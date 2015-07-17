<% require css('themes/simple/css/layout.css') %>
<% require css('core/css/core.css') %>
<% include SideBar %>
<div class="content-container content unit size3of4">
    <h1>$Title</h1>
    <div class="unit size1of1">
        <% if $SlideShow %>
            <div class="slideshow">
                <% include FlexSlider %>
            </div>
        <% end_if %>
    </div>

    <div class="unit size1of1">
        <% if $SubTitle %><h2>$SubTitle</h2><% end_if %>
        <% if $Content %>$Content<% end_if %>
    </div>

    <% if $SpiffList %>
        <% loop $SpiffList.Limit(3) %>
            <div class="unit size1of3 <% if $Last %>lastUnit<% end_if %> spiff">
                $Me
            </div>
        <% end_loop %>
    <% end_if %>

</div>
<% require javascript('framework/thirdparty/jquery/jquery.js') %>
<% require javascript('flexslider/thirdparty/flexslider/jquery.flexslider-min.js') %>