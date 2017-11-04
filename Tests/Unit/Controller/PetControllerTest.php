<?php
namespace ThomasWoehlke\T3petclinic\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Thomas Woehlke <thomas@woehlke.org>
 */
class PetControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \ThomasWoehlke\T3petclinic\Controller\PetController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ThomasWoehlke\T3petclinic\Controller\PetController::class)
            ->setMethods(['redirect', 'forward', 'addFlashMessage'])
            ->disableOriginalConstructor()
            ->getMock();
    }

    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * @test
     */
    public function listActionFetchesAllPetsFromRepositoryAndAssignsThemToView()
    {

        $allPets = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $petRepository = $this->getMockBuilder(\ThomasWoehlke\T3petclinic\Domain\Repository\PetRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $petRepository->expects(self::once())->method('findAll')->will(self::returnValue($allPets));
        $this->inject($this->subject, 'petRepository', $petRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('pets', $allPets);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenPetToView()
    {
        $pet = new \ThomasWoehlke\T3petclinic\Domain\Model\Pet();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('pet', $pet);

        $this->subject->showAction($pet);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenPetToPetRepository()
    {
        $pet = new \ThomasWoehlke\T3petclinic\Domain\Model\Pet();

        $petRepository = $this->getMockBuilder(\ThomasWoehlke\T3petclinic\Domain\Repository\PetRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $petRepository->expects(self::once())->method('add')->with($pet);
        $this->inject($this->subject, 'petRepository', $petRepository);

        $this->subject->createAction($pet);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenPetToView()
    {
        $pet = new \ThomasWoehlke\T3petclinic\Domain\Model\Pet();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('pet', $pet);

        $this->subject->editAction($pet);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenPetInPetRepository()
    {
        $pet = new \ThomasWoehlke\T3petclinic\Domain\Model\Pet();

        $petRepository = $this->getMockBuilder(\ThomasWoehlke\T3petclinic\Domain\Repository\PetRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $petRepository->expects(self::once())->method('update')->with($pet);
        $this->inject($this->subject, 'petRepository', $petRepository);

        $this->subject->updateAction($pet);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenPetFromPetRepository()
    {
        $pet = new \ThomasWoehlke\T3petclinic\Domain\Model\Pet();

        $petRepository = $this->getMockBuilder(\ThomasWoehlke\T3petclinic\Domain\Repository\PetRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $petRepository->expects(self::once())->method('remove')->with($pet);
        $this->inject($this->subject, 'petRepository', $petRepository);

        $this->subject->deleteAction($pet);
    }
}
