<?php
namespace ThomasWoehlke\T3petclinic\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Thomas Woehlke <thomas@woehlke.org>
 */
class VetTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \ThomasWoehlke\T3petclinic\Domain\Model\Vet
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ThomasWoehlke\T3petclinic\Domain\Model\Vet();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getFirstNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getFirstName()
        );
    }

    /**
     * @test
     */
    public function setFirstNameForStringSetsFirstName()
    {
        $this->subject->setFirstName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'firstName',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getLastNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getLastName()
        );
    }

    /**
     * @test
     */
    public function setLastNameForStringSetsLastName()
    {
        $this->subject->setLastName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'lastName',
            $this->subject
        );
    }
}
