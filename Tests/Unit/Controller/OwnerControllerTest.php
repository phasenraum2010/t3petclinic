<?php
namespace ThomasWoehlke\T3petclinic\Tests\Unit\Controller;

/**
 * Test case.
 *
 * @author Thomas Woehlke <thomas@woehlke.org>
 */
class OwnerControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
    /**
     * @var \ThomasWoehlke\T3petclinic\Controller\OwnerController
     */
    protected $subject = null;

    protected function setUp()
    {
        parent::setUp();
        $this->subject = $this->getMockBuilder(\ThomasWoehlke\T3petclinic\Controller\OwnerController::class)
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
    public function listActionFetchesAllOwnersFromRepositoryAndAssignsThemToView()
    {

        $allOwners = $this->getMockBuilder(\TYPO3\CMS\Extbase\Persistence\ObjectStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $ownerRepository = $this->getMockBuilder(\ThomasWoehlke\T3petclinic\Domain\Repository\OwnerRepository::class)
            ->setMethods(['findAll'])
            ->disableOriginalConstructor()
            ->getMock();
        $ownerRepository->expects(self::once())->method('findAll')->will(self::returnValue($allOwners));
        $this->inject($this->subject, 'ownerRepository', $ownerRepository);

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $view->expects(self::once())->method('assign')->with('owners', $allOwners);
        $this->inject($this->subject, 'view', $view);

        $this->subject->listAction();
    }

    /**
     * @test
     */
    public function showActionAssignsTheGivenOwnerToView()
    {
        $owner = new \ThomasWoehlke\T3petclinic\Domain\Model\Owner();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('owner', $owner);

        $this->subject->showAction($owner);
    }

    /**
     * @test
     */
    public function createActionAddsTheGivenOwnerToOwnerRepository()
    {
        $owner = new \ThomasWoehlke\T3petclinic\Domain\Model\Owner();

        $ownerRepository = $this->getMockBuilder(\ThomasWoehlke\T3petclinic\Domain\Repository\OwnerRepository::class)
            ->setMethods(['add'])
            ->disableOriginalConstructor()
            ->getMock();

        $ownerRepository->expects(self::once())->method('add')->with($owner);
        $this->inject($this->subject, 'ownerRepository', $ownerRepository);

        $this->subject->createAction($owner);
    }

    /**
     * @test
     */
    public function editActionAssignsTheGivenOwnerToView()
    {
        $owner = new \ThomasWoehlke\T3petclinic\Domain\Model\Owner();

        $view = $this->getMockBuilder(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface::class)->getMock();
        $this->inject($this->subject, 'view', $view);
        $view->expects(self::once())->method('assign')->with('owner', $owner);

        $this->subject->editAction($owner);
    }

    /**
     * @test
     */
    public function updateActionUpdatesTheGivenOwnerInOwnerRepository()
    {
        $owner = new \ThomasWoehlke\T3petclinic\Domain\Model\Owner();

        $ownerRepository = $this->getMockBuilder(\ThomasWoehlke\T3petclinic\Domain\Repository\OwnerRepository::class)
            ->setMethods(['update'])
            ->disableOriginalConstructor()
            ->getMock();

        $ownerRepository->expects(self::once())->method('update')->with($owner);
        $this->inject($this->subject, 'ownerRepository', $ownerRepository);

        $this->subject->updateAction($owner);
    }

    /**
     * @test
     */
    public function deleteActionRemovesTheGivenOwnerFromOwnerRepository()
    {
        $owner = new \ThomasWoehlke\T3petclinic\Domain\Model\Owner();

        $ownerRepository = $this->getMockBuilder(\ThomasWoehlke\T3petclinic\Domain\Repository\OwnerRepository::class)
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();

        $ownerRepository->expects(self::once())->method('remove')->with($owner);
        $this->inject($this->subject, 'ownerRepository', $ownerRepository);

        $this->subject->deleteAction($owner);
    }
}
