<% if $Image %>
    <span class="noborder">
        <% if $PageLinkID %><a href="$PageLink.Link"><% end_if %>
        <% with $Image %>
            <img class="lazy" data-original="$PaddedImage(300,200).URL" src="core/thirdparty/lazyload/img/grey.gif"
                 width="300" height="200" alt="$Name.XML">
        <% end_with %>
        <% if $PageLinkID %></a><% end_if %>
    </span>
<% end_if %>
<h4>
    <% if $PageLinkID %><a href="$PageLink.Link" class="SpiffHeadline"><% end_if %>
    $Name
    <% if $PageLinkID %></a><% end_if %>
</h4>
<% if $Description %>$Description<% end_if %>
<% if $PageLink %><p><button onclick="location.href='{$PageLink.Link}'" class="learnMore">Learn More</button></p><% end_if %>
<% require javascript('framework/thirdparty/jquery/jquery.js') %>
<% require javascript('core/thirdparty/lazyload/jquery.lazyload.min.js') %>
<% require javascript('core/javascript/lazy_init.js') %>