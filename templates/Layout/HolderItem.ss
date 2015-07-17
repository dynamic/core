<% require css('themes/simple/css/layout.css') %>
<% require css('core/css/core.css') %>
<div class="core-container content unit size3of4">
    <article>
        <h1>$Title</h1>
        <% if $Image %>
            <p class="noborder">
                <img class="lazy" data-original="$Image.PaddedImage(700,400).URL" src="core/thirdparty/lazyload/img/grey.gif"
                 width="700" height="400" alt="$Title.XML">
            </p>
        <% end_if %>
        <% if $SubTitle %><h2>$SubTitle</h2><% end_if %>
        <% if $Content %>$Content<% end_if %>
        <% if $SlideShow %>
            <div class="slideshow clearfix">
                <% include FlexSlider %>
            </div>
        <% end_if %>
        <% if $Tags %><p><% include Tags %></p><% end_if %>
    </article>
    $Form
    $CommentsForm
</div>
<aside class="core-sidebar unit size1of4 lastUnit">
    <% with $Parent %>
        <% include RssLink %>
        <% include TagList %>
    <% end_with %>
</aside>
<% require javascript('framework/thirdparty/jquery/jquery.js') %>
<% require javascript('core/thirdparty/lazyload/jquery.lazyload.min.js') %>
<% require javascript('core/javascript/lazy_init.js') %>