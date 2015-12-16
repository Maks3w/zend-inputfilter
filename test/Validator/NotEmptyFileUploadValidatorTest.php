<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Zend\InputFilterTest\Validator;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\InputFilter\Validator\NotEmptyFileUploadValidator;

/**
 * @covers Zend\InputFilter\Validator\NotEmptyFileUploadValidator
 */
class NotEmptyFileUploadValidatorTest extends TestCase
{
    /**
     * @var NotEmptyFileUploadValidator
     */
    protected $validator;

    protected function setUp()
    {
        $this->validator = new NotEmptyFileUploadValidator();
    }

    /**
     * @dataProvider emptyValueProvider
     */
    public function testIsValid($value)
    {
        $this->assertFalse($this->validator->isValid($value));
    }

    /**
     * @dataProvider notEmptyValueProvider
     */
    public function testNotValid($value)
    {
        $this->assertTrue($this->validator->isValid($value));
    }

    public function emptyValueProvider()
    {
        $uploadErrNoFile = ['error' => UPLOAD_ERR_NO_FILE];

        return [
            'string' => ['file'],
            'single' => [$uploadErrNoFile],
            'multi' => [[$uploadErrNoFile]],
        ];
    }

    public function notEmptyValueProvider()
    {
        $uploadErrOk = ['error' => UPLOAD_ERR_OK];

        return [
            'empty' => [[]],
            'single' => [$uploadErrOk],
            'multi' => [[$uploadErrOk]],
        ];
    }
}
