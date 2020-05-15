# API
## Routes

### User ###

#### GET /getUser/{userId} ####

[Response](#GET-getUser-body)

### Task ###

#### GET /getTasksOfList/{listId} ####

[Response](#POST-getTasksOfList-body)

#### GET /getTaskById/{taskId} ####

Response: (todo)

#### POST /addOrUpdateTask ####

[Body](#POST-addOrUpdateTask-body)
Response: none
Info: If id is null, create new task

### Tasklist ###

#### GET /getListsByUserId/{userId} ####

[Response](#POST-getListsByUserId-body)

#### POST /addOrUpdateList ####

[Body](#POST-addOrUpdateList-body)
Response: none

## Request bodies ##

### POST addOrUpdateList body ###

```json
{
   "id": id,
   "name": name,
}
```

### POST addOrUpdateTask body ###

(in work)

```json
{
   "task"
}
```

## Response bodies ##

### POST getListsByUserId body ###

(in work)

```json
[
    {
        "tasks":
        [
            { "task" },
            { "task" }
        ]
    },
    {
        "tasks":
        [
            {"task" }
        ]
    }
]
```

### GET getUser body ###

```json
{
   "id": id,
   "name": name,
   "password": password
}
```

### GET getTasksOfList body ###

(in work)

```json
[
    {
        "task"
    },
    {
        "task"
    }
]
```
