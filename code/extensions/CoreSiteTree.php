<?php

class CoreSiteTree extends SiteTreeExtension {

	private static $db = array(
		'PageTitle' => 'Varchar(255)'
	);

	public function updateCMSFields(FieldList $fields) {

		$after = (class_exists('BlogPost') && $this->owner->ClassName == 'BlogPost') ? 'Title' : 'MenuTitle';

		$fields->insertAfter(TextField::create('SubTitle', 'Sub Title'), $after);

		$fields->removeByName('Metadata');
		$meta = ToggleCompositeField::create('Metadata', _t('SiteTree.MetadataToggle', 'Metadata'),
				array(
						$metaTitle = new TextField('PageTitle', $this->owner->fieldLabel('Page Title')),
						$metaFieldDesc = new TextareaField("MetaDescription", $this->owner->fieldLabel('MetaDescription')),
						$metaFieldExtra = new TextareaField("ExtraMeta",$this->owner->fieldLabel('ExtraMeta'))
				)
		)->setHeadingLevel(4);
		// Help text for MetaData on page content editor
		$metaFieldDesc
				->setRightTitle(
						_t(
								'SiteTree.METADESCHELP',
								"Search engines use this content for displaying search results (although it will not influence their ranking)."
						)
				)
				->addExtraClass('help');
		$metaFieldExtra
				->setRightTitle(
						_t(
								'SiteTree.METAEXTRAHELP',
								"HTML tags for additional meta information. For example &lt;meta name=\"customName\" content=\"your custom content here\" /&gt;"
						)
				)
				->addExtraClass('help');
		$fields->addFieldToTab('Root.Main', $meta);
	}

	public function MenuChildren() {
		return $this->owner->Children()->filter('ShowInMenus', true);
	}

}