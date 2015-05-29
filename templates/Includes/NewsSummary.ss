<div class="line">
    <div class="unit size1of5 preview">
        <% if $PreviewThumb %>
            <img class="lazy" data-original="$PreviewThumb.CroppedImage(300,300).URL" src="core/thirdparty/lazyload/img/grey.gif"
                 width="300" height="300" alt="$Title.XML">
        <% end_if %>
    </div>
    <div class="unit size4of5 preview">
        <h3><a href="$Link">$Title</a></h3>
        <p>
            <% if $DateAuthored %>$DateAuthored.NiceUS<% end_if %>
            <% if $DateAuthored && $Author %> by <% end_if %>
            <% if $Author %>$Author<% end_if %>
        </p>
        <% if $Abstract %>
            <p>$Abstract.LimitWordCount</p>
        <% else %>
            <p>$Content.LimitWordCount</p>
        <% end_if %>
        <p>
            <% if $Category %>
                <a class="label label-inverse" href="$Category.Link">$Category.Title</a>
            <% end_if %>
            <time datetime="$Date">$Date.niceUS</time>
        </p>
        <p><button onclick="location.href='$Link.XML'">Read More</button></p>
    </div>
</div>
<% require javascript('framework/thirdparty/jquery/jquery.js') %>
<% require javascript('core/thirdparty/lazyload/jquery.lazyload.min.js') %>
<% require javascript('core/javascript/lazy_init.js') %>