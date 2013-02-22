<div class="AsideBox">
    <h3>Information</h3>
	    <% with SiteConfig %>
		    $FullAddressHTML
		    
		    <% if ShowDirections %>
		    	<p>$AddressMap(180,100)</p>
		    <% end_if %>
		    
		    <% if PhoneNumber %>
		        <p>
		        	PhoneNumber:<br>
		        	<a href="tel:{$PhoneNumber}" rel="tel">$PhoneNumber</a>
		        </p>
		    <% end_if %>
		    
		    <% if Hours %>
		        <p>
		        	HOURS:<br>
		        	$Hours
		        </p>
		    <% end_if %>
	    <% end_with %>
</div>