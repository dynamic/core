<% require css('themes/simple/css/layout.css') %>
<% require css('core/css/core.css') %>
<div class="content unit size3of5 core-container">
    <article>
        <h2>$Title</h2>
        <% if $SubTitle %><h3>$SubTitle</h3><% end_if %>
        <% if $Content %>$Content<% end_if %>
    </article>
    $Form
</div>
<div class="core-sidebar content unit size2of5">
    <% include CompanyInfo %>
</div>