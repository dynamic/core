<% with $SiteConfig %>
    <h3>$CompanyName</h3>

    <% if $PhoneNumber %><p>Phone: <a href="tel:{$PhoneNumber}" class="PhoneTracking">$PhoneNumber</a></p><% end_if %>

    $FullAddressHTML

    $AddressMap(440,300)

    <% if $Hours %>
        <p>
            HOURS:<br>
            $Hours
        </p>
    <% end_if %>
<% end_with %>