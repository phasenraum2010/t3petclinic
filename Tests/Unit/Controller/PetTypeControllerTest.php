<?php
namespace ThomasWoehlke\T3petclinic\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Thomas Woehlke <thomas@woehlke.org>
 */
class PetTypeControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \ThomasWoehlke\T3petclinic\Controller\PetTypeController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ThomasWoehlke\T3petclinic\Controller\PetTypeController::class)
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
    public function listActionFetchesAllPetTypesFromRepositoryAndAssignsThemToView()
    {

        $allPetTypes = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $petTypeRepository = $this->getMockBuilder(\ThomasWoehlke\T3petclinic\Domain\Repository\PetTypeRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $petTypeRepository->expects(self::once())->method('findAll')->will(self::returnValue($allPetTypes));
        $this->inject($this->subject, 'petTypeRepository', $petTypeRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('petTypes', $allPetTypes);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenPetTypeToView()
    {
        $petType = new \ThomasWoehlke\T3petclinic\Domain\Model\PetType();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('petType', $petType);

        $this->subject->showAction($petType);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenPetTypeToPetTypeRepository()
    {
        $petType = new \ThomasWoehlke\T3petclinic\Domain\Model\PetType();

        $petTypeRepository = $this->getMockBuilder(\ThomasWoehlke\T3petclinic\Domain\Repository\PetTypeRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $petTypeRepository->expects(self::once())->method('add')->with($petType);
        $this->inject($this->subject, 'petTypeRepository', $petTypeRepository);

        $this->subject->createAction($petType);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenPetTypeToView()
    {
        $petType = new \ThomasWoehlke\T3petclinic\Domain\Model\PetType();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('petType', $petType);

        $this->subject->editAction($petType);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenPetTypeInPetTypeRepository()
    {
        $petType = new \ThomasWoehlke\T3petclinic\Domain\Model\PetType();

        $petTypeRepository = $this->getMockBuilder(\ThomasWoehlke\T3petclinic\Domain\Repository\PetTypeRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $petTypeRepository->expects(self::once())->method('update')->with($petType);
        $this->inject($this->subject, 'petTypeRepository', $petTypeRepository);

        $this->subject->updateAction($petType);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenPetTypeFromPetTypeRepository()
    {
        $petType = new \ThomasWoehlke\T3petclinic\Domain\Model\PetType();

        $petTypeRepository = $this->getMockBuilder(\ThomasWoehlke\T3petclinic\Domain\Repository\PetTypeRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $petTypeRepository->expects(self::once())->method('remove')->with($petType);
        $this->inject($this->subject, 'petTypeRepository', $petTypeRepository);

        $this->subject->deleteAction($petType);
    }
}
