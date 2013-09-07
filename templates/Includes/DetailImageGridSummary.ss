<a href="$Link" class="touch"></a>
<div class="overlay"></div>
<div class="centered">
    <a href="$Link" class="touch">
		<h4>Learn about</h4>
        <h3><% if PreviewHeadline %>$PreviewHeadline<% end_if %></h3>
    </a>
</div>
<% if PreviewThumb %>
	<a href="$Link" class="touch"><img src="$PreviewThumb.CroppedImage(220,220).URL" alt="$Title.XML" class="scale-with-grid"></a>
<% end_if %>
