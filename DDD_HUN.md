# DDD

## Clean Architekcture (Onion Architecture, Hexagonal Architecture)
![](cleen-architecture.png)

![](onion-architecture.png)


## Építőkockák

### Bounded context


### Entity

Midig van egy Id-je
Id alapján történik az összehasonlítás és a perzisztálás
Modósítható

Entity validáció:
- egy érték esetén pld email setterbe

```php
class City extends Entity
{
	$id
	$name
	$zip
...

	protected function setZip($zip)
	{
		if(strlen($zip) !== 4)
			throw new Exception('Írányítószám nem valid');
			
		$this->zip = $zip;
	}
}
```

- ha az entity-t egyben kell akkor kell egy validátor osztály

```php
class CityValidator
{
	public validate(City $city)
	{
		$city2 = $this->cityZipService->getCityFromZip($city->getZip());
		if($city2 === null || $city->getId() != $city2->getId()
			return false;
		return true;
	}
}
```

### Value object

Adatokat tárolnak, az értékei nem változhatnak.
Két value object-et összehasonlítása az értékei alapján törétnik, tehát hiába két különböző referencia de az értékei ugyan azok akkor a két ojektumot azonosnak tekintjük.

Value objectek tartalmazhatnak value object(ket), vagy atomi értékeket, de mást nem.

Ha value objectnél mindig a setter-be kerül a validáció.

Value ob

Példa:

Egy felhasználó címe, ha változik akkor egy teljesen új készül belőle nem pedig a régit módosítjuk és ezt hozzárendeljük a felhasználóhoz.

Money Value object, ami tartalmaz egy Currency Value object-et.
Money currency értékét nem változtathatjuk, csak úgy a amount-ot is változtatjuk hisz szorosan összefügg.
Ezt úgy tudjuk megvalósítani hogy egy funckiót hívumnk meg a kívánt értékmódítással, ami egy új value objectet add vissza (számított értékkekkel)
```php
class Money
{
...
	public function incraseAmount($amount)
	{
		return new self($this->getAmount()+$amount,$this->getCurrency());
	}
...
}
```

### Aggregate

Gyökér entity pld rendelés ami rendlés item entity-ket tartalmaz.

A rendelés item entity-knek önnmagukban nincs értelmük (nem tartalmazhatnak bussines logikát) ezért hozzájuk csak egy aggregate-en keresztül lehet hozzáférni.

A repository ilyen Aggregate-tel tér vissza (az OrderItem-hez nem baj ha van repository de csak indokolt esetben)

perzisztálás atomi azaz mind a root entity mind a c

```php
class OrderItem extends Entity
{
	$id;
	$amount
	$productId;
	...

}


class Order extends Aggregate
{
	$items;
	$userId;
	$shopId;
	...
	
	public __construct($userId,$shopId)
	{
		$this->setUserId($userId);
		$this->setShopId($shopId);
	}
	
	
	public function addItem($productId, $amount)
	{
		$this->items->add(new OrderItem($productId, $amount));
	}
	
	...

}


class OrderApplicationSerrvice
{


	public function addOrderItemToOrder(OrderItemDto $orderItem)
	{
		...
		// ez példa de nem tökéletes, az komplex példánál a helyes megoldás
		$order->addItem($orderItem->getProductId(),$orderItem->getAmount());
		...

	}
...

}


```

### Repository

Entity-ket vagy Aggregate-eket rak bele és add vissza halmazból (pld adatbázis)

### Factory

Factory design pattern

Általában (bonyolult) Aggregete-et állít elő.
Ha egyszerű az Aggregate azt inkább constructorral állítsuk elő.


### Services

Üzleti logika van

### További kifejezések

#### Dependency injection


#### DTO - DataTransferObject
- egyszerű objektumok
- feladata az adatok továbbítása két réteg között


## Services


### Application Service

Faladata: ha valaki intterakcióba akar lépni a domainnel ezen keresztűl teheti meg.

Szinte mindig a controllerbe hívom meg.
Egy DTO-t adok át neki és DTO-t kapok vissza, azért mert a controller-ben nem lehetnek domain dolgok mert semmi köze hozzá (üzelti logika nem a contoller-ben van)

### Domain Service

Feladata: Komplex Domain műveleteket végez, paraméterei DDD építőkockák lehetnek és Entity-t vagy Value objectet ad vissza

Akkor használjuk ha,
- több repository-ból kell adatokat lekérdezni hozzá


### Infrastructure Service

Feladata: Minden olyan dolog ami az infrastruktúrába tartozik

Példa: 
EmailInfrastructureService- Email küldése.


### Komplex példa

```php
class OrderItem extends Entity
{
	$id;
	$amount
	$productId;
	...

}

class User
{
	$id;
	
	...
	
	public function makeOrder($shopId)
	{
		return new Order($this->getId(),$shopId);
	}
	
	...
}

class Order extends Aggregate
{
	$items;
	$userId;
	$shopId;
	...
	
	public __construct($userId,$shopId)
	{
		$this->setUserId($userId);
		$this->setShopId($shopId);
	}
	
	
	public function addItem($productId, $amount)
	{
		$this->items->add(new OrderItem($productId, $amount));
	}
	
	...

}


class OrderApplicationSerrvice
{

	public function addOrderItemToOrder(OrderItemDto $orderItem)
	{
		$order = null;
		
		if($orderItem->getOrderId() === null)
		{
			$user = $this->getCurrentUser();
			$order = $user->makeOrder($this->getCurrentShopId());
		}
		else
		{
			$order = $this->orderRepository->get($orderItem->getOrderId());
		}
		if($order === null(
			throw new OrderDoesNotExistExeption();
		
		$order = $this->orderDomainService->addItem($order,$orderItem->getProductId(),$orderItem->getAmount());
		$response = new OrderResponse();
		$response->fromDomain($order);
		return $repsonse;

	}
	public function orderDone($orderDoneDto $orderDto)
	{
	
		$order = $this->orderRepository->get($orderDto->getId());
		
		if($order === null)
			throw new OrderDoesNotExistExeption();
	
		$orderValidator = OrderDoneValidator($order);
		$orderValidator->validate();
		
		$this->orderDomainService->orderDone($order);
		
		$this->emailService->sendEmail($this->getCurrentUser()->email, (new OrderEamilPresenter($order))->present());
	}
	
...

}


class OrderDomainService
{

	public function addOrderItemToOrder(Order $order, $productId,  $amount)
	{

		$product = $this->productRepository->get($productId);
		
		if($product === null)
			throw new ProductNotFoundException();
		
		if($product->getStoreAmount() < $amount)
			throw new ProductNotEnoughInStoreException();
		
		
		$order->addItem($productId, $amount);
				
		$this->orderRepository->store($order);
		
		$this->productRepository->reservation($productId, $amount,$order->getId());
		
		return $order;

	}


}


```

