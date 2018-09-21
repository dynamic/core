<?php

namespace Dynamic\Core\Form;

use SilverStripe\Forms\TextField;

/**
 * Created by Dynamic Inc.
 * Author: nhorstmeier
 * Date: 3/14/14
 * Time: 9:11 AM
 */

class YoutubeField extends TextField
{

    public function Type()
    {
        return 'link text';
    }

    public function validate($validator)
    {

        $this->value = trim($this->value);

        $youtubePattern = '^(?:https?://)?(?:www\.)?(?:youtube\.com|youtu\.be)/watch\?v=([^&]+)';
        $youtubeSharePattern = '^(?:https?://)?(?:www\.)?(?:youtu\.be)/([^&]+)';

        $pregSafePattern = str_replace('/', '\\/', $youtubePattern);
        $pregSafeSharePattern = str_replace('/', '\\/', $youtubeSharePattern);

        if ($this->value && (
            !preg_match('/' . $pregSafePattern . '/i', $this->value) &&
            !preg_match('/' . $pregSafeSharePattern . '/i', $this->value))) {
            $validator->validationError(
                $this->name,
                _t('LinkField.VALIDATION', "Please enter a valid Youtube address"),
                'validation'
            );
            return false;
        } else {
            return true;
        }
    }
}
