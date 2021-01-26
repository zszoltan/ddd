# DDD

## Clean Architekcture (Onion Architecture, Hexagonal Architecture)
![](clean-architecture.png)

![](onion-architecture.png)


## Építőkockák


### Entity

Midig van egy Id-je
Id alapján történik az összehasonlítás és a perzisztálás
Modósítható

Entity validáció:
- egy érték esetén pld email setterbe
- ha az entity-t egyben kell akkor kell egy validátor osztály
```php
class City extends Entity
{
	$id
	$name
	$zip

}
```

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

### Repository

Entity-ket add vissza Entity store-okból (pld adatbázis)

### Factory

Factory design pattern

### Services

Üzleti logika van

##További Kifejezések
Dependency injection
DTO


## Services


### Application Service

Faladata:

### Domain Service

Feladata:

### Infrastructure Service

Feladata:

Példa: 
EmailInfrastructureService
Email küldése.




