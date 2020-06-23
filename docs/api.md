# API
## Routes

### Task ###

#### GET /getTask/{taskId} ####

[Response](#GET-getTask-body)

#### GET /getTasksOfList/{listId} ####

[Response](#GET-getTasksOfList-body)

#### POST /addOrUpdateTask ####

[Body](#POST-addOrUpdateTask-body)\
Response: none\
Info: If id is null, create new task

### Tasklist ###

#### GET /getAllLists ####

[Response](#GET-getAllLists-body)

#### POST /addOrUpdateList ####

[Body](#POST-addOrUpdateList-body)\
Response: none

## Request bodies ##

### POST addOrUpdateTask body ###

(in work)

```json
{
   "id":"id",
    "name":"name",
    "duedate":"duedate",
    "description":"description",
    "weight":"weight",
    "state":"state"
}
```

### POST addOrUpdateList body ###

```json
{
   "id": "id",
   "name": "name",
}
```

## Response bodies ##

### GET getTask body ###

```json
{
    "id":"id",
    "name":"name",
    "duedate":"duedate",
    "description":"description",
    "weight":"weight",
    "state":"state"
}
```

### GET getTasksOfList body ###

(in work)

```json
[
    {
        "id":"id",
        "name":"name",
        "duedate":"duedate",
        "description":"description",
        "weight":"weight",
        "state":"state"
    },
    {
        "id":"id",
        "name":"name",
        "duedate":"duedate",
        "description":"description",
        "weight":"weight",
        "state":"state"
    }
]
```

### GET getAllLists body ###

```json
[
    {
        "id":"id",
        "name":"name",
        "tasks":
        [
            { 
                "[task](#GET-getTask-body)" 
            },
            { 
                "[task](#GET-getTask-body)" 
            }
        ]
    },
    {
        "id":"id",
        "name":"name",
        "tasks":
        [
            { 
                "[task](#GET-getTask-body)" 
            }
        ]
    }
]
```
