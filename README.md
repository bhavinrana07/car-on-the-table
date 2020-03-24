# Toy Car App using Symfony Frontend and Backend(API)

The application is a simulation of a toy car moving on a square tabletop, of
dimensions 5 units x 5 units. There are no other obstructions on the table surface.

The car is free to roam around the surface of the table, but must be prevented from
falling to destruction. Any movement that would result in the car falling from the
table must be prevented, however further valid movement commands must still be
allowed.

## Installation

- drop the project in your localhost folder/ docker conainer and access the project with url.

## Technology
- PHP Symfony Open source Framework
- Symfony FOSUserBundle
- Bootstap
- CSS, Jquery and jaavscript 


## WorkFlow
- API is buid with using Syumfony standard http components
- Front end is build with using Bootstap Javascript CSS and JQuery 
- to strat playing with the toy Car you need to select X,Y and F (Facing, e.g. North)
- once you initialize the starting point you can see that car is visible on the starting point you selevted 
- and then you can use, Move 1 Step, Move Left Move Right Comands to move car around the table cloth
- if you try to move the car out of the table clothes you wil get warnings.


### Preview
## Explaining one
![UI output](screens/01.gif)

## Explaining two
![UI output](screens/02.gif)

## Explaining three
![UI output](screens/03.gif)


## Explaining mobile
![UI output](screens/mobile-view.gif)


## API Endpoints
### GET
##### get accounts
```yaml
'GET' accounts-with-txt-file/public/api/accounts
```
##### response
```yaml
[
    {
        "name": "user1.txt",
        "balance": "9900"
    },
    {
        "name": "user2.txt",
        "balance": "10100"
    }
]
```
##### reset accounts
```yaml
'GET' accounts-with-txt-file/public/api/resetAccounts
```
##### response
```yaml
[
    {
        "name": "user1.txt",
        "balance": "10000"
    },
    {
        "name": "user2.txt",
        "balance": "10000"
    }
]
```
### POST
##### amount transfer
```yaml
'POST' accounts-with-txt-file/public/api/transfer
```

##### request
```yaml
{
    "transfer_from": "1",
    "transfer_to": "2",
    "amount": "500"
}
```
##### response
```yaml
[
    {
        "name": "user1.txt",
        "balance": "9500"
    },
    {
        "name": "user2.txt",
        "balance": "10500"
    }
]
```


