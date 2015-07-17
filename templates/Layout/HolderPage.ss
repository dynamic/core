<% require css('themes/simple/css/layout.css') %>
<% require css('core/css/core.css') %>
<div class="core-container content unit size3of4">
    <article>
        <h1>$Title</h1>
        <% if $SubTitle %><h3>$SubTitle</h3><% end_if %>
        <div class="content">$Content</div>
    </article>

    <% if $Message %><h4>$Message</h4><% end_if %>

    <% if $Items %>
        <% loop $Items %>
            $Summary
        <% end_loop %>

        <% with $Items %>
            <% include Pagination %>
        <% end_with %>
    <% else %>
        <p>No entries</p>
    <% end_if %>

    $Form
    $CommentsForm
</div>
<aside class="core-sidebar unit size1of4">
    <% include RssLink %>
    <% include TagList %>
</aside>