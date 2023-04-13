<?php
require_once('Database.php');
require_once('Queries.php');
session_start();

class Product
{
    protected $id;
    protected $name;
    protected $price;
    protected $quantity;
    protected $imagePath;
    protected $RAM;
    protected $storageCapacity;
    protected $screenSize;
    protected $processorType;
    protected $processorSpeed;
    protected $opticalSensorResolution;
    protected $weight;
    protected $dimension;
    protected $manufacturer;
    protected $os;

    protected $pdo;

    public function __construct(
        $id = null,
        $name = null,
        $price = null,
        $quantity = null,
        $imagePath = null,
        $RAM = null,
        $storageCapacity = null,
        $screenSize = null,
        $processorType = null,
        $processorSpeed = null,
        $opticalSensorResolution = null,
        $weight = null,
        $dimension = null,
        $manufacturer = null,
        $os = null
    ) {
        if (!$this->pdo) $this->pdo = Database::getConnection();
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->imagePath = $imagePath;
        $this->RAM = $RAM;
        $this->storageCapacity = $storageCapacity;
        $this->screenSize = $screenSize;
        $this->processorType = $processorType;
        $this->processorSpeed = $processorSpeed;
        $this->opticalSensorResolution = $opticalSensorResolution;
        $this->weight = $weight;
        $this->dimension = $dimension;
        $this->manufacturer = $manufacturer;
        $this->os = $os;
    }

    // Getter methods
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getImagePath()
    {
        return $this->imagePath;
    }

    public function getRAM()
    {
        return $this->RAM;
    }

    public function getStorageCapacity()
    {
        return $this->storageCapacity;
    }

    public function getScreenSize()
    {
        return $this->screenSize;
    }

    public function getProcessorType()
    {
        return $this->processorType;
    }

    public function getProcessorSpeed()
    {
        return $this->processorSpeed;
    }

    public function getOpticalSensorResolution()
    {
        return $this->opticalSensorResolution;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function getDimension()
    {
        return $this->dimension;
    }

    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    public function getOS()
    {
        return $this->os;
    }

    // Setter methods
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;
    }

    public function setRAM($RAM)
    {
        $this->RAM = $RAM;
    }

    public function setStorageCapacity($storageCapacity)
    {
        $this->storageCapacity = $storageCapacity;
    }

    public function setScreenSize($screenSize)
    {
        $this->screenSize = $screenSize;
    }

    public function setProcessorType($processorType)
    {
        $this->processorType = $processorType;
    }

    public function setProcessorSpeed($processorSpeed)
    {
        $this->processorSpeed = $processorSpeed;
    }

    public function setOpticalSensorResolution($opticalSensorResolution)
    {
        $this->opticalSensorResolution = $opticalSensorResolution;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function setDimension($dimension)
    {
        $this->dimension = $dimension;
    }

    public function setManufacturer($manufacturer)
    {
        $this->manufacturer = $manufacturer;
    }

    public function setOS($os)
    {
        $this->os = $os;
    }


    public function getProductList()
    {
        $products = array();
        try {
            $stmt = $this->pdo->prepare(Queries::$productListQuery);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($products, new Product(
                    $row['id'],
                    $row['name'],
                    $row['price'],
                    "",
                    $row['image_path'],
                    $row['ram'],
                    $row['storage_capacity'],
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    $row['manufacturer'],
                    $row['OS']
                ));
            }
        } catch (Exception $ex) {
        }
        return $products;
    }

    public function getProduct($argProductName)
    {
        $product = array();
        try {
            $stmt = $this->pdo->prepare(Queries::$productResultQuery);
            $stmt->execute(["productName" => "%$argProductName%"]);
            $numRow =$stmt->rowCount();
            echo $numRow;
            if ( $numRow > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    array_push($product, new Product(
                        $row['id'],
                        $row['name'],
                        $row['price'],
                        "",
                        $row['image_path'],
                        $row['ram'],
                        $row['storage_capacity'],
                        "",
                        "",
                        "",
                        "",
                        "",
                        "",
                        $row['manufacturer'],
                        $row['OS']

                    ));
                    echo "Good to go";
                    break;

                }

            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        return $product;
    }

    public function getProductById($argProductId)
    {
        $product = null;
        try {
            $stmt = $this->pdo->prepare(Queries::$productDetailQuery);
            $stmt->execute(["productId" => $argProductId]);
            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $product = new Product(
                    $row['id'],
                    $row['name'],
                    $row['price'],
                    $row['quantity'],
                    $row['image_path'],
                    $row['ram'],
                    $row['storage_capacity'],
                    $row['screen_size'],
                    $row['processor_type'],
                    $row['processor_speed'],
                    $row['optical_sensor_resolution'],
                    $row['weight'],
                    $row['dimension'],
                    $row['manufacturer'],
                    $row['OS']
                );
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
        return $product;
    }

    public function getfilterProductsByManufacturer($argManufacturerId)
    {
        $products = array();
        try {
            $stmt = $this->pdo->prepare(Queries::$productListQuery);
            $stmt->execute(["manufacturereId" => $argManufacturerId]);
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                array_push($products, new Product(
                    $row['id'],
                    $row['name'],
                    $row['price'],
                    "",
                    $row['image_path'],
                    $row['ram'],
                    $row['storage_capacity'],
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    $row['manufacturer'],
                    $row['OS']
                ));
            }
        } catch (Exception $ex) {
        }
        return $products;
    }

    public function getfilterProductsByOs($argOsId)
    {
        $products = null;
        try {
            $stmt = $this->pdo->prepare(Queries::$productListFilterByOSQuery);
            $stmt->execute(["osName" => $argOsId]);
            if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $product = new Product(
                    $row['id'],
                    $row['name'],
                    $row['price'],
                    "",
                    $row['image_path'],
                    $row['ram'],
                    $row['storage_capacity'],
                    "",
                    "",
                    "",
                    "",
                    "",
                    "",
                    $row['manufacturer'],
                    $row['OS']
                );
            }
            // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //     array_push($products, new Product(
            //         $row['id'],
            //         $row['name'],
            //         $row['price'],
            //         "",
            //         $row['image_path'],
            //         $row['ram'],
            //         $row['storage_capacity'],
            //         "",
            //         "",
            //         "",
            //         "",
            //         "",
            //         "",
            //         $row['manufacturer'],
            //         $row['OS']
            //     ));
            // }
        } catch (Exception $ex) {
        }
        return $products;
    }
}
