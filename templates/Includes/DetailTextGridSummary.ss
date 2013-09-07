<h3 class="detail-subhead">
	<a href="$Link">$PreviewHeadline</a>
</h3>
<% if PreviewThumb %>
	<a href="$Link" class="touch"><img src="$PreviewThumb.CroppedImage(220,220).URL" alt="$Title.XML" class="scale-with-grid"></a>
<% end_if %>
<% if Abstract %>$Abstract<br><% end_if %>
<p><a href="$Link">Read More</a></p>