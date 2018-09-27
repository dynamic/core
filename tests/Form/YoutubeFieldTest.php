<?php

namespace Dynamic\Core\Test\Form;

use Dynamic\Core\Form\YoutubeField;
use SilverStripe\Control\Controller;
use SilverStripe\Dev\FunctionalTest;
use SilverStripe\Dev\TestOnly;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\Validator;
use SilverStripe\View\SSViewer;

class YoutubeFieldTest extends FunctionalTest
{
    public function testYoutubeLinkSyntax()
    {
        $this->internalCheck("https://www.youtube.com/watch?v=a6EEAF1gJ2A", "Valid, simple", true);
        $this->internalCheck("https://youtu.be/a6EEAF1gJ2A", "Valid, share link", true);
        $this->internalCheck("", "Empty link", true);
        $this->internalCheck("invalid", "Invalid, simple", false);
        $this->internalCheck("http://invalid.com/watch?PX0z-vLdc0k", "Invalid, wrong domain", false);
        $this->internalCheck("http://youtube.com", "Invalid, domain too simple", false);
        $this->internalCheck("http://youtube.com/watch", "Invalid, video specified", false);
    }

    public function internalCheck($youtubeLink, $checkText, $expectSuccess)
    {
        $field = new YoutubeField("YoutubeLink");
        $field->setValue($youtubeLink);

        $this->markTestSkipped('need to revisit');
        $val = new YoutubeFieldTest_Validator();
        try {
            $field->validate($val);
            // If we expect failure and processing gets here without an exception, the test failed
            //$this->assertTrue($expectSuccess, $checkText." (/$youtubeLink/ passed validation, but not expected to)");
        } catch (Exception $e) {
            if ($e instanceof PHPUnit_Framework_AssertionFailedError) {
                throw $e;
            } elseif ($expectSuccess) {
                $this->assertTrue(
                    false,
                    $checkText . ": " . $e->GetMessage() .
                        " (/$youtubeLink/ did not pass validation, but was expected to)"
                );
            }
        }
    }

    public function testYoutubeFieldPopulation()
    {
        $this->markTestSkipped('Need to determine which Form to use');
        $this->get('YoutubeFieldTest_Controller');
        $this->submitForm('Form_Form', null, array(
            'Youtube' => 'http://www.youtube.com/watch?v=NTDjLGdQrZk'
        ));

        $this->assertPartialMatchBySelector('p.good', array(
            'Test save was successful'
        ));
    }
}

// todo: need to revisit
/*
class YoutubeFieldTest_Validator extends Validator
{
    public function validationError($fieldName, $message, $messageType = '', $cast = '')
    {
        //throw new \Exception($message);
    }

    public function javascript()
    {
    }

    public function php($data)
    {
    }
}

class YoutubeFieldTest_Controller extends Controller implements TestOnly
{
    private static $allowed_actions = array('Form');

    private static $url_handlers = array(
        '$Action//$ID/$OtherID' => "handleAction",
    );

    protected $template = 'BlankPage';

    public function Link($action = null)
    {
        return Controller::join_links(
            'YoutubeFieldTest_Controller',
            $this->request->latestParam('Action'),
            $this->request->latestParam('ID'),
            $action
        );
    }

    public function Form()
    {
        $form = new Form(
            $this,
            'Form',
            new FieldList(
                new YoutubeField('Youtube')
            ),
            new FieldList(
                new FormAction('doSubmit')
            ),
            new RequiredFields(
                'Youtube'
            )
        );

        // Disable CSRF protection for easier form submission handling
        $form->disableSecurityToken();

        return $form;
    }

    public function doSubmit($data, $form, $request)
    {
        $form->sessionMessage('Test save was successful', 'good');
        return $this->redirectBack();
    }

    public function getViewer($action = null)
    {
        return new SSViewer('BlankPage');
    }
}
*/
