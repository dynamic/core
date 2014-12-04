<?php

/**
 * A simple extension to dropdown field, pre-configured to list states.
 *
 */
class StateDropdownField extends DropdownField {

	/**
	 * Should we default the dropdown to the region determined from the user's locale?
	 * @var bool
	 */
	//private static $default_to_locale = true;

    public static $source = array(
        'AL'=>"Alabama",
        'AK'=>"Alaska",
        'AZ'=>"Arizona",
        'AR'=>"Arkansas",
        'CA'=>"California",
        'CO'=>"Colorado",
        'CT'=>"Connecticut",
        'DE'=>"Delaware",
        'DC'=>"District Of Columbia",
        'FL'=>"Florida",
        'GA'=>"Georgia",
        'HI'=>"Hawaii",
        'ID'=>"Idaho",
        'IL'=>"Illinois",
        'IN'=>"Indiana",
        'IA'=>"Iowa",
        'KS'=>"Kansas",
        'KY'=>"Kentucky",
        'LA'=>"Louisiana",
        'ME'=>"Maine",
        'MD'=>"Maryland",
        'MA'=>"Massachusetts",
        'MI'=>"Michigan",
        'MN'=>"Minnesota",
        'MS'=>"Mississippi",
        'MO'=>"Missouri",
        'MT'=>"Montana",
        'NE'=>"Nebraska",
        'NV'=>"Nevada",
        'NH'=>"New Hampshire",
        'NJ'=>"New Jersey",
        'NM'=>"New Mexico",
        'NY'=>"New York",
        'NC'=>"North Carolina",
        'ND'=>"North Dakota",
        'OH'=>"Ohio",
        'OK'=>"Oklahoma",
        'OR'=>"Oregon",
        'PA'=>"Pennsylvania",
        'RI'=>"Rhode Island",
        'SC'=>"South Carolina",
        'SD'=>"South Dakota",
        'TN'=>"Tennessee",
        'TX'=>"Texas",
        'UT'=>"Utah",
        'VT'=>"Vermont",
        'VA'=>"Virginia",
        'WA'=>"Washington",
        'WV'=>"West Virginia",
        'WI'=>"Wisconsin",
        'WY'=>"Wyoming",
        '-' => '-----',
        'AB' => 'Alberta',
        'BC' => 'British Columbia',
        'MB' => 'Manitoba',
        'NB' => 'New Brunswick',
        'NL' => 'Newfoundland and Labrador',
        'NS' => 'Nova Scotia',
        'ON' => 'Ontario',
        'PE' => 'Prince Edward Island',
        'QC' => 'Quebec',
        'SK' => 'Saskatchewan'
    );

	/**
	 * The region code to default to if default_to_locale is set to false, or we can't determine a region from a locale
	 *  @var string
	 */
	//private static $default_state = 'WI';

	protected $extraClasses = array('dropdown');

	/**
	 * Get the locale of the Member, or if we're not logged in or don't have a locale, use the default one
	 * @return string
	 */
	/*protected function locale() {
		if (($member = Member::currentUser()) && $member->Locale) return $member->Locale;
		return i18n::get_locale();
	}*/

	public function __construct($name, $title = null, $source = null, $value = "", $form=null) {
		if(!is_array($source)) {
			// Get a list of countries from Zend
			$source = self::$source;
		}

		parent::__construct($name, ($title===null) ? $name : $title, $source, $value, $form);
	}

	public function Field($properties = array()) {
		$source = $this->getSource();

		if (!$this->value || !isset($source[$this->value])) {
			$this->value = $this->config()->default_state;
		}

		return parent::Field();
	}
}
