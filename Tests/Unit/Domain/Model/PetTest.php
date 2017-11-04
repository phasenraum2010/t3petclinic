<?php
namespace ThomasWoehlke\T3petclinic\Tests\Unit\Domain\Model;

/**
 * Test case.
 *
 * @author Thomas Woehlke <thomas@woehlke.org>
 */
class PetTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \ThomasWoehlke\T3petclinic\Domain\Model\Pet
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = new \ThomasWoehlke\T3petclinic\Domain\Model\Pet();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function getNameReturnsInitialValueForString()
    {
        self::assertSame(
            '',
            $this->subject->getName()
        );
    }

    /**
     * @test
     */
    public function setNameForStringSetsName()
    {
        $this->subject->setName('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'name',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getBirthdateReturnsInitialValueForDateTime()
    {
        self::assertEquals(
            null,
            $this->subject->getBirthdate()
        );
    }

    /**
     * @test
     */
    public function setBirthdateForDateTimeSetsBirthdate()
    {
        $dateTimeFixture = new \DateTime();
        $this->subject->setBirthdate($dateTimeFixture);

        self::assertAttributeEquals(
            $dateTimeFixture,
            'birthdate',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getOwnerReturnsInitialValueForOwner()
    {
        self::assertEquals(
            null,
            $this->subject->getOwner()
        );
    }

    /**
     * @test
     */
    public function setOwnerForOwnerSetsOwner()
    {
        $ownerFixture = new \ThomasWoehlke\T3petclinic\Domain\Model\Owner();
        $this->subject->setOwner($ownerFixture);

        self::assertAttributeEquals(
            $ownerFixture,
            'owner',
            $this->subject
        );
    }

    /**
     * @test
     */
    public function getPetTypeReturnsInitialValueForPetType()
    {
        self::assertEquals(
            null,
            $this->subject->getPetType()
        );
    }

    /**
     * @test
     */
    public function setPetTypeForPetTypeSetsPetType()
    {
        $petTypeFixture = new \ThomasWoehlke\T3petclinic\Domain\Model\PetType();
        $this->subject->setPetType($petTypeFixture);

        self::assertAttributeEquals(
            $petTypeFixture,
            'petType',
            $this->subject
        );
    }
}
