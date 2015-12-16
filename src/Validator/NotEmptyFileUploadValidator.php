<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\InputFilter\Validator;

use Zend\Validator\AbstractValidator;

/**
 * Checks if the raw input value is not an empty file input eg: no file was uploaded
 */
class NotEmptyFileUploadValidator extends AbstractValidator
{
    const INVALID = 'notEmptyInvalid';
    const IS_EMPTY = 'isEmpty';

    /**
     * @var array
     */
    protected $messageTemplates = [
        self::IS_EMPTY => "Value is required and can't be empty",
        self::INVALID => "Invalid type given. array expected",
    ];

    /**
     * {@inheritdoc}
     */
    public function isValid($value)
    {
        if (!is_array($value)) {
            $this->error(self::INVALID);
            return false;
        }

        if (isset($value['error']) && $value['error'] === UPLOAD_ERR_NO_FILE) {
            $this->error(self::IS_EMPTY);
            return false;
        }

        if (count($value) === 1 && isset($value[0])) {
            return $this->isValid($value[0]);
        }

        return true;
    }
}
