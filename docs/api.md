# API
## Routes

### User ###

#### GET /getUser/{userId} ####

[Response](#GET-getUser-body)

### Task ###

#### GET /getTasksOfList/{listId} ####

[Response](#GET-getTasksOfList-body)

#### GET /getTaskById/{taskId} ####

[Response](#GET-getTaskById-body)

#### POST /addOrUpdateTask ####

[Body](#POST-addOrUpdateTask-body)\
Response: none\
Info: If id is null, create new task

### Tasklist ###

#### GET /getListsByUserId/{userId} ####

[Response](#POST-getListsByUserId-body)

#### POST /addOrUpdateList ####

[Body](#POST-addOrUpdateList-body)\
Response: none

## Request bodies ##

### POST addOrUpdateTask body ###

(in work)

```json
{
   "task"
}
```

### POST addOrUpdateList body ###

```json
{
   "id": id,
   "name": name,
}
```

## Response bodies ##

### GET getUser body ###

```json
{
   "id": id,
   "name": name,
   "password": password
}
```

### GET getTaskById body ###
(in work)

```json
{
    "task"
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
