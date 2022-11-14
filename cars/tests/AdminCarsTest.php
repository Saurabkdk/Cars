<?php

class AdminCarsTest extends \PHPUnit\Framework\TestCase
{
    public function mockBuild(){
        return $this->getMockBuilder('\classes\DatabaseController')->getMock();
    }

    public function testCarInsert(){
        $testDataAdminCar = [
            'car' => [
                'name' => 'Buggati',
                'price' => '300000',
                'manufacturerId' => '2',
                'description' => 'Good'
            ],
            'carDesc' => [
                'mileage' => '20',
                'engine' => 'Nitro'
            ]
        ];

        $tableOfCars = $this->mockBuild();
        $tableOfCars->expects($this->once())
            ->method('saveData')
            ->with($this->equalTo($testDataAdminCar['car']));

        $tableOfManufacturers = $this->mockBuild();
        $tableOfManufacturers->expects($this->once())
            ->method('getAll')
            ->with();

        $tableOfArchives = $this->mockBuild();
        $tableOfArchives->expects($this->once())
            ->method('addData')
            ->with($this->equalTo($testDataAdminCar['car']));

        $tableOfCarDescs = $this->mockBuild();
        $tableOfCarDescs->expects($this->once())
            ->method('saveData')
            ->with($this->equalTo($testDataAdminCar['carDesc']));

        $tableOfImages = $this->mockBuild();
        $tableOfImages->expects($this->once())
            ->method('saveData')
            ->with($this->equalTo($testDataAdminCar['car']));

        $AdminCar = new \controllers\controller\AdminCars($tableOfCars, $tableOfManufacturers, $tableOfArchives, $tableOfCarDescs, $tableOfImages, [], $testDataAdminCar);

        $parinam = $AdminCar->addEditFillUp();
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    public function testCarUpdate(){
        $testDataAdminCar = [
            'car' => [
                'id' => '2',
                'name' => 'Buggati',
                'price' => '300000',
                'manufacturerId' => '2',
                'description' => 'Good'
            ],
            'carDesc' => [
                'mileage' => '20',
                'engine' => 'Nitro'
            ]
        ];

        $tableOfCars = $this->mockBuild();
        $tableOfCars->expects($this->once())
            ->method('saveData')
            ->with($this->equalTo($testDataAdminCar['car']));

        $tableOfManufacturers = $this->mockBuild();
        $tableOfManufacturers->expects($this->once())
            ->method('getAll')
            ->with();

        $tableOfArchives = $this->mockBuild();
        $tableOfArchives->expects($this->once())
            ->method('addData')
            ->with($this->equalTo($testDataAdminCar['car']));

        $tableOfCarDescs = $this->mockBuild();
        $tableOfCarDescs->expects($this->once())
            ->method('saveData')
            ->with($this->equalTo($testDataAdminCar['carDesc']));

        $tableOfImages = $this->mockBuild();
        $tableOfImages->expects($this->once())
            ->method('saveData')
            ->with($this->equalTo($testDataAdminCar['car']));

        $AdminCar = new \controllers\controller\AdminCars($tableOfCars, $tableOfManufacturers, $tableOfArchives, $tableOfCarDescs, $tableOfImages, [], $testDataAdminCar);

        $parinam = $AdminCar->addEditFillUp();
        $this->assertEquals($parinam['pageTemplate'], 'displayInformation.html.php');

    }

    public function testCarDelete(){
        $id = [
            'id' => 2
        ];
        $tableOfCars = $this->mockBuild();
        $tableOfCars->expects($this->once())
            ->method('deleteData')
            ->with($this->equalTo($id));

        $tableOfManufacturers = $this->mockBuild();
        $tableOfManufacturers->expects($this->once())
            ->method()
            ->with();

        $tableOfArchives = $this->mockBuild();
        $tableOfArchives->expects($this->once())
            ->method()
            ->with();

        $tableOfCarDescs = $this->mockBuild();
        $tableOfCarDescs->expects($this->once())
            ->method()
            ->with();

        $tableOfImages = $this->mockBuild();
        $tableOfImages->expects($this->once())
            ->method()
            ->with();

        $AdminCar = new \controllers\controller\AdminCars($tableOfCars, $tableOfManufacturers, $tableOfArchives, $tableOfCarDescs, $tableOfImages, $id []);

        $parinam = $AdminCar->deleteFillUp();
        $this->assertEquals($parinam['pageTemplate'], '');

    }

}