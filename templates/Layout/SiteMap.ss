<% include SideBar %>
<div class="content-container unit size3of4 lastUnit">
    <article>
        <h1>$Title</h1>
        <% if $Content %>$Content<% end_if %>

        <% if $Sitemap %>
            <div id="Sitemap">$Sitemap</div>
        <% end_if %>
    </article>
    $Form
    $CommentsForm
</div>