<div class="twelve columns alpha typography">
    <article>
		$Breadcrumbs
        <h2>$Title</h2>
		<% if $SubTitle %><h3>$SubTitle</h3><% end_if %>

        <div class="content typography">$Content</div>

		<% if $Results %>
            <header class="resultsHeader">
				<% if $Filter %><h3 class="pull-left">$Filter</h3><% end_if %>
                <p class="pull-right">Displaying $Results.FirstItem - $Results.LastItem of $Results.Count</p>
            </header>

			<% loop $Results %>
                <article class="$EvenOdd clearfix half-bottom">
					<h3>$Title</h3>
					$Summary
                </article>
			<% end_loop %>

			<% with $Results %>
				<% include Pagination %>
			<% end_with %>

		<% end_if %>

    </article>

</div>
<div class="four columns sidebar omega">
    <aside>

		$AdvSearchForm

		<% include SideBar %>

		<% include TagList %>
    </aside>
</div>