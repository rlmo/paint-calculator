# Paint Calculator - Developed by [rlmo](https://github.com/rlmo)

## Objective
An application that helps the user calculate the amount of paint needed to paint a room.
The user fills in each of the dimensions of the four walls and how many doors and windows they have, and the app informs how many cans of paint are needed for painting.

## Project
The project is composed of a [Laravel](https://laravel.com/) API (server-app) and a [Vue.js](https://vuejs.org/) app (vue-app).
It uses Docker Compose to run both apps.

## Installing and running the app

### Prerequisites
You need [Docker](https://www.docker.com/) and [Docker Compose](https://docs.docker.com/compose/) to run the app.

### Installing and running
- With Docker running, execute the following command in the root directory of the project to build the images and create the containers:
```
  docker-compose up -d
```
- After the containers are created, execute the following command in the root directory to install the Node dependencies and start the Vue app:
```
  docker exec -it paint-calculator-vue-app /bin/sh ./install-dependencies.sh
```
- When the command above finishes, you can access the application at: http://localhost:9000

## API
-  If you want to use the API without the frontend interface, you use the host: http://localhost:8000 with the following endpoints:

| Method | Endpoint | Payload | Description |
| - | - | - | - |
| GET | /api/door/info | | Returns door size and associated rules |
| GET | /api/window/info | | Returns window size and associated rules |
| GET | /api/paint-can/info | | Returns paint can sizes |
| GET | /api/wall/rules | | Returns associated wall rules |
| POST | /api/paintWalls | (Check example below) | Returns the amount of paint needed or errors for each wall |

POST /api/paintWalls payload example:

```json
{
    "1": {
        "height": "3",
        "width": "12",
        "doors": "0",
        "windows": "0"
    },
    "2": {
        "height": "3",
        "width": "15",
        "doors": "0",
        "windows": "1"
    },
    "3": {
        "height": "3",
        "width": "12",
        "doors": "1",
        "windows": "0"
    },
    "4": {
        "height": "3",
        "width": "15",
        "doors": "1",
        "windows": "1"
    }
}
```

Successful example response:
```json
{
    "paintArea": 154.15999999999997,
    "litersNeeded": 30.83,
    "paintCans": {
        "18": 1,
        "3.6": 3,
        "2.5": 0,
        "0.5": 5
    }
}
```

Error example response:
```json
[
    {
        "errors": 1,
        "errorMessages": [
            "Parede 2: A altura de paredes com porta deve ser, no mínimo, 0.3 metros maior que a altura da porta."
        ],
        "wallNumber": 2
    },
    {
        "errors": 1,
        "errorMessages": [
            "Parede 3: Área da parede deve ter no mínimo 1 metro quadrado e no máximo 50."
        ],
        "wallNumber": 3
    },
    {
        "errors": 1,
        "errorMessages": [
            "Parede 4: O total de área das portas e janelas deve ser no máximo 50% da área de parede."
        ],
        "wallNumber": 4
    }
]
```