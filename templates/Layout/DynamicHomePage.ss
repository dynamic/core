<% require css('themes/simple/css/layout.css') %>
<% require css('core/css/core.css') %>
<div class="content">
    <div class="line size1of1">
        <% if $SlideShow %>
            <div class="slideshow">
                <% include FlexSliderHomePage %>
            </div>
        <% end_if %>
    </div>
    <div class="line">
        <div class="unit size1of1">
            <h1>$Title</h1>
            <% if $SubTitle %><h3>$SubTitle</h3><% end_if %>
            <% if $Content %>$Content<% end_if %>
        </div>
    </div>
    <div class="line">
        <% if $SpiffList %>
            <% loop $SpiffList.Limit(4) %>
                <div class="unit size1of4 <% if $Last %>lastUnit<% end_if %> spiff">
                    $Me
                </div>
            <% end_loop %>
        <% end_if %>
    </div>
</div>
